<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;
use App\Models\Subject;



class GuruDashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $pengajar = $user->pengajar;

    if (!$pengajar) {
        return view('guru.dashboard', [
            'jadwals' => collect(),
            'rekap'   => collect(),
        ]);
    }

    $jadwalGroups = Jadwal::with(['subject', 'kelas'])
        ->where('pengajar_id', $pengajar->id)
        ->get()
        ->groupBy(fn ($j) =>
            $j->subject_id.'|'.
            $j->kelas_id.'|'.
            $j->jam_mulai.'|'.
            $j->jam_selesai.'|'.
            $j->ruang
        );

    $rekap = collect();

    foreach ($jadwalGroups as $group) {
        $first = $group->first();

        $total = $group->count();

        $hadir = Absensi::where('user_id', $user->id)
            ->where('status', 'hadir')
            ->whereIn('jadwal_id', $group->pluck('id'))
            ->count();

        $rekap->push([
            'subject' => $first->subject->nama,
            'kelas'   => $first->kelas->nama ?? 'Umum',
            'jam'     => "{$first->jam_mulai} - {$first->jam_selesai}",
            'hadir'   => $hadir,
            'total'   => $total,
            'persen'  => $total > 0 ? round(($hadir / $total) * 100, 2) : 0,
        ]);
    }

    return view('guru.dashboard', [
        'jadwals' => $jadwalGroups,
        'rekap'   => $rekap,
    ]);
}


}
