<?php

namespace Database\Seeders;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class Create_user_id_Seeder extends Seeder
{
    public function run(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->foreignId('user_id')->default(1)->constrained('users');
        });
    }
}
