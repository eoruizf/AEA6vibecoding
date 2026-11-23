<?php

namespace Database\Factories;

use App\Models\Dog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DogFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'       => User::factory(),
            'name'          => fake()->firstName(),
            'description'   => fake()->optional()->sentence(12),
            'date_of_birth' => fake()->dateTimeBetween('-12 years', '-2 months'),
            'breed'         => fake()->randomElement(['Labrador', 'Pastor Alemán', 'Husky', 'Beagle', 'Bulldog', 'Caniche', 'Mestizo']),
            'sex'           => fake()->randomElement(Dog::SEXES),
            'weight'        => fake()->randomFloat(2, 3, 45),
            'photos'        => null,
            'is_neutered'   => fake()->boolean(),
            'color'         => fake()->randomElement(['Negro', 'Marrón', 'Blanco', 'Dorado', 'Gris']),
        ];
    }
}