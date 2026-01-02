<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Pengajar;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with(['pengajar', 'santris', 'jadwals.pengajar'])->orderBy('nama')->get();
        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('admin.kelas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kelas,nama',
            'kode' => 'nullable|string|max:20|unique:kelas,kode',
            'pengajar_id' => 'nullable|exists:pengajars,id',
        ]);

        Kelas::create($validated);

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function edit(Kelas $kela)
    {
        return view('admin.kelas.edit', compact('kela'));
    }

    public function show(Kelas $kela)
    {
        $kela->load(['pengajar', 'santris.user', 'jadwals.pengajar', 'jadwals.subject']);
        
        // Get unique pengajars teaching this class from jadwal
        $pengajarsMengajar = $kela->jadwals
            ->filter(fn($j) => $j->pengajar)
            ->groupBy('pengajar_id')
            ->map(function($jadwals) {
                $first = $jadwals->first();
                return [
                    'pengajar' => $first->pengajar,
                    'subjects' => $jadwals->map(fn($j) => $j->subject?->nama)->unique()->filter()->values()
                ];
            })->values();
        
        return view('admin.kelas.show', compact('kela', 'pengajarsMengajar'));
    }

    public function update(Request $request, Kelas $kela)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kelas,nama,' . $kela->id,
            'kode' => 'nullable|string|max:20|unique:kelas,kode,' . $kela->id,
            'pengajar_id' => 'nullable|exists:pengajars,id',
        ]);

        $kela->update($validated);

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil diperbarui!');
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();

        return redirect()->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil dihapus!');
    }
}
