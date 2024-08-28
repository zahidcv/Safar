<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fn () => User::inRandomOrder()->first()->id,
            'year' => $this->faker->year(),
            'make' => $this->faker->company(),
            'model' => $this->faker->word(),
            'color' => $this->faker->safeColorName(),
            'license_plate' => strtoupper($this->faker->bothify('??####')),
        ];
    }
}
