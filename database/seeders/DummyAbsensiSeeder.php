<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Absensi;
use App\Models\Santri;
use App\Models\Jadwal;

class DummyAbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $santri = Santri::all();
        $jadwal = Jadwal::all();

        foreach ($santri as $s) {
            foreach ($jadwal as $j) {
                Absensi::create([
                    'santri_id' => $s->id,
                    'jadwal_id' => $j->id,
                    'status' => collect(['hadir','alfa'])->random(),
                    'waktu_absen' => now(),
                ]);
            }
        }
    }
}
