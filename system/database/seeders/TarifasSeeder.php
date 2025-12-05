<?php

namespace Database\Seeders;

use App\Models\Tarifa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TarifasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tarifas específicas con estructura correcta
        $tarifasEspecificas = [
            [
                'nombre' => 'Tarifa Urbana Básica',
                'descripcion' => 'Tarifa estándar para servicios urbanos dentro de la ciudad',
                'tarifa_base' => 4500.00,
                'tarifa_por_km' => 1200.00,
                'tarifa_por_minuto' => 300.00,
                'tarifa_minima' => 4500.00,
                'tarifa_maxima' => 50000.00,
                'recargo_nocturno' => 20.00,
                'recargo_festivo' => 30.00,
                'recargo_lluvia' => 15.00,
                'tipo_servicio' => 'urbano',
                'estado' => 'activa',
                'fecha_vigencia_inicio' => '2024-01-01',
                'fecha_vigencia_fin' => '2024-12-31',
                'creado_por' => 1,
            ],
            [
                'nombre' => 'Tarifa Aeropuerto',
                'descripcion' => 'Tarifa especial para traslados hacia y desde el aeropuerto',
                'tarifa_base' => 15000.00,
                'tarifa_por_km' => 1800.00,
                'tarifa_por_minuto' => 400.00,
                'tarifa_minima' => 15000.00,
                'tarifa_maxima' => 80000.00,
                'recargo_nocturno' => 25.00,
                'recargo_festivo' => 35.00,
                'recargo_lluvia' => 20.00,
                'tipo_servicio' => 'aeropuerto',
                'estado' => 'activa',
                'fecha_vigencia_inicio' => '2024-01-01',
                'creado_por' => 1,
            ],
            [
                'nombre' => 'Tarifa Intermunicipal',
                'descripcion' => 'Tarifa para viajes entre municipios cercanos',
                'tarifa_base' => 8000.00,
                'tarifa_por_km' => 1500.00,
                'tarifa_por_minuto' => 350.00,
                'tarifa_minima' => 8000.00,
                'tarifa_maxima' => 120000.00,
                'recargo_nocturno' => 30.00,
                'recargo_festivo' => 40.00,
                'recargo_lluvia' => 25.00,
                'tipo_servicio' => 'intermunicipal',
                'estado' => 'activa',
                'fecha_vigencia_inicio' => '2024-01-01',
                'creado_por' => 1,
            ],
            [
                'nombre' => 'Tarifa Especial Ejecutiva',
                'descripcion' => 'Tarifa premium para servicios ejecutivos y corporativos',
                'tarifa_base' => 7000.00,
                'tarifa_por_km' => 1600.00,
                'tarifa_por_minuto' => 450.00,
                'tarifa_minima' => 7000.00,
                'tarifa_maxima' => 100000.00,
                'recargo_nocturno' => 35.00,
                'recargo_festivo' => 45.00,
                'recargo_lluvia' => 30.00,
                'tipo_servicio' => 'especial',
                'estado' => 'activa',
                'fecha_vigencia_inicio' => '2024-01-01',
                'creado_por' => 1,
            ],
        ];

        foreach ($tarifasEspecificas as $tarifaData) {
            Tarifa::create($tarifaData);
        }

        // Crear tarifas adicionales usando factory
        Tarifa::factory()->count(16)->create();
        
        $this->command->info('Se crearon 20 tarifas: 4 específicas + 16 generadas');
    }
}
