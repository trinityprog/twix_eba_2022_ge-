<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CheckFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => $this->faker->image(),
            'date' => now()->addDays(rand(0, 30)),
            'time' => $this->faker->time(),
            'sum' => $this->faker->numerify('#####'),
            'status' => $this->faker->numberBetween(0, 2),
            'source' => $this->faker->randomElement(['web', 'telegram']),
            'user_id' => rand(2, 101),
            'created_at' => now()->addDays(rand(0, 30)),
        ];
    }
}
