<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    // Relación con el modelo Role (un permiso puede pertenecer a varios roles)
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }
}
