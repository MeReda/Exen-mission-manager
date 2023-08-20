<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mission>
 */
class MissionFactory extends Factory
{
    protected $model = \App\Models\Mission::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->text(10),
            'object' => fake()->text(10),
            'description' => fake()->text(),
            'place' => fake()->address(),
            'date' => fake()->date(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'companion' => fake()->name(),
            'budget' => fake()->randomNumber(4),
            'state' => fake()->randomElement(['complete', 'incomplete']),
            'user_id' => random_int(1,11),
        ];
    }
}
