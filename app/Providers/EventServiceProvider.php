<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Listeners\SendEmailToAdminOnRegistration;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
// use Illuminate\Support\ServiceProvider;  // Puede Sutituir al de arriba pero -array-
class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailToAdminOnRegistration::class,
        ],

    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {

        // Puedes registrar servicios aquí, si es necesario.
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Si necesitas lógica extra para inicializar o escuchar eventos, lo puedes hacer aquí.
    }
}
