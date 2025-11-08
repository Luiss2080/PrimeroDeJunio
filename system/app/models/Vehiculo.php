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
}