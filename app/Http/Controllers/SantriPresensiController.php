<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SantriPresensiController extends Controller
{
    // halaman setelah scan QR
    public function scan(Request $request): View
    {
        $jadwalId = $request->query('jadwal_id');

        $jadwal = Jadwal::find($jadwalId);

        return view('presensi.scan', [
            'jadwal'   => $jadwal,
            'jadwalId' => $jadwalId,
        ]);
    }

    // simpan presensi santri
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
        ]);

        $user = $request->user();          // user yang login
        $santri = $user->santri;           // relasi user -> santri (sudah kamu bikin di model User)

        if (!$santri) {
            return back()->with('error', 'Akun ini bukan santri.');
        }

        $jadwalId = $request->input('jadwal_id');

        Absensi::updateOrCreate(
            [
                'santri_id' => $santri->id,
                'jadwal_id' => $jadwalId,
            ],
            [
                'status'      => 'hadir',
                'waktu_absen' => now(),
            ]
        );

        return back()->with('success', 'Presensi berhasil direkam.');
    }
}
