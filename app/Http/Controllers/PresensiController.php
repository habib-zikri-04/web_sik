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
    $user = $request->user();
    $jadwalId = $request->query('jadwal_id');

    // Jika ada jadwal_id (dari QR), cek apakah jadwal tersebut hari ini dan dalam rentang waktu
    if ($jadwalId) {
        $jadwal = Jadwal::find($jadwalId);
        $now = now();
        $today = $now->toDateString();
        $currentTime = $now->format('H:i:s');

        if (!$jadwal || $jadwal->tanggal !== $today) {
            return view('presensi.not-today', ['message' => 'Jadwal ini tidak dijadwalkan untuk hari ini.']);
        }

        // Cek Waktu
        if ($currentTime < $jadwal->jam_mulai) {
            return view('presensi.not-today', ['message' => 'Sesi presensi belum dimulai. Silakan kembali pada pukul ' . substr($jadwal->jam_mulai, 0, 5) . ' WIB.']);
        }

        if ($currentTime > $jadwal->jam_selesai) {
            return view('presensi.not-today', ['message' => 'Sesi presensi telah berakhir pada pukul ' . substr($jadwal->jam_selesai, 0, 5) . ' WIB.']);
        }
    } else {
        // Jika buka scanner manual, cek apakah ada jadwal untuk user ini hari ini
        $adaJadwalHariIni = Jadwal::where('tanggal', now()->toDateString())
            ->where(function($q) use ($user) {
                if ($user->role === 'santri') {
                    $q->where('kelas_id', $user->santri?->kelas_id)->orWhere('kelas_id', 14);
                } elseif ($user->role === 'guru') {
                    // Guru punya jadwal mengajar sendiri atau sesi Mengaji (Subject ID 1)
                    $q->where('pengajar_id', $user->pengajar?->id)->orWhere('subject_id', 1);
                } elseif (in_array($user->role, ['civitas', 'dema'])) {
                    $mengajiId = 1; // ID Subject Mengaji
                    $q->where('subject_id', $mengajiId)
                      ->orWhere('ruang', 'Aula Tuanku Imam Bonjol')
                      ->orWhere('kelas_id', 14);
                }
            })->exists();

        if (!$adaJadwalHariIni && $user->role !== 'admin') {
            return view('presensi.not-today', ['message' => 'Tidak ada jadwal kegiatan untuk Anda hari ini.']);
        }
    }

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

        $jadwal = Jadwal::find($request->jadwal_id);
        $now = now();
        $today = $now->toDateString();
        $currentTime = $now->format('H:i:s');
        
        // Cek apakah jadwal tersebut hari ini
        if ($jadwal->tanggal !== $today) {
            return back()->with('error', 'Presensi hanya dapat dilakukan pada hari jadwal berlangsung.');
        }

        // Cek Waktu
        if ($currentTime < $jadwal->jam_mulai) {
            return back()->with('error', 'Presensi belum dimulai. Sesi dimulai pukul ' . substr($jadwal->jam_mulai, 0, 5));
        }

        if ($currentTime > $jadwal->jam_selesai) {
            return back()->with('error', 'Sesi presensi telah berakhir pada pukul ' . substr($jadwal->jam_selesai, 0, 5));
        }

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

        $routeName = match($user->role) {
            'santri' => 'santri.dashboard',
            'civitas' => 'civitas.presensi',
            'dema' => 'dema.presensi',
            'guru' => 'guru.dashboard',
            default => 'dashboard',
        };

        return redirect()->route($routeName)->with('success', 'Absensi berhasil dicatat.');
    }
}
