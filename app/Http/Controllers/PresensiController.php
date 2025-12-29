<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Santri;
use App\Models\Pengajar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PresensiController extends Controller
{

    // TAMPILKAN HALAMAN SCAN
    public function scan(Request $request): View
{
    $jadwalId = $request->query('jadwal_id');
    $user = $request->user();

    if ($jadwalId) {
        $sudahAbsen = Absensi::where('jadwal_id', $jadwalId)
            ->where('user_id', $user->id)
            ->exists();

        if ($sudahAbsen) {
            return view('presensi.sudah-scan');
        }
    }

    return view('presensi.scan', [
        'jadwalId' => $jadwalId,
    ]);
}
    public function store(Request $request)
    {
        $request->validate([
        'jadwal_id' => 'required|exists:jadwals,id',
    ]);

    $user = $request->user();

    // cek apakah sudah absen
    $sudahAbsen = Absensi::where('jadwal_id', $request->jadwal_id)
        ->where('user_id', $user->id)
        ->exists();

    if ($sudahAbsen) {
        return back()->with('info', 'Anda sudah melakukan presensi sebelumnya.');
    }

    Absensi::create([
        'jadwal_id'   => $request->jadwal_id,
        'user_id'     => $user->id,
        'role'        => $user->role,
        'status'      => 'hadir',
        'waktu_absen' => now(),
    ]);

        return back()->with('success', 'Absensi berhasil dicatat.');
    }
}
