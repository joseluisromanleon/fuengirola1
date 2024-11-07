<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
// Limpiar caché de permisos si estás utilizando el paquete Spatie
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

// Crear permisos
        $permissions = [
            'application.create',
            'application.authorize',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }

// Crear roles
        $admin = Role::updateOrCreate(['name' => 'admin']);
        $profesor = Role::updateOrCreate(['name' => 'profesor']);
        $empresa = Role::updateOrCreate(['name' => 'empresa']);
        $executive = Role::updateOrCreate(['name' => 'executive']);

// Asignar permisos a los roles
        $admin->syncPermissions($permissions);
        $empresa->syncPermissions($permissions);

// Asignar permisos específicos al rol 'executive'
        $executive_permissions = [
            'application.create',
        ];
        $executive->syncPermissions($executive_permissions);
    }
}
