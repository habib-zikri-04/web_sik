<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Pengajar;
use App\Models\Subject;

class JadwalsSeeder extends Seeder
{
    private function sesiFromJam(string $jamMulai): int
    {
        // Slot jam dari PDF
        return match ($jamMulai) {
            '08:00:00' => 0,
            '08:30:00' => 1,
            '10:40:00' => 2,
            '14:00:00' => 3,
            default => 0,
        };
    }

    private function normalizeKelas(string $nama): string
    {
        $nama = trim($nama);

        // Satukan "Berdayaguna" / "Berdaya Guna" dll
        if (stripos($nama, 'Berdaya') !== false) {
            return 'Berdaya Guna';
        }

        // Ambil "Teknologi" saja
        if (stripos($nama, 'Teknologi') !== false) {
            return 'Teknologi';
        }

        return $nama;
    }

    private function normalizeJam(string $jam): string
    {
        // PDF pakai format "08.30 - 10.30" → kita pakai time SQL
        $jam = str_replace('.', ':', trim($jam));
        if (strlen($jam) === 5) return $jam . ':00';
        return $jam;
    }

    public function run(): void
    {
        /**
         * TEMPLATE BARIS JADWAL (diambil dari PDF Jadwal SIK 1 2025-2026)
         * Kolom PDF: Kode | Nama Lokal | Pukul | Mata Kuliah | Kelas | Dosen
         * Sumber Keislaman & Keimanan: :contentReference[oaicite:5]{index=5}
         * Sumber Keihsanan: :contentReference[oaicite:6]{index=6}
         */
        $templates = [

            // =======================
        // SESI MENGAJI (SEMUA ROLE)
        // =======================
            [
            'ruang'       => 'Aula',
            'jam_mulai'   => '08:00:00',
            'jam_selesai' => '08:25:00',
            'subject'     => 'Mengaji',
            'kelas'       => null,        // TIDAK ADA KELAS
            'pengajar'    => null // atau pengajar khusus
            ],
            // =======================
            // KEISLAMAN
            // =======================
            ['ruang' => 'C.1.07.I', 'jam_mulai' => '08:30:00', 'jam_selesai' => '10:30:00', 'subject' => 'Keislaman', 'kelas' => 'Menjadi Imam', 'pengajar' => 'Annisa Wahid'],
            ['ruang' => 'C.1.07.I', 'jam_mulai' => '10:40:00', 'jam_selesai' => '12:40:00', 'subject' => 'Keislaman', 'kelas' => 'Menginspirasi Semesta', 'pengajar' => 'Annisa Wahid'],
            ['ruang' => 'C.1.07.I', 'jam_mulai' => '14:00:00', 'jam_selesai' => '16:00:00', 'subject' => 'Keislaman', 'kelas' => 'Cepat dan Adaptif', 'pengajar' => 'Annisa Wahid'],

            ['ruang' => 'C.1.08.I', 'jam_mulai' => '08:30:00', 'jam_selesai' => '10:30:00', 'subject' => 'Keislaman', 'kelas' => 'Solutif dan Edukatif', 'pengajar' => 'Faisal'],
            ['ruang' => 'C.1.08.I', 'jam_mulai' => '10:40:00', 'jam_selesai' => '12:40:00', 'subject' => 'Keislaman', 'kelas' => 'Melayani dan Bertanggungjawab', 'pengajar' => 'Faisal'],
            ['ruang' => 'C.1.08.I', 'jam_mulai' => '14:00:00', 'jam_selesai' => '16:00:00', 'subject' => 'Keislaman', 'kelas' => 'Jujur', 'pengajar' => 'Faisal'],

            ['ruang' => 'C.1.09.I', 'jam_mulai' => '08:30:00', 'jam_selesai' => '10:30:00', 'subject' => 'Keislaman', 'kelas' => 'Imajinatif', 'pengajar' => 'Nailatul Fadhilah Agusti'],
            ['ruang' => 'C.1.09.I', 'jam_mulai' => '10:40:00', 'jam_selesai' => '12:40:00', 'subject' => 'Keislaman', 'kelas' => 'Berdaya Guna', 'pengajar' => 'Nailatul Fadhilah Agusti'],
            ['ruang' => 'C.1.09.I', 'jam_mulai' => '14:00:00', 'jam_selesai' => '16:00:00', 'subject' => 'Keislaman', 'kelas' => 'Saling Membesarkan', 'pengajar' => 'Nailatul Fadhilah Agusti'],

            ['ruang' => 'J.2.01.I', 'jam_mulai' => '08:30:00', 'jam_selesai' => '10:30:00', 'subject' => 'Keislaman', 'kelas' => 'MenSaHaBaTi', 'pengajar' => 'Shadrio Shaufi'],
            ['ruang' => 'J.2.01.I', 'jam_mulai' => '10:40:00', 'jam_selesai' => '12:40:00', 'subject' => 'Keislaman', 'kelas' => 'Sains', 'pengajar' => 'Shadrio Shaufi'],
            ['ruang' => 'J.2.01.I', 'jam_mulai' => '14:00:00', 'jam_selesai' => '16:00:00', 'subject' => 'Keislaman', 'kelas' => 'Teknologi', 'pengajar' => 'Shadrio Shaufi'],

            // =======================
            // KEIMANAN
            // =======================
            ['ruang' => 'J.2.02.I', 'jam_mulai' => '08:30:00', 'jam_selesai' => '10:30:00', 'subject' => 'Keimanan', 'kelas' => 'Teknologi', 'pengajar' => 'Akhiar Fuadi'],
            ['ruang' => 'J.2.02.I', 'jam_mulai' => '10:40:00', 'jam_selesai' => '12:40:00', 'subject' => 'Keimanan', 'kelas' => 'Menjadi Imam', 'pengajar' => 'Akhiar Fuadi'],
            ['ruang' => 'J.2.02.I', 'jam_mulai' => '14:00:00', 'jam_selesai' => '16:00:00', 'subject' => 'Keimanan', 'kelas' => 'Menginspirasi Semesta', 'pengajar' => 'Akhiar Fuadi'],

            ['ruang' => 'J.2.03.I', 'jam_mulai' => '08:30:00', 'jam_selesai' => '10:30:00', 'subject' => 'Keimanan', 'kelas' => 'Cepat dan Adaptif', 'pengajar' => 'Rahmat Hidayat'],
            ['ruang' => 'J.2.03.I', 'jam_mulai' => '10:40:00', 'jam_selesai' => '12:40:00', 'subject' => 'Keimanan', 'kelas' => 'Solutif dan Edukatif', 'pengajar' => 'Rahmat Hidayat'],
            ['ruang' => 'J.2.03.I', 'jam_mulai' => '14:00:00', 'jam_selesai' => '16:00:00', 'subject' => 'Keimanan', 'kelas' => 'Melayani dan Bertanggungjawab', 'pengajar' => 'Rahmat Hidayat'],

            ['ruang' => 'J.2.04.I', 'jam_mulai' => '08:30:00', 'jam_selesai' => '10:30:00', 'subject' => 'Keimanan', 'kelas' => 'Jujur', 'pengajar' => 'Muhibbudin'],
            ['ruang' => 'J.2.04.I', 'jam_mulai' => '10:40:00', 'jam_selesai' => '12:40:00', 'subject' => 'Keimanan', 'kelas' => 'Imajinatif', 'pengajar' => 'Muhibbudin'],
            ['ruang' => 'J.2.04.I', 'jam_mulai' => '14:00:00', 'jam_selesai' => '16:00:00', 'subject' => 'Keimanan', 'kelas' => 'Berdaya Guna', 'pengajar' => 'Muhibbudin'],

            ['ruang' => 'J.2.05.I', 'jam_mulai' => '08:30:00', 'jam_selesai' => '10:30:00', 'subject' => 'Keimanan', 'kelas' => 'Saling Membesarkan', 'pengajar' => 'Rismandianto'],
            ['ruang' => 'J.2.05.I', 'jam_mulai' => '10:40:00', 'jam_selesai' => '12:40:00', 'subject' => 'Keimanan', 'kelas' => 'MenSaHaBaTi', 'pengajar' => 'Rismandianto'],
            ['ruang' => 'J.2.05.I', 'jam_mulai' => '14:00:00', 'jam_selesai' => '16:00:00', 'subject' => 'Keimanan', 'kelas' => 'Sains', 'pengajar' => 'Rismandianto'],

            // =======================
            // KEIHSANAN
            // Catatan: beberapa dosen kosong di PDF → pakai "TBD Keihsanan"
            // =======================
            ['ruang' => 'C.1.01.I', 'jam_mulai' => '08:30:00', 'jam_selesai' => '10:30:00', 'subject' => 'Keihsanan', 'kelas' => 'Sains', 'pengajar' => 'TBD Keihsanan'],
            ['ruang' => 'C.1.01.I', 'jam_mulai' => '10:40:00', 'jam_selesai' => '12:40:00', 'subject' => 'Keihsanan', 'kelas' => 'Teknologi', 'pengajar' => 'TBD Keihsanan'],
            ['ruang' => 'C.1.01.I', 'jam_mulai' => '14:00:00', 'jam_selesai' => '16:00:00', 'subject' => 'Keihsanan', 'kelas' => 'Menjadi Imam', 'pengajar' => 'TBD Keihsanan'],

            ['ruang' => 'C.1.02.I', 'jam_mulai' => '08:30:00', 'jam_selesai' => '10:30:00', 'subject' => 'Keihsanan', 'kelas' => 'Menginspirasi Semesta', 'pengajar' => 'Ira Sasmita'],
            ['ruang' => 'C.1.02.I', 'jam_mulai' => '10:40:00', 'jam_selesai' => '12:40:00', 'subject' => 'Keihsanan', 'kelas' => 'Cepat dan Adaptif', 'pengajar' => 'Ira Sasmita'],
            ['ruang' => 'C.1.02.I', 'jam_mulai' => '14:00:00', 'jam_selesai' => '16:00:00', 'subject' => 'Keihsanan', 'kelas' => 'Solutif dan Edukatif', 'pengajar' => 'Ira Sasmita'],

            ['ruang' => 'C.1.05.I', 'jam_mulai' => '08:30:00', 'jam_selesai' => '10:30:00', 'subject' => 'Keihsanan', 'kelas' => 'Melayani dan Bertanggungjawab', 'pengajar' => 'TBD Keihsanan'],
            ['ruang' => 'C.1.05.I', 'jam_mulai' => '10:40:00', 'jam_selesai' => '12:40:00', 'subject' => 'Keihsanan', 'kelas' => 'Jujur', 'pengajar' => 'TBD Keihsanan'],
            ['ruang' => 'C.1.05.I', 'jam_mulai' => '14:00:00', 'jam_selesai' => '16:00:00', 'subject' => 'Keihsanan', 'kelas' => 'Imajinatif', 'pengajar' => 'TBD Keihsanan'],

            ['ruang' => 'C.1.06.I', 'jam_mulai' => '08:30:00', 'jam_selesai' => '10:30:00', 'subject' => 'Keihsanan', 'kelas' => 'Berdaya Guna', 'pengajar' => 'Shafwatul Bary'],
            ['ruang' => 'C.1.06.I', 'jam_mulai' => '10:40:00', 'jam_selesai' => '12:40:00', 'subject' => 'Keihsanan', 'kelas' => 'Saling Membesarkan', 'pengajar' => 'Shafwatul Bary'],
            ['ruang' => 'C.1.06.I', 'jam_mulai' => '14:00:00', 'jam_selesai' => '16:00:00', 'subject' => 'Keihsanan', 'kelas' => 'MenSaHaBaTi', 'pengajar' => 'Shafwatul Bary'],
        ];

        // =========================
        // TANGGAL: tiap hari Rabu (16 pertemuan)
        // Dokumen ditandatangani 25 Agustus 2025 → Rabu terdekat setelah itu: 27 Agustus 2025
        // =========================
        // $start = Carbon::create(2025, 8, 27); // Rabu
        $start = Carbon::create(2025, 12, 30); //test hari ini
        $dates = [];
        for ($i = 0; $i < 16; $i++) {
            $dates[] = $start->copy()->addWeeks($i)->toDateString();
        }

        foreach ($dates as $tanggal) {
            foreach ($templates as $t) {
    $subject = Subject::where('nama', $t['subject'])->firstOrFail();

    $kelasId = null;
    if ($t['kelas']) {
        $kelasNama = $this->normalizeKelas($t['kelas']);
        $kelas = Kelas::where('nama', $kelasNama)->firstOrFail();
        $kelasId = $kelas->id;
    }

    $pengajar = Pengajar::where('nama', $t['pengajar'])->first();

    Jadwal::updateOrCreate(
        [
            'tanggal'     => $tanggal,
            'jam_mulai'   => $this->normalizeJam($t['jam_mulai']),
            'jam_selesai' => $this->normalizeJam($t['jam_selesai']),
            'subject_id'  => $subject->id,
            'kelas_id'    => $kelasId,
        ],
        [
            'pengajar_id' => $pengajar?->id,
            'sesi'        => $this->sesiFromJam($this->normalizeJam($t['jam_mulai'])),
            'ruang'       => $t['ruang'],
        ]
    );
}

        }
    }
}
