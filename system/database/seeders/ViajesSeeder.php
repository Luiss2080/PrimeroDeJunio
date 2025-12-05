<?php

namespace Database\Seeders;

use App\Models\Viaje;
use App\Models\Conductor;
use App\Models\Vehiculo;
use App\Models\Cliente;
use App\Models\Tarifa;
use Illuminate\Database\Seeder;

class ViajesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Conductor::count() == 0 || Vehiculo::count() == 0) {
            $this->command->warn('No hay conductores o vehículos disponibles para crear viajes');
            return;
        }

        $conductores = Conductor::all();
        $vehiculos = Vehiculo::all();
        $clientes = Cliente::all();
        $tarifas = Tarifa::all();

        // Viajes específicos con datos completos y realistas
        $viajesEspecificos = [
            [
                'conductor_id' => $conductores->first()?->id,
                'vehiculo_id' => $vehiculos->first()?->id,
                'cliente_id' => $clientes->first()?->id,
                'tarifa_id' => $tarifas->first()?->id,
                'origen' => 'Centro Comercial Andino',
                'destino' => 'Universidad Nacional',
                'fecha_viaje' => now()->subDays(5),
                'hora_inicio' => now()->subDays(5)->setHour(14)->setMinute(30),
                'hora_fin' => now()->subDays(5)->setHour(15)->setMinute(10),
                'distancia_km' => 8.5,
                'duracion_minutos' => 40,
                'estado' => 'completado',
                'precio_total' => 18500.00,
                'metodo_pago' => 'efectivo',
                'calificacion_conductor' => 5,
                'calificacion_cliente' => 4,
                'observaciones' => 'Viaje sin contratiempos, cliente puntual',
            ],
            [
                'conductor_id' => $conductores->skip(1)->first()?->id,
                'vehiculo_id' => $vehiculos->skip(1)->first()?->id,
                'cliente_id' => $clientes->skip(1)->first()?->id,
                'tarifa_id' => $tarifas->skip(1)->first()?->id,
                'origen' => 'Aeropuerto El Dorado',
                'destino' => 'Hotel Casa Dann Carlton',
                'fecha_viaje' => now()->subDays(3),
                'hora_inicio' => now()->subDays(3)->setHour(18)->setMinute(45),
                'hora_fin' => now()->subDays(3)->setHour(19)->setMinute(35),
                'distancia_km' => 15.2,
                'duracion_minutos' => 50,
                'estado' => 'completado',
                'precio_total' => 35000.00,
                'metodo_pago' => 'transferencia',
                'calificacion_conductor' => 5,
                'calificacion_cliente' => 5,
                'observaciones' => 'Cliente extranjero, muy satisfecho con el servicio',
            ],
            [
                'conductor_id' => $conductores->skip(2)->first()?->id,
                'vehiculo_id' => $vehiculos->skip(2)->first()?->id,
                'cliente_id' => $clientes->skip(2)->first()?->id,
                'tarifa_id' => $tarifas->skip(2)->first()?->id,
                'origen' => 'Hospital San Ignacio',
                'destino' => 'Farmacia Cruz Verde',
                'fecha_viaje' => now()->subDays(1),
                'hora_inicio' => now()->subDays(1)->setHour(10)->setMinute(15),
                'hora_fin' => now()->subDays(1)->setHour(10)->setMinute(35),
                'distancia_km' => 3.8,
                'duracion_minutos' => 20,
                'estado' => 'completado',
                'precio_total' => 9500.00,
                'metodo_pago' => 'efectivo',
                'calificacion_conductor' => 4,
                'calificacion_cliente' => 5,
                'observaciones' => 'Viaje médico urgente, conductor muy colaborador',
            ]
        ];

        foreach ($viajesEspecificos as $viajeData) {
            // Solo crear si tenemos las referencias necesarias
            if ($viajeData['conductor_id'] && $viajeData['vehiculo_id']) {
                Viaje::create($viajeData);
            }
        }

        // Crear viajes adicionales usando factory
        $viajesCreados = Viaje::factory()
            ->count(47)
            ->recycle($conductores)
            ->recycle($vehiculos)
            ->recycle($clientes)
            ->recycle($tarifas)
            ->create();

        $this->command->info('Se crearon ' . (count($viajesEspecificos) + count($viajesCreados)) . ' viajes: 3 específicos + 47 generados');
    }
}