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
                    'fecha_asignacion' => now()->subDays(rand(1, 30)),
                    'fecha_desasignacion' => null,
                    'estado' => 'activa',
                    'turno' => ['mañana', 'tarde', 'noche'][rand(0, 2)],
                    'observaciones' => 'Asignación regular de vehículo',
                    'kilometraje_inicial' => rand(20000, 80000),
                    'kilometraje_final' => null,
                    'responsable_asignacion' => 'Supervisor',
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
                'fecha_asignacion' => $fechaInicio,
                'fecha_desasignacion' => $fechaFin,
                'estado' => 'finalizada',
                'turno' => ['mañana', 'tarde', 'noche'][rand(0, 2)],
                'observaciones' => 'Asignación finalizada por cambio de turno',
                'kilometraje_inicial' => rand(15000, 60000),
                'kilometraje_final' => rand(65000, 95000),
                'responsable_asignacion' => 'Administrador',
                'motivo_desasignacion' => ['Cambio de turno', 'Mantenimiento', 'Solicitud conductor'][rand(0, 2)],
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