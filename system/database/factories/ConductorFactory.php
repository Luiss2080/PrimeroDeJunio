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
        return [
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'cedula' => $this->faker->unique()->numerify('##########'),
            'telefono' => $this->faker->phoneNumber(),
            'direccion' => $this->faker->address(),
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '-20 years'),
            'grupo_sanguineo' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
            'contacto_emergencia_nombre' => $this->faker->name(),
            'contacto_emergencia_telefono' => $this->faker->phoneNumber(),
            'antecedentes_penales' => $this->faker->boolean(10), // 10% chance of having records (for testing)
            'experiencia_anos' => $this->faker->numberBetween(1, 20),
            'estado' => $this->faker->randomElement(['activo', 'activo', 'activo', 'inactivo', 'suspendido']),
            'estado_pago' => $this->faker->randomElement(['al_dia', 'al_dia', 'mora', 'pendiente']),
            'fecha_ingreso' => $this->faker->date(),
            'observaciones' => $this->faker->sentence(),
        ];
    }
}
