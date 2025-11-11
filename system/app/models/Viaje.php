<?php

/**
 * Modelo Viaje - Sistema PRIMERO DE JUNIO
 */
class Viaje extends Model
{
    protected $table = 'viajes';
    protected $fillable = [
        'conductor_id',
        'vehiculo_id',
        'cliente_id',
        'cliente_nombre',
        'cliente_telefono',
        'origen',
        'destino',
        'distancia_km',
        'duracion_minutos',
        'tarifa_aplicada_id',
        'valor_base',
        'recargos',
        'descuentos',
        'valor_total',
        'metodo_pago',
        'estado',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'observaciones',
        'calificacion',
        'comentario_cliente'
    ];

    public function obtenerCompleto($id)
    {
        return $this->db->fetch(
            "SELECT v.*, 
                    c.nombre as conductor_nombre, c.apellido as conductor_apellido, c.telefono as conductor_telefono,
                    ve.placa, ve.marca, ve.modelo, ve.color,
                    cl.nombre as cliente_nombre_db, cl.apellido as cliente_apellido, cl.tipo_cliente,
                    t.nombre as tarifa_nombre
             FROM viajes v
             INNER JOIN conductores c ON v.conductor_id = c.id
             INNER JOIN vehiculos ve ON v.vehiculo_id = ve.id
             LEFT JOIN clientes cl ON v.cliente_id = cl.id
             LEFT JOIN tarifas t ON v.tarifa_aplicada_id = t.id
             WHERE v.id = ?",
            [$id]
        );
    }

    public function obtenerTodos($fechaInicio = null, $fechaFin = null, $estado = null)
    {
        $sql = "SELECT v.*, 
                       c.nombre as conductor_nombre, c.apellido as conductor_apellido,
                       ve.placa,
                       COALESCE(cl.nombre, v.cliente_nombre) as cliente_final
                FROM viajes v
                INNER JOIN conductores c ON v.conductor_id = c.id
                INNER JOIN vehiculos ve ON v.vehiculo_id = ve.id
                LEFT JOIN clientes cl ON v.cliente_id = cl.id
                WHERE 1=1";
        
        $params = [];

        if ($fechaInicio) {
            $sql .= " AND v.fecha_hora_inicio >= ?";
            $params[] = $fechaInicio;
        }

        if ($fechaFin) {
            $sql .= " AND v.fecha_hora_inicio <= ?";
            $params[] = $fechaFin;
        }

        if ($estado) {
            $sql .= " AND v.estado = ?";
            $params[] = $estado;
        }

        $sql .= " ORDER BY v.fecha_hora_inicio DESC";

        return $this->db->fetchAll($sql, $params);
    }

    public function obtenerEstadisticas($fechaInicio = null, $fechaFin = null)
    {
        $whereClause = "WHERE 1=1";
        $params = [];

        if ($fechaInicio) {
            $whereClause .= " AND fecha_hora_inicio >= ?";
            $params[] = $fechaInicio;
        }

        if ($fechaFin) {
            $whereClause .= " AND fecha_hora_inicio <= ?";
            $params[] = $fechaFin;
        }

        $stats = [
            'total' => $this->db->fetch("SELECT COUNT(*) as count FROM viajes $whereClause", $params)['count'],
            'completados' => $this->db->fetch("SELECT COUNT(*) as count FROM viajes $whereClause AND estado = 'completado'", array_merge($params, ['completado']))['count'],
            'en_curso' => $this->db->fetch("SELECT COUNT(*) as count FROM viajes $whereClause AND estado = 'en_curso'", array_merge($params, ['en_curso']))['count'],
            'cancelados' => $this->db->fetch("SELECT COUNT(*) as count FROM viajes $whereClause AND estado = 'cancelado'", array_merge($params, ['cancelado']))['count'],
            'pendientes' => $this->db->fetch("SELECT COUNT(*) as count FROM viajes $whereClause AND estado = 'pendiente'", array_merge($params, ['pendiente']))['count']
        ];

        // Estadísticas de ingresos
        $ingresos = $this->db->fetch(
            "SELECT SUM(valor_total) as total_ingresos, AVG(valor_total) as promedio_viaje,
                    SUM(distancia_km) as total_km, AVG(distancia_km) as promedio_km
             FROM viajes $whereClause AND estado = 'completado'",
            array_merge($params, ['completado'])
        );

        $stats['ingresos'] = $ingresos;

        // Métodos de pago
        $metodosPago = $this->db->fetchAll(
            "SELECT metodo_pago, COUNT(*) as cantidad, SUM(valor_total) as total
             FROM viajes $whereClause AND estado = 'completado'
             GROUP BY metodo_pago",
            array_merge($params, ['completado'])
        );

        $stats['metodos_pago'] = $metodosPago;

        return $stats;
    }

