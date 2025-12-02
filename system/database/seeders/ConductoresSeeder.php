<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conductor;
use App\Models\Vehiculo;
use App\Models\AsignacionVehiculo;
use Carbon\Carbon;

class ConductoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Crear Conductor (Juan Perez)
        $conductor = Conductor::create([
            'nombre' => 'Juan',
            'apellido' => 'Pérez', // Note: Model uses 'apellidos' or 'apellido'? Migration says 'apellido', Model says 'apellidos'. I need to check Model again.
            'cedula' => '1234567',
            'telefono' => '+591 700-12345',
            'email' => 'juan.perez@email.com',
            'direccion' => 'Av. Principal #123, Zona Norte',
            'fecha_nacimiento' => '1990-05-15',
            'licencia_numero' => 'LIC-123456', // Migration says 'licencia_numero', Model says 'licencia_conducir'. Check Model!
            'licencia_categoria' => 'C',
            'licencia_vigencia' => '2026-12-31', // Migration says 'licencia_vigencia', Model says 'fecha_vencimiento_licencia'. Check Model!
            'experiencia_anos' => 5,
            'estado' => 'activo',
            'rating' => 4.8,
            'total_viajes' => 1240,
            'asistencia_porcentaje' => 98,
            'antecedentes_verificados_at' => '2024-01-15',
            'fecha_ingreso' => '2021-06-01',
        ]);

        // 2. Crear Vehículo (Toyota Corolla)
        $vehiculo = Vehiculo::create([
            'placa' => '2024-ABC',
            'marca' => 'Toyota',
            'modelo' => 'Corolla',
            'color' => 'Blanco',
            'ano' => 2018,
            'cilindraje' => 1800,
            'propietario_nombre' => 'Juan Pérez',
            'propietario_cedula' => '1234567',
            'estado' => 'activo',
            'soat_vigencia' => '2024-12-31',
            'tecnicomecanica_vigencia' => '2024-12-31',
        ]);

        // 3. Asignar Vehículo
        AsignacionVehiculo::create([
            'conductor_id' => $conductor->id,
            'vehiculo_id' => $vehiculo->id,
            'fecha_inicio' => Carbon::now()->subMonths(6),
            'turno' => 'manana',
            'estado' => 'activa',
        ]);
    }
}
