<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // GURU
        User::updateOrCreate(
            ['email' => 'guru@example.com'],
            [
                'name' => 'Guru Satu',
                'password' => Hash::make('password'),
                'role' => 'guru',
            ]
        );

        // SISWA
        User::updateOrCreate(
            ['email' => 'siswa@example.com'],
            [
                'name' => 'Siswa Contoh',
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ]
        );

        // SEMA
        User::updateOrCreate(
            ['email' => 'sema@example.com'],
            [
                'name' => 'Ketua SEMA',
                'password' => Hash::make('password'),
                'role' => 'sema',
            ]
        );

        // DEMA
        User::updateOrCreate(
            ['email' => 'dema@example.com'],
            [
                'name' => 'Ketua DEMA',
                'password' => Hash::make('password'),
                'role' => 'dema',
            ]
        );
    }
}
