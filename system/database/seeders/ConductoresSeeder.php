<?php

namespace Database\Seeders;

use App\Models\Conductor;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class ConductoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleConductor = Role::where('nombre', 'conductor')->first();
        $roleOperador = Role::where('nombre', 'operador')->first();
        
        if (!$roleConductor) {
            echo "Rol 'conductor' no encontrado. Ejecuta RolesSeeder primero.\n";
            return;
        }

        // Crear conductores específicos con datos completos
        $conductoresEspecificos = [
            [
                'nombre' => 'Carlos',
                'apellido' => 'Rodríguez',
                'cedula' => '12345678',
                'telefono' => '+57 310 123 4567',
                'email' => 'carlos.rodriguez@conductor.com',
                'ciudad' => 'Bogotá',
                'experiencia_anos' => 8,
                'rating' => 4.8,
                'estado' => 'activo',
                'estado_operativo' => 'disponible',
            ],
            [
                'nombre' => 'María',
                'apellido' => 'González',
                'cedula' => '87654321',
                'telefono' => '+57 315 987 6543',
                'email' => 'maria.gonzalez@conductor.com',
                'ciudad' => 'Medellín',
                'experiencia_anos' => 5,
                'rating' => 4.9,
                'estado' => 'activo',
                'estado_operativo' => 'disponible',
            ],
            [
                'nombre' => 'Luis',
                'apellido' => 'Martínez',
                'cedula' => '11223344',
                'telefono' => '+57 320 111 2233',
                'email' => 'luis.martinez@conductor.com',
                'ciudad' => 'Cali',
                'experiencia_anos' => 12,
                'rating' => 4.7,
                'estado' => 'activo',
                'estado_operativo' => 'ocupado',
            ]
        ];

        foreach ($conductoresEspecificos as $conductorData) {
            // Crear usuario asociado
            $user = User::factory()->create([
                'rol_id' => $roleConductor->id,
                'nombre' => $conductorData['nombre'],
                'apellido' => $conductorData['apellido'],
                'email' => $conductorData['email'],
                'telefono' => $conductorData['telefono'],
                'cedula' => $conductorData['cedula'],
                'estado' => 'activo',
            ]);

            // Crear conductor
            Conductor::factory()->create([
                'usuario_id' => $user->id,
                'nombre' => $conductorData['nombre'],
                'apellido' => $conductorData['apellido'],
                'cedula' => $conductorData['cedula'],
                'telefono' => $conductorData['telefono'],
                'email' => $conductorData['email'],
                'ciudad' => $conductorData['ciudad'],
                'experiencia_anos' => $conductorData['experiencia_anos'],
                'rating' => $conductorData['rating'],
                'estado' => $conductorData['estado'],
                'estado_operativo' => $conductorData['estado_operativo'],
                'total_viajes' => fake()->numberBetween(100, 500),
                'creado_por' => 1, // Asumiendo que el primer usuario es admin
            ]);
        }

        // Crear conductores experimentados adicionales
        Conductor::factory()->count(5)->experimentado()->create([
            'creado_por' => 1,
        ]);

        // Crear conductores regulares
        Conductor::factory()->count(10)->activo()->create([
            'creado_por' => 1,
        ]);

        // Crear algunos conductores con problemas para testing
        Conductor::factory()->count(2)->documentosVencidos()->create([
            'estado' => 'suspendido',
            'motivo_estado' => 'Documentos vencidos',
            'creado_por' => 1,
        ]);

        // Conductor inactivo
        Conductor::factory()->create([
            'estado' => 'inactivo',
            'fecha_baja' => now()->subDays(15),
            'motivo_baja' => 'Renuncia voluntaria',
            'creado_por' => 1,
        ]);

        echo "Conductores creados exitosamente.\n";
    }
}
