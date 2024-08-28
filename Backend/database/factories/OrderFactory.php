<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'book_id' => Book::inRandomOrder()->first()->id, // Assumes a BookFactory exists
            'quantity' => $this->faker->numberBetween(1, 100),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
