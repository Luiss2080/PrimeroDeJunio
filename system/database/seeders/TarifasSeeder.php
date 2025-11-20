<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TarifasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tarifas')->insert([
            [
                'nombre' => 'Tarifa Estándar 2025',
                'descripcion' => 'Tarifa regular para servicios urbanos',
                'tarifa_base' => 3500.00,
                'tarifa_por_km' => 1200.00,
                'tarifa_por_minuto' => 50.00,
                'tarifa_minima' => 4500.00,
                'tarifa_maxima' => 50000.00,
                'recargo_nocturno' => 20.00,
                'recargo_festivo' => 15.00,
                'recargo_lluvia' => 10.00,
                'hora_inicio_nocturno' => '18:00:00',
                'hora_fin_nocturno' => '06:00:00',
                'estado' => 'activa',
                'fecha_vigencia_inicio' => '2025-01-01',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Tarifa Corporativa',
                'descripcion' => 'Tarifa especial para empresas afiliadas',
                'tarifa_base' => 3000.00,
                'tarifa_por_km' => 1000.00,
                'tarifa_por_minuto' => 40.00,
                'tarifa_minima' => 4000.00,
                'tarifa_maxima' => 45000.00,
                'recargo_nocturno' => 15.00,
                'recargo_festivo' => 10.00,
                'recargo_lluvia' => 5.00,
                'hora_inicio_nocturno' => '18:00:00',
                'hora_fin_nocturno' => '06:00:00',
                'estado' => 'activa',
                'fecha_vigencia_inicio' => '2025-01-01',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Tarifa Aeropuerto',
                'descripcion' => 'Tarifa específica para servicios al aeropuerto',
                'tarifa_base' => 8000.00,
                'tarifa_por_km' => 1500.00,
                'tarifa_por_minuto' => 60.00,
                'tarifa_minima' => 12000.00,
                'tarifa_maxima' => 80000.00,
                'recargo_nocturno' => 25.00,
                'recargo_festivo' => 20.00,
                'recargo_lluvia' => 15.00,
                'hora_inicio_nocturno' => '18:00:00',
                'hora_fin_nocturno' => '06:00:00',
                'estado' => 'activa',
                'fecha_vigencia_inicio' => '2025-01-01',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Tarifa Promocional',
                'descripcion' => 'Tarifa promocional para nuevos clientes',
                'tarifa_base' => 2500.00,
                'tarifa_por_km' => 900.00,
                'tarifa_por_minuto' => 30.00,
                'tarifa_minima' => 3500.00,
                'tarifa_maxima' => 35000.00,
                'recargo_nocturno' => 10.00,
                'recargo_festivo' => 5.00,
                'recargo_lluvia' => 5.00,
                'hora_inicio_nocturno' => '18:00:00',
                'hora_fin_nocturno' => '06:00:00',
                'estado' => 'inactiva',
                'fecha_vigencia_inicio' => '2024-12-01',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
