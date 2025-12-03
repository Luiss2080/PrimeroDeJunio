<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Turno>
 */
class TurnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha_hora_inicio' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'fecha_hora_fin' => function (array $attributes) {
                return $this->faker->dateTimeInInterval($attributes['fecha_hora_inicio'], '+8 hours');
            },
            'km_inicial' => $this->faker->numberBetween(10000, 50000),
            'km_final' => function (array $attributes) {
                return $attributes['km_inicial'] + $this->faker->numberBetween(50, 300);
            },
            'total_recaudado' => $this->faker->randomFloat(2, 100000, 500000),
            'estado' => 'cerrado',
        ];
    }
}
