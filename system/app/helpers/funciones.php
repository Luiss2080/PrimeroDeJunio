<?php

/**
 * Funciones Helper del Sistema PRIMERO DE JUNIO
 */

/**
 * Validar número de teléfono colombiano
 */
function validarTelefono($telefono) {
    // Patrón para teléfonos colombianos (móvil y fijo)
    $patron = '/^(\+57|57)?[0-9]{10}$|^(\+57|57)?[0-9]{7}$/';
    return preg_match($patron, preg_replace('/[\s\-()]/', '', $telefono));
}

/**
 * Validar cédula colombiana
 */
function validarCedula($cedula) {
    $cedula = preg_replace('/[^0-9]/', '', $cedula);
    
    if (strlen($cedula) < 6 || strlen($cedula) > 10) {
        return false;
    }
    
    return is_numeric($cedula);
}

/**
 * Validar placa de vehículo colombiano
 */
function validarPlaca($placa) {
    // Patrón para placas colombianas: ABC123 o ABC12A
    $patron = '/^[A-Z]{3}[0-9]{2}[0-9A-Z]$/';
    return preg_match($patron, strtoupper(str_replace(' ', '', $placa)));
}

/**
 * Calcular edad a partir de fecha de nacimiento
 */
function calcularEdad($fechaNacimiento) {
    if (empty($fechaNacimiento)) return 0;
    
    $nacimiento = new DateTime($fechaNacimiento);
    $hoy = new DateTime();
    return $hoy->diff($nacimiento)->y;
}

/**
 * Calcular distancia entre dos puntos (Haversine formula)
 */
function calcularDistancia($lat1, $lon1, $lat2, $lon2, $unidad = 'K') {
    $radioTierra = ($unidad == 'K') ? 6371 : 3959; // Kilómetros o millas
    
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);
    
    $a = sin($dLat / 2) * sin($dLat / 2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLon / 2) * sin($dLon / 2);
    
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distancia = $radioTierra * $c;
    
    return round($distancia, 2);
}

/**
 * Calcular tarifa de viaje
 */
function calcularTarifa($distanciaKm, $tipoTarifa = 'normal', $esNocturno = false, $esFestivo = false) {
    $config = config('tarifas');
    
    $tarifaBase = $config['tarifa_base'];
    $tarifaPorKm = $config['tarifa_por_km'];
    
    $valor = $tarifaBase + ($distanciaKm * $tarifaPorKm);
    
    // Aplicar recargos
    if ($esNocturno) {
        $valor += $valor * ($config['recargo_nocturno_porcentaje'] / 100);
    }
    
    if ($esFestivo) {
        $valor += $valor * ($config['recargo_festivo_porcentaje'] / 100);
    }
    
    return round($valor, 0);
}

/**
 * Verificar si una fecha es festivo en Colombia
 */
function esFestivo($fecha) {
    // Lista básica de festivos fijos en Colombia
    $festivosFijos = [
        '01-01', // Año Nuevo
        '05-01', // Día del Trabajo
        '07-20', // Día de la Independencia
        '08-07', // Batalla de Boyacá
        '12-08', // Inmaculada Concepción
        '12-25'  // Navidad
    ];
    
    $fechaFormateada = date('m-d', strtotime($fecha));
    return in_array($fechaFormateada, $festivosFijos);
}

/**
 * Verificar si es horario nocturno
 */
function esHorarioNocturno($hora = null) {
    if ($hora === null) {
        $hora = date('H:i:s');
    }
    
    $horaActual = new DateTime($hora);
    $inicioNocturno = new DateTime('22:00:00');
    $finNocturno = new DateTime('06:00:00');
    
    return $horaActual >= $inicioNocturno || $horaActual <= $finNocturno;
}

/**
 * Generar nombre único para archivo
 */
function generarNombreArchivo($nombreOriginal, $prefijo = '') {
    $extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
    $nombre = pathinfo($nombreOriginal, PATHINFO_FILENAME);
    
    $nombreLimpio = preg_replace('/[^A-Za-z0-9\-_]/', '', $nombre);
    $timestamp = time();
    $random = substr(md5(uniqid()), 0, 8);
    
    return $prefijo . $nombreLimpio . '_' . $timestamp . '_' . $random . '.' . $extension;
}

/**
 * Subir archivo con validaciones
 */
