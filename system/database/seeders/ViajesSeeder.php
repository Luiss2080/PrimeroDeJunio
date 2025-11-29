<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViajesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $viajes = [];
        
        // Generar viajes de los últimos 30 días
        for ($i = 1; $i <= 50; $i++) {
            $fechaViaje = now()->subDays(rand(0, 30));
            $horaInicio = $fechaViaje->copy()->addHours(rand(6, 22))->addMinutes(rand(0, 59));
            $duracionMinutos = rand(10, 120);
            $horaFin = $horaInicio->copy()->addMinutes($duracionMinutos);
            
            $distanciaKm = rand(2, 25);
            $tarifaBase = rand(3000, 15000);
            $propina = rand(0, 5000);
            $total = $tarifaBase + $propina;
            
            $viajes[] = [
                'conductor_id' => rand(1, 10),
                'cliente_id' => rand(1, 20),
                'vehiculo_id' => rand(1, 13),
                'origen' => $this->getOrigenAleatorio(),
                'destino' => $this->getDestinoAleatorio(),
                'fecha_viaje' => $fechaViaje->toDateString(),
                'hora_inicio' => $horaInicio->toTimeString(),
                'hora_fin' => $horaFin->toTimeString(),
                'distancia_km' => $distanciaKm,
                'tarifa_base' => $tarifaBase,
                'tarifa_adicional' => 0,
                'propina' => $propina,
                'total' => $total,
                'estado' => $this->getEstadoAleatorio(),
                'metodo_pago' => $this->getMetodoPagoAleatorio(),
                'calificacion_conductor' => rand(3, 5),
                'calificacion_cliente' => rand(3, 5),
                'observaciones' => $this->getObservacionAleatoria(),
                'created_at' => $fechaViaje,
                'updated_at' => $fechaViaje
            ];
        }
        
        DB::table('viajes')->insert($viajes);
    }
    
    private function getOrigenAleatorio()
    {
        $origenes = [
            'Centro Comercial Multiplaza',
            'Universidad Nacional',
            'Hospital Central',
            'Aeropuerto Internacional',
            'Terminal de Buses',
            'Plaza Principal',
            'Mercado Central',
            'Estadio Municipal',
            'Parque Central',
            'Centro Médico',
            'Mall del Norte',
            'Zona Rosa'
        ];
        
        return $origenes[array_rand($origenes)];
    }
    
    private function getDestinoAleatorio()
    {
        $destinos = [
            'Residencial Los Pinos',
            'Barrio San José',
            'Colonia El Progreso',
            'Sector Industrial',
            'Zona Universitaria',
            'Centro Histórico',
            'Barrio Nuevo',
            'Urbanización La Esperanza',
            'Sector Comercial',
            'Zona Hotelera',
            'Barrio Popular',
            'Residencial Las Flores'
        ];
        
        return $destinos[array_rand($destinos)];
    }
    
    private function getEstadoAleatorio()
    {
        $estados = ['completado', 'completado', 'completado', 'completado', 'cancelado'];
        return $estados[array_rand($estados)];
    }
    
    private function getMetodoPagoAleatorio()
    {
        $metodos = ['efectivo', 'tarjeta', 'transferencia', 'efectivo', 'efectivo'];
        return $metodos[array_rand($metodos)];
    }
    
    private function getObservacionAleatoria()
    {
        $observaciones = [
            'Viaje sin novedad',
            'Cliente muy amable',
            'Tráfico pesado en la ruta',
            'Entrega de paquete incluida',
            'Viaje nocturno',
            'Cliente frecuente',
            'Ruta alternativa por obras',
            'Parada adicional solicitada',
            null,
            null
        ];
        
        return $observaciones[array_rand($observaciones)];
    }
}