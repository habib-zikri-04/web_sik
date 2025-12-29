<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Pengajar;
use App\Models\Subject;
use App\Models\User;

class PengajarsSeeder extends Seeder
{
    private function makeEmail(string $name): string
    {
        $slug = Str::of($name)->lower()->replace('.', '')->replace("'", '')->replace('  ', ' ')
            ->slug('.');
        return $slug . '@dummy.local';
    }

    public function run(): void
    {
        // Dari PDF Jadwal: dosen yang muncul
        // Ada beberapa baris Keihsanan yang dosennya kosong → kita buat placeholder "TBD"
        $pengajars = [
            ['nama' => 'Annisa Wahid', 'subject_kode' => 'KEI'],
            ['nama' => 'Faisal', 'subject_kode' => 'KEI'],
            ['nama' => 'Nailatul Fadhilah Agusti', 'subject_kode' => 'KEI'],
            ['nama' => 'Shadrio Shaufi', 'subject_kode' => 'KEI'],

            ['nama' => 'Akhiar Fuadi', 'subject_kode' => 'KIM'],
            ['nama' => 'Rahmat Hidayat', 'subject_kode' => 'KIM'],
            ['nama' => 'Muhibbudin', 'subject_kode' => 'KIM'],
            ['nama' => 'Rismandianto', 'subject_kode' => 'KIM'],

            ['nama' => 'Ira Sasmita', 'subject_kode' => 'KHS'],
            ['nama' => 'Shafwatul Bary', 'subject_kode' => 'KHS'],

            // placeholder untuk baris Keihsanan yang dosennya kosong di PDF jadwal
            ['nama' => 'TBD Keihsanan', 'subject_kode' => 'KHS'],
        ];

        foreach ($pengajars as $p) {
            $subject = Subject::where('kode', $p['subject_kode'])->firstOrFail();

            $email = $this->makeEmail($p['nama']);

            // buat user dummy pengajar kalau belum ada
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $p['nama'],
                    'password' => bcrypt('password'), // dev only
                    'email_verified_at' => now(),
                    'role' => 'guru',
                ]
            );

            Pengajar::updateOrCreate(
                ['email' => $email],
                [
                    'user_id' => $user->id,
                    'nama' => $p['nama'],
                    'subject_id' => $subject->id,
                ]
            );
        }
    }
}
