<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 1. Crea los Equipos por defecto
     * 2. Crea el usuario Admin
     *
    */

    public function run(): void
    {
        // Llamar a los seeders en el orden establecido

        $this->call([
            DefaultTeamSeeder::class,
            AdminUserSeeder::class,

        ]);
    }
}
