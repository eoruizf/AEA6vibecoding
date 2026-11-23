<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-1 month', '+3 months');

        return [
            'user_id'       => User::factory(),
            'title'         => fake()->randomElement([
                'Paseo canino solidario', 'Feria de adopción', 'Taller de educación canina',
                'Quedada de perros', 'Jornada de vacunación', 'Concurso de disfraces caninos',
            ]),
            'description'   => fake()->paragraph(),
            'starts_at'     => $start,
            'ends_at'       => (clone $start)->modify('+3 hours'),
            'location_name' => fake()->company(),
            'address'       => fake()->streetAddress(),
            'city'          => fake()->city(),
            'price'         => fake()->optional(0.4)->randomFloat(2, 3, 25),
            'max_attendees' => fake()->optional()->numberBetween(10, 200),
            'status'        => 'published',
        ];
    }
}