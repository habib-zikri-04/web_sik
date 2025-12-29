<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = [
            'Menjadi Imam',
            'Menginspirasi Semesta',
            'Cepat dan Adaptif',
            'Solutif dan Edukatif',
            'Melayani dan Bertanggungjawab',
            'Jujur',
            'Imajinatif',
            'Berdaya Guna',        // disatukan
            'Saling Membesarkan',
            'MenSaHaBaTi',
            'Sains',
            'Teknologi',           // hanya satu
        ];

        foreach ($kelas as $nama) {
            Kelas::updateOrCreate(['nama' => $nama]);
        }
    }
}
