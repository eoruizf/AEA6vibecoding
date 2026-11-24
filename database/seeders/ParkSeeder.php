<?php

namespace Database\Seeders;

use App\Models\Park;
use Illuminate\Database\Seeder;

class ParkSeeder extends Seeder
{
    public function run(): void
    {
        $parks = [
            [
                'name' => 'Parc caní de les Planes',
                'description' => 'Zona verde tranquila con recorridos amplios para pasear y socializar entre perros.',
                'address' => 'Avinguda de les Planes, 32',
                'city' => 'Sabadell',
                'latitude' => 41.5557000,
                'longitude' => 2.0931000,
                'phone' => null,
                'email' => null,
                'website' => null,
                'opening_hours' => 'Apertura diurna. Horario sujeto a normativa municipal.',
                'services' => ['Agua', 'Bancos', 'Bolsas para residuos', 'Zona vallada'],
                'has_dog_zone' => true,
            ],
            [
                'name' => 'Zona canina del Parc Central',
                'description' => 'Espacio vallado junto al parque central, adecuado para encuentros y juegos supervisados.',
                'address' => 'Passeig de la Plaça Major',
                'city' => 'Sabadell',
                'latitude' => 41.5428000,
                'longitude' => 2.1066000,
                'phone' => null,
                'email' => null,
                'website' => null,
                'opening_hours' => 'Abierto todos los días de 07:00 a 22:00',
                'services' => ['Agua', 'Canchas', 'Bancos', 'Zona vallada'],
                'has_dog_zone' => true,
            ],
            [
                'name' => 'Espai Gos del Turó d’en Querol',
                'description' => 'Parque periurbano con zonas de sombra y senderos amplios para paseos tranquilos.',
                'address' => 'Camí del Turó d’en Querol',
                'city' => 'Sabadell',
                'latitude' => 41.5682000,
                'longitude' => 2.1113000,
                'phone' => null,
                'email' => null,
                'website' => null,
                'opening_hours' => 'Apertura diurna',
                'services' => ['Agua', 'Senderos', 'Bancos'],
                'has_dog_zone' => true,
            ],
            [
                'name' => 'Parc de Can Gambús',
                'description' => 'Gran zona natural con amplias superficies verdes y rutas aptas para pasear con perro.',
                'address' => 'Camí de Can Gambús',
                'city' => 'Sabadell',
                'latitude' => 41.5509000,
                'longitude' => 2.0724000,
                'phone' => null,
                'email' => null,
                'website' => null,
                'opening_hours' => 'De 08:00 a 21:00',
                'services' => ['Senderos', 'Agua', 'Bolsas para residuos'],
                'has_dog_zone' => false,
            ],
            [
                'name' => 'Zona canina de Sant Jordi',
                'description' => 'Espacio de tamaño medio orientado a socialización responsable y juego controlado.',
                'address' => 'Carrer de Sant Jordi',
                'city' => 'Terrassa',
                'latitude' => 41.5572000,
                'longitude' => 2.0197000,
                'phone' => null,
                'email' => null,
                'website' => null,
                'opening_hours' => 'Todos los días de 07:30 a 22:30',
                'services' => ['Agua', 'Canchas', 'Bancos', 'Zona vallada'],
                'has_dog_zone' => true,
            ],
            [
                'name' => 'Parc dels Ocellets',
                'description' => 'Parque urbano familiar con una zona apta para perros en su perímetro exterior.',
                'address' => 'Avinguda de Castellar, 12',
                'city' => 'Cerdanyola del Vallès',
                'latitude' => 41.4955000,
                'longitude' => 2.1392000,
                'phone' => null,
                'email' => null,
                'website' => null,
                'opening_hours' => 'De 08:00 a 20:30',
                'services' => ['Bancos', 'Bolsas para residuos', 'Agua'],
                'has_dog_zone' => false,
            ],
            [
                'name' => 'Parc caní de la Rambla',
                'description' => 'Zona canina urbana con superficie segura y elementos básicos para el descanso de propietarios.',
                'address' => 'Rambla d’Ègara, 45',
                'city' => 'Terrassa',
                'latitude' => 41.5636000,
                'longitude' => 2.0101000,
                'phone' => null,
                'email' => null,
                'website' => null,
                'opening_hours' => 'Abierto todos los días',
                'services' => ['Agua', 'Canchas', 'Zona vallada'],
                'has_dog_zone' => true,
            ],
        ];

        foreach ($parks as $data) {
            Park::updateOrCreate(['name' => $data['name']], $data);
        }
    }
}
