<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'general' => $this->faker->sentence(),
            'locale' => $this->faker->sentence(),
            'image' => $this->faker->word() . '.png'
        ];
    }
}
