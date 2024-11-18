<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

class Team extends JetstreamTeam
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    /**
     * Relación para obtener los usuarios de un equipo.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'team_user')
            ->withPivot(['role','team_id', 'user_id'])
            ->withTimestamps();
    }
// Funciones no utilizables dado el belongsToMany
  /*  public function isUserOwner(User $user)
    {
        return $this->users()->where('user_id', $user->id)->where('role', 'propietario')->exists();
    }

    public function isUserAdmin(User $user)
    {
        return $this->users()->where('user_id', $user->id)->where('role', 'administrador')->exists();
    }*/
}
