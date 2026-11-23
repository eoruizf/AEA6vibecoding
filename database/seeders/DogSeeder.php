<?php

namespace Database\Seeders;

use App\Models\Dog;
use App\Models\User;
use Illuminate\Database\Seeder;

class DogSeeder extends Seeder
{
    public function run(): void
    {
        // Kol user 3ando 0 l 3 klab
        User::all()->each(function (User $user) {
            Dog::factory()->count(fake()->numberBetween(0, 3))->create(['user_id' => $user->id]);
        });
    }
}