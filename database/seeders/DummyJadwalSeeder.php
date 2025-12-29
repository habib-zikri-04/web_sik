<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;
use App\Models\Pengajar;
use App\Models\Subject;
use Carbon\Carbon;

class DummyJadwalSeeder extends Seeder
{
    public function run(): void
    {
        $kei = Subject::where('kode', 'KEI')->first();
        $kim = Subject::where('kode', 'KIM')->first();
        $khs = Subject::where('kode', 'KHS')->first();

        // Guru berdasarkan mapel
        $guruKei = Pengajar::where('subject_id', $kei->id)->inRandomOrder()->first();
        $guruKim = Pengajar::where('subject_id', $kim->id)->inRandomOrder()->first();
        $guruKhs = Pengajar::where('subject_id', $khs->id)->inRandomOrder()->first();

        // Rotasi untuk 3 kelompok
        $rotasi = [
            1 => [$kei->id, $kim->id, $khs->id],  // Sesi 1
            2 => [$kim->id, $khs->id, $kei->id],  // Sesi 2
            3 => [$khs->id, $kei->id, $kim->id],  // Sesi 3
        ];

        // $tanggalAwal = now()->next('Wednesday');
        $tanggalAwal = today();
        $jumlahPertemuan = 16;

        for ($pertemuan = 0; $pertemuan < $jumlahPertemuan; $pertemuan++) {

            $tanggal = $tanggalAwal->copy()->addWeeks($pertemuan);

            /* ============================
               Sesi 0 → Mengaji (sama semua)
               ============================ */
            Jadwal::create([
                'sesi' => 0,
                'subject_id' => $kei->id,
                'pengajar_id' => $guruKei->id,
                'tanggal' => $tanggal,
                'jam_mulai' => '08:00',
                'jam_selesai' => '09:00',
            ]);

            /* ==========================================
               Sesi 1-3 → 3 kelas: KEI / KIM / KHS
               Menggunakan rotasi urutan mapel
               ========================================== */
            for ($sesi = 1; $sesi <= 3; $sesi++) {

                $subjectId = $rotasi[$sesi][($pertemuan % 3)];

                $guru = match ($subjectId) {
                    $kei->id => $guruKei,
                    $kim->id => $guruKim,
                    $khs->id => $guruKhs,
                };

                $jamMulai = match($sesi) {
                    1 => '09:00',
                    2 => '11:00',
                    3 => '13:00',
                };

                $jamSelesai = match($sesi) {
                    1 => '11:00',
                    2 => '13:00',
                    3 => '18:00',
                };

                Jadwal::create([
                    'sesi' => $sesi,
                    'subject_id' => $subjectId,
                    'pengajar_id' => $guru->id,
                    'tanggal' => $tanggal,
                    'jam_mulai' => $jamMulai,
                    'jam_selesai' => $jamSelesai,
                ]);
            }
        }
    }
}
