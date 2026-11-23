<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        Event::factory()->count(10)->create([
            'user_id' => fn () => $users->random()->id,
        ]);
    }
}