<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Pengajar;
use App\Models\Civitas;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // --- JADWAL KEGIATAN (REAL DATA) ---
        $jadwalRaw = \App\Models\Jadwal::with(['subject', 'kelas', 'pengajar'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'asc')
            ->take(4)
            ->get();

        $jadwal = $jadwalRaw->map(function($j) {
            return [
                'judul'      => ($j->subject->nama ?? 'Kegiatan') . ' - ' . ($j->kelas->nama ?? 'Semua'),
                'waktu'      => \Carbon\Carbon::parse($j->tanggal)->translatedFormat('l, d M') . ' (' . substr($j->jam_mulai, 0, 5) . ' - ' . substr($j->jam_selesai, 0, 5) . ')',
                'keterangan' => $j->ruang ?? 'Ruang Belum Ditentukan',
            ];
        })->toArray();

        // --- TOTAL DATA ---
        $totalSantri  = Santri::count();
        $totalGuru    = Pengajar::count();
        $totalCivitas = Civitas::count();

        // --- RANGE MINGGU INI ---
        $startOfWeek = now()->startOfWeek();
        $endOfWeek   = now()->endOfWeek();

        // --- SANTRI YANG HADIR (UNIK) ---
        $hadirSantri = Absensi::where('role', 'santri')
            ->where('status', 'hadir')
            ->whereBetween('waktu_absen', [$startOfWeek, $endOfWeek])
            ->distinct('user_id')
            ->count('user_id');

        // --- PERSENTASE ---
        $persentaseKehadiran = $totalSantri > 0
            ? round(($hadirSantri / $totalSantri) * 100)
            : 0;

        return view('admin.dashboard', compact(
            'totalSantri',
            'totalGuru',
            'totalCivitas',
            'jadwal',
            'persentaseKehadiran',
        ));
    }
}

