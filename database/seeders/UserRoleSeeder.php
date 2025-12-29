<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // // GURU
        // User::updateOrCreate(
        //     ['email' => 'guru1@example.com'],
        //     [
        //         'name' => 'Guru 1',
        //         'password' => Hash::make('password'),
        //         'role' => 'guru',
        //     ]
        // );

        // User::updateOrCreate(
        //     ['email' => 'guru2@example.com'],
        //     [
        //         'name' => 'Guru 2',
        //         'password' => Hash::make('password'),
        //         'role' => 'guru',
        //     ]
        // );

        // // SANTRI
        // User::updateOrCreate(
        //     ['email' => 'santri1@example.com'],
        //     [
        //         'name' => 'Santri 1',
        //         'password' => Hash::make('password'),
        //         'role' => 'santri',
        //     ]
        // );

        // User::updateOrCreate(
        //     ['email' => 'santri2@example.com'],
        //     [
        //         'name' => 'Santri 2',
        //         'password' => Hash::make('password'),
        //         'role' => 'santri',
        //     ]
        // );

        // // CIVITAS
        // User::updateOrCreate(
        //     ['email' => 'civitas1@example.com'],
        //     [
        //         'name' => 'Civitas 1',
        //         'password' => Hash::make('password'),
        //         'role' => 'civitas',
        //     ]
        // );
    }
}
