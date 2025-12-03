<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Viaje>
 */
class ViajeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $valorBase = $this->faker->numberBetween(5000, 50000);
        $recargos = $this->faker->randomElement([0, 0, 2000, 5000]);
        $descuentos = $this->faker->randomElement([0, 0, 0, 1000]);
        
        return [
            'conductor_id' => \App\Models\Conductor::factory(),
            'vehiculo_id' => \App\Models\Vehiculo::factory(),
            'cliente_id' => \App\Models\Cliente::factory(),
            'tarifa_aplicada_id' => \App\Models\Tarifa::factory(),
            'cliente_nombre' => $this->faker->name(), // Fallback if no cliente_id
            'cliente_telefono' => $this->faker->phoneNumber(),
            'origen' => $this->faker->address(),
            'destino' => $this->faker->address(),
            'distancia_km' => $this->faker->randomFloat(2, 1, 50),
            'duracion_minutos' => $this->faker->numberBetween(5, 120),
            'tiempo_espera_minutos' => $this->faker->numberBetween(0, 30),
            'costo_tiempo_espera' => $this->faker->randomFloat(2, 0, 10000),
            'valor_base' => $valorBase,
            'recargos' => $recargos,
            'descuentos' => $descuentos,
            'valor_total' => $valorBase + $recargos - $descuentos,
            'metodo_pago' => $this->faker->randomElement(['efectivo', 'efectivo', 'transferencia']),
            'estado' => $this->faker->randomElement(['completado', 'completado', 'cancelado']),
            'fecha_hora_inicio' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'fecha_hora_fin' => function (array $attributes) {
                return $this->faker->dateTimeInInterval($attributes['fecha_hora_inicio'], '+2 hours');
            },
            'calificacion' => $this->faker->numberBetween(3, 5),
            'comentario_cliente' => $this->faker->sentence(),
        ];
    }
}
