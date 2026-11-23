<?php

namespace Database\Seeders;

use App\Models\AdoptionDog;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class InteractionSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ([AdoptionDog::all(), Event::all()] as $models) {
            foreach ($models as $model) {
                $users->random(min($users->count(), rand(0, 6)))->each(fn ($u) => $model->toggleLike($u));
                $users->random(min($users->count(), rand(0, 3)))->each(fn ($u) => $model->toggleFavorite($u));

                foreach (range(1, rand(0, 3)) as $i) {
                    $model->comments()->create([
                        'user_id' => $users->random()->id,
                        'body'    => fake()->sentence(10),
                    ]);
                }
            }
        }
    }
}