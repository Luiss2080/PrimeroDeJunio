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
}