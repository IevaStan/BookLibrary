<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'name' => fake()->name,
            // 'surname' => fake()->name,
            // 'birthdate' => fake()->date(),
            // 'country' => fake()->country        
            'name' =>$this->faker->firstName(),
            'surname' =>$this->faker->lastName(),
            'birthdate' =>$this->faker->dateTimeBetween('-70 year', '-18 year'),
            'country' =>$this->faker->country() 
        ];
    }
}
