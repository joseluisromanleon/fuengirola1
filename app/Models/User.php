<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasTeams;

    /** @use HasFactory<UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_Admin',
        'current_team_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Puedes eliminar esta función; Jetstream lo maneja automáticamente con el treat HasTeams.

    /*public function currentTeam()
    {
        return $this->belongsTo(Team::class);
    }*/


    // verifico que sea un numero y no un booleano
    public function isCurrentTeam($team)
    {

        if (!is_object($team)) {
            dd('Team is not an object', $team);
        }
        if (!$this->currentTeam) {
            dd('Current team is null');
        }
        return $team->id === $this->currentTeam->id;
    }





    // devuelve todos los equipos al que pertenece el usuario caso (Many to Many)
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_user')
            ->withPivot(['role','team_id', 'user_id'])
            ->withTimestamps();
    }


}
