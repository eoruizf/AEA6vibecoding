<?php

namespace Database\Seeders;

use App\Models\AdoptionDog;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdoptionDogSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        AdoptionDog::factory()->count(15)->create([
            'user_id' => fn () => $users->random()->id,
        ]);
    }
}