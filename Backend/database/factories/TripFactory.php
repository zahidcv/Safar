<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
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
            'driver_id' => fn () => Driver::inRandomOrder()->first()->id, // Creates a new Driver model instance
            'is_started' => $this->faker->boolean(),
            'is_completed' => $this->faker->boolean(),
            'origin' => json_encode([
                'latitude' => $this->faker->latitude,
                'longitude' => $this->faker->longitude,
            ]), // Generating an array and encoding it as JSON
            'destination' => json_encode([
                'latitude' => $this->faker->latitude,
                'longitude' => $this->faker->longitude,
            ]),
            'destination_name' => $this->faker->optional()->word(),
            'driver_location' => json_encode([
                'latitude' => $this->faker->latitude,
                'longitude' => $this->faker->longitude,
            ]),
        ];
    }
}
