<?php

namespace Database\Factories;

use App\Models\TestVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestQuestionFactory extends Factory
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
            'locale' => $this->faker->sentence()
        ];
    }
}
