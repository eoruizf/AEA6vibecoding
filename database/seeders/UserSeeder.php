<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin (updateOrCreate bach ma ytrepetach ila 3awdti seed)
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'              => 'Admin',
                'password'          => 'Admin@12345', // BDDELHA f production!
                'role'              => User::ROLE_ADMIN,
                'contact_phone'     => '+212600000000',
                'contact_email'     => 'contact@example.com',
                'email_verified_at' => now(),
            ]
        );

        // User 3adi
        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name'              => 'Usuario de prueba',
                'password'          => 'User@12345',
                'role'              => User::ROLE_USER,
                'email_verified_at' => now(),
            ]
        );

        // 10 users 3chwaiyin
        User::factory()->count(10)->create();
    }
}