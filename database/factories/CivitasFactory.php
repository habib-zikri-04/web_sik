<?php

namespace Database\Factories;

use App\Models\Civitas;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CivitasFactory extends Factory
{
    protected $model = Civitas::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state([
                'role' => 'civitas',   // sesuaikan nama role di tabel users
            ]),

            'nama'   => $this->faker->name(),
            'email'  => $this->faker->unique()->safeEmail(),
            'no_hp'  => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
        ];
    }
}
