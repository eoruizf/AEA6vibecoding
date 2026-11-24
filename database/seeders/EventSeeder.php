<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $owners = User::whereIn('email', [
            'laia.martinez@example.com',
            'marc.vilalta@example.com',
            'clara.puig@example.com',
            'oriol.soler@example.com',
            'nuria.ferrer@example.com',
            'jordi.roca@example.com',
        ])->pluck('id', 'email');

        $events = [
            ['title' => 'Paseo social por el Parc Central', 'days' => 7, 'hours' => 18, 'city' => 'Sabadell', 'location' => 'Parc Central de Sabadell', 'address' => 'Passeig de la Plaça Major', 'owner' => 'laia.martinez@example.com', 'price' => 0, 'limit' => 30, 'description' => 'Paseo tranquilo para perros y propietarios, con paradas para socialización responsable.'],
            ['title' => 'Encuentro de cachorros de Sabadell', 'days' => 12, 'hours' => 17, 'city' => 'Sabadell', 'location' => 'Parc caní de les Planes', 'address' => 'Avinguda de les Planes, 32', 'owner' => 'marc.vilalta@example.com', 'price' => 0, 'limit' => 20, 'description' => 'Quedada de cachorros de hasta 12 meses con juegos supervisados y consejos básicos.'],
            ['title' => 'Taller de educación positiva', 'days' => 16, 'hours' => 10, 'city' => 'Terrassa', 'location' => 'Espacio comunitario ficticio Terrassa', 'address' => 'Carrer de la Rasa, 70', 'owner' => 'clara.puig@example.com', 'price' => 12, 'limit' => 15, 'description' => 'Taller práctico de refuerzo positivo, llamadas y manejo relajado durante paseos urbanos.'],
            ['title' => 'Feria de adopción del Vallès', 'days' => 21, 'hours' => 11, 'city' => 'Sabadell', 'location' => 'Zona ajardinada de la Plaza Mayor', 'address' => 'Plaça de la Vila', 'owner' => 'nuria.ferrer@example.com', 'price' => 0, 'limit' => 100, 'description' => 'Encuentro informativo de adopción responsable con perros disponibles de asociaciones locales ficticias.'],
            ['title' => 'Ruta canina por Sant Jordi', 'days' => 26, 'hours' => 9, 'city' => 'Terrassa', 'location' => 'Rambla d’Ègara', 'address' => 'Rambla d’Ègara, 45', 'owner' => 'jordi.roca@example.com', 'price' => 0, 'limit' => 25, 'description' => 'Ruta urbana suave con paradas educativas y zona de juego al final del recorrido.'],
            ['title' => 'Taller de primeros auxilios caninos', 'days' => 31, 'hours' => 16, 'city' => 'Cerdanyola del Vallès', 'location' => 'Centro demo Cerdanyola', 'address' => 'Plaça del Mercat, 9', 'owner' => 'oriol.soler@example.com', 'price' => 18, 'limit' => 18, 'description' => 'Sesión demostrativa sobre prevención, vendajes básicos y cuándo acudir al veterinario.'],
            ['title' => 'Excursión canina al Turó d’en Querol', 'days' => 38, 'hours' => 9, 'city' => 'Sabadell', 'location' => 'Turó d’en Querol', 'address' => 'Camí del Turó d’en Querol', 'owner' => 'laia.martinez@example.com', 'price' => 5, 'limit' => 20, 'description' => 'Ruta senderista moderada para perros habituados a caminar y propietarios con equipamiento básico.'],
            ['title' => 'Concurso amistoso de disfraces caninos', 'days' => 43, 'hours' => 12, 'city' => 'Ripollet', 'location' => 'Parque público demo Ripollet', 'address' => 'Carrer de Sant Lluís, 33', 'owner' => 'marc.vilalta@example.com', 'price' => 3, 'limit' => 40, 'description' => 'Actividad familiar sin presión competitiva, centrada en disfraces cómodos y seguridad animal.'],
            ['title' => 'Cafetería y charla para propietarios', 'days' => 49, 'hours' => 18, 'city' => 'Barcelona', 'location' => 'Espacio comunitario ficticio Barcelona Nord', 'address' => 'Avinguda Meridiana, 390', 'owner' => 'clara.puig@example.com', 'price' => 8, 'limit' => 24, 'description' => 'Charla informal sobre convivencia urbana, rutinas y bienestar emocional canino.'],
        ];

        foreach ($events as $data) {
            $startsAt = now()->addDays($data['days'])->setTime($data['hours'], 0);

            Event::updateOrCreate(
                ['title' => $data['title'], 'city' => $data['city']],
                [
                    'user_id' => $owners[$data['owner']],
                    'description' => $data['description'],
                    'starts_at' => $startsAt,
                    'ends_at' => $startsAt->copy()->addHours(3),
                    'location_name' => $data['location'],
                    'address' => $data['address'],
                    'latitude' => null,
                    'longitude' => null,
                    'price' => $data['price'],
                    'max_attendees' => $data['limit'],
                    'status' => 'published',
                    'image' => null,
                ]
            );
        }
    }
}