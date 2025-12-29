<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\NilaiSantri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class GuruNilaiController extends Controller
{
    public function index(Request $request)
{
    $guru = Auth::user()->pengajar;

    $jadwal = Jadwal::with(['kelas.santris.user', 'subject'])
        ->where('pengajar_id', $guru->id)
        ->where('id', $request->jadwal_id)
        ->firstOrFail();

    $kelas = $jadwal->kelas;
    $subject = $jadwal->subject;

    $santris = $kelas->santris()->with([
        'nilai' => function ($q) use ($subject, $kelas) {
            $q->where('subject_id', $subject->id)
              ->where('kelas_id', $kelas->id);
        }
    ])->get();

    return view('guru.nilai.index', compact(
        'jadwal',
        'santris',
        'subject',
        'kelas'
    ));
}

    public function store(Request $request)
{
    $request->validate([
        'santri_id' => 'required',
        'subject_id' => 'required',
        'kelas_id' => 'required',
        'nilai' => 'nullable|integer|min:0|max:100',
        'feedback' => 'nullable|string',
    ]);

    NilaiSantri::updateOrCreate(
        [
            'santri_id' => $request->santri_id,
            'subject_id' => $request->subject_id,
            'kelas_id' => $request->kelas_id,
        ],
        [
            'nilai' => $request->nilai,
            'feedback' => $request->feedback,
        ]
    );

    return back()->with('success', 'Nilai berhasil disimpan');
}

}
