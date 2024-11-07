<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasProfilePhoto, HasTeams, HasRoles, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret'];
    protected $appends = ['profile_photo_url'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación para obtener los roles del usuario en un equipo específico.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user_team')
            ->withPivot('team_id') // Incluye el equipo en la relación
            ->withTimestamps();
    }

    /**
     * Verifica si el usuario tiene un rol específico en un equipo.
     */
    public function hasRoleInTeam($roleName, $teamId)
    {
        return $this->roles()
            ->wherePivot('team_id', $teamId)
            ->where('name', $roleName)
            ->exists();
    }

    /**
     * Obtiene todos los permisos de un usuario basado en sus roles en equipos.
     */
    public function permissions()
    {
        return $this->roles()
            ->with('permissions') // Carga los permisos a través de los roles
            ->get()
            ->flatMap(fn($role) => $role->permissions)
            ->unique('id');
    }

    public function rolesInCurrentTeam()
    {
        return $this->roles()->wherePivot('team_id', $this->current_team_id);
    }

    public function hasRoleInCurrentTeam($roleName)
    {
        return $this->rolesInCurrentTeam()->where('name', $roleName)->exists();
    }

    public function permissionsInCurrentTeam()
    {
        return $this->rolesInCurrentTeam()
            ->with('permissions')
            ->get()
            ->flatMap(fn($role) => $role->permissions)
            ->unique('id');
    }

}
