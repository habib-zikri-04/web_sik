<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NilaiSantri;
use App\Models\Kelas;
use App\Models\Subject;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RekapNilaiController extends Controller
{
    public function index(Request $request)
    {
        $query = NilaiSantri::with(['santri.user', 'kelas', 'subject'])
            ->whereHas('subject', function ($q) {
                $q->where('kode', '!=', 'MGJ');
            });

        // Filter by kelas
        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }

        // Filter by subject
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        // Search by name
        if ($request->filled('search')) {
            $query->whereHas('santri.user', function ($q) use ($request) {
                $q->where('name', 'ILIKE', '%' . $request->search . '%');
            });
        }

        $nilais = $query->orderBy('kelas_id')
            ->orderBy('subject_id')
            ->paginate(20);

        $kelasList = Kelas::orderBy('nama')->get();
        $subjectList = Subject::where('kode', '!=', 'MGJ')->orderBy('nama')->get();

        return view('admin.rekap-nilai.index', compact('nilais', 'kelasList', 'subjectList'));
    }

    public function downloadPdf(Request $request)
    {
        $nilais = NilaiSantri::with([
            'santri.user',
            'kelas',
            'subject',
        ])
        ->orderBy('kelas_id')
        ->orderBy('subject_id')
        ->get();

        $pdf = Pdf::loadView(
            'admin.rekap-nilai.pdf',
            compact('nilais')
        )->setPaper('a4', 'portrait');

        if ($request->has('stream')) {
            return $pdf->stream('rekap-nilai-santri.pdf');
        }

        return $pdf->download('rekap-nilai-santri.pdf');
    }
}
