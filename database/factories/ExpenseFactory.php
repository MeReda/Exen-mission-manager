<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    protected $model = \App\Models\Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category' => fake()->randomElement(['transport', 'food', 'accommodation', 'other']),
            'amount' => fake()->randomNumber(3),
            'description' => fake()->text(),
            'receipt_image' => fake()->imageUrl(),
            'mission_id' => random_int(1,30),
        ];
    }
}
