<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'email' => $this->faker->email(),
            'phone' => blink()->fake(),
            'question' => $this->faker->sentence(),
            'answer' => $this->faker->sentence(),
            'status' => rand(0, 1),
            'source' => $this->faker->randomElement(['web', 'telegram']),
        ];
    }
}
