<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    protected $model = Driver::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'persentase_hasil' => $this->faker->randomElement([45, 50, 40]),
            'tanggungan_koperasi' => $this->faker->randomElement([75000, 100000, 50000]),
        ];
    }
}
