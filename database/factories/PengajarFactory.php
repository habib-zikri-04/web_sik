<?php

namespace Database\Factories;

use App\Models\Pengajar;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengajarFactory extends Factory
{
    protected $model = Pengajar::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state([
                'role' => 'guru',
            ]),

            'nama'   => $this->faker->name(),
            'email'  => $this->faker->unique()->safeEmail(),
            'no_hp'  => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
        ];
    }
}
