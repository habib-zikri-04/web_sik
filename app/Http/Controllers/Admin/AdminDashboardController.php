<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // sementara dummy dulu, nanti ganti pakai query absensi
        $totalSantri   = 0;
        $totalGuru     = 0;
        $totalCivitas  = 0;

        // contoh jadwal statis (persis seperti HTML kamu)
        $jadwal = [
            [
                'judul' => 'Sesi Mengaji',
                'waktu' => '08.00 – 09.00 WIB',
                'keterangan' => 'Santri, Civitas, dan Ormawa',
                'warna' => 'red',
            ],
            [
                'judul' => 'Sesi Kelas 1',
                'waktu' => '09.00 – 11.00 WIB',
                'keterangan' => 'Pembelajaran',
                'warna' => 'green',
            ],
            [
                'judul' => 'Sesi Kelas 2',
                'waktu' => '11.00 – 13.00 WIB',
                'keterangan' => 'Pembelajaran',
                'warna' => 'green',
            ],
            [
                'judul' => 'Sesi Kelas 3',
                'waktu' => '13.00 – 16.00 WIB',
                'keterangan' => 'Pembelajaran',
                'warna' => 'green',
            ],
        ];

        // nanti persentase ini kita hitung dari absensi guru + santri + civitas
        $persentaseKehadiran = 0;

        return view('admin.dashboard', compact(
            'totalSantri',
            'totalGuru',
            'totalCivitas',
            'jadwal',
            'persentaseKehadiran'
        ));
    }
}
