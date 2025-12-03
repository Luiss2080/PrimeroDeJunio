<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mantenimiento>
 */
class MantenimientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vehiculo_id' => \App\Models\Vehiculo::factory(),
            'tipo' => $this->faker->randomElement(['preventivo', 'correctivo', 'lavado']),
            'descripcion' => $this->faker->sentence(),
            'fecha_ingreso' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'fecha_salida' => function (array $attributes) {
                return $this->faker->dateTimeInInterval($attributes['fecha_ingreso'], '+2 days');
            },
            'costo' => $this->faker->randomFloat(2, 50000, 500000),
            'taller_nombre' => $this->faker->company(),
            'estado' => 'completado',
        ];
    }
}