function subirArchivo($archivo, $directorio, $tiposPermitidos = null) {
    if ($tiposPermitidos === null) {
        $tiposPermitidos = config('files.allowed_types');
    }
    
    $nombreOriginal = $archivo['name'];
    $temporal = $archivo['tmp_name'];
    $tamano = $archivo['size'];
    $error = $archivo['error'];
    
    // Verificar errores
    if ($error !== UPLOAD_ERR_OK) {
        throw new Exception('Error al subir archivo: ' . $error);
    }
    
    // Verificar tamaño
    $tamanoMaximo = convertirTamanoABytes(config('files.max_size'));
    if ($tamano > $tamanoMaximo) {
        throw new Exception('Archivo demasiado grande');
    }
    
    // Verificar tipo
    $extension = strtolower(pathinfo($nombreOriginal, PATHINFO_EXTENSION));
    if (!in_array($extension, $tiposPermitidos)) {
        throw new Exception('Tipo de archivo no permitido');
    }
    
    // Crear directorio si no existe
    if (!is_dir($directorio)) {
        mkdir($directorio, 0755, true);
    }
    
    // Generar nombre único
    $nombreFinal = generarNombreArchivo($nombreOriginal);
    $rutaCompleta = $directorio . '/' . $nombreFinal;
    
    // Mover archivo
    if (move_uploaded_file($temporal, $rutaCompleta)) {
        return $nombreFinal;
    }
    
    throw new Exception('Error al guardar archivo');
}

/**
 * Convertir tamaño legible a bytes
 */
function convertirTamanoABytes($tamano) {
    $unidad = substr($tamano, -2);
    $numero = (int) substr($tamano, 0, -2);
    
    switch (strtoupper($unidad)) {
        case 'KB':
            return $numero * 1024;
        case 'MB':
            return $numero * 1024 * 1024;
        case 'GB':
            return $numero * 1024 * 1024 * 1024;
        default:
            return $numero;
    }
}

/**
 * Formatear tiempo transcurrido
 */
function tiempoTranscurrido($fecha) {
    $ahora = new DateTime();
    $tiempo = new DateTime($fecha);
    $diferencia = $ahora->diff($tiempo);
    
    if ($diferencia->days > 0) {
        return $diferencia->days . ' día' . ($diferencia->days > 1 ? 's' : '');
    } elseif ($diferencia->h > 0) {
        return $diferencia->h . ' hora' . ($diferencia->h > 1 ? 's' : '');
    } elseif ($diferencia->i > 0) {
        return $diferencia->i . ' minuto' . ($diferencia->i > 1 ? 's' : '');
    } else {
        return 'Hace un momento';
    }
}

/**
 * Limpiar texto para URL (slug)
 */
function crearSlug($texto) {
    $slug = strtolower(trim($texto));
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    return trim($slug, '-');
}

/**
 * Verificar si una cadena es JSON válido
 */
function esJsonValido($cadena) {
    json_decode($cadena);
    return json_last_error() === JSON_ERROR_NONE;
}

/**
 * Obtener IP del cliente
 */
function obtenerIpCliente() {
    $keys = ['HTTP_X_FORWARDED_FOR', 'HTTP_X_REAL_IP', 'HTTP_CLIENT_IP', 'REMOTE_ADDR'];
    
    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            $ips = explode(',', $_SERVER[$key]);
            $ip = trim($ips[0]);
            
            if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                return $ip;
            }
        }
    }
    
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

/**
 * Generar código de verificación numérico
 */
function generarCodigoVerificacion($longitud = 6) {
    $codigo = '';
    for ($i = 0; $i < $longitud; $i++) {
        $codigo .= random_int(0, 9);
    }
    return $codigo;
}

/**
 * Enviar notificación (placeholder para implementar)
 */
function enviarNotificacion($tipo, $destinatario, $mensaje, $datos = []) {
    // Implementar según el tipo: email, sms, push, etc.
    logInfo("Notificación {$tipo}: {$mensaje}", ['destinatario' => $destinatario, 'datos' => $datos]);
}

/**
 * Obtener configuración regional (Colombia)
 */
function obtenerConfiguracionRegional() {
    return [
        'moneda' => 'COP',
        'simbolo_moneda' => '$',
        'separador_miles' => '.',
        'separador_decimal' => ',',
        'formato_fecha' => 'd/m/Y',
        'formato_fecha_hora' => 'd/m/Y H:i',
        'zona_horaria' => 'America/Bogota'
    ];
}