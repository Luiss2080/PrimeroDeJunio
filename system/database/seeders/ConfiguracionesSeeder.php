<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfiguracionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $configuraciones = [
            // Información de la Empresa/Asociación
            ['clave' => 'empresa_nombre', 'valor' => 'PRIMERO DE JUNIO - Asociación de Mototaxis', 'descripcion' => 'Nombre oficial de la empresa', 'tipo' => 'string', 'categoria' => 'empresa'],
            ['clave' => 'empresa_nit', 'valor' => '900123456-7', 'descripcion' => 'NIT de la empresa', 'tipo' => 'string', 'categoria' => 'empresa'],
            ['clave' => 'empresa_telefono', 'valor' => '601-2345678', 'descripcion' => 'Teléfono principal de la empresa', 'tipo' => 'string', 'categoria' => 'empresa'],
            ['clave' => 'empresa_direccion', 'valor' => 'Calle 123 #45-67, Bogotá D.C.', 'descripcion' => 'Dirección principal de la empresa', 'tipo' => 'string', 'categoria' => 'empresa'],
            ['clave' => 'empresa_email', 'valor' => 'info@primerodejunio.com', 'descripcion' => 'Email principal de la empresa', 'tipo' => 'string', 'categoria' => 'empresa'],
            ['clave' => 'empresa_representante', 'valor' => 'Carlos Alberto Rodriguez', 'descripcion' => 'Representante legal de la empresa', 'tipo' => 'string', 'categoria' => 'empresa'],
            
            // Configuraciones del Sistema
            ['clave' => 'sistema_nombre', 'valor' => 'Sistema de Gestión PRIMERO DE JUNIO', 'descripcion' => 'Nombre del sistema', 'tipo' => 'string', 'categoria' => 'sistema'],
            ['clave' => 'sistema_version', 'valor' => '1.0.0', 'descripcion' => 'Versión actual del sistema', 'tipo' => 'string', 'categoria' => 'sistema'],
            ['clave' => 'zona_horaria', 'valor' => 'America/Bogota', 'descripcion' => 'Zona horaria del sistema', 'tipo' => 'string', 'categoria' => 'sistema'],
            ['clave' => 'moneda', 'valor' => 'COP', 'descripcion' => 'Moneda utilizada en el sistema', 'tipo' => 'string', 'categoria' => 'sistema'],
            
            // Configuraciones de Tarifas
            ['clave' => 'tarifa_minima_global', 'valor' => '4500', 'descripcion' => 'Tarifa mínima por viaje en pesos', 'tipo' => 'number', 'categoria' => 'tarifas'],
            ['clave' => 'tarifa_por_km', 'valor' => '1800', 'descripcion' => 'Tarifa por kilómetro recorrido', 'tipo' => 'number', 'categoria' => 'tarifas'],
            ['clave' => 'tarifa_diaria_conductor', 'valor' => '15000', 'descripcion' => 'Tarifa diaria que paga cada conductor', 'tipo' => 'number', 'categoria' => 'tarifas'],
            ['clave' => 'recargo_nocturno_porcentaje', 'valor' => '20', 'descripcion' => 'Porcentaje de recargo nocturno', 'tipo' => 'number', 'categoria' => 'tarifas'],
            
            // Configuraciones de Operación
            ['clave' => 'max_viajes_dia_conductor', 'valor' => '15', 'descripcion' => 'Máximo número de viajes por día por conductor', 'tipo' => 'number', 'categoria' => 'operacion'],
            ['clave' => 'horario_operacion_inicio', 'valor' => '05:00', 'descripcion' => 'Hora de inicio de operaciones diarias', 'tipo' => 'string', 'categoria' => 'operacion'],
            ['clave' => 'horario_operacion_fin', 'valor' => '23:00', 'descripcion' => 'Hora de fin de operaciones diarias', 'tipo' => 'string', 'categoria' => 'operacion'],
            
            // Configuraciones de Seguridad
            ['clave' => 'session_timeout_minutos', 'valor' => '30', 'descripcion' => 'Tiempo de expiración de sesión en minutos', 'tipo' => 'number', 'categoria' => 'seguridad'],
            ['clave' => 'max_intentos_login', 'valor' => '5', 'descripcion' => 'Máximo número de intentos de login fallidos', 'tipo' => 'number', 'categoria' => 'seguridad'],
            
            // Configuraciones de Conductores
            ['clave' => 'edad_minima_conductor', 'valor' => '21', 'descripcion' => 'Edad mínima para ser conductor', 'tipo' => 'number', 'categoria' => 'conductores'],
            ['clave' => 'experiencia_minima_anos', 'valor' => '2', 'descripcion' => 'Años mínimos de experiencia requeridos', 'tipo' => 'number', 'categoria' => 'conductores'],
            
            // Configuraciones de Dashboard
            ['clave' => 'refresh_dashboard_segundos', 'valor' => '30', 'descripcion' => 'Frecuencia de actualización del dashboard', 'tipo' => 'number', 'categoria' => 'dashboard'],
        ];
        
        foreach ($configuraciones as &$config) {
            $config['created_at'] = now();
            $config['updated_at'] = now();
        }
        
        DB::table('configuraciones')->insert($configuraciones);
    }
}
