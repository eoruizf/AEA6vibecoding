<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => 'Admin@12345',
                'role' => User::ROLE_ADMIN,
                'contact_phone' => '+212600000000',
                'contact_email' => 'contact@example.com',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Usuario de prueba',
                'password' => 'User@12345',
                'role' => User::ROLE_USER,
                'email_verified_at' => now(),
            ]
        );

        $demoUsers = [
            ['name' => 'Laia Martínez', 'email' => 'laia.martinez@example.com', 'phone' => '+34 600 101 101', 'contact_email' => 'laia.contacto@example.com'],
            ['name' => 'Marc Vilalta', 'email' => 'marc.vilalta@example.com', 'phone' => '+34 600 102 102', 'contact_email' => 'marc.contacto@example.com'],
            ['name' => 'Clara Puig', 'email' => 'clara.puig@example.com', 'phone' => '+34 600 103 103', 'contact_email' => 'clara.contacto@example.com'],
            ['name' => 'Oriol Soler', 'email' => 'oriol.soler@example.com', 'phone' => '+34 600 104 104', 'contact_email' => 'oriol.contacto@example.com'],
            ['name' => 'Núria Ferrer', 'email' => 'nuria.ferrer@example.com', 'phone' => '+34 600 105 105', 'contact_email' => 'nuria.contacto@example.com'],
            ['name' => 'Jordi Roca', 'email' => 'jordi.roca@example.com', 'phone' => '+34 600 106 106', 'contact_email' => 'jordi.contacto@example.com'],
            ['name' => 'Anna Costa', 'email' => 'anna.costa@example.com', 'phone' => '+34 600 107 107', 'contact_email' => 'anna.contacto@example.com'],
            ['name' => 'Pol Grau', 'email' => 'pol.grau@example.com', 'phone' => '+34 600 108 108', 'contact_email' => 'pol.contacto@example.com'],
        ];

        foreach ($demoUsers as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => 'Demo@12345',
                    'role' => User::ROLE_USER,
                    'contact_phone' => $data['phone'],
                    'contact_email' => $data['contact_email'],
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}