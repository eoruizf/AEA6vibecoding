<?php

namespace Database\Seeders;

use App\Models\VeterinaryCenter;
use Illuminate\Database\Seeder;

class VeterinaryCenterSeeder extends Seeder
{
    public function run(): void
    {
        $centers = [
            [
                'name' => 'Clínica Veterinària Demo Sabadell Nord',
                'description' => 'Centro veterinario ficticio orientado a atención preventiva, consulta general y bienestar animal.',
                'address' => 'Carrer del Nord, 18',
                'city' => 'Sabadell',
                'latitude' => 41.5579000,
                'longitude' => 2.1118000,
                'phone' => '+34 937 000 101',
                'email' => 'demo-sabadell-nord@example.com',
                'website' => 'https://example.com/demo-sabadell-nord',
                'opening_hours' => 'Lunes a viernes de 09:00 a 20:00. Sábados de 09:00 a 14:00.',
                'services' => ['Vacunación', 'Diagnóstico', 'Microchip', 'Peluquería'],
            ],
            [
                'name' => 'Centre Veterinaris Demo Vallès',
                'description' => 'Centro de demostración para cirugía, hospitalización y seguimiento clínico de caninos.',
                'address' => 'Avinguda de Barberà, 240',
                'city' => 'Sabadell',
                'latitude' => 41.5386000,
                'longitude' => 2.1159000,
                'phone' => '+34 937 000 102',
                'email' => 'demo-valles@example.com',
                'website' => 'https://example.com/demo-valles',
                'opening_hours' => 'Lunes a sábado de 09:00 a 21:00',
                'services' => ['Cirugía', 'Diagnóstico', 'Hospitalización', 'Urgencias'],
            ],
            [
                'name' => 'Hospital Veterinari Fictici Terrassa',
                'description' => 'Centro ficticio especializado en urgencias y atención integral de animales de compañía.',
                'address' => 'Carrer de la Rasa, 70',
                'city' => 'Terrassa',
                'latitude' => 41.5657000,
                'longitude' => 2.0163000,
                'phone' => '+34 937 000 103',
                'email' => 'demo-terrassa@example.com',
                'website' => null,
                'opening_hours' => 'Urgencias 24 horas. Consultas de 10:00 a 20:00.',
                'services' => ['Urgencias', 'Cirugía', 'Diagnóstico', 'Hospitalización'],
            ],
            [
                'name' => 'Veterinària Demo Cerdanyola',
                'description' => 'Clínica de demostración centrada en medicina preventiva y microchipado.',
                'address' => 'Plaça del Mercat, 9',
                'city' => 'Cerdanyola del Vallès',
                'latitude' => 41.4913000,
                'longitude' => 2.1357000,
                'phone' => '+34 937 000 104',
                'email' => 'demo-cerdanyola@example.com',
                'website' => 'https://example.com/demo-cerdanyola',
                'opening_hours' => 'Lunes a viernes de 09:30 a 19:30',
                'services' => ['Vacunación', 'Microchip', 'Diagnóstico', 'Peluquería'],
            ],
            [
                'name' => 'Centre Animal Demo Ripollet',
                'description' => 'Centro veterinario ficticio con atención general y orientación conductual para propietarios.',
                'address' => 'Carrer de Sant Lluís, 33',
                'city' => 'Ripollet',
                'latitude' => 41.4971000,
                'longitude' => 2.1556000,
                'phone' => '+34 937 000 105',
                'email' => null,
                'website' => null,
                'opening_hours' => 'Lunes a viernes de 10:00 a 19:00',
                'services' => ['Vacunación', 'Diagnóstico', 'Peluquería'],
            ],
            [
                'name' => 'Urgències Veterinàries Demo Barcelona Nord',
                'description' => 'Servicio ficticio de urgencias para pruebas y demostraciones de la aplicación.',
                'address' => 'Avinguda Meridiana, 390',
                'city' => 'Barcelona',
                'latitude' => 41.4235000,
                'longitude' => 2.1882000,
                'phone' => '+34 937 000 106',
                'email' => 'demo-urgencias-nord@example.com',
                'website' => 'https://example.com/demo-urgencias-nord',
                'opening_hours' => 'Urgencias disponibles las 24 horas',
                'services' => ['Urgencias', 'Diagnóstico', 'Hospitalización', 'Cirugía'],
            ],
        ];

        foreach ($centers as $data) {
            VeterinaryCenter::updateOrCreate(['name' => $data['name']], $data);
        }
    }
}
