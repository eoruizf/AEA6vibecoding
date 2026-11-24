<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DogSeeder::class,
            ParkSeeder::class,
            VeterinaryCenterSeeder::class,
            EventSeeder::class,
            AdoptionDogSeeder::class,
            InteractionSeeder::class,
        ]);
    }
}