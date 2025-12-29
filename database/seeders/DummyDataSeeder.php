<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Santri;
use App\Models\Pengajar;
use App\Models\Civitas;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // 100 SANTRI
        for ($i = 0; $i < 30; $i++) {
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // semua pakai password "password"
                'role' => 'santri',
            ]);

            Santri::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'email' => $user->email,
                'no_hp' => fake()->phoneNumber(),
                'alamat' => fake()->address(),
                'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            ]);
        }

        // 10 PENGAJAR
        $subjects = Subject::all(); // KEI, KIM, KHS
        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'guru',
            ]);

            Pengajar::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'email' => $user->email,
                'no_hp' => fake()->phoneNumber(),
                'alamat' => fake()->address(),
                'subject_id' => $subjects->random()->id,
            ]);
        }

        // 20 CIVITAS
        for ($i = 0; $i < 20; $i++) {
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'civitas',
            ]);

            Civitas::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'email' => $user->email,
                'no_hp' => fake()->phoneNumber(),
                'alamat' => fake()->address(),
            ]);
        }
    }
}
