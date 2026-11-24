<?php

namespace Database\Seeders;

use App\Models\Dog;
use App\Models\User;
use Illuminate\Database\Seeder;

class DogSeeder extends Seeder
{
    public function run(): void
    {
        $ownerIds = User::whereIn('email', [
            'laia.martinez@example.com',
            'marc.vilalta@example.com',
            'clara.puig@example.com',
            'oriol.soler@example.com',
            'nuria.ferrer@example.com',
            'jordi.roca@example.com',
            'anna.costa@example.com',
            'pol.grau@example.com',
        ])->pluck('id', 'email');

        $dogs = [
            ['name' => 'Bruna', 'breed' => 'Border Collie', 'monthsAgo' => 48, 'sex' => 'female', 'weight' => 18.40, 'color' => 'Negro y blanco', 'neutered' => true, 'owner' => 'laia.martinez@example.com', 'description' => 'Muy activa y cariñosa. Le encantan los juegos de inteligencia y los paseos largos.', 'microchip' => 'CAT-DEMO-DOG-001'],
            ['name' => 'Thor', 'breed' => 'Labrador Retriever', 'monthsAgo' => 62, 'sex' => 'male', 'weight' => 31.20, 'color' => 'Dorado', 'neutered' => true, 'owner' => 'marc.vilalta@example.com', 'description' => 'Tranquilo con familias y otros perros. Disfruta del agua y las reuniones al aire libre.', 'microchip' => 'CAT-DEMO-DOG-002'],
            ['name' => 'Nala', 'breed' => 'Pastor Alemán', 'monthsAgo' => 84, 'sex' => 'female', 'weight' => 28.10, 'color' => 'Marrón y negro', 'neutered' => true, 'owner' => 'clara.puig@example.com', 'description' => 'Atenta y protectora, con buen manejo en paseos. Le gustan las actividades de olfato.', 'microchip' => 'CAT-DEMO-DOG-003'],
            ['name' => 'Coco', 'breed' => 'Caniche mediano', 'monthsAgo' => 30, 'sex' => 'male', 'weight' => 9.30, 'color' => 'Blanco', 'neutered' => false, 'owner' => 'oriol.soler@example.com', 'description' => 'Pequeño, sociable y curioso. Se adapta bien a pisos y rutas urbanas.', 'microchip' => 'CAT-DEMO-DOG-004'],
            ['name' => 'Luna', 'breed' => 'Mestiza', 'monthsAgo' => 20, 'sex' => 'female', 'weight' => 12.80, 'color' => 'Negro y marrón', 'neutered' => true, 'owner' => 'nuria.ferrer@example.com', 'description' => 'Joven y alegre, en aprendizaje de educación básica. Busca amigos de juego.', 'microchip' => 'CAT-DEMO-DOG-005'],
            ['name' => 'Max', 'breed' => 'Beagle', 'monthsAgo' => 75, 'sex' => 'male', 'weight' => 14.60, 'color' => 'Tricolor', 'neutered' => true, 'owner' => 'jordi.roca@example.com', 'description' => 'Aficionado al rastreo y a los paseos. Sociable con otros perros, curioso y atento.', 'microchip' => 'CAT-DEMO-DOG-006'],
            ['name' => 'Mia', 'breed' => 'Shiba Inu', 'monthsAgo' => 42, 'sex' => 'female', 'weight' => 8.90, 'color' => 'Naranja y blanco', 'neutered' => true, 'owner' => 'anna.costa@example.com', 'description' => 'Independiente pero cariñosa. Muy observadora y tranquila en el entorno urbano.', 'microchip' => 'CAT-DEMO-DOG-007'],
            ['name' => 'Rocky', 'breed' => 'Bulldog francés', 'monthsAgo' => 55, 'sex' => 'male', 'weight' => 12.40, 'color' => 'Atigrado', 'neutered' => true, 'owner' => 'pol.grau@example.com', 'description' => 'Divertido y dormilón. Necesita ejercicio moderado y paseos sin calor excesivo.', 'microchip' => 'CAT-DEMO-DOG-008'],
            ['name' => 'Tala', 'breed' => 'Husky Siberiano', 'monthsAgo' => 38, 'sex' => 'female', 'weight' => 21.50, 'color' => 'Gris y blanco', 'neutered' => false, 'owner' => 'laia.martinez@example.com', 'description' => 'Enérgica y expresiva. Disfruta de rutas largas y actividades deportivas caninas.', 'microchip' => 'CAT-DEMO-DOG-009'],
            ['name' => 'Bimba', 'breed' => 'Teckel', 'monthsAgo' => 96, 'sex' => 'female', 'weight' => 7.20, 'color' => 'Negro y fuego', 'neutered' => true, 'owner' => 'marc.vilalta@example.com', 'description' => 'Pequeña y valiente, con buen carácter. Prefiere paseos tranquilos y zonas conocidas.', 'microchip' => 'CAT-DEMO-DOG-010'],
        ];

        foreach ($dogs as $data) {
            Dog::updateOrCreate(
                ['microchip_number' => $data['microchip']],
                [
                    'user_id' => $ownerIds[$data['owner']],
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'date_of_birth' => now()->subMonths($data['monthsAgo'])->format('Y-m-d'),
                    'breed' => $data['breed'],
                    'sex' => $data['sex'],
                    'weight' => $data['weight'],
                    'photos' => null,
                    'is_neutered' => $data['neutered'],
                    'color' => $data['color'],
                ]
            );
        }
    }
}