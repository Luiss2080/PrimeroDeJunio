<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AsignacionVehiculo>
 */
class AsignacionVehiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'conductor_id' => \App\Models\Conductor::factory(),
            'vehiculo_id' => \App\Models\Vehiculo::factory(),
            'fecha_inicio' => $this->faker->dateTimeBetween('-1 year', '-1 month'),
            'fecha_fin' => null,
            'estado' => 'activo',
            'observaciones' => $this->faker->sentence(),
        ];
    }
}
