<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;

class DemaDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get Mengaji subject
        $mengajiSubject = Subject::where('kode', 'MGJ')->first();
        
        // Get all Mengaji schedules (tidak terikat kelas)
        $jadwals = collect();
        if ($mengajiSubject) {
            $jadwals = Jadwal::where('subject_id', $mengajiSubject->id)
                ->with(['pengajar', 'kelas'])
                ->orderBy('tanggal', 'asc')
                ->orderBy('jam_mulai', 'asc')
                ->get();
        }
        
        // Get my attendance records
        $myAttendance = Absensi::where('user_id', $user->id)
            ->whereHas('jadwal', function($q) use ($mengajiSubject) {
                if ($mengajiSubject) {
                    $q->where('subject_id', $mengajiSubject->id);
                }
            })
            ->pluck('jadwal_id')
            ->toArray();
        
        // Calculate attendance stats
        $totalJadwal = $jadwals->count();
        $totalHadir = count($myAttendance);
        $persentase = $totalJadwal > 0 ? round(($totalHadir / $totalJadwal) * 100, 1) : 0;
        
        return view('dema.dashboard', compact(
            'jadwals', 
            'myAttendance', 
            'totalJadwal', 
            'totalHadir', 
            'persentase',
            'mengajiSubject'
        ));
    }
}
