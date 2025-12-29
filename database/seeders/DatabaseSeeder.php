<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::updateOrCreate([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);



        $this->call([
        UserRoleSeeder::class,
        SubjectsSeeder::class,
        KelasSeeder::class,
        PengajarsSeeder::class,
        SantrisSeeder::class,
        CivitasSeeder::class,
        JadwalsSeeder::class,
        AbsensiSeeder::class,
        NilaiSantriSeeder::class,
        ]);

    }



}
