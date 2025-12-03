<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campana>
 */
class CampanaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->catchPhrase(),
            'descripcion' => $this->faker->paragraph(),
            'fecha_inicio' => $this->faker->date(),
            'fecha_fin' => $this->faker->dateTimeBetween('+1 month', '+3 months'),
            'presupuesto_total' => $this->faker->randomFloat(2, 1000000, 10000000),
            'estado' => $this->faker->randomElement(['activa', 'pausada', 'finalizada']),
        ];
    }
}
