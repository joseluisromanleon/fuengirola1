<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Laravel\Jetstream\Team;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),

        ];
    }
    /**
     * Asociar un usuario al equipo creado.
     *
     * @param  User  $user
     * @return \App\Models\Team
     */
    public function withUser(User $user): Team
    {
        $team = $this->create();  // Crear el equipo
        $team->users()->attach($user, ['role' => 'admin']);  // Asocia al usuario como 'admin' o el rol que desees
        return $team;
    }
}
