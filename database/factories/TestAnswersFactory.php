<?php

namespace Database\Factories;

use App\Models\TestQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestAnswersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'text' => $this->faker->word(),
            'image' => $this->faker->word() . '.png',
        ];
    }
}
