<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagosTarifaDiariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pagos = [];
        
        // Generar pagos de tarifa diaria para los últimos 60 días
        for ($i = 1; $i <= 120; $i++) {
            $fechaPago = now()->subDays(rand(0, 60));
            $monto = rand(15000, 25000); // Tarifa diaria entre 15k y 25k
            
            $pagos[] = [
                'conductor_id' => rand(1, 10),
                'fecha_pago' => $fechaPago->toDateString(),
                'monto' => $monto,
                'metodo_pago' => $this->getMetodoPagoAleatorio(),
                'referencia_pago' => $this->generarReferencia(),
                'estado' => $this->getEstadoAleatorio(),
                'observaciones' => $this->getObservacionAleatoria(),
                'created_at' => $fechaPago,
                'updated_at' => $fechaPago
            ];
        }
        
        DB::table('pagos_tarifa_diaria')->insert($pagos);
    }
    
    private function getMetodoPagoAleatorio()
    {
        $metodos = [
            'efectivo',
            'transferencia',
            'deposito',
            'efectivo',
            'efectivo' // Más probabilidad de efectivo
        ];
        
        return $metodos[array_rand($metodos)];
    }
    
    private function getEstadoAleatorio()
    {
        $estados = [
            'pagado',
            'pagado',
            'pagado',
            'pendiente',
            'vencido'
        ];
        
        return $estados[array_rand($estados)];
    }
    
    private function generarReferencia()
    {
        $prefijos = ['TRF', 'DEP', 'EFE', 'PAG'];
        $prefijo = $prefijos[array_rand($prefijos)];
        $numero = str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);
        
        return $prefijo . '-' . $numero;
    }
    
    private function getObservacionAleatoria()
    {
        $observaciones = [
            'Pago realizado a tiempo',
            'Pago con mora de 1 día',
            'Conductor al día con pagos',
            'Pago parcial - completar mañana',
            'Descuento aplicado por buen comportamiento',
            'Pago completo sin novedad',
            null,
            null
        ];
        
        return $observaciones[array_rand($observaciones)];
    }
}