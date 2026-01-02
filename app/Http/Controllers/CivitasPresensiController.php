<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class CivitasPresensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get Mengaji subject
        $mengajiSubject = Subject::where('kode', 'MGJ')->first();
        
        // Get all applicable schedules: Mengaji subject OR in Aula Tuanku Imam Bonjol OR Kelas "Semua"
        $jadwals = Jadwal::with(['pengajar', 'kelas'])
            ->where(function($query) use ($mengajiSubject) {
                if ($mengajiSubject) {
                    $query->where('subject_id', $mengajiSubject->id);
                }
                $query->orWhere('ruang', 'Aula Tuanku Imam Bonjol')
                      ->orWhere('kelas_id', 14);
            })
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        // Check if there's any schedule FOR TODAY for civitas
        $adaJadwalHariIni = Jadwal::where('tanggal', now()->toDateString())
            ->where(function($query) use ($mengajiSubject) {
                if ($mengajiSubject) {
                    $query->where('subject_id', $mengajiSubject->id);
                }
                $query->orWhere('ruang', 'Aula Tuanku Imam Bonjol')
                      ->orWhere('kelas_id', 14);
            })->exists();
        
        // Get my attendance records
        $myAttendance = Absensi::where('user_id', $user->id)
            ->whereHas('jadwal', function($q) use ($mengajiSubject) {
                $q->where(function($sub) use ($mengajiSubject) {
                    if ($mengajiSubject) {
                        $sub->where('subject_id', $mengajiSubject->id);
                    }
                    $sub->orWhere('ruang', 'Aula Tuanku Imam Bonjol')
                        ->orWhere('kelas_id', 14);
                });
            })
            ->pluck('jadwal_id')
            ->toArray();
        
        // Calculate attendance stats
        $totalJadwal = $jadwals->count();
        $totalHadir = count($myAttendance);
        $persentase = $totalJadwal > 0 ? round(($totalHadir / $totalJadwal) * 100, 1) : 0;
        
        return view('civitas.presensi', compact(
            'jadwals', 
            'myAttendance', 
            'totalJadwal', 
            'totalHadir', 
            'persentase',
            'mengajiSubject',
            'adaJadwalHariIni'
        ));
    }
}
