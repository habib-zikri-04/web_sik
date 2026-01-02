<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Pengajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GuruPresensiController extends Controller
{
    public function index()
    {
        $now = now();
        $user = Auth::user();
        
        // Get pengajar record for current user
        $pengajar = Pengajar::where('user_id', $user->id)->first();
        
        if (!$pengajar) {
            return view('guru.presensi.index', [
                'jadwalAktif' => collect(),
                'qrs' => collect(),
                'now' => $now,
                'error' => 'Akun guru Anda belum terhubung dengan data pengajar.',
            ]);
        }

        // Get active jadwal only for this pengajar's direct classes
        // (Mengaji sessions are handled by central QR displayed by Admin)
        $jadwalAktif = Jadwal::with(['kelas', 'subject', 'pengajar'])
            ->where('pengajar_id', $pengajar->id)
            ->whereDate('tanggal', $now->toDateString())
            ->whereTime('jam_mulai', '<=', $now->format('H:i:s'))
            ->whereTime('jam_selesai', '>=', $now->format('H:i:s'))
            ->orderBy('jam_mulai')
            ->orderBy('ruang')
            ->get();

        // QR per jadwal
        $qrs = $jadwalAktif->mapWithKeys(function ($j) {
            $url = \Illuminate\Support\Facades\URL::temporarySignedRoute(
                'presensi.scan',
                now()->addMinutes(10),
                ['jadwal_id' => $j->id]
            );
            return [$j->id => QrCode::size(260)->generate($url)];
        });

        return view('guru.presensi.index', [
            'jadwalAktif' => $jadwalAktif,
            'qrs' => $qrs,
            'now' => $now,
        ]);
    }

    // API untuk refresh QR Code
    public function getQr($jadwalId)
    {
        $user = Auth::user();
        $pengajar = Pengajar::where('user_id', $user->id)->first();
        
        // Verify this jadwal belongs to this pengajar
        $jadwal = Jadwal::where('id', $jadwalId)
            ->where('pengajar_id', $pengajar?->id)
            ->first();
            
        if (!$jadwal) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Generate Signed URL baru (10 menit)
        $url = \Illuminate\Support\Facades\URL::temporarySignedRoute(
            'presensi.scan',
            now()->addMinutes(10),
            ['jadwal_id' => $jadwalId]
        );

        $qrCode = QrCode::size(260)->generate($url);

        return response()->json([
            'qr_code' => (string) $qrCode,
            'expires_in' => 600
        ]);
    }
}
