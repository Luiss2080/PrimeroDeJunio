<?php

namespace Database\Seeders;

use App\Models\Documento;
use App\Models\Conductor;
use App\Models\Vehiculo;
use Illuminate\Database\Seeder;

class DocumentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed documents for Conductors (Licencia)
        Conductor::all()->each(function ($conductor) {
            Documento::factory()->create([
                'documentable_id' => $conductor->id,
                'documentable_type' => Conductor::class,
                'tipo_documento' => 'Licencia de Conducción',
                'numero' => $conductor->cedula, // Or random
            ]);
        });

        // Seed documents for Vehicles (SOAT, Tecno, Seguro)
        Vehiculo::all()->each(function ($vehiculo) {
            $docs = ['SOAT', 'Tecnomecánica', 'Seguro Todo Riesgo', 'Tarjeta de Propiedad'];
            foreach ($docs as $tipo) {
                Documento::factory()->create([
                    'documentable_id' => $vehiculo->id,
                    'documentable_type' => Vehiculo::class,
                    'tipo_documento' => $tipo,
                ]);
            }
        });
    }
}
