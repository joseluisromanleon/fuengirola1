<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    /*
    * 1. Obtener todas las tablas de la base de datos
    * 2. Ignorarará la tabla de migraciones de las acciones a realizar 
    * 2. Eliminar claves foráneas del resto primero
    * 3. Eliminar las tablas después de eliminar las claves foráneas.
    */

    public function up()
    {
        // Obtener todas las tablas de la base de datos
        $tables = DB::select('SHOW TABLES');
        $database = env('DB_DATABASE');

        // Cambiar la manera de acceder a las tablas
        foreach ($tables as $table) {
            // Acceder dinámicamente a la propiedad que contiene el nombre de la tabla
            $tableName = current((array)$table);

            // Omitir la tabla de migraciones
            if ($tableName == 'migrations') {
                continue;
            }

            // Eliminar claves foráneas primero
            $foreignKeys = DB::select("
                SELECT CONSTRAINT_NAME 
                FROM information_schema.KEY_COLUMN_USAGE 
                WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND REFERENCED_TABLE_NAME IS NOT NULL
            ", [$database, $tableName]);

            foreach ($foreignKeys as $foreignKey) {
                $constraint = $foreignKey->CONSTRAINT_NAME;

                // Eliminar la clave foránea
                DB::statement("ALTER TABLE $tableName DROP FOREIGN KEY $constraint");
            }
        }

        // Ahora eliminar las tablas después de eliminar las claves foráneas
        foreach ($tables as $table) {
            $tableName = current((array)$table);

            // Omitir la tabla de migraciones
            if ($tableName == 'migrations') {
                continue;
            }

            // Eliminar la tabla
            Schema::dropIfExists($tableName);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Aquí no hacemos nada porque no podemos restaurar las tablas
        // Si quieres restaurar las tablas deberías agregar una lógica para eso
    }
};
