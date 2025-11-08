<?php

/**
 * Modelo Configuracion - Sistema PRIMERO DE JUNIO
 */
class Configuracion extends Model
{
    protected $table = 'configuraciones';
    protected $fillable = [
        'clave',
        'valor',
        'tipo',
        'descripcion',
        'categoria'
    ];

    public function obtener($clave, $valorPorDefecto = null)
    {
        $config = $this->db->fetch(
            "SELECT valor, tipo FROM configuraciones WHERE clave = ?",
            [$clave]
        );

        if (!$config) {
            return $valorPorDefecto;
        }

        return $this->convertirValor($config['valor'], $config['tipo']);
    }

    public function establecer($clave, $valor, $tipo = 'string', $descripcion = '', $categoria = 'general')
    {
        $existe = $this->db->fetch(
            "SELECT id FROM configuraciones WHERE clave = ?",
            [$clave]
        );

        $valorString = $this->convertirAString($valor, $tipo);

        if ($existe) {
            return $this->db->update('configuraciones', [
                'valor' => $valorString,
                'tipo' => $tipo,
                'descripcion' => $descripcion,
                'categoria' => $categoria,
                'updated_at' => date('Y-m-d H:i:s')
            ], ['id' => $existe['id']]);
        } else {
            return $this->create([
                'clave' => $clave,
                'valor' => $valorString,
                'tipo' => $tipo,
                'descripcion' => $descripcion,
                'categoria' => $categoria
            ]);
        }
    }

    public function obtenerPorCategoria($categoria = null)
    {
        $sql = "SELECT * FROM configuraciones";
        $params = [];

        if ($categoria) {
            $sql .= " WHERE categoria = ?";
            $params[] = $categoria;
        }

        $sql .= " ORDER BY categoria, clave";

        $configuraciones = $this->db->fetchAll($sql, $params);
        
        foreach ($configuraciones as &$config) {
            $config['valor_procesado'] = $this->convertirValor($config['valor'], $config['tipo']);
        }

        return $configuraciones;
    }

    public function obtenerCategorias()
    {
        return $this->db->fetchAll(
            "SELECT DISTINCT categoria FROM configuraciones ORDER BY categoria"
        );
    }

    public function eliminar($clave)
    {
        return $this->db->delete('configuraciones', ['clave' => $clave]);
    }

    private function convertirValor($valor, $tipo)
    {
        switch ($tipo) {
            case 'boolean':
                return filter_var($valor, FILTER_VALIDATE_BOOLEAN);
            case 'integer':
                return (int) $valor;
            case 'float':
                return (float) $valor;
            case 'array':
                return json_decode($valor, true);
            case 'json':
                return json_decode($valor, true);
            case 'string':
            default:
                return $valor;
        }
    }

    private function convertirAString($valor, $tipo)
    {
        switch ($tipo) {
            case 'boolean':
                return $valor ? '1' : '0';
            case 'array':
            case 'json':
                return json_encode($valor);
            case 'integer':
            case 'float':
            case 'string':
            default:
                return (string) $valor;
        }
    }

    public function obtenerConfiguracionCompleta()
    {
        $configuraciones = $this->obtenerPorCategoria();
        $config = [];

        foreach ($configuraciones as $item) {
            $config[$item['clave']] = $this->convertirValor($item['valor'], $item['tipo']);
        }

        return $config;
    }

