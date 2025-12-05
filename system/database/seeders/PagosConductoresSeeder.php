<?php

namespace Database\Seeders;

use App\Models\PagoConductor;
use App\Models\Conductor;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PagosConductoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Conductor::count() == 0) {
            return;
        }

        $conductores = Conductor::all();
        
        $pagos = [
            // Pagos regulares completados (15 registros)
            [
                'conductor_id' => $conductores->random()->id,
                'periodo_inicio' => Carbon::now()->subMonth()->startOfMonth(),
                'periodo_fin' => Carbon::now()->subMonth()->endOfMonth(),
                'salario_base' => 1300000.00,
                'total_viajes_realizados' => 125,
                'comision_viajes' => 750000.00,
                'bonificaciones' => 50000.00,
                'horas_extras' => 25.5,
                'valor_hora_extra' => 6000.00,
                'total_horas_extras' => 153000.00,
                'descuentos_seguridad_social' => 184500.00,
                'otros_descuentos' => 35000.00,
                'descuentos_detalle' => json_encode([
                    ['concepto' => 'EPS', 'valor' => 52000],
                    ['concepto' => 'Pensión', 'valor' => 104000],
                    ['concepto' => 'ARL', 'valor' => 28500],
                    ['concepto' => 'Préstamo personal', 'valor' => 35000]
                ]),
                'total_ingresos' => 2253000.00,
                'total_descuentos' => 219500.00,
                'valor_neto_pagar' => 2033500.00,
                'estado_pago' => 'pagado',
                'fecha_programada_pago' => Carbon::now()->subMonth()->endOfMonth()->addDays(5),
                'fecha_pago_real' => Carbon::now()->subMonth()->endOfMonth()->addDays(5),
                'metodo_pago' => 'transferencia_bancaria',
                'numero_transaccion' => 'TXN-' . rand(100000, 999999),
                'observaciones' => 'Pago mensual completo. Incluye bonificación por puntualidad.',
                'tipo_pago' => 'mensual',
                'creado_por' => 1
            ],
            [
                'conductor_id' => $conductores->random()->id,
                'periodo_inicio' => Carbon::now()->subMonth()->startOfMonth(),
                'periodo_fin' => Carbon::now()->subMonth()->endOfMonth(),
                'salario_base' => 1300000.00,
                'total_viajes_realizados' => 98,
                'comision_viajes' => 588000.00,
                'bonificaciones' => 0.00,
                'horas_extras' => 18.0,
                'valor_hora_extra' => 6000.00,
                'total_horas_extras' => 108000.00,
                'descuentos_seguridad_social' => 179280.00,
                'otros_descuentos' => 20000.00,
                'descuentos_detalle' => json_encode([
                    ['concepto' => 'EPS', 'valor' => 51936],
                    ['concepto' => 'Pensión', 'valor' => 99792],
                    ['concepto' => 'ARL', 'valor' => 27552],
                    ['concepto' => 'Multa tránsito', 'valor' => 20000]
                ]),
                'total_ingresos' => 1996000.00,
                'total_descuentos' => 199280.00,
                'valor_neto_pagar' => 1796720.00,
                'estado_pago' => 'pagado',
                'fecha_programada_pago' => Carbon::now()->subMonth()->endOfMonth()->addDays(5),
                'fecha_pago_real' => Carbon::now()->subMonth()->endOfMonth()->addDays(5),
                'metodo_pago' => 'transferencia_bancaria',
                'numero_transaccion' => 'TXN-' . rand(100000, 999999),
                'observaciones' => 'Pago mensual regular. Se descontó multa de tránsito.',
                'tipo_pago' => 'mensual',
                'creado_por' => 1
            ],
            [
                'conductor_id' => $conductores->random()->id,
                'periodo_inicio' => Carbon::now()->subWeeks(2)->startOfWeek(),
                'periodo_fin' => Carbon::now()->subWeeks(2)->endOfWeek(),
                'salario_base' => 325000.00,
                'total_viajes_realizados' => 32,
                'comision_viajes' => 192000.00,
                'bonificaciones' => 15000.00,
                'horas_extras' => 6.0,
                'valor_hora_extra' => 6000.00,
                'total_horas_extras' => 36000.00,
                'descuentos_seguridad_social' => 51180.00,
                'otros_descuentos' => 0.00,
                'descuentos_detalle' => json_encode([
                    ['concepto' => 'EPS', 'valor' => 14820],
                    ['concepto' => 'Pensión', 'valor' => 28404],
                    ['concepto' => 'ARL', 'valor' => 7956]
                ]),
                'total_ingresos' => 568000.00,
                'total_descuentos' => 51180.00,
                'valor_neto_pagar' => 516820.00,
                'estado_pago' => 'pagado',
                'fecha_programada_pago' => Carbon::now()->subWeeks(1)->startOfWeek(),
                'fecha_pago_real' => Carbon::now()->subWeeks(1)->startOfWeek(),
                'metodo_pago' => 'efectivo',
                'numero_transaccion' => null,
                'observaciones' => 'Pago semanal. Incluye bonificación por desempeño.',
                'tipo_pago' => 'semanal',
                'creado_por' => 1
            ],
            [
                'conductor_id' => $conductores->random()->id,
                'periodo_inicio' => Carbon::now()->subDays(15),
                'periodo_fin' => Carbon::now()->subDays(1),
                'salario_base' => 650000.00,
                'total_viajes_realizados' => 68,
                'comision_viajes' => 408000.00,
                'bonificaciones' => 25000.00,
                'horas_extras' => 12.5,
                'valor_hora_extra' => 6000.00,
                'total_horas_extras' => 75000.00,
                'descuentos_seguridad_social' => 103740.00,
                'otros_descuentos' => 15000.00,
                'descuentos_detalle' => json_encode([
                    ['concepto' => 'EPS', 'valor' => 30084],
                    ['concepto' => 'Pensión', 'valor' => 57672],
                    ['concepto' => 'ARL', 'valor' => 15984],
                    ['concepto' => 'Préstamo empresa', 'valor' => 15000]
                ]),
                'total_ingresos' => 1158000.00,
                'total_descuentos' => 118740.00,
                'valor_neto_pagar' => 1039260.00,
                'estado_pago' => 'pagado',
                'fecha_programada_pago' => Carbon::now()->subDays(1),
                'fecha_pago_real' => Carbon::now()->subDays(1),
                'metodo_pago' => 'transferencia_bancaria',
                'numero_transaccion' => 'TXN-' . rand(100000, 999999),
                'observaciones' => 'Pago quincenal. Buen rendimiento en viajes.',
                'tipo_pago' => 'quincenal',
                'creado_por' => 1
            ],
            [
                'conductor_id' => $conductores->random()->id,
                'periodo_inicio' => Carbon::now()->subDays(7),
                'periodo_fin' => Carbon::now()->subDays(1),
                'salario_base' => 275000.00,
                'total_viajes_realizados' => 28,
                'comision_viajes' => 168000.00,
                'bonificaciones' => 10000.00,
                'horas_extras' => 4.0,
                'valor_hora_extra' => 6000.00,
                'total_horas_extras' => 24000.00,
                'descuentos_seguridad_social' => 42831.00,
                'otros_descuentos' => 5000.00,
                'descuentos_detalle' => json_encode([
                    ['concepto' => 'EPS', 'valor' => 12411],
                    ['concepto' => 'Pensión', 'valor' => 23793],
                    ['concepto' => 'ARL', 'valor' => 6627],
                    ['concepto' => 'Descuento combustible', 'valor' => 5000]
                ]),
                'total_ingresos' => 477000.00,
                'total_descuentos' => 47831.00,
                'valor_neto_pagar' => 429169.00,
                'estado_pago' => 'pagado',
                'fecha_programada_pago' => Carbon::now(),
                'fecha_pago_real' => Carbon::now(),
                'metodo_pago' => 'efectivo',
                'numero_transaccion' => null,
                'observaciones' => 'Pago semanal. Descuento por combustible adicional.',
                'tipo_pago' => 'semanal',
                'creado_por' => 1
            ],
            [
                'conductor_id' => $conductores->random()->id,
                'periodo_inicio' => Carbon::now()->subDays(3),
                'periodo_fin' => Carbon::now()->subDays(1),
                'salario_base' => 130000.00,
                'total_viajes_realizados' => 15,
                'comision_viajes' => 90000.00,
                'bonificaciones' => 5000.00,
                'horas_extras' => 2.0,
                'valor_hora_extra' => 6000.00,
                'total_horas_extras' => 12000.00,
                'descuentos_seguridad_social' => 21267.00,
                'otros_descuentos' => 0.00,
                'descuentos_detalle' => json_encode([
                    ['concepto' => 'EPS', 'valor' => 6159],
                    ['concepto' => 'Pensión', 'valor' => 11811],
                    ['concepto' => 'ARL', 'valor' => 3297]
                ]),
                'total_ingresos' => 237000.00,
                'total_descuentos' => 21267.00,
                'valor_neto_pagar' => 215733.00,
                'estado_pago' => 'pagado',
                'fecha_programada_pago' => Carbon::yesterday(),
                'fecha_pago_real' => Carbon::yesterday(),
                'metodo_pago' => 'transferencia_bancaria',
                'numero_transaccion' => 'TXN-' . rand(100000, 999999),
                'observaciones' => 'Pago por días trabajados. Período corto.',
                'tipo_pago' => 'por_dias',
                'creado_por' => 1
            ],

            // Continuando con más pagos...
            [
                'conductor_id' => $conductores->random()->id,
                'periodo_inicio' => Carbon::now()->subDays(30),
                'periodo_fin' => Carbon::now()->subDays(16),
                'salario_base' => 650000.00,
                'total_viajes_realizados' => 72,
                'comision_viajes' => 432000.00,
                'bonificaciones' => 30000.00,
                'horas_extras' => 15.0,
                'valor_hora_extra' => 6000.00,
                'total_horas_extras' => 90000.00,
                'descuentos_seguridad_social' => 108360.00,
                'otros_descuentos' => 25000.00,
                'descuentos_detalle' => json_encode([
                    ['concepto' => 'EPS', 'valor' => 31404],
                    ['concepto' => 'Pensión', 'valor' => 60192],
                    ['concepto' => 'ARL', 'valor' => 16764],
                    ['concepto' => 'Prestamo personal', 'valor' => 25000]
                ]),
                'total_ingresos' => 1202000.00,
                'total_descuentos' => 133360.00,
                'valor_neto_pagar' => 1068640.00,
                'estado_pago' => 'pagado',
                'fecha_programada_pago' => Carbon::now()->subDays(10),
                'fecha_pago_real' => Carbon::now()->subDays(10),
                'metodo_pago' => 'transferencia_bancaria',
                'numero_transaccion' => 'TXN-' . rand(100000, 999999),
                'observaciones' => 'Pago quincenal. Excelente desempeño con bonificación.',
                'tipo_pago' => 'quincenal',
                'creado_por' => 1
            ],

            // Agregando más registros hasta llegar a 25+
            [
                'conductor_id' => $conductores->random()->id,
                'periodo_inicio' => Carbon::now()->subWeeks(3)->startOfWeek(),
                'periodo_fin' => Carbon::now()->subWeeks(3)->endOfWeek(),
                'salario_base' => 325000.00,
                'total_viajes_realizados' => 35,
                'comision_viajes' => 210000.00,
                'bonificaciones' => 20000.00,
                'horas_extras' => 8.0,
                'valor_hora_extra' => 6000.00,
                'total_horas_extras' => 48000.00,
                'descuentos_seguridad_social' => 53415.00,
                'otros_descuentos' => 10000.00,
                'descuentos_detalle' => json_encode([
                    ['concepto' => 'EPS', 'valor' => 15471],
                    ['concepto' => 'Pensión', 'valor' => 29649],
                    ['concepto' => 'ARL', 'valor' => 8295],
                    ['concepto' => 'Descuento por daño', 'valor' => 10000]
                ]),
                'total_ingresos' => 603000.00,
                'total_descuentos' => 63415.00,
                'valor_neto_pagar' => 539585.00,
                'estado_pago' => 'pagado',
                'fecha_programada_pago' => Carbon::now()->subWeeks(2)->startOfWeek(),
                'fecha_pago_real' => Carbon::now()->subWeeks(2)->startOfWeek(),
                'metodo_pago' => 'efectivo',
                'numero_transaccion' => null,
                'observaciones' => 'Pago semanal. Descuento por reparación menor del vehículo.',
                'tipo_pago' => 'semanal',
                'creado_por' => 1
            ],

            // Pagos pendientes y programados (10+ registros)
            [
                'conductor_id' => $conductores->random()->id,
                'periodo_inicio' => Carbon::now()->startOfWeek(),
                'periodo_fin' => Carbon::now()->endOfWeek(),
                'salario_base' => 325000.00,
                'total_viajes_realizados' => 42,
                'comision_viajes' => 252000.00,
                'bonificaciones' => 15000.00,
                'horas_extras' => 10.0,
                'valor_hora_extra' => 6000.00,
                'total_horas_extras' => 60000.00,
                'descuentos_seguridad_social' => 58140.00,
                'otros_descuentos' => 0.00,
                'descuentos_detalle' => json_encode([
                    ['concepto' => 'EPS', 'valor' => 16836],
                    ['concepto' => 'Pensión', 'valor' => 32244],
                    ['concepto' => 'ARL', 'valor' => 9060]
                ]),
                'total_ingresos' => 652000.00,
                'total_descuentos' => 58140.00,
                'valor_neto_pagar' => 593860.00,
                'estado_pago' => 'pendiente',
                'fecha_programada_pago' => Carbon::now()->addDays(2),
                'fecha_pago_real' => null,
                'metodo_pago' => 'transferencia_bancaria',
                'numero_transaccion' => null,
                'observaciones' => 'Pago semanal pendiente. En proceso de aprobación.',
                'tipo_pago' => 'semanal',
                'creado_por' => 1
            ],
            [
                'conductor_id' => $conductores->random()->id,
                'periodo_inicio' => Carbon::now()->subDays(15),
                'periodo_fin' => Carbon::now(),
                'salario_base' => 650000.00,
                'total_viajes_realizados' => 85,
                'comision_viajes' => 510000.00,
                'bonificaciones' => 40000.00,
                'horas_extras' => 20.0,
                'valor_hora_extra' => 6000.00,
                'total_horas_extras' => 120000.00,
                'descuentos_seguridad_social' => 118800.00,
                'otros_descuentos' => 0.00,
                'descuentos_detalle' => json_encode([
                    ['concepto' => 'EPS', 'valor' => 34440],
                    ['concepto' => 'Pensión', 'valor' => 66000],
                    ['concepto' => 'ARL', 'valor' => 18360]
                ]),
                'total_ingresos' => 1320000.00,
                'total_descuentos' => 118800.00,
                'valor_neto_pagar' => 1201200.00,
                'estado_pago' => 'aprobado',
                'fecha_programada_pago' => Carbon::tomorrow(),
                'fecha_pago_real' => null,
                'metodo_pago' => 'transferencia_bancaria',
                'numero_transaccion' => null,
                'observaciones' => 'Pago quincenal aprobado. Listo para transferencia.',
                'tipo_pago' => 'quincenal',
                'creado_por' => 1
            ],

            // Agregando registros adicionales hasta completar 25+
            [
                'conductor_id' => $conductores->random()->id,
                'periodo_inicio' => Carbon::now()->subMonth(2)->startOfMonth(),
                'periodo_fin' => Carbon::now()->subMonth(2)->endOfMonth(),
                'salario_base' => 1300000.00,
                'total_viajes_realizados' => 110,
                'comision_viajes' => 660000.00,
                'bonificaciones' => 35000.00,
                'horas_extras' => 22.0,
                'valor_hora_extra' => 6000.00,
                'total_horas_extras' => 132000.00,
                'descuentos_seguridad_social' => 190605.00,
                'otros_descuentos' => 45000.00,
                'descuentos_detalle' => json_encode([
                    ['concepto' => 'EPS', 'valor' => 55215],
                    ['concepto' => 'Pensión', 'valor' => 105831],
                    ['concepto' => 'ARL', 'valor' => 29559],
                    ['concepto' => 'Préstamo vivienda', 'valor' => 45000]
                ]),
                'total_ingresos' => 2127000.00,
                'total_descuentos' => 235605.00,
                'valor_neto_pagar' => 1891395.00,
                'estado_pago' => 'pagado',
                'fecha_programada_pago' => Carbon::now()->subMonth(2)->endOfMonth()->addDays(5),
                'fecha_pago_real' => Carbon::now()->subMonth(2)->endOfMonth()->addDays(5),
                'metodo_pago' => 'transferencia_bancaria',
                'numero_transaccion' => 'TXN-' . rand(100000, 999999),
                'observaciones' => 'Pago mensual con excelente desempeño. Incluye préstamo vivienda.',
                'tipo_pago' => 'mensual',
                'creado_por' => 1
            ]
        ];

        // Generar registros adicionales para alcanzar 25+
        for ($i = count($pagos); $i < 25; $i++) {
            $conductor = $conductores->random();
            $periodo_inicio = Carbon::now()->subDays(rand(1, 60));
            $periodo_fin = $periodo_inicio->copy()->addDays(rand(7, 30));
            
            $total_viajes = rand(15, 80);
            $salario_base = rand(300, 1300) * 1000;
            $comision_viajes = $total_viajes * rand(4000, 8000);
            $bonificaciones = rand(0, 1) ? rand(10000, 50000) : 0;
            $horas_extras = rand(0, 25);
            $total_horas_extras = $horas_extras * 6000;
            
            $total_ingresos = $salario_base + $comision_viajes + $bonificaciones + $total_horas_extras;
            $descuentos_ss = $total_ingresos * 0.09;
            $otros_descuentos = rand(0, 1) ? rand(5000, 30000) : 0;
            $total_descuentos = $descuentos_ss + $otros_descuentos;
            
            $pagos[] = [
                'conductor_id' => $conductor->id,
                'periodo_inicio' => $periodo_inicio,
                'periodo_fin' => $periodo_fin,
                'salario_base' => $salario_base,
                'total_viajes_realizados' => $total_viajes,
                'comision_viajes' => $comision_viajes,
                'bonificaciones' => $bonificaciones,
                'horas_extras' => $horas_extras,
                'valor_hora_extra' => 6000.00,
                'total_horas_extras' => $total_horas_extras,
                'descuentos_seguridad_social' => $descuentos_ss,
                'otros_descuentos' => $otros_descuentos,
                'descuentos_detalle' => json_encode([
                    ['concepto' => 'EPS', 'valor' => round($descuentos_ss * 0.3)],
                    ['concepto' => 'Pensión', 'valor' => round($descuentos_ss * 0.57)],
                    ['concepto' => 'ARL', 'valor' => round($descuentos_ss * 0.13)]
                ]),
                'total_ingresos' => $total_ingresos,
                'total_descuentos' => $total_descuentos,
                'valor_neto_pagar' => $total_ingresos - $total_descuentos,
                'estado_pago' => collect(['pagado', 'pendiente', 'aprobado'])->random(),
                'fecha_programada_pago' => $periodo_fin->copy()->addDays(rand(1, 7)),
                'fecha_pago_real' => rand(0, 1) ? $periodo_fin->copy()->addDays(rand(1, 7)) : null,
                'metodo_pago' => collect(['transferencia_bancaria', 'efectivo', 'cheque'])->random(),
                'numero_transaccion' => rand(0, 1) ? 'TXN-' . rand(100000, 999999) : null,
                'observaciones' => 'Pago generado automáticamente por el sistema.',
                'tipo_pago' => collect(['semanal', 'quincenal', 'mensual'])->random(),
                'creado_por' => 1
            ];
        }

        foreach ($pagos as $pago) {
            PagoConductor::create(array_merge($pago, [
                'actualizado_por' => 1,
            ]));
        }
    }
}
