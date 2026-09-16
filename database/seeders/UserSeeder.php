<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\UserRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'name' => 'Administrador',
            'email' => 'admin@faculdade.com',
            'password' => '12345678',
            'role' => UserRole::ADMIN,
        ]);

            User::updateOrCreate([
        'name' => 'Coordenador',
        'email' => 'coordenador@faculdade.com',
        'password' => '12345678',
        'role' => UserRole::COORDENADOR,
    ]);

    User::updateOrCreate([
        'name' => 'Professor',
        'email' => 'professor@faculdade.com',
        'password' => '12345678',
        'role' => UserRole::PROFESSOR,
    ]);
    }
}
