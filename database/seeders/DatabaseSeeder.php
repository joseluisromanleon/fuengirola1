<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            DefaultTeamSeeder::class,
            AdminUserSeeder::class,
            ModifyTeams::class,
            Is_adminSeederDelete::class,
            Create_user_id_Seeder::class,
        ]);
    }
}
