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
                'direccion' => 'Calle 85 # 12-45, Bogotá',
                'ciudad' => 'Bogotá',
                'departamento' => 'Cundinamarca',
                'fecha_registro' => '2024-01-15',
                'estado' => 'activo',
                'tipo_cliente' => 'frecuente',
                'rating' => 4.8,
                'numero_viajes' => 45,
                'preferencias' => json_encode([
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
                'direccion' => 'Carrera 15 # 67-89, Medellín',
                'ciudad' => 'Medellín',
                'departamento' => 'Antioquia',
                'fecha_registro' => '2024-02-20',
                'estado' => 'activo',
                'tipo_cliente' => 'corporativo',
                'rating' => 4.9,
                'numero_viajes' => 67,
                'preferencias' => json_encode([
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
                'direccion' => 'Avenida 6N # 23-45, Cali',
                'ciudad' => 'Cali',
                'departamento' => 'Valle del Cauca',
                'fecha_registro' => '2024-03-10',
                'estado' => 'activo',
                'tipo_cliente' => 'ocasional',
                'rating' => 4.6,
                'numero_viajes' => 12,
                'preferencias' => json_encode([
                    'musica' => 'reggaeton',
                    'temperatura' => 'caliente',
                    'conversacion' => true
                ])
            ]
        ];

        foreach ($clientesEspecificos as $clienteData) {
            // Crear usuario asociado si existe el rol
            $usuario = null;
            if ($roleCliente) {
                $usuario = User::create([
                    'rol_id' => $roleCliente->id,
                    'nombre' => $clienteData['nombre'],
                    'apellido' => $clienteData['apellido'],
                    'email' => $clienteData['email'],
                    'password' => Hash::make('Cliente123!'),
                    'telefono' => $clienteData['telefono'],
                    'cedula' => $clienteData['cedula'],
                    'direccion' => $clienteData['direccion'],
                    'ciudad' => $clienteData['ciudad'],
                    'departamento' => $clienteData['departamento'],
                    'fecha_nacimiento' => now()->subYears(rand(25, 60)),
                    'estado' => $clienteData['estado'],
                    'email_verified_at' => now(),
                ]);
                
                $clienteData['usuario_id'] = $usuario->id;
            }

            Cliente::create($clienteData);
        }

        // Crear clientes adicionales usando factory
        Cliente::factory()->count(17)->create();
        
        $this->command->info('Se crearon 20 clientes: 3 específicos + 17 generados');
    }
}
