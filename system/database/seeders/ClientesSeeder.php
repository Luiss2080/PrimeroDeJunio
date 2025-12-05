<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleCliente = Role::where('nombre', 'cliente')->first();
        
        if (!$roleCliente) {
            $this->command->warn('Rol cliente no encontrado. Creando algunos clientes sin usuario asociado.');
        }

        // Clientes específicos con datos completos
        $clientesEspecificos = [
            [
                'nombre' => 'Ana',
                'apellido' => 'Ramírez',
                'cedula' => '52123456',
                'telefono' => '+57 301 555 1234',
                'email' => 'ana.ramirez@email.com',
                'direccion_habitual' => 'Calle 85 # 12-45, Bogotá',
                'ciudad_residencia' => 'Bogotá',
                'departamento_residencia' => 'Cundinamarca',
                'fecha_registro' => '2024-01-15',
                'estado' => 'activo',
                'tipo_cliente' => 'frecuente',
                'calificacion_promedio' => 4.8,
                'total_viajes' => 45,
                'preferencias_viaje' => json_encode([
                    'musica' => 'pop',
                    'temperatura' => 'media',
                    'conversacion' => true
                ])
            ],
            [
                'nombre' => 'Roberto',
                'apellido' => 'Torres',
                'cedula' => '10987654',
                'telefono' => '+57 315 444 5678',
                'email' => 'roberto.torres@email.com',
                'direccion_habitual' => 'Carrera 15 # 67-89, Medellín',
                'ciudad_residencia' => 'Medellín',
                'departamento_residencia' => 'Antioquia',
                'fecha_registro' => '2024-02-20',
                'estado' => 'activo',
                'tipo_cliente' => 'corporativo',
                'calificacion_promedio' => 4.9,
                'total_viajes' => 67,
                'preferencias_viaje' => json_encode([
                    'musica' => 'clasica',
                    'temperatura' => 'fria',
                    'conversacion' => false
                ])
            ],
            [
                'nombre' => 'Sofía',
                'apellido' => 'Mendoza',
                'cedula' => '33445566',
                'telefono' => '+57 320 777 8899',
                'email' => 'sofia.mendoza@email.com',
                'direccion_habitual' => 'Avenida 6N # 23-45, Cali',
                'ciudad_residencia' => 'Cali',
                'departamento_residencia' => 'Valle del Cauca',
                'fecha_registro' => '2024-03-10',
                'estado' => 'activo',
                'tipo_cliente' => 'particular',
                'calificacion_promedio' => 4.6,
                'total_viajes' => 12,
                'preferencias_viaje' => json_encode([
                    'musica' => 'reggaeton',
                    'temperatura' => 'caliente',
                    'conversacion' => true
                ])
            ]
        ];

        foreach ($clientesEspecificos as $clienteData) {
            Cliente::create($clienteData);
        }

        // Crear clientes adicionales usando factory
        Cliente::factory()->count(17)->create();
        
        $this->command->info('Se crearon 20 clientes: 3 específicos + 17 generados');
    }
}
