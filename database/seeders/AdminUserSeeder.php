<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            // Crear un equipo "Admins" o asignar el equipo correspondiente
            // $team = Team::create(['name' => 'Admins', 'user_id' => $admin->id]);
        }

        // Asociar al usuario admin con todos los equipos y asignar el rol "owner" en cada uno
        // Aquí debes hacer uso de la tabla intermedia `team_user` y establecer el rol

        $teams = Team::all();  // O puedes definir los equipos que deseas asociar

        foreach ($teams as $team) {
            $admin->teams()->attach($team->id, ['role' => 'owner']);
        }
    }
}

