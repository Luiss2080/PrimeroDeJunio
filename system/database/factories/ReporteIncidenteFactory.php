<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReporteIncidente>
 */
class ReporteIncidenteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usuario_reporta_id' => \App\Models\User::factory(),
            'viaje_id' => \App\Models\Viaje::factory(),
            'vehiculo_id' => \App\Models\Vehiculo::factory(),
            'tipo' => $this->faker->randomElement(['accidente', 'falla_mecanica', 'queja_cliente', 'objeto_olvidado']),
            'descripcion' => $this->faker->paragraph(),
            'nivel_gravedad' => $this->faker->randomElement(['bajo', 'medio', 'alto']),
            'estado' => $this->faker->randomElement(['reportado', 'en_revision', 'resuelto']),
            'resolucion' => $this->faker->sentence(),
            'fecha_resolucion' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
