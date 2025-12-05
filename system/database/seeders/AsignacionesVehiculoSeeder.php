<?php

namespace Database\Seeders;

use App\Models\AsignacionVehiculo;
use App\Models\Conductor;
use App\Models\Vehiculo;
use Illuminate\Database\Seeder;

class AsignacionesVehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Conductor::count() == 0 || Vehiculo::count() == 0) {
            $this->command->warn('No hay conductores o vehículos disponibles para crear asignaciones');
            return;
        }

        $conductores = Conductor::all();
        $vehiculos = Vehiculo::all();

        // Asignaciones específicas con datos completos
        $asignacionesEspecificas = [];
        
        // Crear asignaciones actuales (una por conductor si hay suficientes vehículos)
        $conductoresActivos = $conductores->where('estado', 'activo')->take(min($conductores->count(), $vehiculos->count()));
        
        foreach ($conductoresActivos as $index => $conductor) {
            if (isset($vehiculos[$index])) {
                $asignacionesEspecificas[] = [
                    'conductor_id' => $conductor->id,
                    'vehiculo_id' => $vehiculos[$index]->id,
                    'fecha_inicio' => now()->subDays(rand(1, 30))->toDateString(),
                    'fecha_fin' => null,
                    'estado' => 'activa',
                    'turno' => ['manana', 'tarde', 'noche'][rand(0, 2)],
                    'hora_inicio' => '08:00:00',
                    'hora_fin' => '18:00:00',
                    'dias_semana' => 'L,M,X,J,V,S',
                    'observaciones' => 'Asignación regular de vehículo',
                ];
            }
        }

        // Crear algunas asignaciones históricas (finalizadas)
        for ($i = 0; $i < 5; $i++) {
            $fechaInicio = now()->subDays(rand(60, 180));
            $fechaFin = $fechaInicio->copy()->addDays(rand(10, 30));
            
            $asignacionesEspecificas[] = [
                'conductor_id' => $conductores->random()->id,
                'vehiculo_id' => $vehiculos->random()->id,
                'fecha_inicio' => $fechaInicio->toDateString(),
                'fecha_fin' => $fechaFin->toDateString(),
                'estado' => 'terminada',
                'turno' => ['manana', 'tarde', 'noche'][rand(0, 2)],
                'hora_inicio' => '06:00:00',
                'hora_fin' => '16:00:00',
                'dias_semana' => 'L,M,X,J,V',
                'observaciones' => 'Asignación finalizada por cambio de turno',
            ];
        }

        foreach ($asignacionesEspecificas as $asignacionData) {
            AsignacionVehiculo::create($asignacionData);
        }

        // Crear algunas asignaciones adicionales usando factory si necesitamos más
        $totalCreadas = count($asignacionesEspecificas);
        $faltantes = 20 - $totalCreadas;
        
        if ($faltantes > 0) {
            AsignacionVehiculo::factory()
                ->count($faltantes)
                ->recycle($conductores)
                ->recycle($vehiculos)
                ->create();
        }

        $this->command->info("Se crearon $totalCreadas asignaciones específicas + $faltantes generadas = 20 total");
    }
}