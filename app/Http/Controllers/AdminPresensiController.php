<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminPresensiController extends Controller
{
    public function index()
    {
        $now = now();

        $jadwalAktif = Jadwal::with(['kelas', 'subject', 'pengajar'])
            ->whereDate('tanggal', $now->toDateString())
            ->whereTime('jam_mulai', '<=', $now->format('H:i:s'))
            ->whereTime('jam_selesai', '>=', $now->format('H:i:s'))
            ->orderBy('jam_mulai')
            ->orderBy('ruang')
            ->get();

        // QR per jadwal
        $qrs = $jadwalAktif->mapWithKeys(function ($j) {
            // QR mengarah ke halaman scanner (GET) dengan SIGNED URL expired 10 menit
            $url = \Illuminate\Support\Facades\URL::temporarySignedRoute(
                'presensi.scan',
                now()->addMinutes(10),
                ['jadwal_id' => $j->id]
            );
            return [$j->id => QrCode::size(260)->generate($url)];
        });

        return view('admin.presensi.index', [
            'jadwalAktif' => $jadwalAktif,
            'qrs' => $qrs,
            'now' => $now,
        ]);
    }

    // API untuk refresh QR Code
    public function getQr($jadwalId)
    {
        // Generate Signed URL baru (10 menit)
        $url = \Illuminate\Support\Facades\URL::temporarySignedRoute(
            'presensi.scan',
            now()->addMinutes(10),
            ['jadwal_id' => $jadwalId]
        );

        // Return SVG QR Code sebagai string
        $qrCode = QrCode::size(260)->generate($url);

        return response()->json([
            'qr_code' => (string) $qrCode, // Cast to string agar bisa dirender di JS
            'expires_in' => 600 // 10 menit dalam detik
        ]);
    }
}