    public function crearViaje($data)
    {
        // Calcular valor total si no viene calculado
        if (!isset($data['valor_total'])) {
            $data['valor_total'] = $data['valor_base'] + ($data['recargos'] ?? 0) - ($data['descuentos'] ?? 0);
        }

        return $this->create($data);
    }

    public function iniciarViaje($id)
    {
        return $this->update($id, [
            'estado' => 'en_curso',
            'fecha_hora_inicio' => date('Y-m-d H:i:s')
        ]);
    }

    public function completarViaje($id, $data = [])
    {
        $updateData = array_merge($data, [
            'estado' => 'completado',
            'fecha_hora_fin' => date('Y-m-d H:i:s')
        ]);

        return $this->update($id, $updateData);
    }

    public function cancelarViaje($id, $observaciones = '')
    {
        return $this->update($id, [
            'estado' => 'cancelado',
            'observaciones' => $observaciones
        ]);
    }

    public function calificarViaje($id, $calificacion, $comentario = '')
    {
        return $this->update($id, [
            'calificacion' => $calificacion,
            'comentario_cliente' => $comentario
        ]);
    }

    public function obtenerPorConductor($conductorId, $fechaInicio = null, $fechaFin = null)
    {
        $sql = "SELECT v.*, 
                       COALESCE(cl.nombre, v.cliente_nombre) as cliente_final,
                       ve.placa
                FROM viajes v
                INNER JOIN vehiculos ve ON v.vehiculo_id = ve.id
                LEFT JOIN clientes cl ON v.cliente_id = cl.id
                WHERE v.conductor_id = ?";
        
        $params = [$conductorId];

        if ($fechaInicio) {
            $sql .= " AND v.fecha_hora_inicio >= ?";
            $params[] = $fechaInicio;
        }

        if ($fechaFin) {
            $sql .= " AND v.fecha_hora_inicio <= ?";
            $params[] = $fechaFin;
        }

        $sql .= " ORDER BY v.fecha_hora_inicio DESC";

        return $this->db->fetchAll($sql, $params);
    }

    public function obtenerPorVehiculo($vehiculoId, $fechaInicio = null, $fechaFin = null)
    {
        $sql = "SELECT v.*, 
                       c.nombre as conductor_nombre, c.apellido as conductor_apellido,
                       COALESCE(cl.nombre, v.cliente_nombre) as cliente_final
                FROM viajes v
                INNER JOIN conductores c ON v.conductor_id = c.id
                LEFT JOIN clientes cl ON v.cliente_id = cl.id
                WHERE v.vehiculo_id = ?";
        
        $params = [$vehiculoId];

        if ($fechaInicio) {
            $sql .= " AND v.fecha_hora_inicio >= ?";
            $params[] = $fechaInicio;
        }

        if ($fechaFin) {
            $sql .= " AND v.fecha_hora_inicio <= ?";
            $params[] = $fechaFin;
        }

        $sql .= " ORDER BY v.fecha_hora_inicio DESC";

        return $this->db->fetchAll($sql, $params);
    }

    public function obtenerRutasPopulares($limite = 10, $fechaInicio = null, $fechaFin = null)
    {
        $sql = "SELECT origen, destino, COUNT(*) as frecuencia,
                       AVG(valor_total) as valor_promedio,
                       AVG(distancia_km) as distancia_promedio
                FROM viajes 
                WHERE estado = 'completado'";
        
        $params = [];

        if ($fechaInicio) {
            $sql .= " AND fecha_hora_inicio >= ?";
            $params[] = $fechaInicio;
        }

        if ($fechaFin) {
            $sql .= " AND fecha_hora_inicio <= ?";
            $params[] = $fechaFin;
        }

        $sql .= " GROUP BY origen, destino
                  ORDER BY frecuencia DESC
                  LIMIT ?";
        
        $params[] = $limite;

        return $this->db->fetchAll($sql, $params);
    }

