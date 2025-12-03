<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarifa>
 */
class TarifaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->words(3, true),
            'costo_base' => $this->faker->numberBetween(3000, 10000),
            'costo_km' => $this->faker->numberBetween(1000, 3000),
            'costo_minuto' => $this->faker->numberBetween(200, 500),
            'horario_inicio' => '06:00:00',
            'horario_fin' => '22:00:00',
            'estado' => 'activo',
        ];
    }
}
