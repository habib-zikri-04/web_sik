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
            // QR mengarah ke halaman scanner (GET)
            $url = route('presensi.scan', ['jadwal_id' => $j->id]);
            return [$j->id => QrCode::size(260)->generate($url)];
        });

        return view('admin.presensi.index', [
            'jadwalAktif' => $jadwalAktif,
            'qrs' => $qrs,
            'now' => $now,
        ]);
    }
}
