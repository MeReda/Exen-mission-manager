<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fname' => 'Admin',
            'lname' => 'Admin',
            'CIN' => $this->faker->regexify('[A-Z]{1}[0-9]{6}'),
            'email' => 'admin@exen.com',
            'password' => '$2y$10$4II/hf.x/VyJBXDxmpA5Q.F5g9dsmBAXkRJLsn6pddOyPoreQ9gHK', // test
            'profile' => 'developer',
            'type' => 'admin',
        ];
    }
}
