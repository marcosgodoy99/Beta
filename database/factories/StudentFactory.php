<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'lastname' => fake()->lastname(),
            'dni' => fake()->unique()->numerify('########'), 
            'curso' => fake()->randomElement(['1','2','3']),
            'group' => fake()->randomElement(['A','B']),
            'birthdate' => fake()->dateTimeBetween('-20 years', '-10 years')->format('Y-m-d'),
        ];
    }
}
