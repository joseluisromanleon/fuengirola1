<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Relación con el modelo Team: un rol puede pertenecer a varios equipos.
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'role_team');
    }

    /**
     * Relación con el modelo Permission: un rol tiene múltiples permisos.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    /**
     * Verifica si el rol tiene un permiso específico.
     *
     * @param string $permissionName
     * @return bool
     */
    public function hasPermission($permissionName)
    {
        return $this->permissions->contains('name', $permissionName);
    }
}
