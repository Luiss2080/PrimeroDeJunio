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
                'fecha_inicio' => '2024-01-15',
                'fecha_fin' => null,
                'turno' => 'manana',
                'hora_inicio' => '06:00:00',
                'hora_fin' => '14:00:00',
                'dias_semana' => 'L,M,X,J,V',
                'estado' => 'activa',
                'observaciones' => 'Asignación inicial - Conductor experimentado - Turno mañana',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'conductor_id' => 2,
                'vehiculo_id' => 2,
                'fecha_inicio' => '2024-01-16',
                'fecha_fin' => null,
                'turno' => 'tarde',
                'hora_inicio' => '14:00:00',
                'hora_fin' => '22:00:00',
                'dias_semana' => 'L,M,X,J,V,S',
                'estado' => 'activa',
                'observaciones' => 'Asignación regular - Zona centro - Turno tarde',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'conductor_id' => 3,
                'vehiculo_id' => 3,
                'fecha_inicio' => '2024-01-17',
                'fecha_fin' => null,
                'turno' => 'noche',
                'hora_inicio' => '22:00:00',
                'hora_fin' => '06:00:00',
                'dias_semana' => 'L,M,X,J,V,S,D',
                'estado' => 'activa',
                'observaciones' => 'Asignación zona norte - Turno nocturno',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'conductor_id' => 4,
                'vehiculo_id' => 4,
                'fecha_inicio' => '2024-01-18',
                'fecha_fin' => '2024-11-15',
                'turno' => 'completo',
                'hora_inicio' => '06:00:00',
                'hora_fin' => '18:00:00',
                'dias_semana' => 'L,M,X,J,V',
                'estado' => 'terminada',
                'observaciones' => 'Terminada - Cambio de vehículo por mantenimiento',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'conductor_id' => 4,
                'vehiculo_id' => 5,
                'fecha_inicio' => '2024-11-16',
                'fecha_fin' => null,
                'turno' => 'completo',
                'hora_inicio' => '06:00:00',
                'hora_fin' => '18:00:00',
                'dias_semana' => 'L,M,X,J,V',
                'estado' => 'activa',
                'observaciones' => 'Nueva asignación después de mantenimiento',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'conductor_id' => 5,
                'vehiculo_id' => 6,
                'fecha_inicio' => '2024-02-01',
                'fecha_fin' => null,
                'turno' => 'tarde',
                'hora_inicio' => '12:00:00',
                'hora_fin' => '20:00:00',
                'dias_semana' => 'L,M,X,J,V,S',
                'estado' => 'activa',
                'observaciones' => 'Asignación zona sur - Horario flexible',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'conductor_id' => 6,
                'vehiculo_id' => 7,
                'fecha_inicio' => '2024-02-05',
                'fecha_fin' => null,
                'turno' => 'noche',
                'hora_inicio' => '20:00:00',
                'hora_fin' => '04:00:00',
                'dias_semana' => 'V,S,D',
                'estado' => 'activa',
                'observaciones' => 'Conductor de confianza - turno nocturno fines de semana',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'conductor_id' => 7,
                'vehiculo_id' => 8,
                'fecha_inicio' => '2024-02-10',
                'fecha_fin' => null,
                'turno' => 'manana',
                'hora_inicio' => '07:00:00',
                'hora_fin' => '15:00:00',
                'dias_semana' => 'L,X,V',
                'estado' => 'activa',
                'observaciones' => 'Asignación temporal - prueba medio tiempo',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}