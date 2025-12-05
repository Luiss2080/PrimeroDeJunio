<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PagoConductor>
 */
class PagoConductorFactory extends Factory
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
            'fecha_pago' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'monto' => $this->faker->randomFloat(2, 50000, 100000),
            'tipo' => $this->faker->randomElement(['tarifa_diaria', 'tarifa_diaria', 'multa', 'abono_deuda']),
            'metodo_pago' => $this->faker->randomElement(['efectivo', 'transferencia', 'consignacion', 'descuento_viajes', 'cheque']),
            'registrado_por' => \App\Models\User::inRandomOrder()->first()?->id ?? 1,
            'estado' => $this->faker->randomElement(['pagado', 'pagado', 'pendiente']),
            'observaciones' => $this->faker->sentence(),
        ];
    }
}
