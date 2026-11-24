<?php

namespace Database\Seeders;

use App\Models\AdoptionDog;
use App\Models\Dog;
use App\Models\Event;
use App\Models\Park;
use App\Models\VeterinaryCenter;
use App\Models\User;
use Illuminate\Database\Seeder;

class InteractionSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::whereIn('email', [
            'admin@example.com',
            'user@example.com',
            'laia.martinez@example.com',
            'marc.vilalta@example.com',
            'clara.puig@example.com',
            'oriol.soler@example.com',
            'nuria.ferrer@example.com',
            'jordi.roca@example.com',
        ])->get();

        if ($users->isEmpty()) {
            return;
        }

        $models = collect()
            ->concat(Dog::all())
            ->concat(Park::all())
            ->concat(VeterinaryCenter::all())
            ->concat(Event::all())
            ->concat(AdoptionDog::all());

        foreach ($models as $model) {
            foreach ($users->take(3) as $index => $user) {
                $model->likes()->firstOrCreate(['user_id' => $user->id]);

                if ($index < 2) {
                    $model->favorites()->firstOrCreate(['user_id' => $user->id]);
                }

                $body = match ($model::class) {
                    Dog::class => 'Qué perro tan bonito. Espero que siga disfrutando de muchos paseos.',
                    Park::class => 'Buen espacio para conocer a otros perros y propietarios de la zona.',
                    VeterinaryCenter::class => 'Información útil para preparar una visita responsable.',
                    Event::class => 'Una actividad interesante para compartir con nuestra comunidad canina.',
                    AdoptionDog::class => 'Esperemos que encuentre pronto una familia adecuada y responsable.',
                };

                $model->comments()->firstOrCreate([
                    'user_id' => $user->id,
                    'body' => $body,
                ]);
            }
        }
    }
}