    public function obtenerReporteHorario($fecha = null)
    {
        $whereClause = "WHERE estado = 'completado'";
        $params = [];

        if ($fecha) {
            $whereClause .= " AND DATE(fecha_hora_inicio) = ?";
            $params[] = $fecha;
        } else {
            $whereClause .= " AND DATE(fecha_hora_inicio) = CURDATE()";
        }

        return $this->db->fetchAll(
            "SELECT HOUR(fecha_hora_inicio) as hora,
                    COUNT(*) as total_viajes,
                    SUM(valor_total) as total_ingresos,
                    AVG(valor_total) as promedio_viaje
             FROM viajes $whereClause
             GROUP BY HOUR(fecha_hora_inicio)
             ORDER BY hora",
            $params
        );
    }

    public function obtenerReporteDiario($fechaInicio = null, $fechaFin = null)
    {
        $whereClause = "WHERE estado = 'completado'";
        $params = [];

        if ($fechaInicio) {
            $whereClause .= " AND DATE(fecha_hora_inicio) >= ?";
            $params[] = $fechaInicio;
        }

        if ($fechaFin) {
            $whereClause .= " AND DATE(fecha_hora_inicio) <= ?";
            $params[] = $fechaFin;
        }

        if (!$fechaInicio && !$fechaFin) {
            $whereClause .= " AND DATE(fecha_hora_inicio) >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
        }

        return $this->db->fetchAll(
            "SELECT DATE(fecha_hora_inicio) as fecha,
                    COUNT(*) as total_viajes,
                    SUM(valor_total) as total_ingresos,
                    AVG(valor_total) as promedio_viaje,
                    SUM(distancia_km) as total_km
             FROM viajes $whereClause
             GROUP BY DATE(fecha_hora_inicio)
             ORDER BY fecha DESC",
            $params
        );
    }

    public function buscar($termino)
    {
        return $this->db->fetchAll(
            "SELECT v.*, 
                    c.nombre as conductor_nombre, c.apellido as conductor_apellido,
                    ve.placa,
                    COALESCE(cl.nombre, v.cliente_nombre) as cliente_final
             FROM viajes v
             INNER JOIN conductores c ON v.conductor_id = c.id
             INNER JOIN vehiculos ve ON v.vehiculo_id = ve.id
             LEFT JOIN clientes cl ON v.cliente_id = cl.id
             WHERE v.origen LIKE ? OR v.destino LIKE ? 
             OR v.cliente_nombre LIKE ? OR v.cliente_telefono LIKE ?
             OR cl.nombre LIKE ? OR cl.telefono LIKE ?
             OR c.nombre LIKE ? OR c.apellido LIKE ?
             OR ve.placa LIKE ?
             ORDER BY v.fecha_hora_inicio DESC",
            ["%$termino%", "%$termino%", "%$termino%", "%$termino%", 
             "%$termino%", "%$termino%", "%$termino%", "%$termino%", "%$termino%"]
        );
    }

    /**
     * Iniciar viaje (alias para iniciarViaje)
     */
    public function iniciar($id)
    {
        return $this->iniciarViaje($id);
    }

    /**
     * Completar viaje (alias para completarViaje)
     */
    public function completar($id, $data = [])
    {
        return $this->completarViaje($id, $data);
    }

    /**
     * Cancelar viaje (alias para cancelarViaje)
     */
    public function cancelar($id, $observaciones = '')
    {
        return $this->cancelarViaje($id, $observaciones);
    }

    /**
     * Obtener reporte mensual
     */
    public function obtenerReporteMensual($mes, $ano)
    {
        $fechaInicio = "$ano-$mes-01";
        $fechaFin = date('Y-m-t', strtotime($fechaInicio));

        return [
            'estadisticas' => $this->obtenerEstadisticas($fechaInicio, $fechaFin),
            'viajes_por_dia' => $this->obtenerReporteDiario($fechaInicio, $fechaFin),
            'rutas_populares' => $this->obtenerRutasPopulares(10, $fechaInicio, $fechaFin),
            'conductores_top' => $this->obtenerTopConductores(10, $fechaInicio, $fechaFin)
        ];
    }

    /**
     * Obtener estadísticas de conductor
     */
    public function obtenerEstadisticasConductor($conductorId, $fechaInicio = null, $fechaFin = null)
    {
        $sql = "SELECT 
                    COUNT(*) as total_viajes,
                    SUM(CASE WHEN estado = 'completado' THEN 1 ELSE 0 END) as viajes_completados,
                    SUM(CASE WHEN estado = 'cancelado' THEN 1 ELSE 0 END) as viajes_cancelados,
                    SUM(CASE WHEN estado = 'completado' THEN valor_total ELSE 0 END) as total_ingresos,
                    AVG(CASE WHEN estado = 'completado' THEN valor_total ELSE NULL END) as promedio_viaje,
                    AVG(CASE WHEN estado = 'completado' AND calificacion IS NOT NULL THEN calificacion ELSE NULL END) as calificacion_promedio,
                    SUM(CASE WHEN estado = 'completado' THEN distancia_km ELSE 0 END) as total_km
                FROM viajes 
                WHERE conductor_id = ?";
        
        $params = [$conductorId];

        if ($fechaInicio) {
            $sql .= " AND DATE(fecha_hora_inicio) >= ?";
            $params[] = $fechaInicio;
        }

        if ($fechaFin) {
            $sql .= " AND DATE(fecha_hora_inicio) <= ?";
            $params[] = $fechaFin;
        }

        return $this->db->fetch($sql, $params);
    }

