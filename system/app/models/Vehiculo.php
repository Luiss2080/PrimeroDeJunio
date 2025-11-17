<?php

/**
 * Modelo Vehiculo - Sistema PRIMERO DE JUNIO
 */
class Vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'color',
        'ano',
        'cilindraje',
        'numero_motor',
        'numero_chasis',
        'propietario_nombre',
        'propietario_cedula',
        'propietario_telefono',
        'seguro_numero',
        'seguro_vigencia',
        'soat_numero',
        'soat_vigencia',
        'tecnicomecanica_numero',
        'tecnicomecanica_vigencia',
        'tarjeta_propiedad',
        'estado',
        'observaciones'
    ];

    public function buscarPorPlaca($placa)
    {
        return $this->findBy('placa', $placa);
    }

    public function obtenerEstadisticas()
    {
        $stats = [
            'total' => $this->count(),
            'activos' => $this->count(['estado' => 'activo']),
            'mantenimiento' => $this->count(['estado' => 'mantenimiento']),
            'inactivos' => $this->count(['estado' => 'inactivo']),
            'vendidos' => $this->count(['estado' => 'vendido'])
        ];

        // Estadísticas por marca
        $marcas = $this->db->fetchAll(
            "SELECT marca, COUNT(*) as cantidad 
             FROM vehiculos 
             WHERE estado = 'activo' 
             GROUP BY marca 
             ORDER BY cantidad DESC"
        );
        $stats['por_marca'] = $marcas;

        // Vencimientos próximos (30 días)
        $stats['soat_por_vencer'] = $this->db->fetch(
            "SELECT COUNT(*) as count FROM vehiculos 
             WHERE soat_vigencia <= DATE_ADD(NOW(), INTERVAL 30 DAY) 
             AND soat_vigencia >= NOW() 
             AND estado = 'activo'"
        )['count'];

        $stats['tecnicomecanica_por_vencer'] = $this->db->fetch(
            "SELECT COUNT(*) as count FROM vehiculos 
             WHERE tecnicomecanica_vigencia <= DATE_ADD(NOW(), INTERVAL 30 DAY) 
             AND tecnicomecanica_vigencia >= NOW() 
             AND estado = 'activo'"
        )['count'];

        return $stats;
    }

    public function buscar($termino)
    {
        return $this->db->fetchAll(
            "SELECT * FROM vehiculos 
             WHERE placa LIKE ? OR marca LIKE ? OR modelo LIKE ? 
             OR propietario_nombre LIKE ? OR propietario_cedula LIKE ?
             ORDER BY placa",
            ["%$termino%", "%$termino%", "%$termino%", "%$termino%", "%$termino%"]
        );
    }

    public function obtenerDisponibles()
    {
        return $this->db->fetchAll(
            "SELECT v.* FROM vehiculos v 
             LEFT JOIN asignaciones_vehiculo av ON v.id = av.vehiculo_id AND av.estado = 'activa'
             WHERE v.estado = 'activo' AND av.id IS NULL
             ORDER BY v.placa"
        );
    }

    public function obtenerAsignado($vehiculoId)
    {
        return $this->db->fetch(
            "SELECT c.*, av.turno, av.hora_inicio, av.hora_fin, av.dias_semana, av.fecha_inicio
             FROM conductores c 
             INNER JOIN asignaciones_vehiculo av ON c.id = av.conductor_id 
             WHERE av.vehiculo_id = ? AND av.estado = 'activa'",
            [$vehiculoId]
        );
    }

    public function obtenerHistorialConductores($vehiculoId)
    {
        return $this->db->fetchAll(
            "SELECT c.nombre, c.apellido, c.cedula, av.fecha_inicio, av.fecha_fin, av.turno 
             FROM conductores c 
             INNER JOIN asignaciones_vehiculo av ON c.id = av.conductor_id 
             WHERE av.vehiculo_id = ? 
             ORDER BY av.fecha_inicio DESC",
            [$vehiculoId]
        );
    }

    public function obtenerMantenimientos($vehiculoId)
    {
        return $this->db->fetchAll(
            "SELECT * FROM mantenimientos 
             WHERE vehiculo_id = ? 
             ORDER BY fecha_programada DESC",
            [$vehiculoId]
        );
    }

    public function obtenerUltimoMantenimiento($vehiculoId)
    {
        return $this->db->fetch(
            "SELECT * FROM mantenimientos 
             WHERE vehiculo_id = ? AND estado = 'completado'
             ORDER BY fecha_realizada DESC 
             LIMIT 1",
            [$vehiculoId]
        );
    }

    public function obtenerProximoMantenimiento($vehiculoId)
    {
        return $this->db->fetch(
            "SELECT * FROM mantenimientos 
             WHERE vehiculo_id = ? AND estado = 'programado'
             ORDER BY fecha_programada ASC 
             LIMIT 1",
            [$vehiculoId]
        );
    }

    public function obtenerViajesRealizados($vehiculoId, $fechaInicio = null, $fechaFin = null)
    {
        $sql = "SELECT COUNT(*) as total_viajes, SUM(valor_total) as total_ingresos,
                       AVG(distancia_km) as distancia_promedio
                FROM viajes 
                WHERE vehiculo_id = ? AND estado = 'completado'";
        
        $params = [$vehiculoId];

        if ($fechaInicio) {
            $sql .= " AND fecha_hora_inicio >= ?";
            $params[] = $fechaInicio;
        }

        if ($fechaFin) {
            $sql .= " AND fecha_hora_inicio <= ?";
            $params[] = $fechaFin;
        }

        return $this->db->fetch($sql, $params);
    }

    public function obtenerVencimientosSoat($dias = 30)
    {
        return $this->db->fetchAll(
            "SELECT *, DATEDIFF(soat_vigencia, NOW()) as dias_restantes 
             FROM vehiculos 
             WHERE soat_vigencia <= DATE_ADD(NOW(), INTERVAL ? DAY) 
             AND soat_vigencia >= NOW() 
             AND estado = 'activo'
             ORDER BY soat_vigencia ASC",
            [$dias]
        );
    }

    public function obtenerVencimientosTecnicomecanica($dias = 30)
    {
        return $this->db->fetchAll(
            "SELECT *, DATEDIFF(tecnicomecanica_vigencia, NOW()) as dias_restantes 
             FROM vehiculos 
             WHERE tecnicomecanica_vigencia <= DATE_ADD(NOW(), INTERVAL ? DAY) 
             AND tecnicomecanica_vigencia >= NOW() 
             AND estado = 'activo'
             ORDER BY tecnicomecanica_vigencia ASC",
            [$dias]
        );
    }

    public function cambiarEstado($id, $nuevoEstado, $observaciones = '')
    {
        return $this->update($id, [
            'estado' => $nuevoEstado,
            'observaciones' => $observaciones
        ]);
    }

    public function obtenerMasUtilizados($limite = 10, $fechaInicio = null, $fechaFin = null)
    {
        $sql = "SELECT v.*, COUNT(vi.id) as total_viajes, 
                       SUM(vi.valor_total) as total_ingresos
                FROM vehiculos v 
                INNER JOIN viajes vi ON v.id = vi.vehiculo_id 
                WHERE vi.estado = 'completado'";
        
        $params = [];

        if ($fechaInicio) {
            $sql .= " AND vi.fecha_hora_inicio >= ?";
            $params[] = $fechaInicio;
        }

        if ($fechaFin) {
            $sql .= " AND vi.fecha_hora_inicio <= ?";
            $params[] = $fechaFin;
        }

        $sql .= " GROUP BY v.id 
                  ORDER BY total_viajes DESC 
                  LIMIT ?";
        
        $params[] = $limite;

        return $this->db->fetchAll($sql, $params);
    }

    public function obtenerPorPropietario($cedulaPropietario)
    {
        return $this->where(['propietario_cedula' => $cedulaPropietario]);
    }

    /**
     * Obtener conductor asignado a un vehículo
     */
    public function obtenerConductorAsignado($vehiculoId)
    {
        return $this->obtenerAsignado($vehiculoId);
    }

    /**
     * Obtener historial de mantenimientos
     */
    public function obtenerHistorialMantenimientos($vehiculoId)
    {
        return $this->obtenerMantenimientos($vehiculoId);
    }

    /**
     * Obtener estadísticas de viajes de un vehículo
     */
    public function obtenerEstadisticasViajes($vehiculoId, $fechaInicio = null, $fechaFin = null)
    {
        return $this->obtenerViajesRealizados($vehiculoId, $fechaInicio, $fechaFin);
    }

    /**
     * Obtener próximos vencimientos de un vehículo
     */
    public function obtenerProximosVencimientos($vehiculoId)
    {
        $vehiculo = $this->find($vehiculoId);
        if (!$vehiculo) return [];

        $vencimientos = [];
        $hoy = new DateTime();

        // SOAT
        if (!empty($vehiculo['soat_vigencia'])) {
            $fechaVencimiento = new DateTime($vehiculo['soat_vigencia']);
            $diasRestantes = $hoy->diff($fechaVencimiento)->days;
            if ($fechaVencimiento >= $hoy) {
                $vencimientos[] = [
                    'tipo' => 'SOAT',
                    'fecha' => $vehiculo['soat_vigencia'],
                    'dias_restantes' => $diasRestantes,
                    'estado' => $diasRestantes <= 30 ? 'proximo' : 'vigente'
                ];
            }
        }

        // Tecnomecánica
        if (!empty($vehiculo['tecnicomecanica_vigencia'])) {
            $fechaVencimiento = new DateTime($vehiculo['tecnicomecanica_vigencia']);
            $diasRestantes = $hoy->diff($fechaVencimiento)->days;
            if ($fechaVencimiento >= $hoy) {
                $vencimientos[] = [
                    'tipo' => 'Tecnomecánica',
                    'fecha' => $vehiculo['tecnicomecanica_vigencia'],
                    'dias_restantes' => $diasRestantes,
                    'estado' => $diasRestantes <= 30 ? 'proximo' : 'vigente'
                ];
            }
        }

        return $vencimientos;
    }

    /**
     * Asignar conductor a vehículo
     */
    public function asignarConductor($vehiculoId, $conductorId, $fechaAsignacion)
    {
        // Desasignar conductor anterior si existe
        $this->db->execute(
            "UPDATE asignaciones_vehiculo SET estado = 'inactiva', fecha_fin = NOW() 
             WHERE vehiculo_id = ? AND estado = 'activa'",
            [$vehiculoId]
        );

        // Crear nueva asignación
        return $this->db->insert(
            "INSERT INTO asignaciones_vehiculo (vehiculo_id, conductor_id, fecha_inicio, estado) 
             VALUES (?, ?, ?, 'activa')",
            [$vehiculoId, $conductorId, $fechaAsignacion]
        );
    }

    /**
     * Desasignar conductor de vehículo
     */
    public function desasignarConductor($vehiculoId)
    {
        return $this->db->execute(
            "UPDATE asignaciones_vehiculo SET estado = 'inactiva', fecha_fin = NOW() 
             WHERE vehiculo_id = ? AND estado = 'activa'",
            [$vehiculoId]
        );
    }

    /**
     * Registrar mantenimiento
     */
    public function registrarMantenimiento($datos)
    {
        return $this->db->insert(
            "INSERT INTO mantenimientos (vehiculo_id, tipo_mantenimiento, descripcion, fecha_programada, costo, estado) 
             VALUES (?, ?, ?, ?, ?, ?)",
            [
                $datos['vehiculo_id'],
                $datos['tipo'] ?? 'preventivo',
                $datos['descripcion'],
                $datos['fecha_programada'],
                $datos['costo_estimado'] ?? 0,
                'programado'
            ]
        );
    }

    /**
     * Activar vehículo
     */
    public function activar($id)
    {
        return $this->update($id, ['estado' => 'activo']);
    }

    /**
     * Desactivar vehículo
     */
    public function desactivar($id)
    {
        return $this->update($id, ['estado' => 'inactivo']);
    }

    /**
     * Marcar en mantenimiento
     */
    public function marcarEnMantenimiento($id)
    {
        return $this->update($id, ['estado' => 'mantenimiento']);
    }

    /**
     * Marcar como disponible
     */
    public function marcarDisponible($id)
    {
        return $this->update($id, ['estado' => 'activo']);
    }

    /**
     * Obtener próximos vencimientos de todos los vehículos
     */
    public function obtenerProximosVencimientosTodos($dias = 30)
    {
        $soat = $this->obtenerVencimientosSoat($dias);
        $tecnicomecanica = $this->obtenerVencimientosTecnicomecanica($dias);

        $vencimientos = [];
        
        foreach ($soat as $v) {
            $v['tipo'] = 'SOAT';
            $vencimientos[] = $v;
        }
        
        foreach ($tecnicomecanica as $v) {
            $v['tipo'] = 'Tecnomecánica';
            $vencimientos[] = $v;
        }

        // Ordenar por días restantes
        usort($vencimientos, function($a, $b) {
            return $a['dias_restantes'] - $b['dias_restantes'];
        });

        return $vencimientos;
    }

    /**
     * Obtener historial de mantenimientos de todos los vehículos
     */
    public function obtenerHistorialMantenimientosTodos($vehiculoId = null, $fechaInicio = null, $fechaFin = null)
    {
        $sql = "SELECT m.*, v.placa, v.marca, v.modelo 
                FROM mantenimientos m
                INNER JOIN vehiculos v ON m.vehiculo_id = v.id
                WHERE 1=1";
        
        $params = [];

        if ($vehiculoId) {
            $sql .= " AND m.vehiculo_id = ?";
            $params[] = $vehiculoId;
        }

        if ($fechaInicio) {
            $sql .= " AND DATE(m.fecha_programada) >= ?";
            $params[] = $fechaInicio;
        }

        if ($fechaFin) {
            $sql .= " AND DATE(m.fecha_programada) <= ?";
            $params[] = $fechaFin;
        }

        $sql .= " ORDER BY m.fecha_programada DESC";

        return $this->db->fetchAll($sql, $params);
    }

    /**
     * Obtener todos los vehículos
     */
    public function obtenerTodos($incluirInactivos = false)
    {
        if ($incluirInactivos) {
            return $this->all('placa');
        }
        
        $sql = "SELECT * FROM {$this->table} WHERE estado IN ('activo', 'mantenimiento') ORDER BY placa";
        return $this->db->fetchAll($sql);
    }

    /**
     * Actualizar kilometraje
     */
    public function actualizarKilometraje($id, $nuevoKilometraje, $observaciones = '')
    {
        // Nota: Necesitaríamos agregar campo kilometraje a la tabla vehiculos
        // Por ahora solo actualizar observaciones
        return $this->update($id, ['observaciones' => $observaciones]);
    }

    /**
     * Obtener vehículos en mantenimiento
     */
    public function obtenerVehiculosMantenimiento()
    {
        return $this->where(['estado' => 'mantenimiento'], 'placa');
    }

    /**
     * Obtener rendimiento de la flota
     */
    public function obtenerRendimientoFlota()
    {
        return $this->db->fetchAll(
            "SELECT v.placa, v.marca, v.modelo,
                    COUNT(vi.id) as total_viajes,
                    SUM(vi.valor_total) as ingresos_totales,
                    AVG(vi.valor_total) as promedio_viaje,
                    SUM(vi.distancia_km) as km_totales
             FROM vehiculos v
             LEFT JOIN viajes vi ON v.id = vi.vehiculo_id AND vi.estado = 'completado'
             WHERE v.estado = 'activo'
             GROUP BY v.id
             ORDER BY ingresos_totales DESC"
        );
    }

    /**
     * Verificar si se puede eliminar un vehículo
     */
    public function puedeEliminar($id)
    {
        $viajes = $this->db->fetch(
            "SELECT COUNT(*) as count FROM viajes WHERE vehiculo_id = ?",
            [$id]
        );
        
        return $viajes['count'] == 0;
    }

    /**
     * Obtener campos buscables
     */
    protected function getSearchableFields()
    {
        return ['placa', 'marca', 'modelo', 'propietario_nombre', 'propietario_cedula'];
    }

    /**
     * Obtener vehículos utilizados en un período
     */
    public function obtenerVehiculosUtilizadosPeriodo($periodo, $fecha = null)
    {
        $fechaInicio = null;
        $fechaFin = null;

        switch ($periodo) {
            case 'dia':
                $fechaInicio = $fechaFin = $fecha ?? date('Y-m-d');
                break;
            case 'semana':
                $fechaInicio = date('Y-m-d', strtotime('monday this week'));
                $fechaFin = date('Y-m-d', strtotime('sunday this week'));
                break;
            case 'mes':
                $fechaInicio = date('Y-m-01');
                $fechaFin = date('Y-m-t');
                break;
        }

        return $this->db->fetch(
            "SELECT COUNT(DISTINCT v.vehiculo_id) as cantidad
             FROM viajes v
             INNER JOIN vehiculos ve ON v.vehiculo_id = ve.id
             WHERE DATE(v.fecha_hora_inicio) BETWEEN ? AND ?
             AND ve.estado = 'activo'",
            [$fechaInicio, $fechaFin]
        )['cantidad'];
    }

    /**
     * Obtener vehículos en uso actualmente
     */
    public function obtenerEnUso()
    {
        $sql = "SELECT v.*, c.nombre as conductor_nombre, c.apellido as conductor_apellido 
                FROM {$this->table} v
                INNER JOIN asignaciones_vehiculo av ON v.id = av.vehiculo_id 
                INNER JOIN conductores c ON av.conductor_id = c.id
                WHERE av.estado = 'activa' AND v.estado = 'activo'";
        return $this->db->fetchAll($sql);
    }

    /**
     * Obtener vehículos que necesitan atención
     */
    public function obtenerQueNecesitanAtencion($diasAnticipacion = 30)
    {
        $soatVence = $this->obtenerVencimientosSoat($diasAnticipacion);
        $tecnicomecanicaVence = $this->obtenerVencimientosTecnicomecanica($diasAnticipacion);
        $mantenimiento = $this->where(['estado' => 'mantenimiento']);

        $atencion = [];

        foreach ($soatVence as $vehiculo) {
            $vehiculo['motivo'] = 'SOAT próximo a vencer';
            $atencion[] = $vehiculo;
        }

        foreach ($tecnicomecanicaVence as $vehiculo) {
            $vehiculo['motivo'] = 'Tecnomecánica próxima a vencer';
            $atencion[] = $vehiculo;
        }

        foreach ($mantenimiento as $vehiculo) {
            $vehiculo['motivo'] = 'En mantenimiento';
            $atencion[] = $vehiculo;
        }

        return $atencion;
    }

    /**
     * Obtener reporte de uso de vehículos
     */
    public function obtenerReporteUso($filtros = [])
    {
        $sql = "SELECT v.id, v.placa, v.marca, v.modelo, v.color, v.ano,
                       CONCAT(v.placa, ' - ', v.marca, ' ', v.modelo) as vehiculo_info,
                       COALESCE(CONCAT(c.nombre, ' ', c.apellido), 'Sin asignar') as conductor_asignado,
                       COUNT(vi.id) as total_viajes,
                       SUM(CASE WHEN vi.estado = 'completado' THEN vi.distancia_km ELSE 0 END) as km_recorridos,
                       SUM(CASE WHEN vi.estado = 'completado' THEN vi.tiempo_minutos ELSE 0 END) / 60.0 as horas_uso,
                       SUM(CASE WHEN vi.estado = 'completado' THEN vi.valor_total ELSE 0 END) as ingresos_generados,
                       v.estado
                FROM vehiculos v
                LEFT JOIN asignaciones_vehiculo av ON v.id = av.vehiculo_id AND av.estado = 'activa'
                LEFT JOIN conductores c ON av.conductor_id = c.id
                LEFT JOIN viajes vi ON v.id = vi.vehiculo_id";

        $whereConditions = [];
        $params = [];

        if (!empty($filtros['fecha_inicio'])) {
            $whereConditions[] = "DATE(vi.fecha_hora_inicio) >= ?";
            $params[] = $filtros['fecha_inicio'];
        }

        if (!empty($filtros['fecha_fin'])) {
            $whereConditions[] = "DATE(vi.fecha_hora_inicio) <= ?";
            $params[] = $filtros['fecha_fin'];
        }

        if (!empty($filtros['vehiculo_id'])) {
            $whereConditions[] = "v.id = ?";
            $params[] = $filtros['vehiculo_id'];
        }

        if (!empty($whereConditions)) {
            $sql .= " WHERE " . implode(" AND ", $whereConditions);
        }

        $sql .= " GROUP BY v.id, v.placa, v.marca, v.modelo, v.color, v.ano, 
                          conductor_asignado, v.estado
                  ORDER BY total_viajes DESC";

        return $this->db->fetchAll($sql, $params);
    }

    /**
     * Obtener métricas de vehículos
     */
    public function obtenerMetricas($fechaInicio, $fechaFin)
    {
        $sql = "SELECT 
                    COUNT(DISTINCT v.id) as total_vehiculos,
                    COUNT(DISTINCT CASE WHEN vi.id IS NOT NULL THEN v.id END) as vehiculos_en_uso,
                    COUNT(DISTINCT CASE WHEN v.estado = 'activo' THEN v.id END) as vehiculos_activos,
                    COUNT(DISTINCT CASE WHEN v.estado = 'mantenimiento' THEN v.id END) as vehiculos_mantenimiento
                FROM vehiculos v
                LEFT JOIN viajes vi ON v.id = vi.vehiculo_id 
                    AND DATE(vi.fecha_hora_inicio) BETWEEN ? AND ?
                    AND vi.estado = 'completado'";

        return $this->db->fetch($sql, [$fechaInicio, $fechaFin]);
    }

    /**
     * Listar vehículos activos
     */
    public function listarActivos()
    {
        return $this->db->fetchAll(
            "SELECT v.*, CONCAT(v.placa, ' - ', v.marca, ' ', v.modelo) as descripcion_completa
             FROM vehiculos v 
             WHERE v.estado = 'activo'
             ORDER BY v.placa"
        );
    }
}