<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class RekapAbsensiController extends Controller
{
    public function index(Request $request): View
    {
        $jadwalId = $request->query('jadwal_id');

        $jadwals = Jadwal::orderBy('tanggal', 'desc')->get();

        $query = Absensi::with(['user'])
            ->when($jadwalId, function ($q) use ($jadwalId) {
                $q->where('jadwal_id', $jadwalId);
            });

        $rekap = [
            'santri'   => (clone $query)->where('role', 'santri')->get(),
            'guru'     => (clone $query)->where('role', 'guru')->get(),
            'civitas'  => (clone $query)->where('role', 'civitas')->get(),
        ];

        return view('admin.rekap-absensi.index', compact(
            'rekap',
            'jadwals',
            'jadwalId'
        ));
    }

    public function downloadPdf(Request $request, string $role)
{
    $subjects = Subject::all();
    $rekap = [];

    // ... (rest of the logic remains same, just need to update signature and return)
    // Actually I need to check where to put the return.
    // The role logic is long, I should only change the tail returns.
    // Wait, let's just do it for the whole method or specific parts.
    
    // I will replace only the return statements for each role.

    // ================= SANTRI =================
    if ($role === 'santri') {

        $users = User::where('role', 'santri')->with('santri')->get();

        foreach ($users as $user) {
            $kelasId = optional($user->santri)->kelas_id;

            foreach ($subjects as $subject) {

                $total = Jadwal::where('subject_id', $subject->id)
                    ->when($subject->kode !== 'MGJ', fn ($q) =>
                        $q->where('kelas_id', $kelasId)
                    )
                    ->count();

                if ($total === 0) {
                    continue;
                }

                $hadir = Absensi::where('user_id', $user->id)
                    ->where('status', 'hadir')
                    ->whereHas('jadwal', function ($q) use ($subject, $kelasId) {
                        $q->where('subject_id', $subject->id);

                        if ($subject->kode !== 'MGJ') {
                            $q->where('kelas_id', $kelasId);
                        }
                    })
                    ->count();

                $persen = round(($hadir / $total) * 100, 2);

                $rekap[] = [
                    'nama'   => $user->name,
                    'subject'=> $subject->nama,
                    'hadir'  => $hadir,
                    'total'  => $total,
                    'persen' => $persen,
                    'status' => $persen >= 80
                        ? 'Boleh Ujian'
                        : 'Tidak Boleh Ujian',
                ];
            }
        }

        $pdf = Pdf::loadView('admin.rekap-absensi.pdf.santri', compact('rekap'));
        if ($request->has('stream')) {
            return $pdf->stream('rekap-santri-per-subject.pdf');
        }
        return $pdf->download('rekap-santri-per-subject.pdf');
    }

    // ================= GURU & CIVITAS =================
    /*
    |--------------------------------------------------------------------------
    | REKAP GURU (PER SUBJECT + PER KELAS)
    |--------------------------------------------------------------------------
    */
    if ($role === 'guru') {

        $gurus = User::where('role', 'guru')
            ->with(['pengajar.subject'])
            ->get();

        $rekap = [];

        foreach ($gurus as $guru) {

            $pengajar = $guru->pengajar;
            if (!$pengajar || !$pengajar->subject) {
                continue;
            }

            $subject = $pengajar->subject;

            // ambil semua kelas yang pernah diajar guru ini
            $kelasList = Jadwal::where('pengajar_id', $pengajar->id)
                ->where('subject_id', $subject->id)
                ->with('kelas')
                ->get()
                ->pluck('kelas')
                ->unique('id');

            foreach ($kelasList as $kelas) {

                // total pertemuan guru di kelas ini
                $totalPertemuan = Jadwal::where('pengajar_id', $pengajar->id)
                    ->where('subject_id', $subject->id)
                    ->where('kelas_id', $kelas->id)
                    ->count();

                if ($totalPertemuan === 0) {
                    continue;
                }

                // jumlah hadir
                $hadir = Absensi::where('user_id', $guru->id)
                    ->where('status', 'hadir')
                    ->whereHas('jadwal', function ($q) use ($pengajar, $subject, $kelas) {
                        $q->where('pengajar_id', $pengajar->id)
                          ->where('subject_id', $subject->id)
                          ->where('kelas_id', $kelas->id);
                    })
                    ->count();

                $rekap[] = [
                    'nama'   => $guru->name,
                    'subject'=> $subject->nama,
                    'kelas'  => $kelas->nama,
                    'hadir'  => $hadir,
                    'total'  => $totalPertemuan,
                ];
            }
        }

        $pdf = Pdf::loadView(
            'admin.rekap-absensi.pdf.guru',
            compact('rekap')
        )->setPaper('a4', 'portrait');

        if ($request->has('stream')) {
            return $pdf->stream('rekap-guru-per-kelas.pdf');
        }
        return $pdf->download('rekap-guru-per-kelas.pdf');
    }

    /*
    |--------------------------------------------------------------------------
    | REKAP CIVITAS (PER SUBJECT, TANPA KELAS)
    |--------------------------------------------------------------------------
    */
    if ($role === 'civitas') {

    $civitas = User::where('role', 'civitas')->get();
    $subjects = Subject::all();

    $rekap = [];

    foreach ($civitas as $user) {
        foreach ($subjects as $subject) {

            // 🔹 hanya subject yang memang pernah ada absensi civitas
            $totalPertemuan = Jadwal::where('subject_id', $subject->id)
                ->whereHas('absensis', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->count();

            if ($totalPertemuan === 0) {
                continue; // ⛔ jangan tampilkan subject ini
            }

            $hadir = Absensi::where('user_id', $user->id)
                ->where('status', 'hadir')
                ->whereHas('jadwal', function ($q) use ($subject) {
                    $q->where('subject_id', $subject->id);
                })
                ->count();

            $rekap[] = [
                'nama'    => $user->name,
                'subject' => $subject->nama,
                'hadir'   => $hadir,
                'total'   => $totalPertemuan,
            ];
        }
    }

    $pdf = Pdf::loadView(
        'admin.rekap-absensi.pdf.civitas',
        compact('rekap')
    )->setPaper('a4', 'portrait');

    if ($request->has('stream')) {
        return $pdf->stream('rekap-civitas.pdf');
    }
    return $pdf->download('rekap-civitas.pdf');
}

    abort(404);
}

}
