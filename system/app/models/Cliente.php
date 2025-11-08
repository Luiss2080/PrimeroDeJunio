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

    public function obtenerHistorialViajes($clienteId, $limite = 20)
    {
        return $this->db->fetchAll(
            "SELECT v.*, c.nombre as conductor_nombre, c.apellido as conductor_apellido,
                    ve.placa, ve.marca, ve.modelo
             FROM viajes v
             INNER JOIN conductores c ON v.conductor_id = c.id
             INNER JOIN vehiculos ve ON v.vehiculo_id = ve.id
             WHERE v.cliente_id = ?
             ORDER BY v.fecha_hora_inicio DESC
             LIMIT ?",
            [$clienteId, $limite]
        );
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
}