<?php

namespace Database\Seeders;

use App\Models\Viaje;
use App\Models\Conductor;
use App\Models\Vehiculo;
use App\Models\Cliente;
use App\Models\Tarifa;
use Illuminate\Database\Seeder;

class ViajesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Conductor::count() == 0 || Vehiculo::count() == 0) {
            $this->command->warn('No hay conductores o vehículos disponibles para crear viajes');
            return;
        }

        // Usar factory para crear todos los viajes
        Viaje::factory()
            ->count(50)
            ->recycle(Conductor::all())
            ->recycle(Vehiculo::all())
            ->recycle(Cliente::all())
            ->recycle(Tarifa::all())
            ->create();
            
        $this->command->info('Se crearon 50 viajes usando factory');
    }
}