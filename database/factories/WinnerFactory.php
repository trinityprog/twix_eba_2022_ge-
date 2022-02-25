<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WinnerFactory extends Factory
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
            'prize_id' => 1,
            'won_at' => now()->addDays(rand(0, 30))
        ];
    }
}
