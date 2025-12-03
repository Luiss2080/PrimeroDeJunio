<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehiculo>
 */
class VehiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'placa' => $this->faker->unique()->bothify('???###'),
            'marca' => $this->faker->randomElement(['Toyota', 'Chevrolet', 'Kia', 'Hyundai', 'Nissan']),
            'modelo' => $this->faker->randomElement(['Corolla', 'Spark', 'Picanto', 'Accent', 'Versa']),
            'color' => $this->faker->safeColorName(),
            'ano' => $this->faker->numberBetween(2015, 2025),
            'cilindraje' => $this->faker->randomElement([1000, 1200, 1400, 1600, 2000]),
            'tipo_combustible' => $this->faker->randomElement(['Gasolina', 'Gas', 'Diesel', 'Hibrido']),
            'capacidad_pasajeros' => $this->faker->numberBetween(4, 7),
            'numero_motor' => $this->faker->unique()->bothify('MOT-#######'),
            'numero_chasis' => $this->faker->unique()->bothify('CHA-#######'),
            'propietario_nombre' => $this->faker->name(),
            'propietario_cedula' => $this->faker->numerify('##########'),
            'propietario_telefono' => $this->faker->phoneNumber(),
            'estado' => $this->faker->randomElement(['activo', 'activo', 'mantenimiento', 'inactivo']),
        ];
    }
}
