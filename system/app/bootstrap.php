<?php

/**
 * Bootstrap del Sistema PRIMERO DE JUNIO
 * Inicialización y autoload de clases
 */

// Definir constantes del sistema
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('CONFIG_PATH', ROOT_PATH . '/config');
define('DATABASE_PATH', ROOT_PATH . '/database');
define('PUBLIC_PATH', dirname(ROOT_PATH) . '/public');
define('VIEWS_PATH', APP_PATH . '/views');
define('CONTROLLERS_PATH', APP_PATH . '/controllers');
define('MODELS_PATH', APP_PATH . '/models');
define('LOGS_PATH', ROOT_PATH . '/logs');

// Cargar configuración temprana para SYSTEM_URL
$config = require_once CONFIG_PATH . '/config.php';
define('SYSTEM_URL', rtrim($config['app']['url'], '/') . '/system/public/');

// Cargar configuración
// Ya cargada arriba para SYSTEM_URL

// Configurar zona horaria
date_default_timezone_set($config['app']['timezone']);

// Configurar charset
ini_set('default_charset', $config['app']['charset']);

// Configurar manejo de errores
if ($config['app']['debug']) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Configurar sesiones: sólo ajustar settings si NO hay una sesión activa
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.name', $config['session']['name']);
    ini_set('session.cookie_lifetime', $config['session']['lifetime']);
    ini_set('session.cookie_path', $config['session']['path']);
    ini_set('session.cookie_httponly', $config['session']['httponly']);
    ini_set('session.cookie_secure', $config['session']['secure']);

    // Iniciar la sesión ahora que la configuración se aplicó
    session_start();
} else {
    // Si la sesión ya está activa no intentamos cambiar ini settings relacionados
    // para evitar warnings: ini_set() cannot change session ini settings when a
    // session is active.
    if (function_exists('logWarning')) {
        logWarning('Session already active: session ini settings skipped');
    }
}

// Autoloader para clases
spl_autoload_register(function ($className) {
    $paths = [
        APP_PATH . '/core/',
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
        APP_PATH . '/helpers/'
    ];

    foreach ($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Cargar helpers globales
require_once APP_PATH . '/helpers/funciones.php';

// Función para manejar errores no capturados
function handleException($exception)
{
    global $config;

    if ($config['app']['debug']) {
        echo "<h1>Error no capturado</h1>";
        echo "<p><strong>Mensaje:</strong> " . $exception->getMessage() . "</p>";
        echo "<p><strong>Archivo:</strong> " . $exception->getFile() . "</p>";
        echo "<p><strong>Línea:</strong> " . $exception->getLine() . "</p>";
        echo "<pre>" . $exception->getTraceAsString() . "</pre>";
    } else {
        echo "<h1>Error del servidor</h1>";
        echo "<p>Ha ocurrido un error interno. Por favor, contacta al administrador.</p>";
    }

    // Registrar error
    logSystemError($exception);
}

// Función para registrar errores
function logSystemError($exception)
{
    $logFile = LOGS_PATH . '/error.log';

    // Crear directorio de logs si no existe
    if (!is_dir(LOGS_PATH)) {
        mkdir(LOGS_PATH, 0755, true);
    }

    $logMessage = sprintf(
        "[%s] %s in %s:%d\nStack trace:\n%s\n\n",
        date('Y-m-d H:i:s'),
        $exception->getMessage(),
        $exception->getFile(),
        $exception->getLine(),
        $exception->getTraceAsString()
    );

    file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
}

// Establecer manejador de excepciones
set_exception_handler('handleException');

// Función helper para logging
function writeLog($level, $message, $context = [])
{
    $logFile = LOGS_PATH . '/app.log';

    if (!is_dir(LOGS_PATH)) {
        mkdir(LOGS_PATH, 0755, true);
    }

    $logEntry = sprintf(
        "[%s] %s: %s %s\n",
        date('Y-m-d H:i:s'),
        strtoupper($level),
        $message,
        !empty($context) ? json_encode($context) : ''
    );

    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}

// Funciones helper para logging por nivel
function logInfo($message, $context = [])
{
    writeLog('info', $message, $context);
}

function logError($message, $context = [])
{
    writeLog('error', $message, $context);
}

function logWarning($message, $context = [])
{
    writeLog('warning', $message, $context);
}

function logDebug($message, $context = [])
{
    global $config;
    if ($config['app']['debug']) {
        writeLog('debug', $message, $context);
    }
}

// Nota: la inicialización de sesión se maneja más arriba cuando se configuran
// las opciones de sesión. No es necesario volver a llamar a session_start() aquí.

// Función helper para obtener configuración
function config($key, $default = null)
{
    global $config;

    $keys = explode('.', $key);
    $value = $config;

    foreach ($keys as $k) {
        if (!isset($value[$k])) {
            return $default;
        }
        $value = $value[$k];
    }

    return $value;
}

// Función helper para URLs
function url($path = '')
{
    $baseUrl = rtrim(config('app.url'), '/');
    $path = ltrim($path, '/');
    return $baseUrl . '/' . $path;
}

// Función helper para assets
function asset($path)
{
    return url('assets/' . ltrim($path, '/'));
}

// Función helper para redirección
function redirect($url, $statusCode = 302)
{
    header("Location: $url", true, $statusCode);
    exit;
}

// Función helper para escape HTML
function e($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Función helper para formatear fecha
function formatDate($date, $format = 'Y-m-d H:i:s')
{
    if (empty($date)) return '';

    $dateObj = new DateTime($date);
    return $dateObj->format($format);
}

// Función helper para formatear moneda
function formatMoney($amount, $currency = 'COP')
{
    return number_format($amount, 0, ',', '.') . ' ' . $currency;
}

// Función helper para validar email
function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Función helper para generar token aleatorio
function generateToken($length = 32)
{
    return bin2hex(random_bytes($length));
}

// Inicialización completada
logInfo('Sistema inicializado correctamente');
