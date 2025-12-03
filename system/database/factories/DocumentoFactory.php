<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Documento>
 */
class DocumentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fechaExpedicion = $this->faker->date();
        return [
            'tipo_documento' => $this->faker->randomElement(['Licencia', 'SOAT', 'Tecnomecanica', 'Tarjeta de Propiedad']),
            'numero' => $this->faker->bothify('DOC-#####'),
            'fecha_expedicion' => $fechaExpedicion,
            'fecha_vencimiento' => $this->faker->dateTimeBetween($fechaExpedicion, '+5 years'),
            'archivo_ruta' => 'documentos/demo.pdf',
            'estado' => 'vigente',
            'observaciones' => $this->faker->sentence(),
        ];
    }
}
