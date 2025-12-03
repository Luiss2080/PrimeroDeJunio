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
            'tarifa_base' => $this->faker->numberBetween(3000, 10000),
            'tarifa_por_km' => $this->faker->numberBetween(1000, 3000),
            'tarifa_por_minuto' => $this->faker->numberBetween(200, 500),
            'tarifa_minima' => $this->faker->numberBetween(5000, 12000),
            'hora_inicio_nocturno' => '18:00:00',
            'hora_fin_nocturno' => '06:00:00',
            'estado' => 'activa',
        ];
    }
}
