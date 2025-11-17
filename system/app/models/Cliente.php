<?php

/**
 * Modelo Cliente - Sistema PRIMERO DE JUNIO
 */
class Cliente extends Model
{
    protected $table = 'clientes';
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'email',
        'direccion_habitual',
        'tipo_cliente',
        'estado',
        'observaciones',
        'descuento_porcentaje'
    ];

    public function buscarPorTelefono($telefono)
    {
        return $this->findBy('telefono', $telefono);
    }

    public function buscarPorEmail($email)
    {
        return $this->findBy('email', $email);
    }

    public function obtenerEstadisticas()
    {
        $stats = [
            'total' => $this->count(),
            'activos' => $this->count(['estado' => 'activo']),
            'inactivos' => $this->count(['estado' => 'inactivo'])
        ];

        // Estadísticas por tipo
        $stats['por_tipo'] = [
            'particular' => $this->count(['tipo_cliente' => 'particular', 'estado' => 'activo']),
            'corporativo' => $this->count(['tipo_cliente' => 'corporativo', 'estado' => 'activo']),
            'frecuente' => $this->count(['tipo_cliente' => 'frecuente', 'estado' => 'activo'])
        ];

        // Clientes con descuentos
        $stats['con_descuentos'] = $this->db->fetch(
            "SELECT COUNT(*) as count FROM clientes 
             WHERE descuento_porcentaje > 0 AND estado = 'activo'"
        )['count'];

        return $stats;
    }

    public function buscar($termino)
    {
        return $this->db->fetchAll(
            "SELECT * FROM clientes 
             WHERE nombre LIKE ? OR apellido LIKE ? OR telefono LIKE ? 
             OR email LIKE ? OR direccion_habitual LIKE ?
             ORDER BY nombre, apellido",
            ["%$termino%", "%$termino%", "%$termino%", "%$termino%", "%$termino%"]
        );
    }

    public function obtenerViajesRealizados($clienteId, $fechaInicio = null, $fechaFin = null)
    {
        $sql = "SELECT COUNT(*) as total_viajes, SUM(valor_total) as total_gastado,
                       AVG(valor_total) as promedio_gasto, AVG(calificacion) as calificacion_promedio
                FROM viajes 
                WHERE cliente_id = ? AND estado = 'completado'";

        $params = [$clienteId];

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

    public function obtenerHistorialViajes($clienteId, $limite = 20, $offset = 0, $fechaInicio = null, $fechaFin = null)
    {
        $sql = "SELECT v.*, c.nombre as conductor_nombre, c.apellido as conductor_apellido,
                       ve.placa, ve.marca, ve.modelo
                FROM viajes v
                INNER JOIN conductores c ON v.conductor_id = c.id
                INNER JOIN vehiculos ve ON v.vehiculo_id = ve.id
                WHERE v.cliente_id = ?";

        $params = [$clienteId];

        if ($fechaInicio) {
            $sql .= " AND DATE(v.fecha_hora_inicio) >= ?";
            $params[] = $fechaInicio;
        }

        if ($fechaFin) {
            $sql .= " AND DATE(v.fecha_hora_inicio) <= ?";
            $params[] = $fechaFin;
        }

        $sql .= " ORDER BY v.fecha_hora_inicio DESC";

        if ($limite > 0) {
            $sql .= " LIMIT ?";
            $params[] = $limite;

            if ($offset > 0) {
                $sql .= " OFFSET ?";
                $params[] = $offset;
            }
        }

        return $this->db->fetchAll($sql, $params);
    }

    public function obtenerClientesFrecuentes($limite = 10, $fechaInicio = null, $fechaFin = null)
    {
        $sql = "SELECT cl.*, COUNT(v.id) as total_viajes, 
                       SUM(v.valor_total) as total_gastado
                FROM clientes cl 
                INNER JOIN viajes v ON cl.id = v.cliente_id 
                WHERE v.estado = 'completado' AND cl.estado = 'activo'";

        $params = [];

        if ($fechaInicio) {
            $sql .= " AND v.fecha_hora_inicio >= ?";
            $params[] = $fechaInicio;
        }

        if ($fechaFin) {
            $sql .= " AND v.fecha_hora_inicio <= ?";
            $params[] = $fechaFin;
        }

        $sql .= " GROUP BY cl.id 
                  HAVING total_viajes >= 5
                  ORDER BY total_viajes DESC 
                  LIMIT ?";

        $params[] = $limite;

        return $this->db->fetchAll($sql, $params);
    }

    public function obtenerClientesCorporativos()
    {
        return $this->where(['tipo_cliente' => 'corporativo', 'estado' => 'activo'], 'nombre ASC');
    }

    public function aplicarDescuento($clienteId, $porcentaje)
    {
        return $this->update($clienteId, ['descuento_porcentaje' => $porcentaje]);
    }

    public function promoverAFrecuente($clienteId, $descuentoPorcentaje = 5.0)
    {
        return $this->update($clienteId, [
            'tipo_cliente' => 'frecuente',
            'descuento_porcentaje' => $descuentoPorcentaje
        ]);
    }

    public function activar($id)
    {
        return $this->update($id, ['estado' => 'activo']);
    }

    public function desactivar($id)
    {
        return $this->update($id, ['estado' => 'inactivo']);
    }

    public function obtenerRutasFrecuentes($clienteId)
    {
        return $this->db->fetchAll(
            "SELECT origen, destino, COUNT(*) as frecuencia
             FROM viajes 
             WHERE cliente_id = ? AND estado = 'completado'
             GROUP BY origen, destino
             HAVING frecuencia > 1
             ORDER BY frecuencia DESC
             LIMIT 10",
            [$clienteId]
        );
    }

    public function obtenerCalificacionesOtorgadas($clienteId)
    {
        return $this->db->fetchAll(
            "SELECT calificacion, comentario_cliente, fecha_hora_inicio,
                    c.nombre as conductor_nombre, c.apellido as conductor_apellido
             FROM viajes v
             INNER JOIN conductores c ON v.conductor_id = c.id
             WHERE v.cliente_id = ? AND v.calificacion IS NOT NULL
             ORDER BY v.fecha_hora_inicio DESC",
            [$clienteId]
        );
    }

    public function obtenerTopGastadores($limite = 10, $fechaInicio = null, $fechaFin = null)
    {
        $sql = "SELECT cl.*, SUM(v.valor_total) as total_gastado,
                       COUNT(v.id) as total_viajes,
                       AVG(v.valor_total) as promedio_viaje
                FROM clientes cl 
                INNER JOIN viajes v ON cl.id = v.cliente_id 
                WHERE v.estado = 'completado' AND cl.estado = 'activo'";

        $params = [];

        if ($fechaInicio) {
            $sql .= " AND v.fecha_hora_inicio >= ?";
            $params[] = $fechaInicio;
        }

        if ($fechaFin) {
            $sql .= " AND v.fecha_hora_inicio <= ?";
            $params[] = $fechaFin;
        }

        $sql .= " GROUP BY cl.id 
                  ORDER BY total_gastado DESC 
                  LIMIT ?";

        $params[] = $limite;

        return $this->db->fetchAll($sql, $params);
    }

    /**
     * Obtener estadísticas de viajes de un cliente específico
     */
    public function obtenerEstadisticasViajes($clienteId, $fechaInicio = null, $fechaFin = null)
    {
        $sql = "SELECT 
                    COUNT(*) as total_viajes,
                    SUM(CASE WHEN estado = 'completado' THEN 1 ELSE 0 END) as viajes_completados,
                    SUM(CASE WHEN estado = 'cancelado' THEN 1 ELSE 0 END) as viajes_cancelados,
                    SUM(CASE WHEN estado = 'completado' THEN valor_total ELSE 0 END) as total_gastado,
                    AVG(CASE WHEN estado = 'completado' THEN valor_total ELSE NULL END) as promedio_gasto,
                    AVG(CASE WHEN estado = 'completado' AND calificacion IS NOT NULL THEN calificacion ELSE NULL END) as calificacion_promedio
                FROM viajes 
                WHERE cliente_id = ?";

        $params = [$clienteId];

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
     * Obtener lugares más comunes de un cliente
     */
    public function obtenerLugaresComunes($clienteId, $limite = 10)
    {
        return $this->db->fetchAll(
            "SELECT 
                origen,
                destino,
                COUNT(*) as frecuencia,
                AVG(valor_total) as precio_promedio
             FROM viajes 
             WHERE cliente_id = ? AND estado = 'completado'
             GROUP BY origen, destino
             ORDER BY frecuencia DESC
             LIMIT ?",
            [$clienteId, $limite]
        );
    }

    /**
     * Obtener clientes nuevos en un período
     */
    public function obtenerClientesNuevos($dias = 30)
    {
        return $this->db->fetchAll(
            "SELECT * FROM clientes 
             WHERE created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)
             ORDER BY created_at DESC",
            [$dias]
        );
    }

    /**
     * Obtener clientes inactivos
     */
    public function obtenerInactivos($diasInactividad = 90)
    {
        return $this->db->fetchAll(
            "SELECT cl.*, 
                    MAX(v.fecha_hora_inicio) as ultimo_viaje,
                    COUNT(v.id) as total_viajes
             FROM clientes cl
             LEFT JOIN viajes v ON cl.id = v.cliente_id
             WHERE cl.estado = 'activo'
             GROUP BY cl.id
             HAVING ultimo_viaje IS NULL 
                OR ultimo_viaje < DATE_SUB(NOW(), INTERVAL ? DAY)
             ORDER BY ultimo_viaje DESC",
            [$diasInactividad]
        );
    }

    /**
     * Obtener distribución por tipos
     */
    public function obtenerDistribucionTipos()
    {
        return $this->db->fetchAll(
            "SELECT tipo_cliente, COUNT(*) as cantidad
             FROM clientes 
             WHERE estado = 'activo'
             GROUP BY tipo_cliente
             ORDER BY cantidad DESC"
        );
    }

    /**
     * Verificar si se puede eliminar un cliente
     */
    public function puedeEliminar($id)
    {
        $viajes = $this->db->fetch(
            "SELECT COUNT(*) as count FROM viajes WHERE cliente_id = ?",
            [$id]
        );

        return $viajes['count'] == 0;
    }

    /**
     * Validar documento único
     */
    public function validarDocumentoUnico($documento, $excludeId = null)
    {
        $sql = "SELECT COUNT(*) as count FROM clientes WHERE documento_identidad = ?";
        $params = [$documento];

        if ($excludeId) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }

        $result = $this->db->fetch($sql, $params);
        return $result['count'] == 0;
    }

    /**
     * Validar teléfono único
     */
    public function validarTelefonoUnico($telefono, $excludeId = null)
    {
        $sql = "SELECT COUNT(*) as count FROM clientes WHERE telefono = ?";
        $params = [$telefono];

        if ($excludeId) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }

        $result = $this->db->fetch($sql, $params);
        return $result['count'] == 0;
    }

    /**
     * Obtener campos buscables
     */
    protected function getSearchableFields()
    {
        return ['nombre', 'apellido', 'telefono', 'email', 'direccion_habitual'];
    }

    /**
     * Obtener clientes activos
     */
    public function obtenerActivos()
    {
        return $this->where(['estado' => 'activo'], 'nombre, apellido');
    }

    /**
     * Obtener reporte de actividad de clientes
     */
    public function obtenerReporteActividad($filtros = [])
    {
        $sql = "SELECT c.id, c.nombre, c.apellido, c.telefono, c.tipo_cliente,
                       CONCAT(c.nombre, ' ', COALESCE(c.apellido, '')) as cliente_nombre,
                       COUNT(v.id) as total_viajes,
                       SUM(CASE WHEN v.estado = 'completado' THEN v.valor_total ELSE 0 END) as gasto_total,
                       AVG(CASE WHEN v.estado = 'completado' THEN v.valor_total ELSE NULL END) as promedio_viaje,
                       MAX(v.fecha_hora_inicio) as ultimo_viaje,
                       c.estado
                FROM clientes c
                LEFT JOIN viajes v ON c.id = v.cliente_id";

        $params = [];

        if (!empty($filtros['fecha_inicio'])) {
            $sql .= " AND DATE(v.fecha_hora_inicio) >= ?";
            $params[] = $filtros['fecha_inicio'];
        }

        if (!empty($filtros['fecha_fin'])) {
            $sql .= " AND DATE(v.fecha_hora_inicio) <= ?";
            $params[] = $filtros['fecha_fin'];
        }

        if (!empty($filtros['cliente_id'])) {
            $sql .= " AND c.id = ?";
            $params[] = $filtros['cliente_id'];
        }

        if (!empty($filtros['tipo_cliente'])) {
            $sql .= " AND c.tipo_cliente = ?";
            $params[] = $filtros['tipo_cliente'];
        }

        $sql .= " GROUP BY c.id, c.nombre, c.apellido, c.telefono, c.tipo_cliente, c.estado
                  ORDER BY total_viajes DESC";

        return $this->db->fetchAll($sql, $params);
    }

    /**
     * Obtener métricas de clientes
     */
    public function obtenerMetricas($fechaInicio, $fechaFin)
    {
        $sql = "SELECT 
                    COUNT(DISTINCT c.id) as total_clientes,
                    COUNT(DISTINCT CASE WHEN v.id IS NOT NULL THEN c.id END) as clientes_activos,
                    COUNT(DISTINCT CASE WHEN c.tipo_cliente = 'corporativo' THEN c.id END) as clientes_corporativos,
                    COUNT(DISTINCT CASE WHEN c.tipo_cliente = 'frecuente' THEN c.id END) as clientes_frecuentes
                FROM clientes c
                LEFT JOIN viajes v ON c.id = v.cliente_id 
                    AND DATE(v.fecha_hora_inicio) BETWEEN ? AND ?
                    AND v.estado = 'completado'
                WHERE c.estado = 'activo'";

        return $this->db->fetch($sql, [$fechaInicio, $fechaFin]);
    }

    /**
     * Listar clientes activos
     */
    public function listarActivos()
    {
        return $this->db->fetchAll(
            "SELECT c.*, CONCAT(c.nombre, ' ', COALESCE(c.apellido, '')) as nombre_completo
             FROM clientes c 
             WHERE c.estado = 'activo'
             ORDER BY c.nombre, c.apellido"
        );
    }
}
