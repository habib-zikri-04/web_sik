<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsSeeder extends Seeder
{
    public function run(): void
    {
        // Mapping dari PDF jadwal: Keislaman, Keimanan, Keihsanan
        // Kamu bisa ubah kode sesuai standar kamu (KEI, KIM, KHS)
        $subjects = [
            ['kode' => 'MGJ', 'nama' => 'Mengaji'],
            ['kode' => 'KEI', 'nama' => 'Keislaman'],
            ['kode' => 'KIM', 'nama' => 'Keimanan'],
            ['kode' => 'KHS', 'nama' => 'Keihsanan'],
        ];

        foreach ($subjects as $s) {
            Subject::updateOrCreate(
                ['kode' => $s['kode']],
                ['nama' => $s['nama']]
            );
        }
    }
}
