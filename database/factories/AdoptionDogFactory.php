<?php

namespace Database\Factories;

use App\Models\AdoptionDog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdoptionDogFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id'               => User::factory(),
            'name'                  => fake()->firstName(),
            'description'           => fake()->paragraph(),
            'date_of_birth'         => fake()->dateTimeBetween('-10 years', '-3 months'),
            'breed'                 => fake()->randomElement(['Labrador', 'Pastor Alemán', 'Husky', 'Beagle', 'Bulldog', 'Caniche', 'Mestizo']),
            'sex'                   => fake()->randomElement(array_keys(AdoptionDog::SEXES)),
            'size'                  => fake()->randomElement(array_keys(AdoptionDog::SIZES)),
            'weight'                => fake()->randomFloat(2, 3, 40),
            'color'                 => fake()->randomElement(['Negro', 'Marrón', 'Blanco', 'Dorado', 'Gris']),
            'city'                  => fake()->city(),
            'is_neutered'           => fake()->boolean(),
            'is_vaccinated'         => fake()->boolean(80),
            'is_microchipped'       => fake()->boolean(70),
            'good_with_kids'        => fake()->boolean(),
            'good_with_dogs'        => fake()->boolean(),
            'adoption_requirements' => fake()->optional()->sentence(10),
            'status'                => fake()->randomElement(['available', 'available', 'available', 'reserved', 'adopted']),
            'photos'                => null,
        ];
    }
}