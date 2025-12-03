<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GastoOperativo>
 */
class GastoOperativoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo_gasto' => $this->faker->randomElement(['combustible', 'mantenimiento', 'lavado', 'peaje', 'impuesto', 'seguro']),
            'monto' => $this->faker->randomFloat(2, 10000, 500000),
            'fecha' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'descripcion' => $this->faker->sentence(),
            'registrado_por' => \App\Models\User::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}
