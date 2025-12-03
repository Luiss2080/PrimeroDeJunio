<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PagoTarifaDiaria>
 */
class PagoTarifaDiariaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fecha_pago' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'monto' => $this->faker->randomFloat(2, 50000, 100000),
            'metodo_pago' => $this->faker->randomElement(['efectivo', 'transferencia']),
            'estado' => 'aprobado',
            'observaciones' => $this->faker->sentence(),
        ];
    }
}
