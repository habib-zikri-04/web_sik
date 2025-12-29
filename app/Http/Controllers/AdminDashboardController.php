<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Pengajar;
use App\Models\Civitas;
use App\Models\Absensi;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // --- JADWAL KEGIATAN (STATIC) ---
        $jadwal = [
            [
                'judul'      => 'Sesi Mengaji',
                'waktu'      => '08.00 – 09.00 WIB',
                'keterangan' => 'Santri, Civitas, dan Ormawa',
            ],
            [
                'judul'      => 'Sesi Kelas 1',
                'waktu'      => '09.00 – 11.00 WIB',
                'keterangan' => 'Pembelajaran',
            ],
            [
                'judul'      => 'Sesi Kelas 2',
                'waktu'      => '11.00 – 13.00 WIB',
                'keterangan' => 'Pembelajaran',
            ],
            [
                'judul'      => 'Sesi Kelas 3',
                'waktu'      => '13.00 – 16.00 WIB',
                'keterangan' => 'Pembelajaran',
            ],
        ];

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
