<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear los Roles obligatorios del parcial
        $adminRole = Role::create(['nombre' => 'Administrador']);
        $editorRole = Role::create(['nombre' => 'Editor']);
        $userRole = Role::create(['nombre' => 'Espectador']);

        // 2. Crear tu usuario Administrador para pruebas
        User::create([
            'name' => 'Selena Admin',
            'email' => 'selenacuadra@davinci.edu.ar', 
            'password' => Hash::make('admin123'),  //prueba
            'role_id' => $adminRole->id,            //vinculo con rol adminn 
        ]);
    }
}