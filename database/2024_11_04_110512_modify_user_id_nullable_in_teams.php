<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Si hay un error en la tabla en el que el user_id no es nulable ejecutar este migration

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->change(); // Hacemos nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable(false)->change(); // Revertimos a no nullable
        });
    }
};
