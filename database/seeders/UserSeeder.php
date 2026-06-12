<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 2 EDITORES (role_id = 2)
        User::create([
            'name' => 'Juan Editor',
            'email' => 'juan@mundial360.com',
            'email_verified_at' => now(),
            'password' => Hash::make('juan123'),
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Ana Editora',
            'email' => 'ana@mundial360.com',
            'email_verified_at' => now(),
            'password' => Hash::make('ana123'),
            'role_id' => 2,
        ]);

        // 1 ADMIN EXTRA (role_id = 1)
        User::create([
            'name' => 'Carlos Administrador',
            'email' => 'carlos@mundial360.com',
            'email_verified_at' => now(),
            'password' => Hash::make('carlos123'),
            'role_id' => 1,
        ]);

        // 4 ESPECTADORES (role_id = 3)
        User::create([
            'name' => 'Lucas Espectador',
            'email' => 'lucas@mundial360.com',
            'email_verified_at' => now(),
            'password' => Hash::make('lucas123'),
            'role_id' => 3,
        ]);

        User::create([
            'name' => 'Marta Espectadora',
            'email' => 'marta@mundial360.com',
            'email_verified_at' => now(),
            'password' => Hash::make('marta123'),
            'role_id' => 3,
        ]);

        User::create([
            'name' => 'Diego Espectador',
            'email' => 'diego@mundial360.com',
            'email_verified_at' => now(),
            'password' => Hash::make('diego123'),
            'role_id' => 3,
        ]);

        User::create([
            'name' => 'Sofia Espectadora',
            'email' => 'sofia@mundial360.com',
            'email_verified_at' => now(),
            'password' => Hash::make('sofia123'),
            'role_id' => 3,
        ]);
    }
}