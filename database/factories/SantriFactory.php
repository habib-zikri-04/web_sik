<?php

namespace Database\Factories;

use App\Models\Santri;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SantriFactory extends Factory
{
    protected $model = Santri::class;

    public function definition(): array
    {
        return [
            // otomatis bikin user baru dengan role 'siswa'
            'user_id' => User::factory()->state([
                'role' => 'santri',
            ]),

            'nama'   => $this->faker->name(),
            'email'  => $this->faker->unique()->safeEmail(),
            'no_hp'  => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
            'jenis_kelamin' => $this->faker->randomElement(['L','P']),
        ];
    }
}
