<?php

/**
 * Configuración del Sistema PRIMERO DE JUNIO
 */

return [
    // Configuración de la aplicación
    'app' => [
        'name' => 'PRIMERO DE JUNIO',
        'version' => '1.0.0',
        'environment' => 'development', // development, staging, production
        'debug' => true,
        'timezone' => 'America/Bogota',
        'url' => 'http://localhost/PrimeroDeJunio',
        'charset' => 'utf-8'
    ],

    // Configuración de base de datos
    'database' => [
        'host' => 'localhost',
        'name' => 'primero_de_junio',
        'user' => 'root',
        'password' => '',
        'port' => 3306,
        'charset' => 'utf8mb4'
    ],

    // Configuración de sesiones
    'session' => [
        'name' => 'PRIMERO_DE_JUNIO_SESSION',
        'lifetime' => 7200, // 2 horas en segundos
        'path' => '/',
        'domain' => '',
        'secure' => false,
        'httponly' => true
    ],

    // Configuración de logging
    'logging' => [
        'enabled' => true,
        'path' => __DIR__ . '/../logs',
        'level' => 'debug', // debug, info, warning, error
        'max_size' => '10MB',
        'max_files' => 5
    ],

    // Configuración de archivos
    'files' => [
        'uploads_path' => __DIR__ . '/../../public/uploads',
        'max_size' => '10MB',
        'allowed_types' => ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx'],
        'avatar_path' => __DIR__ . '/../../public/uploads/avatars',
        'documents_path' => __DIR__ . '/../../public/uploads/documents'
    ],

    // Configuración de email
    'mail' => [
        'driver' => 'smtp', // smtp, mail, sendmail
        'host' => 'smtp.gmail.com',
        'port' => 587,
        'username' => '',
        'password' => '',
        'encryption' => 'tls', // tls, ssl
        'from' => [
            'address' => 'noreply@primerodejunio.com',
            'name' => 'Sistema PRIMERO DE JUNIO'
        ]
    ],

    // Configuración de paginación
    'pagination' => [
        'per_page' => 15,
        'max_per_page' => 100
    ],

    // Configuración de seguridad
    'security' => [
        'password_min_length' => 6,
        'password_require_special' => false,
        'max_login_attempts' => 5,
        'lockout_time' => 900, // 15 minutos
        'csrf_protection' => true
    ],

    // Configuración de la asociación
    'asociacion' => [
        'nombre' => 'ASOCIACIÓN DE MOTOTAXISTAS PRIMERO DE JUNIO',
        'nit' => '123456789-0',
        'direccion' => 'Calle 123 #45-67',
        'telefono' => '123-456-7890',
        'email' => 'info@primerodejunio.com',
        'ciudad' => 'Ciudad, País'
    ],

    // Configuración de tarifas
    'tarifas' => [
        'tarifa_base' => 2500,
        'tarifa_por_km' => 500,
        'recargo_nocturno_porcentaje' => 20, // 20% después de las 10 PM
        'recargo_festivo_porcentaje' => 15, // 15% en días festivos
        'recargo_aeropuerto' => 5000,
        'descuento_maximo_porcentaje' => 20
    ],

    // Configuración de turnos
    'turnos' => [
        'diurno' => [
            'inicio' => '06:00',
            'fin' => '18:00'
        ],
        'nocturno' => [
            'inicio' => '18:00',
            'fin' => '06:00'
        ]
    ],

    // Configuración de reportes
    'reportes' => [
        'formatos' => ['pdf', 'excel', 'csv'],
        'cache_tiempo' => 3600, // 1 hora
        'logo_path' => __DIR__ . '/../../public/assets/images/logo.png'
    ],

    // Configuración de notificaciones
    'notifications' => [
        'licencias_vencimiento_dias' => 30,
        'soat_vencimiento_dias' => 30,
        'tecnicomecanica_vencimiento_dias' => 30,
        'mantenimiento_recordatorio_dias' => 7
    ],

    // Configuración de API
    'api' => [
        'rate_limit' => 100, // requests per minute
        'version' => 'v1',
        'cors_enabled' => true,
        'cors_origins' => ['*']
    ],

    // Rutas del sistema
    'paths' => [
        'root' => dirname(__DIR__),
        'app' => dirname(__DIR__) . '/app',
        'config' => dirname(__DIR__) . '/config',
        'database' => dirname(__DIR__) . '/database',
        'public' => dirname(__DIR__) . '/../public',
        'views' => dirname(__DIR__) . '/app/views',
        'controllers' => dirname(__DIR__) . '/app/controllers',
        'models' => dirname(__DIR__) . '/app/models',
        'logs' => dirname(__DIR__) . '/logs'
    ]
];