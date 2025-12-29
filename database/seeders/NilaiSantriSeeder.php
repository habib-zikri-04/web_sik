<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NilaiSantri;
use App\Models\Santri;
use App\Models\Subject;
use Illuminate\Support\Arr;

class NilaiSantriSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = Subject::where('kode', '!=', 'MGJ')->get();

        if ($subjects->isEmpty()) {
            return;
        }

        $feedbacks = [
            'Sangat baik, terus dipertahankan.',
            'Aktif dan menunjukkan pemahaman yang bagus.',
            'Perlu sedikit peningkatan dalam konsistensi.',
            'Cukup baik, namun masih bisa lebih fokus.',
            'Perlu latihan tambahan.',
        ];

        $santris = Santri::whereNotNull('kelas_id')->get();

        foreach ($santris as $santri) {
            foreach ($subjects as $subject) {

                // random nilai realistis
                $nilai = rand(65, 95);

                NilaiSantri::updateOrCreate(
                    [
                        'santri_id' => $santri->id,
                        'subject_id' => $subject->id,
                        'kelas_id' => $santri->kelas_id,
                    ],
                    [
                        'nilai' => $nilai,
                        'feedback' => Arr::random($feedbacks),
                    ]
                );
            }
        }
    }
}
