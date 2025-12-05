<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Conductor;
use App\Models\User;
use App\Models\Vehiculo;
use App\Models\Viaje;
use App\Models\Cliente;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class SidebarComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        try {
            // Cache por 5 minutos para mejorar el rendimiento
            $sidebarCounts = Cache::remember('sidebar_counts', 300, function () {
                return [
                    'conductores' => Conductor::count(), // Mostrar todos los conductores
                    'conductores_total' => Conductor::count(),
                    'usuarios' => User::count(),
                    'vehiculos' => Vehiculo::count(),
                    'vehiculos_total' => Vehiculo::count(),
                    'viajes_hoy' => Viaje::count(), // Mostrar todos los viajes en lugar de solo hoy
                    'viajes_mes' => Viaje::whereMonth('created_at', now()->month)
                        ->whereYear('created_at', now()->year)
                        ->count(),
                    'clientes' => Cliente::count(), // Mostrar todos los clientes
                    'clientes_total' => Cliente::count(),
                ];
            });

            $view->with('sidebarCounts', $sidebarCounts);
        } catch (\Exception $e) {
            // En caso de error, proporcionar valores por defecto
            $sidebarCounts = [
                'conductores' => 0,
                'conductores_total' => 0,
                'usuarios' => 0,
                'vehiculos' => 0,
                'vehiculos_total' => 0,
                'viajes_hoy' => 0,
                'viajes_mes' => 0,
                'clientes' => 0,
                'clientes_total' => 0,
            ];

            $view->with('sidebarCounts', $sidebarCounts);
        }
    }

    /**
     * Método para limpiar el cache cuando sea necesario
     */
    public static function clearCache(): void
    {
        Cache::forget('sidebar_counts');
    }
}