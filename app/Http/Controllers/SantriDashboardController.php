<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class SantriDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $santri = $user->santri;

        /* =========================
         | 1. JADWAL (untuk card)
         ========================= */
        $jadwals = Jadwal::with(['subject', 'kelas'])
    ->where(function ($q) use ($santri) {
        $q->whereNull('kelas_id')
          ->orWhere('kelas_id', $santri->kelas_id);
    })
    ->orderBy('jam_mulai')
    ->get()
    ->unique('subject_id')   // 🔥 ini kuncinya
    ->take(4);               // 🔥 batasi 4 card saja


        /* =========================
         | 2. REKAP ABSENSI
         ========================= */
        $rekap = [];

        $subjects = Subject::all();

        foreach ($subjects as $subject) {

            $total = Jadwal::where('subject_id', $subject->id)
                ->when($subject->kode !== 'MGJ', function ($q) use ($santri) {
                    $q->where('kelas_id', $santri->kelas_id);
                })
                ->count();

            if ($total === 0) {
                continue;
            }

            $hadir = Absensi::where('user_id', $user->id)
                ->where('status', 'hadir')
                ->whereHas('jadwal', function ($q) use ($subject, $santri) {
                    $q->where('subject_id', $subject->id);

                    if ($subject->kode !== 'MGJ') {
                        $q->where('kelas_id', $santri->kelas_id);
                    }
                })
                ->count();

            $persentase = round(($hadir / $total) * 100, 2);

            $rekap[] = [
                'subject' => $subject->nama,
                'hadir' => $hadir,
                'total' => $total,
                'persentase' => $persentase,
                'status_ujian' => $persentase >= 80
                    ? 'Boleh Ujian'
                    : 'Tidak Boleh Ujian',
            ];
        }

        return view('santri.dashboard', compact('jadwals', 'rekap'));
    }
}
