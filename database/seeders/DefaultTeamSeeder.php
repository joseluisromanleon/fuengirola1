<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear todos los teams para despues recibir los roles

        // equipo Admins que recibira todos los roles posibles
        Team::create([
            'name' => 'Admins',
        ]);

        // Crear el equipo de Entrada (sin user_id, ya que es para todos)
        Team::create([
            'name' => 'Aplicants',
        ]);

        // Crear el equipo de Empresas
        Team::create([
            'name' => 'Enterprises',
        ]);

        // Crear el equipo de Alumnos
        Team::create([
            'name' => 'Students',
        ]);

        // Crear el equipo de Profesores
        Team::create([
            'name' => 'Teachers',
        ]);
    }
}
