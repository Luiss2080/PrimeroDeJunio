<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Audio>
 */
class AudioFactory extends Factory
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
            'archivo_ruta' => 'audios/demo.mp3', // Placeholder path
            'duracion_segundos' => $this->faker->numberBetween(15, 60),
            'estado' => 'activo',
        ];
    }
}
