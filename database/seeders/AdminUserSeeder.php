<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run()
    {

        // Verificar si el usuario admin ya existe
        $admin = User::where('email', 'admin@tudominio.com')->first();

        // Si no existe, crear el usuario admin
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@tudominio.com', // Cambia a tu correo admin
                'password' => Hash::make('adminpassword'), // Contraseña que quieras para el admin
                'email_verified_at' => now(),
                'is_admin' => true,
                'current_team_id' => 1,
            ]);

            // Asignar rol de Admin, si usas alguna librería como Spatie o manualmente:
            // Si estás utilizando roles de Spatie o alguna librería para roles, asigna el rol de administrador
            // $admin->assignRole('admin'); // Ejemplo con Spatie

            // Si no estás usando roles, puedes dejarlo aquí y añadir un campo en tu modelo User para "is_admin"
            ///// Persistencia  ////
            $admin->is_admin = true;
            $admin->save();
        }

        // Aquí, podrías también asociar el admin con los equipos o hacer otras configuraciones necesarias.

        // Crear o asignar equipos
        //$teams = Team::factory()->count(3)->create(); // Crear 3 equipos como ejemplo

        // Asociar el usuario admin con todos los equipos y al role de owner o admin
        //$admin->teams()->attach($teams->pluck('id')->toArray()); // Asocia al admin con los equipos recién creados

        $admin->teams()->sync([1, 2, 3, 4, 5]); // Asociar al admin con los equipos con ID 1, 2 y 3

    }
}

