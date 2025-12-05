<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Composers\SidebarComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configurar la nueva ruta de las vistas
        config(['view.paths' => [base_path('views')]]);

        // Registrar el View Composer para el sidebar
        View::composer('layouts.sidebar', SidebarComposer::class);
    }
}
