<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsignacionesVehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('asignaciones_vehiculo')->insert([
            [
                'conductor_id' => 1,
                'vehiculo_id' => 1,
                'fecha_asignacion' => '2024-01-15',
                'fecha_desasignacion' => null,
                'estado' => 'activo',
                'observaciones' => 'Asignación inicial - Conductor experimentado',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'conductor_id' => 2,
                'vehiculo_id' => 2,
                'fecha_asignacion' => '2024-01-16',
                'fecha_desasignacion' => null,
                'estado' => 'activo',
                'observaciones' => 'Asignación regular - Zona centro',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'conductor_id' => 3,
                'vehiculo_id' => 3,
                'fecha_asignacion' => '2024-01-17',
                'fecha_desasignacion' => null,
                'estado' => 'activo',
                'observaciones' => 'Asignación zona norte',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'conductor_id' => 4,
                'vehiculo_id' => 4,
                'fecha_asignacion' => '2024-01-18',
                'fecha_desasignacion' => '2024-11-15',
                'estado' => 'inactivo',
                'observaciones' => 'Cambio de vehículo por mantenimiento',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'conductor_id' => 4,
                'vehiculo_id' => 5,
                'fecha_asignacion' => '2024-11-16',
                'fecha_desasignacion' => null,
                'estado' => 'activo',
                'observaciones' => 'Nueva asignación después de mantenimiento',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'conductor_id' => 5,
                'vehiculo_id' => 6,
                'fecha_asignacion' => '2024-02-01',
                'fecha_desasignacion' => null,
                'estado' => 'activo',
                'observaciones' => 'Asignación zona sur',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'conductor_id' => 6,
                'vehiculo_id' => 7,
                'fecha_asignacion' => '2024-02-05',
                'fecha_desasignacion' => null,
                'estado' => 'activo',
                'observaciones' => 'Conductor de confianza - turno nocturno',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'conductor_id' => 7,
                'vehiculo_id' => 8,
                'fecha_asignacion' => '2024-02-10',
                'fecha_desasignacion' => null,
                'estado' => 'activo',
                'observaciones' => 'Asignación temporal - prueba',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}