    /**
     * Obtener viajes de conductor (alias para obtenerPorConductor)
     */
    public function obtenerViajesConductor($conductorId, $fechaInicio = null, $fechaFin = null)
    {
        return $this->obtenerPorConductor($conductorId, $fechaInicio, $fechaFin);
    }

    /**
     * Obtener estadísticas por período
     */
    public function obtenerEstadisticasPeriodo($periodo)
    {
        $fechaInicio = null;
        $fechaFin = null;

        switch ($periodo) {
            case 'hoy':
                $fechaInicio = $fechaFin = date('Y-m-d');
                break;
            case 'semana':
                $fechaInicio = date('Y-m-d', strtotime('-7 days'));
                $fechaFin = date('Y-m-d');
                break;
            case 'mes':
                $fechaInicio = date('Y-m-01');
                $fechaFin = date('Y-m-t');
                break;
            case 'ano':
                $fechaInicio = date('Y-01-01');
                $fechaFin = date('Y-12-31');
                break;
        }

        return $this->obtenerEstadisticas($fechaInicio, $fechaFin);
    }

    /**
     * Obtener viajes para mapa
     */
    public function obtenerViajesParaMapa($fecha = null)
    {
        $sql = "SELECT v.id, v.origen, v.destino, v.estado,
                       c.nombre as conductor_nombre, c.apellido as conductor_apellido,
                       ve.placa
                FROM viajes v
                INNER JOIN conductores c ON v.conductor_id = c.id
                INNER JOIN vehiculos ve ON v.vehiculo_id = ve.id
                WHERE 1=1";
        
        $params = [];

        if ($fecha) {
            $sql .= " AND DATE(v.fecha_hora_inicio) = ?";
            $params[] = $fecha;
        } else {
            $sql .= " AND DATE(v.fecha_hora_inicio) = CURDATE()";
        }

        $sql .= " ORDER BY v.fecha_hora_inicio DESC";

        return $this->db->fetchAll($sql, $params);
    }

    /**
     * Obtener viajes del día
     */
    public function obtenerViajesDelDia($fecha)
    {
        return $this->obtenerTodos($fecha, $fecha, null);
    }

    /**
     * Obtener estadísticas del día
     */
    public function obtenerEstadisticasDia($fecha)
    {
        return $this->obtenerEstadisticas($fecha, $fecha);
    }

    /**
     * Obtener viajes en curso
     */
    public function obtenerEnCurso()
    {
        return $this->obtenerTodos(null, null, 'en_curso');
    }

    /**
     * Obtener estadísticas mensuales
     */
    public function obtenerEstadisticasMensuales()
    {
        $fechaInicio = date('Y-m-01');
        $fechaFin = date('Y-m-t');
        
        return $this->obtenerEstadisticas($fechaInicio, $fechaFin);
    }

    /**
     * Obtener ingresos mensuales
     */
    public function obtenerIngresosMensuales()
    {
        return $this->db->fetchAll(
            "SELECT 
                YEAR(fecha_hora_inicio) as ano,
                MONTH(fecha_hora_inicio) as mes,
                COUNT(*) as total_viajes,
                SUM(valor_total) as total_ingresos
             FROM viajes 
             WHERE estado = 'completado' 
             AND fecha_hora_inicio >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
             GROUP BY YEAR(fecha_hora_inicio), MONTH(fecha_hora_inicio)
             ORDER BY ano DESC, mes DESC"
        );
    }

