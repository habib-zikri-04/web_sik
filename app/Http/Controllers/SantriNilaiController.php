<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\NilaiSantri;
use App\Models\Subject;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SantriNilaiController extends Controller
{
    public function index()
    {
        $santri = Auth::user()->santri;
        $kelasId = $santri->kelas_id;

        $subjects = Subject::all();
        $data = [];

        foreach ($subjects as $subject) {

            // ================= MENGAJI =================
            if ($subject->kode === 'MGJ') {

                $total = Jadwal::where('subject_id', $subject->id)
                    ->count();

                $hadir = Absensi::where('user_id', Auth::id())
                    ->where('status', 'hadir')
                    ->whereHas('jadwal', fn ($q) =>
                        $q->where('subject_id', $subject->id)
                    )
                    ->count();

                if ($total === 0) continue;

                $persen = round(($hadir / $total) * 100, 2);

                $data[] = [
                    'subject' => $subject,
                    'type'    => 'mengaji',
                    'hadir'   => $hadir,
                    'total'   => $total,
                    'persen'  => $persen,
                    'lulus'   => $persen >= 80,
                ];

                continue;
            }

            // ================= SUBJECT NILAI =================
            $nilai = NilaiSantri::where('santri_id', $santri->id)
                ->where('subject_id', $subject->id)
                ->where('kelas_id', $kelasId)
                ->first();

            if (!$nilai) continue;

            $data[] = [
                'subject'  => $subject,
                'type'     => 'nilai',
                'nilai'    => $nilai->nilai,
                'feedback' => $nilai->feedback,
                'lulus'    => $nilai->nilai >= 80,
            ];
        }

        return view('santri.nilai.index', compact('data'));
    }
    public function downloadSertifikat(Request $request, Subject $subject)
{
    $santri = Auth::user()->santri;

    // validasi ulang (WAJIB)
    // (logikanya sama persis dengan index)

    $pdf = Pdf::loadView('santri.sertifikat.pdf', compact(
        'santri',
        'subject'
    ))->setPaper('a4', 'landscape'); // Sertifikat biasanya landscape

    if ($request->has('stream')) {
        return $pdf->stream('sertifikat-'.$subject->kode.'.pdf');
    }

    return $pdf->download(
        'sertifikat-'.$subject->kode.'.pdf'
    );
}
}

