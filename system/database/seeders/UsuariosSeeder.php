<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure roles exist
        if (Role::count() == 0) {
            $this->call(RolesSeeder::class);
        }

        $adminRole = Role::where('nombre', 'administrador')->first();
        $conductorRole = Role::where('nombre', 'conductor')->first();
        $operadorRole = Role::where('nombre', 'operador')->first();
        $supervisorRole = Role::where('nombre', 'supervisor')->first();

        // Create Super Admin User
        $superAdmin = User::factory()->create([
            'nombre' => 'Super',
            'apellido' => 'Administrador',
            'email' => 'superadmin@primero.com',
            'password' => Hash::make('SuperAdmin123!'),
            'rol_id' => $adminRole->id,
            'cedula' => '1000000001',
            'numero_empleado' => 'EMP001',
            'telefono' => '+57 301 234 5678',
            'telefono_emergencia' => '+57 302 234 5678',
            'direccion' => 'Calle 100 # 15-20, Bogotá',
            'ciudad' => 'Bogotá',
            'departamento' => 'Cundinamarca',
            'fecha_nacimiento' => '1985-03-15',
            'genero' => 'masculino',
            'fecha_ingreso' => '2020-01-01',
            'salario_base' => 5000000.00,
            'turno_preferido' => 'matutino',
            'estado' => 'activo',
            'email_verified_at' => now(),
            'tema_preferido' => 'dark',
            'idioma' => 'es',
            'zona_horaria' => 'America/Bogota',
        ]);

        // Create Admin User
        $admin = User::factory()->create([
            'nombre' => 'Carlos',
            'apellido' => 'Rodríguez',
            'email' => 'admin@primero.com',
            'password' => Hash::make('Admin123!'),
            'rol_id' => $adminRole->id,
            'cedula' => '1000000002',
            'numero_empleado' => 'EMP002',
            'telefono' => '+57 310 987 6543',
            'direccion' => 'Carrera 7 # 45-67, Bogotá',
            'ciudad' => 'Bogotá',
            'departamento' => 'Cundinamarca',
            'fecha_nacimiento' => '1988-07-22',
            'genero' => 'masculino',
            'fecha_ingreso' => '2021-06-15',
            'salario_base' => 4000000.00,
            'estado' => 'activo',
            'email_verified_at' => now(),
            'creado_por' => $superAdmin->id,
        ]);

        // Create Supervisor
        $supervisor = User::factory()->create([
            'nombre' => 'María',
            'apellido' => 'González',
            'email' => 'supervisor@primero.com',
            'password' => Hash::make('Supervisor123!'),
            'rol_id' => $supervisorRole?->id ?? $adminRole->id,
            'cedula' => '1000000003',
            'numero_empleado' => 'EMP003',
            'telefono' => '+57 315 456 7890',
            'direccion' => 'Avenida 68 # 25-30, Bogotá',
            'ciudad' => 'Bogotá',
            'departamento' => 'Cundinamarca',
            'fecha_nacimiento' => '1990-11-10',
            'genero' => 'femenino',
            'fecha_ingreso' => '2022-03-01',
            'salario_base' => 3200000.00,
            'turno_preferido' => 'vespertino',
            'estado' => 'activo',
            'email_verified_at' => now(),
            'creado_por' => $admin->id,
        ]);

        // Create Operador
        $operador = User::factory()->create([
            'nombre' => 'Luis',
            'apellido' => 'Martínez',
            'email' => 'operador@primero.com',
            'password' => Hash::make('Operador123!'),
            'rol_id' => $operadorRole?->id ?? $adminRole->id,
            'cedula' => '1000000004',
            'numero_empleado' => 'EMP004',
            'telefono' => '+57 320 111 2233',
            'direccion' => 'Calle 26 # 50-15, Bogotá',
            'ciudad' => 'Bogotá',
            'departamento' => 'Cundinamarca',
            'fecha_nacimiento' => '1992-05-18',
            'genero' => 'masculino',
            'fecha_ingreso' => '2023-01-15',
            'salario_base' => 2500000.00,
            'turno_preferido' => 'nocturno',
            'estado' => 'activo',
            'email_verified_at' => now(),
            'creado_por' => $supervisor->id,
        ]);

        // Create sample Conductores
        if ($conductorRole) {
            User::factory()->count(5)->create([
                'rol_id' => $conductorRole->id,
                'salario_base' => fake()->randomFloat(2, 1500000, 3000000),
                'turno_preferido' => fake()->randomElement(['matutino', 'vespertino', 'nocturno']),
                'disponible_fines_semana' => true,
                'estado' => 'activo',
                'email_verified_at' => now(),
                'creado_por' => $supervisor->id,
            ]);
        }

        // Create users with different states
        User::factory()->create([
            'nombre' => 'Ana',
            'apellido' => 'Pérez',
            'email' => 'ana.perez@primero.com',
            'estado' => 'inactivo',
            'fecha_baja' => now()->subDays(30),
            'motivo_baja' => 'Renuncia voluntaria',
            'rol_id' => $operadorRole?->id ?? $adminRole->id,
            'creado_por' => $admin->id,
        ]);

        User::factory()->create([
            'nombre' => 'Pedro',
            'apellido' => 'Jiménez',
            'email' => 'pedro.jimenez@primero.com',
            'estado' => 'suspendido',
            'rol_id' => $conductorRole?->id ?? $adminRole->id,
            'creado_por' => $admin->id,
            'notas_empleado' => 'Usuario suspendido por incumplimiento de normas',
        ]);

        User::factory()->create([
            'nombre' => 'Laura',
            'apellido' => 'Vargas',
            'email' => 'laura.vargas@primero.com',
            'estado' => 'vacaciones',
            'rol_id' => $operadorRole?->id ?? $adminRole->id,
            'creado_por' => $supervisor->id,
            'notas_empleado' => 'Vacaciones programadas del 1-15 de diciembre',
        ]);

        // Create additional random users
        User::factory()->count(15)->create([
            'rol_id' => function() use ($conductorRole, $operadorRole, $adminRole) {
                $roles = array_filter([$conductorRole?->id, $operadorRole?->id]);
                return !empty($roles) ? fake()->randomElement($roles) : $adminRole->id;
            },
            'creado_por' => function() use ($admin, $supervisor) {
                return fake()->randomElement([$admin->id, $supervisor->id]);
            },
        ]);

        // Create a user with special preferences
        User::factory()->create([
            'nombre' => 'Andrea',
            'apellido' => 'Ramírez',
            'email' => 'andrea.ramirez@primero.com',
            'rol_id' => $supervisorRole?->id ?? $adminRole->id,
            'tema_preferido' => 'dark',
            'idioma' => 'en',
            'zona_horaria' => 'UTC',
            'preferencias_notificaciones' => json_encode([
                'email_nuevos_viajes' => false,
                'email_cambios_horario' => true,
                'email_pagos' => true,
                'sms_emergencias' => true,
                'push_recordatorios' => false,
            ]),
            'recibir_emails_promocionales' => false,
            'creado_por' => $admin->id,
        ]);
    }
}
