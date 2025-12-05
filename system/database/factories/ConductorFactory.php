<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conductor>
 */
class ConductorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fechaIngreso = $this->faker->dateTimeBetween('-3 years', 'now');
        $ciudades = ['Bogotá', 'Medellín', 'Cali', 'Barranquilla', 'Cartagena', 'Bucaramanga'];
        $departamentos = ['Cundinamarca', 'Antioquia', 'Valle del Cauca', 'Atlántico', 'Bolívar', 'Santander'];
        
        return [
            // Información personal
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'cedula' => $this->faker->unique()->numerify('##########'),
            'telefono' => $this->faker->phoneNumber(),
            'telefono_secundario' => $this->faker->optional(0.4)->phoneNumber(),
            'email' => $this->faker->optional(0.7)->safeEmail(),
            'direccion' => $this->faker->address(),
            'ciudad' => $this->faker->randomElement($ciudades),
            'departamento' => $this->faker->randomElement($departamentos),
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-65 years', '-21 years')->format('Y-m-d'),
            'genero' => $this->faker->randomElement(['masculino', 'femenino']),
            'estado_civil' => $this->faker->randomElement(['soltero', 'casado', 'union_libre', 'divorciado']),
            'grupo_sanguineo' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
            
            // Contacto de emergencia
            'contacto_emergencia_nombre' => $this->faker->name(),
            'contacto_emergencia_telefono' => $this->faker->phoneNumber(),
            'contacto_emergencia_relacion' => $this->faker->randomElement(['esposa', 'madre', 'padre', 'hermano', 'hermana', 'hijo']),
            'contacto_emergencia_direccion' => $this->faker->optional(0.6)->address(),
            
            // Información laboral
            'fecha_ingreso' => $fechaIngreso->format('Y-m-d'),

            'salario_base' => $this->faker->randomFloat(2, 1500000, 3500000),
            'comision_porcentaje' => $this->faker->randomFloat(2, 60, 80),
            'disponible_fines_semana' => $this->faker->boolean(70),
            'disponible_feriados' => $this->faker->boolean(40),
            
            // Documentación
            'antecedentes_penales' => $this->faker->boolean(5),
            'antecedentes_verificados_at' => $this->faker->boolean(80) ? $this->faker->dateTimeBetween($fechaIngreso, 'now')->format('Y-m-d') : null,
            'licencia_vencimiento' => $this->faker->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
            'licencia_categoria' => $this->faker->randomElement(['B1', 'B2', 'C1', 'C2']),
            'examen_medico_vencimiento' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            
            // Estadísticas
            'rating' => $this->faker->randomFloat(1, 3.5, 5.0),
            'total_viajes' => $this->faker->numberBetween(0, 500),
            'viajes_completados' => function (array $attributes) {
                return $this->faker->numberBetween(0, $attributes['total_viajes']);
            },
            'viajes_cancelados' => function (array $attributes) {
                return $attributes['total_viajes'] - $attributes['viajes_completados'];
            },
            'total_ingresos' => $this->faker->randomFloat(2, 0, 15000000),
            'kilometraje_total' => $this->faker->randomFloat(2, 0, 50000),
            'asistencia_porcentaje' => $this->faker->numberBetween(85, 100),
            'puntualidad_porcentaje' => $this->faker->numberBetween(80, 100),
            
            // Estado financiero
            'estado_pago' => $this->faker->randomElement(['al_dia', 'al_dia', 'al_dia', 'mora', 'pendiente']),
            'saldo_pendiente' => $this->faker->randomFloat(2, 0, 500000),
            'ultimo_pago' => $this->faker->boolean(80) ? $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d') : null,
            'ultimo_monto_pago' => $this->faker->boolean(80) ? $this->faker->randomFloat(2, 100000, 1000000) : null,
            'metodo_pago_preferido' => $this->faker->randomElement(['efectivo', 'transferencia', 'cheque']),
            
            // Estados
            'estado' => $this->faker->randomElement(['activo', 'activo', 'activo', 'activo', 'inactivo', 'suspendido']),

            
            // Configuraciones
            'acepta_viajes_nocturnos' => $this->faker->boolean(70),
            'acepta_viajes_largos' => $this->faker->boolean(80),
            'radio_operacion_km' => $this->faker->randomFloat(2, 20, 100),
            
            // Otros
            'observaciones' => $this->faker->optional(0.3)->sentence(),
        ];
    }

    /**
     * Estado activo y disponible
     */
    public function activo()
    {
        return $this->state(function (array $attributes) {
            return [
                'estado' => 'activo',

            ];
        });
    }

    /**
     * Con documentos vencidos
     */
    public function documentosVencidos()
    {
        return $this->state(function (array $attributes) {
            return [
                'licencia_vencimiento' => $this->faker->dateTimeBetween('-1 year', '-1 day')->format('Y-m-d'),
                'examen_medico_vencimiento' => $this->faker->dateTimeBetween('-6 months', '-1 day')->format('Y-m-d'),
            ];
        });
    }

    /**
     * Conductor experimentado
     */
    public function experimentado()
    {
        return $this->state(function (array $attributes) {
            return [

                'total_viajes' => $this->faker->numberBetween(1000, 3000),
                'rating' => $this->faker->randomFloat(1, 4.5, 5.0),
                'asistencia_porcentaje' => $this->faker->numberBetween(95, 100),
                'puntualidad_porcentaje' => $this->faker->numberBetween(95, 100),
            ];
        });
    }
}
