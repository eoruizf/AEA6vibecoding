<?php

namespace Database\Seeders;

use App\Models\AdoptionDog;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdoptionDogSeeder extends Seeder
{
    public function run(): void
    {
        $ownerIds = User::whereIn('email', [
            'laia.martinez@example.com',
            'marc.vilalta@example.com',
            'clara.puig@example.com',
            'oriol.soler@example.com',
            'nuria.ferrer@example.com',
        ])->pluck('id', 'email');

        $dogs = [
            ['name' => 'Otto', 'breed' => 'Mestizo mediano', 'sex' => 'male', 'size' => 'medium', 'monthsAgo' => 36, 'weight' => 16.20, 'color' => 'Negro', 'city' => 'Sabadell', 'owner' => 'laia.martinez@example.com', 'status' => 'available', 'neutered' => true, 'vaccinated' => true, 'microchipped' => true, 'kids' => true, 'dogs' => true, 'description' => 'Otto es alegre, sociable y busca una familia activa. Se lleva bien con otros perros.', 'requirements' => 'Paseos diarios y seguimiento inicial de adaptación.'],
            ['name' => 'Pipa', 'breed' => 'Podenco', 'sex' => 'female', 'size' => 'medium', 'monthsAgo' => 24, 'weight' => 13.80, 'color' => 'Canela', 'city' => 'Terrassa', 'owner' => 'marc.vilalta@example.com', 'status' => 'available', 'neutered' => true, 'vaccinated' => true, 'microchipped' => true, 'kids' => true, 'dogs' => true, 'description' => 'Pipa es dulce y observadora. Disfruta de largos paseos y necesita paciencia en su adaptación.', 'requirements' => 'Preferiblemente hogar con experiencia y jardín o acceso a rutas.'],
            ['name' => 'Simba', 'breed' => 'Golden Retriever', 'sex' => 'male', 'size' => 'large', 'monthsAgo' => 18, 'weight' => 27.50, 'color' => 'Dorado', 'city' => 'Cerdanyola del Vallès', 'owner' => 'clara.puig@example.com', 'status' => 'reserved', 'neutered' => true, 'vaccinated' => true, 'microchipped' => true, 'kids' => true, 'dogs' => true, 'description' => 'Simba es afectuoso, tranquilo y muy sociable con personas y perros.', 'requirements' => 'Espacio suficiente y familia disponible para paseos frecuentes.'],
            ['name' => 'Gala', 'breed' => 'Galgo', 'sex' => 'female', 'size' => 'large', 'monthsAgo' => 48, 'weight' => 22.10, 'color' => 'Blanco y marrón', 'city' => 'Rubí', 'owner' => 'oriol.soler@example.com', 'status' => 'available', 'neutered' => true, 'vaccinated' => true, 'microchipped' => true, 'kids' => false, 'dogs' => true, 'description' => 'Gala tiene carácter sereno y disfruta mucho de la compañía tranquila en casa.', 'requirements' => 'Se recomienda hogar sin gatos y con paseos en entorno seguro.'],
            ['name' => 'Toby', 'breed' => 'Fox Terrier', 'sex' => 'male', 'size' => 'small', 'monthsAgo' => 30, 'weight' => 8.60, 'color' => 'Blanco y negro', 'city' => 'Ripollet', 'owner' => 'nuria.ferrer@example.com', 'status' => 'adopted', 'neutered' => true, 'vaccinated' => true, 'microchipped' => true, 'kids' => true, 'dogs' => false, 'description' => 'Toby ya cuenta con una familia adoptante. Es inteligente y muy enérgico.', 'requirements' => 'Adopción completada.'],
            ['name' => 'Kiwi', 'breed' => 'Mestiza pequeña', 'sex' => 'female', 'size' => 'small', 'monthsAgo' => 12, 'weight' => 5.40, 'color' => 'Marrón', 'city' => 'Sabadell', 'owner' => 'laia.martinez@example.com', 'status' => 'available', 'neutered' => false, 'vaccinated' => true, 'microchipped' => true, 'kids' => true, 'dogs' => true, 'description' => 'Kiwi es una cachorra curiosa que aprende rápido y busca juegos seguros.', 'requirements' => 'Compromiso de esterilización y educación positiva.'],
            ['name' => 'Bowie', 'breed' => 'Pastor belga', 'sex' => 'male', 'size' => 'large', 'monthsAgo' => 55, 'weight' => 29.30, 'color' => 'Negro', 'city' => 'Barcelona', 'owner' => 'clara.puig@example.com', 'status' => 'reserved', 'neutered' => true, 'vaccinated' => true, 'microchipped' => true, 'kids' => false, 'dogs' => true, 'description' => 'Bowie es inteligente y activo. Necesita una rutina con actividad física y mental.', 'requirements' => 'Hogar con experiencia en perros de trabajo.'],
            ];

        foreach ($dogs as $data) {
            AdoptionDog::updateOrCreate(
                ['name' => $data['name'], 'city' => $data['city']],
                [
                    'user_id' => $ownerIds[$data['owner']],
                    'description' => $data['description'],
                    'date_of_birth' => now()->subMonths($data['monthsAgo'])->format('Y-m-d'),
                    'breed' => $data['breed'],
                    'sex' => $data['sex'],
                    'size' => $data['size'],
                    'weight' => $data['weight'],
                    'color' => $data['color'],
                    'is_neutered' => $data['neutered'],
                    'is_vaccinated' => $data['vaccinated'],
                    'is_microchipped' => $data['microchipped'],
                    'good_with_kids' => $data['kids'],
                    'good_with_dogs' => $data['dogs'],
                    'adoption_requirements' => $data['requirements'],
                    'status' => $data['status'],
                    'photos' => null,
                ]
            );
        }
    }
}