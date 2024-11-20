<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;

class SendEmailToAdminOnRegistration
{
    /**
     * Handle the event.
     *
     * @param \Illuminate\Auth\Events\Registered $event
     * @return void
     */
    public function handle(Registered $event): void
    {
// Obtener el usuario registrado
        $user = $event->user;


// Asigna el equipo aplicant al usuario si aún no tiene un equipo
        if (!$user->current_team_id) {
            // Usa un equipo existente o crea uno si aún no existe.
            $defaultTeam = \App\Models\Team::find(env('DB_DEV_DEFAULT_TEAM_ID', 2));

            if ($defaultTeam) {
                $user->current_team_id = $defaultTeam->id;
                $user->save();
            }
        }


// Obtener todos los usuarios administradores
        $admins = User::where('is_admin', true)->get();

        // Enviar correo a todos los administradores cuando se registresn nuevos usuarios
        foreach ($admins as $admin) {
            try {
                Mail::to($admin->email)->send(new UserRegistered($user));
            } catch (\Exception $e) {
                // Log the error for debugging
                \Log::error("Error sending email to {$admin->email}: " . $e->getMessage());
            }
        }


    }
}
