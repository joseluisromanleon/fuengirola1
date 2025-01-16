<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
// Verifica si la columna 'user_id' existe en la tabla 'teams'
        if (Schema::hasColumn('teams', 'user_id')) {
            Schema::table('teams', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained()->notNullable()->change(); // Hacemos la columna no nullable
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
// Verifica si la columna 'user_id' existe en la tabla 'teams'
        if (Schema::hasColumn('teams', 'user_id')) {
            Schema::table('teams', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->change(); // Revertimos a nullable
            });
        }
    }
};
