<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ci' => fake()->randomNumber(8,true),
            'surname' => fake()->lastName(),
            'name' => fake()->firstName(),
            'birthdate' => fake()->date(),
            'gender' => fake()->randomKey([0,1])
        ];
    }
}
