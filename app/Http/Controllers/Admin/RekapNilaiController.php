<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NilaiSantri;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RekapNilaiController extends Controller
{
    public function index()
    {
        $nilais = NilaiSantri::with(['santri.user', 'kelas', 'subject'])
    ->whereHas('subject', function ($q) {
        $q->where('kode', '!=', 'MGJ');
    })
    ->orderBy('kelas_id')
    ->orderBy('subject_id')
    ->get();


        return view('admin.rekap-nilai.index', compact('nilais'));
    }

    public function downloadPdf()
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

        return $pdf->download('rekap-nilai-santri.pdf');
    }
}
