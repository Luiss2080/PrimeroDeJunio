<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PagoConductor;
use App\Models\Conductor;

class PagosConductoresSeeder extends Seeder
{
    public function run()
    {
        // Obtener todos los conductores disponibles
        $conductores = Conductor::all();
        
        if ($conductores->isEmpty()) {
            $this->command->warn('No hay conductores disponibles. Ejecuta ConductoresSeeder primero.');
            return;
        }

        $this->command->info('Creando pagos a conductores...');

        // Crear array de pagos
        $pagos = [];

        // Generar 30 pagos usando faker
        for ($i = 0; $i < 30; $i++) {
            $periodInicio = fake('es_CO')->dateTimeBetween('-3 months', '-1 month');
            $periodFin = fake()->dateTimeBetween($periodInicio, 'now');
            
            $pagos[] = [
                'conductor_id' => $conductores->random()->id,
                'fecha_pago' => fake('es_CO')->dateTimeBetween('-6 months', 'now'),
                'monto' => fake()->randomFloat(2, 100000, 2000000),
                'tipo' => fake()->randomElement(['tarifa_diaria', 'comision_viajes', 'bono_productividad', 'multa', 'descuento', 'abono_deuda', 'liquidacion']),
                'metodo_pago' => fake()->randomElement(['efectivo', 'transferencia', 'consignacion', 'descuento_viajes', 'cheque']),
                'periodo_inicio' => $periodInicio,
                'periodo_fin' => $periodFin,
                'estado' => fake()->randomElement(['pendiente', 'pagado', 'exonerado', 'rechazado']),
                'observaciones' => fake('es_CO')->optional(0.6)->text(150),
                'total_viajes_periodo' => rand(10, 50),
                'comision_total_periodo' => fake()->randomFloat(2, 50000, 200000),
                'referencia_externa' => 'REF' . rand(100000, 999999),
                'registrado_por' => 1,
                'actualizado_por' => rand(0, 1) ? 1 : null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach (array_chunk($pagos, 15) as $chunk) {
            PagoConductor::insert($chunk);
        }
        
        $this->command->info('Se crearon 30 pagos a conductores');
    }
}