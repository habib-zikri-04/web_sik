<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;
use App\Models\Subject;

class GuruDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pengajar = $user->pengajar;

        if (!$pengajar) {
            return view('guru.dashboard', [
                'jadwals' => collect(),
                'rekap'   => collect(),
                'rekapMengaji' => null,
                'adaJadwalHariIni' => false,
            ]);
        }

        $jadwalGroups = Jadwal::with(['subject', 'kelas'])
            ->where('pengajar_id', $pengajar->id)
            ->get()
            ->groupBy(fn ($j) =>
                $j->subject_id.'|'.
                $j->kelas_id.'|'.
                $j->jam_mulai.'|'.
                $j->jam_selesai.'|'.
                $j->ruang
            );

        $rekap = collect();

        foreach ($jadwalGroups as $group) {
            $first = $group->first();
            $total = $group->count();
            $hadir = Absensi::where('user_id', $user->id)
                ->where('status', 'hadir')
                ->whereIn('jadwal_id', $group->pluck('id'))
                ->count();

            $rekap->push([
                'subject' => $first->subject->nama,
                'kelas'   => $first->kelas->nama ?? 'Umum',
                'jam'     => "{$first->jam_mulai} - {$first->jam_selesai}",
                'hadir'   => $hadir,
                'total'   => $total,
                'persen'  => $total > 0 ? round(($hadir / $total) * 100, 2) : 0,
            ]);
        }

        // --- REKAP KHUSUS MENGAJI ---
        $mengajiSubject = Subject::where('kode', 'MGJ')->first();
        $rekapMengaji = null;
        if ($mengajiSubject) {
            $jadwalMengaji = Jadwal::where('subject_id', $mengajiSubject->id)->get();
            $totalMengaji = $jadwalMengaji->count();
            $hadirMengaji = Absensi::where('user_id', $user->id)
                ->where('status', 'hadir')
                ->whereIn('jadwal_id', $jadwalMengaji->pluck('id'))
                ->count();
                
            $rekapMengaji = [
                'total' => $totalMengaji,
                'hadir' => $hadirMengaji,
                'persen' => $totalMengaji > 0 ? round(($hadirMengaji / $totalMengaji) * 100, 1) : 0
            ];
        }

        // Check if there's any schedule FOR TODAY for this guru (teaching OR Mengaji)
        $adaJadwalHariIni = Jadwal::where('tanggal', now()->toDateString())
            ->where(function($q) use ($pengajar, $mengajiSubject) {
                $q->where('pengajar_id', $pengajar->id);
                if ($mengajiSubject) {
                    $q->orWhere('subject_id', $mengajiSubject->id);
                }
            })->exists();

        return view('guru.dashboard', [
            'jadwals' => $jadwalGroups,
            'rekap'   => $rekap,
            'rekapMengaji' => $rekapMengaji,
            'adaJadwalHariIni' => $adaJadwalHariIni,
        ]);
    }
}
