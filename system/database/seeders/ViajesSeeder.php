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

        // Crear viajes específicos con campos correctos
        $conductores = Conductor::all();
        $vehiculos = Vehiculo::all();
        $clientes = Cliente::all();
        $tarifas = Tarifa::all();

        $viajes = [];
        
        for ($i = 1; $i <= 50; $i++) {
            $fechaInicio = now()->subDays(rand(1, 30));
            $duracion = rand(15, 90);
            $fechaFin = $fechaInicio->copy()->addMinutes($duracion);
            
            $viajes[] = [
                'conductor_id' => $conductores->random()->id,
                'vehiculo_id' => $vehiculos->random()->id,
                'cliente_id' => rand(0, 1) ? $clientes->random()->id : null,
                'tarifa_aplicada_id' => $tarifas->random()->id,
                'cliente_nombre' => rand(0, 1) ? null : fake('es_ES')->name(),
                'cliente_telefono' => rand(0, 1) ? null : fake('es_ES')->phoneNumber(),
                'origen' => fake('es_ES')->address(),
                'destino' => fake('es_ES')->address(),
                'distancia_km' => fake()->randomFloat(2, 2, 50),
                'duracion_minutos' => $duracion,
                'tiempo_espera_minutos' => rand(0, 15),
                'valor_base' => fake()->randomFloat(2, 5000, 30000),
                'recargos_total' => fake()->randomFloat(2, 0, 5000),
                'descuentos_total' => fake()->randomFloat(2, 0, 3000),
                'valor_total' => fake()->randomFloat(2, 5000, 35000),
                'metodo_pago' => fake()->randomElement(['efectivo', 'tarjeta_debito', 'tarjeta_credito', 'transferencia']),
                'estado_pago' => fake()->randomElement(['pendiente', 'pagado']),
                'estado' => fake()->randomElement(['pendiente', 'confirmado', 'en_curso', 'completado', 'cancelado']),
                'fecha_solicitud' => $fechaInicio->copy()->subMinutes(rand(5, 30)),
                'fecha_hora_inicio' => $fechaInicio,
                'fecha_hora_fin' => fake()->boolean(80) ? $fechaFin : null,
                'tipo_servicio' => fake()->randomElement(['urbano', 'intermunicipal', 'aeropuerto', 'especial']),
                'numero_pasajeros' => rand(1, 4),
                'calificacion_cliente' => rand(0, 1) ? rand(3, 5) : null,
                'comentario_cliente' => rand(0, 1) ? fake('es_ES')->sentence() : null,
                'calificacion_conductor' => rand(0, 1) ? rand(3, 5) : null,
                'comentario_conductor' => rand(0, 1) ? fake('es_ES')->sentence() : null,
                'codigo_reserva' => 'RES' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'plataforma_origen' => fake()->randomElement(['web', 'mobile', 'telefono']),
                'observaciones' => rand(0, 1) ? fake('es_ES')->sentence() : null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach (array_chunk($viajes, 25) as $chunk) {
            Viaje::insert($chunk);
        }
        
        $this->command->info('Se crearon 50 viajes con datos completos');
    }
}