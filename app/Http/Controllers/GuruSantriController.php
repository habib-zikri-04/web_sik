<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;

class GuruSantriController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pengajar = $user->pengajar;

        if (!$pengajar) {
            return view('guru.santri', [
                'groups' => collect(),
            ]);
        }

        // ambil jadwal guru, group per subject + kelas
        $groups = Jadwal::with(['subject', 'kelas.santris.user'])
            ->where('pengajar_id', $pengajar->id)
            ->get()
            ->groupBy(fn ($j) => $j->subject_id.'-'.$j->kelas_id);

        return view('guru.santri', compact('groups'));
    }
}
