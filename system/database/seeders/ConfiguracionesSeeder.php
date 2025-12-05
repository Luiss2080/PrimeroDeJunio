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
            // Información de la Empresa (8 registros)
            ['clave' => 'empresa_nombre', 'valor' => 'PRIMERO DE JUNIO - Asociación de Mototaxis', 'descripcion' => 'Nombre oficial de la empresa', 'tipo' => 'string', 'categoria' => 'empresa', 'es_publica' => true],
            ['clave' => 'empresa_nit', 'valor' => '900123456-7', 'descripcion' => 'NIT de la empresa', 'tipo' => 'string', 'categoria' => 'empresa', 'es_publica' => true],
            ['clave' => 'empresa_telefono', 'valor' => '601-2345678', 'descripcion' => 'Teléfono principal de la empresa', 'tipo' => 'string', 'categoria' => 'empresa', 'es_publica' => true],
            ['clave' => 'empresa_direccion', 'valor' => 'Calle 123 #45-67, Bogotá D.C.', 'descripcion' => 'Dirección principal de la empresa', 'tipo' => 'string', 'categoria' => 'empresa', 'es_publica' => true],
            ['clave' => 'empresa_email', 'valor' => 'info@primerodejunio.com', 'descripcion' => 'Email principal de la empresa', 'tipo' => 'string', 'categoria' => 'empresa', 'es_publica' => true],
            ['clave' => 'empresa_representante', 'valor' => 'Carlos Alberto Rodriguez', 'descripcion' => 'Representante legal de la empresa', 'tipo' => 'string', 'categoria' => 'empresa', 'es_publica' => false],
            ['clave' => 'empresa_logo', 'valor' => '/images/logo.png', 'descripcion' => 'Ruta del logo de la empresa', 'tipo' => 'file', 'categoria' => 'empresa', 'es_publica' => true],
            ['clave' => 'empresa_slogan', 'valor' => 'Tu transporte seguro y confiable', 'descripcion' => 'Slogan de la empresa', 'tipo' => 'string', 'categoria' => 'empresa', 'es_publica' => true],

            // Configuraciones del Sistema (6 registros)
            ['clave' => 'sistema_nombre', 'valor' => 'Sistema de Gestión PRIMERO DE JUNIO', 'descripcion' => 'Nombre del sistema', 'tipo' => 'string', 'categoria' => 'sistema', 'es_publica' => true],
            ['clave' => 'sistema_version', 'valor' => '1.0.0', 'descripcion' => 'Versión actual del sistema', 'tipo' => 'string', 'categoria' => 'sistema', 'es_publica' => false],
            ['clave' => 'zona_horaria', 'valor' => 'America/Bogota', 'descripcion' => 'Zona horaria del sistema', 'tipo' => 'string', 'categoria' => 'sistema', 'es_publica' => false],
            ['clave' => 'moneda', 'valor' => 'COP', 'descripcion' => 'Moneda utilizada en el sistema', 'tipo' => 'string', 'categoria' => 'sistema', 'es_publica' => true],
            ['clave' => 'idioma_default', 'valor' => 'es', 'descripcion' => 'Idioma por defecto del sistema', 'tipo' => 'string', 'categoria' => 'sistema', 'es_publica' => true],
            ['clave' => 'tema_default', 'valor' => 'light', 'descripcion' => 'Tema visual por defecto', 'tipo' => 'string', 'categoria' => 'sistema', 'es_publica' => true],

            // Configuraciones de Tarifas (8 registros)
            ['clave' => 'tarifa_minima_global', 'valor' => '4500', 'descripcion' => 'Tarifa mínima por viaje en pesos', 'tipo' => 'number', 'categoria' => 'tarifas', 'es_publica' => true],
            ['clave' => 'tarifa_por_km', 'valor' => '1800', 'descripcion' => 'Tarifa por kilómetro recorrido', 'tipo' => 'number', 'categoria' => 'tarifas', 'es_publica' => true],
            ['clave' => 'tarifa_diaria_conductor', 'valor' => '15000', 'descripcion' => 'Tarifa diaria que paga cada conductor', 'tipo' => 'number', 'categoria' => 'tarifas', 'es_publica' => false],
            ['clave' => 'recargo_nocturno_porcentaje', 'valor' => '20', 'descripcion' => 'Porcentaje de recargo nocturno', 'tipo' => 'number', 'categoria' => 'tarifas', 'es_publica' => true],
            ['clave' => 'recargo_festivo_porcentaje', 'valor' => '30', 'descripcion' => 'Porcentaje de recargo en días festivos', 'tipo' => 'number', 'categoria' => 'tarifas', 'es_publica' => true],
            ['clave' => 'tarifa_por_minuto', 'valor' => '300', 'descripcion' => 'Tarifa por minuto de espera', 'tipo' => 'number', 'categoria' => 'tarifas', 'es_publica' => true],
            ['clave' => 'porcentaje_comision_conductor', 'valor' => '70', 'descripcion' => 'Porcentaje de comisión para conductores', 'tipo' => 'number', 'categoria' => 'tarifas', 'es_publica' => false],
            ['clave' => 'descuento_maximo_porcentaje', 'valor' => '15', 'descripcion' => 'Descuento máximo aplicable por viaje', 'tipo' => 'number', 'categoria' => 'tarifas', 'es_publica' => false],

            // Configuraciones de Seguridad (5 registros)
            ['clave' => 'session_timeout_minutos', 'valor' => '30', 'descripcion' => 'Tiempo de expiración de sesión en minutos', 'tipo' => 'number', 'categoria' => 'seguridad', 'es_publica' => false],
            ['clave' => 'max_intentos_login', 'valor' => '5', 'descripcion' => 'Máximo número de intentos de login fallidos', 'tipo' => 'number', 'categoria' => 'seguridad', 'es_publica' => false],
            ['clave' => 'bloqueo_temporal_minutos', 'valor' => '15', 'descripcion' => 'Minutos de bloqueo temporal tras fallos de login', 'tipo' => 'number', 'categoria' => 'seguridad', 'es_publica' => false],
            ['clave' => 'require_https', 'valor' => 'true', 'descripcion' => 'Requerir conexiones HTTPS', 'tipo' => 'boolean', 'categoria' => 'seguridad', 'es_publica' => false],
            ['clave' => 'password_min_length', 'valor' => '8', 'descripcion' => 'Longitud mínima de contraseñas', 'tipo' => 'number', 'categoria' => 'seguridad', 'es_publica' => false],

            // Configuraciones de Notificaciones (6 registros)
            ['clave' => 'email_notificaciones_activo', 'valor' => 'true', 'descripcion' => 'Activar notificaciones por email', 'tipo' => 'boolean', 'categoria' => 'notificaciones', 'es_publica' => false],
            ['clave' => 'sms_notificaciones_activo', 'valor' => 'false', 'descripcion' => 'Activar notificaciones por SMS', 'tipo' => 'boolean', 'categoria' => 'notificaciones', 'es_publica' => false],
            ['clave' => 'whatsapp_notificaciones_activo', 'valor' => 'true', 'descripcion' => 'Activar notificaciones por WhatsApp', 'tipo' => 'boolean', 'categoria' => 'notificaciones', 'es_publica' => false],
            ['clave' => 'notificar_viaje_completado', 'valor' => 'true', 'descripcion' => 'Notificar cuando se completa un viaje', 'tipo' => 'boolean', 'categoria' => 'notificaciones', 'es_publica' => false],
            ['clave' => 'notificar_pago_realizado', 'valor' => 'true', 'descripcion' => 'Notificar cuando se realiza un pago', 'tipo' => 'boolean', 'categoria' => 'notificaciones', 'es_publica' => false],
            ['clave' => 'recordatorio_documentos_dias', 'valor' => '30', 'descripcion' => 'Días antes del vencimiento para recordatorio', 'tipo' => 'number', 'categoria' => 'notificaciones', 'es_publica' => false],

            // Configuraciones de Pagos (4 registros)
            ['clave' => 'metodos_pago_activos', 'valor' => '["efectivo","transferencia","tarjeta_debito"]', 'descripcion' => 'Métodos de pago disponibles', 'tipo' => 'json', 'categoria' => 'pagos', 'es_publica' => true],
            ['clave' => 'comision_tarjeta_porcentaje', 'valor' => '3.5', 'descripcion' => 'Comisión por pago con tarjeta', 'tipo' => 'number', 'categoria' => 'pagos', 'es_publica' => false],
            ['clave' => 'limite_credito_default', 'valor' => '100000', 'descripcion' => 'Límite de crédito por defecto para clientes', 'tipo' => 'number', 'categoria' => 'pagos', 'es_publica' => false],
            ['clave' => 'dias_vencimiento_factura', 'valor' => '30', 'descripcion' => 'Días para vencimiento de facturas', 'tipo' => 'number', 'categoria' => 'pagos', 'es_publica' => false],

            // Configuraciones de App Móvil (3 registros)
            ['clave' => 'app_version_minima', 'valor' => '1.0.0', 'descripcion' => 'Versión mínima requerida de la app', 'tipo' => 'string', 'categoria' => 'app', 'es_publica' => true],
            ['clave' => 'app_mantenimiento_activo', 'valor' => 'false', 'descripcion' => 'Modo mantenimiento de la app', 'tipo' => 'boolean', 'categoria' => 'app', 'es_publica' => true],
            ['clave' => 'app_mensaje_mantenimiento', 'valor' => 'Sistema en mantenimiento. Volveremos pronto.', 'descripcion' => 'Mensaje durante mantenimiento', 'tipo' => 'string', 'categoria' => 'app', 'es_publica' => true]
        ];

        foreach ($configuraciones as $config) {
            \App\Models\Configuracion::updateOrCreate(
                ['clave' => $config['clave']],
                array_merge($config, [
                    'es_editable' => $config['es_editable'] ?? true,
                    'actualizado_por' => 1, // Admin user
                ])
            );
        }

        foreach ($configuraciones as &$config) {
            $config['created_at'] = now();
            $config['updated_at'] = now();
        }

        DB::table('configuraciones')->insert($configuraciones);
    }
}
