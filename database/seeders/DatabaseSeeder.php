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
            AdoptionDogSeeder::class,
            EventSeeder::class,
            InteractionSeeder::class,
        ]);
    }
}