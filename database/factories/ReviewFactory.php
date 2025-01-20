<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' => null,
            'review' => fake()->paragraph(),
            'rating' => fake()->numberBetween(1,5),
            'created_at' => fake()->dateTimeBetween('-2 years'),
            'updated_at' => fake()->dateTimeBetween('created_at', 'now')
        ];
    }


    // The purpose of this STATE METHODS is that allow us to overwrite some of the columns that the definition generates, in order to get more different results
    
    public function good()
    {
        return $this->state(function (array $attributes) {
            return[
                'rating' => fake()->numberBetween(4, 5),

            ];
        });
    }

    public function bad()
    {
        return $this->state(function (array $attributes) {
            return[
                'rating' => fake()->numberBetween(1, 3),
                
            ];
        });
    }

    public function avg()
    {
        return $this->state(function (array $attributes) {
            return[
                'rating' => fake()->numberBetween(2, 5),
                
            ];
        });
    }
}
