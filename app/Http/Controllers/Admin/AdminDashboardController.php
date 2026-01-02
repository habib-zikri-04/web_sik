<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Santri;
use App\Models\Pengajar;
use App\Models\Civitas;
use App\Models\Jadwal;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Real data from database
        $totalSantri   = Santri::count();
        $totalGuru     = Pengajar::count();
        $totalCivitas  = Civitas::count();

        // Get today's jadwal
        $now = now();
        $jadwalHariIni = Jadwal::with(['kelas', 'subject', 'pengajar'])
            ->whereDate('tanggal', $now->toDateString())
            ->orderBy('jam_mulai')
            ->get();

        // Format jadwal for display
        $jadwal = $jadwalHariIni->map(function ($item) {
            $sesiNames = ['Mengaji', 'Sesi 1', 'Sesi 2', 'Sesi 3'];
            return [
                'judul' => $sesiNames[$item->sesi] ?? 'Sesi ' . $item->sesi,
                'waktu' => substr($item->jam_mulai, 0, 5) . ' – ' . substr($item->jam_selesai, 0, 5) . ' WIB',
                'keterangan' => ($item->kelas->nama ?? 'Semua') . ' - ' . ($item->subject->nama ?? '-'),
                'warna' => $item->sesi == 0 ? 'red' : 'green',
            ];
        })->toArray();

        // Default jadwal if none today
        if (empty($jadwal)) {
            $jadwal = [
                ['judul' => 'Sesi Mengaji', 'waktu' => '08.00 – 09.00 WIB', 'keterangan' => 'Santri, Civitas, dan Ormawa', 'warna' => 'red'],
                ['judul' => 'Sesi Kelas 1', 'waktu' => '09.00 – 11.00 WIB', 'keterangan' => 'Pembelajaran', 'warna' => 'green'],
                ['judul' => 'Sesi Kelas 2', 'waktu' => '11.00 – 13.00 WIB', 'keterangan' => 'Pembelajaran', 'warna' => 'green'],
                ['judul' => 'Sesi Kelas 3', 'waktu' => '13.00 – 16.00 WIB', 'keterangan' => 'Pembelajaran', 'warna' => 'green'],
            ];
        }

        // Calculate attendance percentage for this week
        $startOfWeek = $now->copy()->startOfWeek();
        $endOfWeek = $now->copy()->endOfWeek();
        
        $totalJadwalWeek = Jadwal::whereBetween('tanggal', [$startOfWeek, $endOfWeek])->count();
        $totalAbsensiWeek = Absensi::whereHas('jadwal', function ($q) use ($startOfWeek, $endOfWeek) {
            $q->whereBetween('tanggal', [$startOfWeek, $endOfWeek]);
        })->where('status', 'hadir')->count();
        
        $expectedAbsensi = $totalJadwalWeek * ($totalSantri + $totalGuru + $totalCivitas);
        $persentaseKehadiran = $expectedAbsensi > 0 
            ? round(($totalAbsensiWeek / $expectedAbsensi) * 100, 1) 
            : 0;

        return view('admin.dashboard', compact(
            'totalSantri',
            'totalGuru',
            'totalCivitas',
            'jadwal',
            'persentaseKehadiran'
        ));
    }
}

