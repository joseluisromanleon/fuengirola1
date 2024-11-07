<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team; // Asegúrate de que el modelo Team esté bien importado
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Jetstream\Jetstream;
class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Resetear los permisos cacheados para que se apliquen correctamente
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos globales
        $permissions = [
            'accept_requirements',
            'reject_requirements',
            'view_requirements',
            'update_profile',
            'apply_for_offer',
            'reject_offer',
            'create_offer',
            'update_offer',
            'delete_offer',
            'accept_apply',
            'reject_apply',
            'view_offer_details',
            'view_profile_student',
            'add_Title',
            'update_Title',
            'delete_Title',
            'add_knowledge',
            'update_knowledge',
            'delete_knowledge',
        ];

        // Crear permisos
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear equipos
        $teamAdmin = Team::firstOrCreate([
            'name' => 'Administradores',
            'user_id' => 1, // Propitetario Creador y Administrador del equipo para Jetstream
        ]);

        $teamSolicitantes = Team::firstOrCreate([
            'name' => 'Solicitantes',
            'user_id' => 1, // Propitetario Creador y Administrador del equipo para Jetstream
        ]);
        $teamProfesores = Team::firstOrCreate([
            'name' => 'Profesores',
            'user_id' => 1, // Propitetario Creador y Administrador del equipo para Jetstream
        ]);

        $teamEmpresas = Team::firstOrCreate([
            'name' => 'Empresas',
            'user_id' => 1, // Propitetario Creador y Administrador del equipo para Jetstream
        ]);
        $teamEstudiantes = Team::firstOrCreate([
            'name' => 'Estudiantes',
            'user_id' => 1, // Propitetario Creador y Administrador del equipo para Jetstream
        ]);

        $roleAllPermission = Permission::all();

        // Crear roles para el equipo de "Solicitantes"
        $rolSolicitante = Role::firstOrCreate(['name' => 'Solicitante']);
        $rolSolicitante->givePermissionTo(['view_requirements', 'view_aplication', 'update_profile']);

        // Crear roles para el equipo de "Estudiantes"
        $rolEstudiante = Role::firstOrCreate(['name' => 'Estudiante']);
        $rolEstudiante->givePermissionTo(['view_requirements', 'update_profile','apply_for_offer', 'reject_for_ofert', 'view_offer_details']);

        // Crear roles para el equipo de "Profesores"
        $rolProfesor = Role::firstOrCreate(['name' => 'Profesor']);
        $rolProfesor->givePermissionTo(['view_requirements', 'update_profile','view_offer_details', 'view_enterprises_details', 'view_students_details']);

        // Crear roles para el equipo de "Empresas"
        $rolEmpresas = Role::firstOrCreate(['name' => 'Empresa']);
        $rolEmpresas->givePermissionTo(['view_requirements', 'update_profile','create_offer', 'update_offer', 'delete_offer', 'accept_apply', 'reject_apply', 'view_students_details']);

        // Asignar todos los permisos al rol de Administrador
        $rolAdministrador = Role::firstOrCreate(['name' => 'Administrador']);
        $rolAdministrador->syncPermissions($roleAllPermission);

        // Crear un usuario (solo si no existe aún) y asignarlo al equipo "Administradores"
        $user = User::firstOrCreate([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'), // Asegúrate de cifrar la contraseña correctamente
        ]);

        // Asignar este usuario al equipo "Administradores" y darle el rol de Administrador
        $user->teams()->attach($teamAdmin->id);
        $user->assignRole('Administrador');



       /*
       // Crear un usuario y asignarle el equipo de "Estudiantes No Aceptados"
         $user = User::find(1);
        if ($user) {
            $user->teams()->attach($teamSolicitantes->id);
            $user->assignRole('Solicitante');
        }

        // Crear otro usuario y asignarle el equipo de "Estudiantes"
        $user2 = User::find(2);
        if ($user2) {
            $user2->teams()->attach($teamEstudiantes->id);
            $user2->assignRole('Estudiante');
       */
    }
}
