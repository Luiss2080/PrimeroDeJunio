<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $logs = [];
        
        // Generar logs del sistema de los últimos 30 días
        for ($i = 1; $i <= 100; $i++) {
            $fechaLog = now()->subDays(rand(0, 30))->subHours(rand(0, 23))->subMinutes(rand(0, 59));
            
            $logs[] = [
                'usuario_id' => rand(1, 8),
                'accion' => $this->getAccionAleatoria(),
                'tabla_afectada' => $this->getTablaAleatoria(),
                'registro_id' => rand(1, 50),
                'datos_anteriores' => $this->getDatosAnteriores(),
                'datos_nuevos' => $this->getDatosNuevos(),
                'ip' => $this->getIpAleatoria(),
                'user_agent' => $this->getUserAgentAleatorio(),
                'created_at' => $fechaLog,
                'updated_at' => $fechaLog
            ];
        }
        
        DB::table('logs')->insert($logs);
    }
    
    private function getAccionAleatoria()
    {
        $acciones = [
            'CREATE',
            'UPDATE', 
            'DELETE',
            'LOGIN',
            'LOGOUT',
            'VIEW',
            'UPDATE',
            'CREATE'
        ];
        
        return $acciones[array_rand($acciones)];
    }
    
    private function getTablaAleatoria()
    {
        $tablas = [
            'users',
            'conductores',
            'vehiculos',
            'viajes',
            'clientes',
            'asignaciones_vehiculo',
            'mantenimientos',
            'pagos_tarifa_diaria'
        ];
        
        return $tablas[array_rand($tablas)];
    }
    
    private function getDatosAnteriores()
    {
        $datos = [
            '{"estado": "inactivo", "telefono": "3001234567"}',
            '{"nombre": "Juan", "email": "juan@email.com"}',
            '{"placa": "ABC123", "estado": "mantenimiento"}',
            null,
            null
        ];
        
        return $datos[array_rand($datos)];
    }
    
    private function getDatosNuevos()
    {
        $datos = [
            '{"estado": "activo", "telefono": "3009876543"}',
            '{"nombre": "Juan Carlos", "email": "juancarlos@email.com"}',
            '{"placa": "ABC123", "estado": "activo"}',
            '{"login": true, "timestamp": "2025-11-29 10:30:00"}',
            '{"registro_creado": true}'
        ];
        
        return $datos[array_rand($datos)];
    }
    
    private function getIpAleatoria()
    {
        $ips = [
            '192.168.1.100',
            '192.168.1.101',
            '192.168.1.102',
            '10.0.0.50',
            '10.0.0.51',
            '127.0.0.1'
        ];
        
        return $ips[array_rand($ips)];
    }
    
    private function getUserAgentAleatorio()
    {
        $userAgents = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:91.0) Gecko/20100101',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36',
            'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36',
            'PostmanRuntime/7.28.4'
        ];
        
        return $userAgents[array_rand($userAgents)];
    }
}