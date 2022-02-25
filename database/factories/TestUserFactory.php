<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(2, 101),
            'result_id' => rand(1, 40),
            'created_at' => now()->addDays(rand(0, 30)),
        ];
    }
}
