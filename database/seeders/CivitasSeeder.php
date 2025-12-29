<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Civitas;
use Illuminate\Support\Facades\Hash;

class CivitasSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {

            $email = "civitas{$i}@example.com";

            // user
            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => "Civitas {$i}",
                    'password' => Hash::make('password'),
                    'role' => 'civitas',
                ]
            );

            // civitas
            Civitas::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nama' => "Civitas {$i}",
                    'email' => $email,
                ]
            );
        }
    }
}
