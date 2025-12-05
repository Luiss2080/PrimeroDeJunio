<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Log;
use App\Models\User;

class LogsSeeder extends Seeder
{
    public function run()
    {
        // Obtener usuarios disponibles
        $usuarios = User::all();
        
        if ($usuarios->isEmpty()) {
            $this->command->warn('No hay usuarios disponibles. Ejecuta UsuariosSeeder primero.');
            return;
        }

        $this->command->info('Creando logs del sistema...');

        $logs = [];
        
        // Generar 50 logs variados
        for ($i = 0; $i < 50; $i++) {
            $usuario = $usuarios->random();
            $fechaLog = fake()->dateTimeBetween('-30 days', 'now');
            
            $logs[] = [
                'usuario_id' => $usuario->id,
                'usuario_nombre' => $usuario->name,
                'usuario_email' => $usuario->email,
                'tipo_accion' => fake()->randomElement(['crear', 'actualizar', 'eliminar', 'login', 'logout', 'crear_viaje', 'finalizar_viaje', 'pago_realizado']),
                'accion_detalle' => fake('es_CO')->sentence(),
                'nivel' => fake()->randomElement(['info', 'warning', 'error']),
                'tabla_afectada' => fake()->randomElement(['users', 'conductores', 'vehiculos', 'viajes', 'clientes', 'pagos_conductores']),
                'registro_id' => rand(1, 50),
                'registro_descripcion' => fake('es_CO')->words(3, true),
                'datos_anteriores' => json_encode(['campo' => 'valor_anterior']),
                'datos_nuevos' => json_encode(['campo' => 'valor_nuevo']),
                'ip_address' => fake()->ipv4(),
                'user_agent' => fake()->userAgent(),
                'modulo' => fake()->randomElement(['conductores', 'vehiculos', 'viajes', 'clientes', 'sistema']),
                'metodo_http' => fake()->randomElement(['GET', 'POST', 'PUT', 'DELETE']),
                'url' => fake()->url(),
                'duracion_ms' => rand(50, 2000),
                'requiere_atencion' => fake()->boolean(10), // 10% de probabilidad
                'created_at' => $fechaLog,
                'updated_at' => $fechaLog,
            ];
        }

        foreach (array_chunk($logs, 25) as $chunk) {
            Log::insert($chunk);
        }
        
        $this->command->info('Se crearon 50 logs del sistema');
    }
}