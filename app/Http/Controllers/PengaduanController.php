<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Admin melihat semua pengaduan
            $pengaduans = Pengaduan::with(['reporter', 'santri'])
                ->latest()
                ->get();
        } else {
            // Guru/Civitas hanya melihat pengaduan mereka sendiri
            $pengaduans = Pengaduan::where('user_id', $user->id)
                ->with(['santri'])
                ->latest()
                ->get();
        }

        return view('pengaduan.index', compact('pengaduans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Guru perlu memilih santri siapa yang dilaporkan
        // Ambil semua santri (atau filter per kelas jika perlu)
        $santris = Santri::orderBy('nama')->get();

        return view('pengaduan.create', compact('santris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_kejadian' => 'required|date',
        ]);

        Pengaduan::create([
            'user_id' => Auth::id(), // Pelapor
            'santri_id' => $request->santri_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'status' => 'pending',
        ]);

        return redirect()->route('pengaduan.index')
            ->with('success', 'Laporan pengaduan berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengaduan $pengaduan)
    {
        $user = Auth::user();

        // Validasi akses
        if ($user->role !== 'admin' && $user->id !== $pengaduan->user_id) {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

        return view('pengaduan.show', compact('pengaduan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        // Hanya admin yang boleh update status
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Hanya Admin yang dapat mengubah status.');
        }

        $request->validate([
            'status' => 'required|in:pending,proses,selesai,ditolak',
        ]);

        $pengaduan->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pengaduan diperbarui.');
    }
}