    /**
     * Obtener top conductores
     */
    public function obtenerTopConductores($limite = 10, $fechaInicio = null, $fechaFin = null)
    {
        $sql = "SELECT c.nombre, c.apellido, c.id,
                       COUNT(v.id) as total_viajes,
                       SUM(v.valor_total) as total_ingresos,
                       AVG(v.calificacion) as calificacion_promedio
                FROM conductores c
                INNER JOIN viajes v ON c.id = v.conductor_id
                WHERE v.estado = 'completado'";
        
        $params = [];

        if ($fechaInicio) {
            $sql .= " AND DATE(v.fecha_hora_inicio) >= ?";
            $params[] = $fechaInicio;
        }

        if ($fechaFin) {
            $sql .= " AND DATE(v.fecha_hora_inicio) <= ?";
            $params[] = $fechaFin;
        }

        $sql .= " GROUP BY c.id
                  ORDER BY total_viajes DESC, total_ingresos DESC
                  LIMIT ?";
        
        $params[] = $limite;

        return $this->db->fetchAll($sql, $params);
    }

    /**
     * Verificar si se puede eliminar un viaje
     */
    public function puedeEliminar($id)
    {
        $viaje = $this->find($id);
        return $viaje && $viaje['estado'] !== 'completado';
    }

    /**
     * Obtener campos buscables
     */
    protected function getSearchableFields()
    {
        return ['origen', 'destino', 'cliente_nombre', 'cliente_telefono'];
    }

    /**
     * Obtener viajes recientes
     */
    public function obtenerRecientes($limite = 10)
    {
        return $this->db->fetchAll(
            "SELECT v.*, 
                    c.nombre as conductor_nombre, c.apellido as conductor_apellido,
                    ve.placa,
                    COALESCE(cl.nombre, v.cliente_nombre) as cliente_final
             FROM viajes v
             INNER JOIN conductores c ON v.conductor_id = c.id
             INNER JOIN vehiculos ve ON v.vehiculo_id = ve.id
             LEFT JOIN clientes cl ON v.cliente_id = cl.id
             ORDER BY v.created_at DESC
             LIMIT ?",
            [$limite]
        );
    }

    /**
     * Obtener viajes recientes de un conductor
     */
    public function obtenerViajesConductorRecientes($conductorId, $limite = 5)
    {
        return $this->db->fetchAll(
            "SELECT v.*, 
                    COALESCE(cl.nombre, v.cliente_nombre) as cliente_final,
                    ve.placa
             FROM viajes v
             INNER JOIN vehiculos ve ON v.vehiculo_id = ve.id
             LEFT JOIN clientes cl ON v.cliente_id = cl.id
             WHERE v.conductor_id = ?
             ORDER BY v.fecha_hora_inicio DESC
             LIMIT ?",
            [$conductorId, $limite]
        );
    }

    /**
     * Obtener ingresos del conductor en el mes actual
     */
    public function obtenerIngresosConductorMes($conductorId)
    {
        return $this->db->fetch(
            "SELECT 
                COUNT(*) as total_viajes,
                SUM(CASE WHEN estado = 'completado' THEN valor_total ELSE 0 END) as total_ingresos,
                AVG(CASE WHEN estado = 'completado' THEN valor_total ELSE NULL END) as promedio_viaje
             FROM viajes 
             WHERE conductor_id = ? 
             AND YEAR(fecha_hora_inicio) = YEAR(NOW()) 
             AND MONTH(fecha_hora_inicio) = MONTH(NOW())",
            [$conductorId]
        );
    }

    /**
     * Obtener ingresos por período
     */
    public function obtenerIngresosPeriodo($periodo, $fecha = null)
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
            "SELECT 
                SUM(CASE WHEN estado = 'completado' THEN valor_total ELSE 0 END) as total_ingresos,
                COUNT(CASE WHEN estado = 'completado' THEN 1 ELSE NULL END) as viajes_completados
             FROM viajes 
             WHERE DATE(fecha_hora_inicio) BETWEEN ? AND ?",
            [$fechaInicio, $fechaFin]
        );
    }

    /**
     * Obtener viajes pendientes
     */
    public function obtenerPendientes()
    {
        return $this->obtenerTodos(null, null, 'pendiente');
    }

    /**
     * Obtener viajes pendientes de hace X minutos
     */
    public function obtenerPendientesAntes($minutos)
    {
        return $this->db->fetchAll(
            "SELECT v.*, 
                    c.nombre as conductor_nombre, c.apellido as conductor_apellido,
                    ve.placa
             FROM viajes v
             INNER JOIN conductores c ON v.conductor_id = c.id
             INNER JOIN vehiculos ve ON v.vehiculo_id = ve.id
             WHERE v.estado = 'pendiente' 
             AND v.fecha_hora_inicio <= DATE_SUB(NOW(), INTERVAL ? MINUTE)",
            [$minutos]
        );
    }
}