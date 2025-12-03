<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HistorialReproduccion>
 */
class HistorialReproduccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha_hora' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'latitud' => $this->faker->latitude(),
            'longitud' => $this->faker->longitude(),
        ];
    }
}
