<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fechaIngreso = fake()->dateTimeBetween('-3 years', 'now');
        $ciudades = ['Bogotá', 'Medellín', 'Cali', 'Barranquilla', 'Cartagena', 'Bucaramanga', 'Pereira', 'Manizales'];
        $departamentos = ['Cundinamarca', 'Antioquia', 'Valle del Cauca', 'Atlántico', 'Bolívar', 'Santander', 'Risaralda', 'Caldas'];
        
        return [
            // Información personal básica
            'nombre' => fake()->firstName(),
            'apellido' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'telefono' => fake()->phoneNumber(),
            'telefono_emergencia' => fake()->optional(0.7)->phoneNumber(),
            'direccion' => fake()->optional(0.8)->address(),
            'ciudad' => fake()->optional(0.9)->randomElement($ciudades),
            'departamento' => fake()->optional(0.9)->randomElement($departamentos),
            'codigo_postal' => fake()->optional(0.6)->postcode(),
            'fecha_nacimiento' => fake()->optional(0.8)->dateTimeBetween('-65 years', '-18 years')->format('Y-m-d'),
            'genero' => fake()->optional(0.7)->randomElement(['masculino', 'femenino', 'otro', 'prefiero_no_decir']),
            'cedula' => fake()->optional(0.9)->unique()->numerify('##########'),
            'avatar' => fake()->optional(0.3)->imageUrl(200, 200, 'people'),
            
            // Información laboral
            'rol_id' => \App\Models\Role::inRandomOrder()->first()?->id ?? 1,
            'fecha_ingreso' => $fechaIngreso->format('Y-m-d'),
            'numero_empleado' => fake()->optional(0.8)->unique()->numerify('EMP###'),
            'salario_base' => fake()->optional(0.6)->randomFloat(2, 1200000, 8000000), // Salarios en COP
            'turno_preferido' => fake()->optional(0.7)->randomElement(['matutino', 'vespertino', 'nocturno', 'flexible']),
            'disponible_fines_semana' => fake()->boolean(70), // 70% disponible fines de semana
            'notas_empleado' => fake()->optional(0.3)->sentence(10),
            
            // Estado y seguridad
            'estado' => fake()->randomElement(['activo', 'activo', 'activo', 'activo', 'inactivo', 'pendiente']), // Más activos
            'ultimo_acceso' => fake()->optional(0.8)->dateTimeBetween('-1 month', 'now'),
            'last_login_ip' => fake()->optional(0.7)->ipv4(),
            'intentos_login_fallidos' => fake()->numberBetween(0, 3),
            'bloqueado_hasta' => null, // Por defecto no bloqueados
            'email_verified_at' => fake()->optional(0.9)->dateTimeBetween($fechaIngreso, 'now'),
            'password_changed_at' => fake()->optional(0.6)->dateTimeBetween($fechaIngreso, 'now'),
            'requiere_cambio_password' => fake()->boolean(10), // 10% requiere cambio
            
            // Configuraciones de usuario
            'tema_preferido' => fake()->randomElement(['light', 'light', 'dark', 'auto']), // Más light
            'idioma' => fake()->randomElement(['es', 'es', 'es', 'en']), // Más español
            'preferencias_notificaciones' => json_encode([
                'email_nuevos_viajes' => fake()->boolean(80),
                'email_cambios_horario' => fake()->boolean(90),
                'email_pagos' => fake()->boolean(95),
                'sms_emergencias' => fake()->boolean(85),
                'push_recordatorios' => fake()->boolean(70),
            ]),
            'recibir_emails_promocionales' => fake()->boolean(60),
            'zona_horaria' => fake()->randomElement(['America/Bogota', 'America/Bogota', 'America/Bogota', 'UTC']),
            
            // Auditoría (se llenarán después si es necesario)
            'creado_por' => null,
            'actualizado_por' => null,
            'fecha_baja' => null,
            'motivo_baja' => null,
            
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