    public function crearConfiguracionesBasicas()
    {
        $configuracionesBasicas = [
            // Información de la Asociación
            ['clave' => 'asociacion_nombre', 'valor' => 'PRIMERO DE JUNIO', 'tipo' => 'string', 'descripcion' => 'Nombre de la asociación', 'categoria' => 'asociacion'],
            ['clave' => 'asociacion_nit', 'valor' => '900123456-7', 'tipo' => 'string', 'descripcion' => 'NIT de la asociación', 'categoria' => 'asociacion'],
            ['clave' => 'asociacion_direccion', 'valor' => 'Calle 123 #45-67, Bogotá', 'tipo' => 'string', 'descripcion' => 'Dirección de la asociación', 'categoria' => 'asociacion'],
            ['clave' => 'asociacion_telefono', 'valor' => '601-2345678', 'tipo' => 'string', 'descripcion' => 'Teléfono de la asociación', 'categoria' => 'asociacion'],
            ['clave' => 'asociacion_email', 'valor' => 'info@primerodejunio.com', 'tipo' => 'string', 'descripcion' => 'Email de la asociación', 'categoria' => 'asociacion'],
            ['clave' => 'asociacion_logo', 'valor' => 'logo.png', 'tipo' => 'string', 'descripcion' => 'Logo de la asociación', 'categoria' => 'asociacion'],
            
            // Sistema
            ['clave' => 'sistema_nombre', 'valor' => 'PRIMERO DE JUNIO - Sistema de Gestión', 'tipo' => 'string', 'descripcion' => 'Nombre del sistema', 'categoria' => 'sistema'],
            ['clave' => 'sistema_version', 'valor' => '1.0.0', 'tipo' => 'string', 'descripcion' => 'Versión del sistema', 'categoria' => 'sistema'],
            ['clave' => 'sistema_timezone', 'valor' => 'America/Bogota', 'tipo' => 'string', 'descripcion' => 'Zona horaria del sistema', 'categoria' => 'sistema'],
            ['clave' => 'sistema_mantenimiento', 'valor' => '0', 'tipo' => 'boolean', 'descripcion' => 'Modo mantenimiento activado', 'categoria' => 'sistema'],
            ['clave' => 'sistema_debug', 'valor' => '0', 'tipo' => 'boolean', 'descripcion' => 'Modo debug activado', 'categoria' => 'sistema'],
            
            // Configuración de Viajes
            ['clave' => 'viajes_tiempo_espera_maximo', 'valor' => '30', 'tipo' => 'integer', 'descripcion' => 'Tiempo máximo de espera en minutos', 'categoria' => 'viajes'],
            ['clave' => 'viajes_distancia_maxima', 'valor' => '50', 'tipo' => 'integer', 'descripcion' => 'Distancia máxima de viaje en kilómetros', 'categoria' => 'viajes'],
            ['clave' => 'viajes_tarifa_nocturna_inicio', 'valor' => '22:00', 'tipo' => 'string', 'descripcion' => 'Hora de inicio tarifa nocturna', 'categoria' => 'viajes'],
            ['clave' => 'viajes_tarifa_nocturna_fin', 'valor' => '06:00', 'tipo' => 'string', 'descripcion' => 'Hora fin tarifa nocturna', 'categoria' => 'viajes'],
            
            // Notificaciones
            ['clave' => 'notif_email_activo', 'valor' => '1', 'tipo' => 'boolean', 'descripcion' => 'Notificaciones por email activadas', 'categoria' => 'notificaciones'],
            ['clave' => 'notif_sms_activo', 'valor' => '0', 'tipo' => 'boolean', 'descripcion' => 'Notificaciones por SMS activadas', 'categoria' => 'notificaciones'],
            ['clave' => 'notif_admin_email', 'valor' => 'admin@primerodejunio.com', 'tipo' => 'string', 'descripcion' => 'Email del administrador para notificaciones', 'categoria' => 'notificaciones'],
            
            // Seguridad
            ['clave' => 'seguridad_intentos_login', 'valor' => '5', 'tipo' => 'integer', 'descripcion' => 'Intentos máximos de login', 'categoria' => 'seguridad'],
            ['clave' => 'seguridad_tiempo_bloqueo', 'valor' => '15', 'tipo' => 'integer', 'descripcion' => 'Tiempo de bloqueo en minutos', 'categoria' => 'seguridad'],
            ['clave' => 'seguridad_session_timeout', 'valor' => '3600', 'tipo' => 'integer', 'descripcion' => 'Tiempo de expiración de sesión en segundos', 'categoria' => 'seguridad'],
            
            // Reportes
            ['clave' => 'reportes_formato_defecto', 'valor' => 'PDF', 'tipo' => 'string', 'descripcion' => 'Formato por defecto de reportes', 'categoria' => 'reportes'],
            ['clave' => 'reportes_limite_registros', 'valor' => '1000', 'tipo' => 'integer', 'descripcion' => 'Límite de registros por reporte', 'categoria' => 'reportes'],
            
            // Backup
            ['clave' => 'backup_automatico', 'valor' => '1', 'tipo' => 'boolean', 'descripcion' => 'Backup automático activado', 'categoria' => 'backup'],
            ['clave' => 'backup_frecuencia', 'valor' => 'diario', 'tipo' => 'string', 'descripcion' => 'Frecuencia de backup automático', 'categoria' => 'backup'],
            ['clave' => 'backup_retener_dias', 'valor' => '30', 'tipo' => 'integer', 'descripcion' => 'Días a retener backups', 'categoria' => 'backup']
        ];

        foreach ($configuracionesBasicas as $config) {
            $existe = $this->db->fetch(
                "SELECT id FROM configuraciones WHERE clave = ?",
                [$config['clave']]
            );

            if (!$existe) {
                $this->create($config);
            }
        }

        return true;
    }

    public function actualizarMultiple($configuraciones)
    {
        try {
            foreach ($configuraciones as $clave => $valor) {
                $configExistente = $this->db->fetch(
                    "SELECT id, tipo FROM configuraciones WHERE clave = ?",
                    [$clave]
                );

                if ($configExistente) {
                    $valorString = $this->convertirAString($valor, $configExistente['tipo']);
                    $this->db->update('configuraciones', [
                        'valor' => $valorString,
                        'updated_at' => date('Y-m-d H:i:s')
                    ], ['id' => $configExistente['id']]);
                }
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function exportar($categoria = null)
    {
        $configuraciones = $this->obtenerPorCategoria($categoria);
        $export = [];

        foreach ($configuraciones as $config) {
            $export[] = [
                'clave' => $config['clave'],
                'valor' => $config['valor_procesado'],
                'tipo' => $config['tipo'],
                'descripcion' => $config['descripcion'],
                'categoria' => $config['categoria']
            ];
        }

        return $export;
    }

    public function importar($configuraciones)
    {
        $importadas = 0;
        
        foreach ($configuraciones as $config) {
            if (isset($config['clave']) && isset($config['valor'])) {
                $this->establecer(
                    $config['clave'],
                    $config['valor'],
                    $config['tipo'] ?? 'string',
                    $config['descripcion'] ?? '',
                    $config['categoria'] ?? 'general'
                );
                $importadas++;
            }
        }

        return $importadas;
    }

    public function limpiarCache()
    {
        // Si se implementa cache en el futuro
        return true;
    }

    public function validarConfiguracion()
    {
        $errores = [];

        // Validar configuraciones críticas
        $criticas = [
            'asociacion_nombre',
            'sistema_timezone',
            'notif_admin_email'
        ];

        foreach ($criticas as $clave) {
            $valor = $this->obtener($clave);
            if (empty($valor)) {
                $errores[] = "Configuración '$clave' está vacía";
            }
        }

        return $errores;
    }

    public function buscar($termino)
    {
        return $this->db->fetchAll(
            "SELECT * FROM configuraciones 
             WHERE clave LIKE ? OR valor LIKE ? OR descripcion LIKE ?
             ORDER BY categoria, clave",
            ["%$termino%", "%$termino%", "%$termino%"]
        );
    }
}