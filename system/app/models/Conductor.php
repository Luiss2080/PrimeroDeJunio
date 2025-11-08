<?php

/**
 * Modelo Conductor - Sistema PRIMERO DE JUNIO
 */
class Conductor extends Model
{
    protected $table = 'conductores';
    protected $fillable = [
        'usuario_id',
        'nombre',
        'apellido',
        'cedula',
        'telefono',
        'direccion',
        'fecha_nacimiento',
        'licencia_numero',
        'licencia_categoria',
        'licencia_vigencia',
        'experiencia_anos',
        'foto',
        'estado',
        'fecha_ingreso',
        'observaciones'
    ];

    public function obtenerConUsuario($id)
    {
        return $this->db->fetch(
            "SELECT c.*, u.email, u.avatar 
             FROM conductores c 
             LEFT JOIN usuarios u ON c.usuario_id = u.id 
             WHERE c.id = ?",
            [$id]
        );
    }

    public function obtenerTodos($incluirInactivos = false)
    {
        $sql = "SELECT c.*, u.email, u.avatar 
                FROM conductores c 
                LEFT JOIN usuarios u ON c.usuario_id = u.id";
        
        if (!$incluirInactivos) {
            $sql .= " WHERE c.estado = 'activo'";
        }
        
        $sql .= " ORDER BY c.nombre, c.apellido";

        return $this->db->fetchAll($sql);
    }

    public function buscarPorCedula($cedula)
    {
        return $this->findBy('cedula', $cedula);
    }

    public function buscarPorLicencia($licencia)
    {
        return $this->findBy('licencia_numero', $licencia);
    }

    public function obtenerEstadisticas()
    {
        $stats = [
            'total' => $this->count(),
            'activos' => $this->count(['estado' => 'activo']),
            'inactivos' => $this->count(['estado' => 'inactivo']),
            'suspendidos' => $this->count(['estado' => 'suspendido'])
        ];

        // Estadísticas de experiencia
        $stats['por_experiencia'] = [
            'novatos' => $this->db->fetch("SELECT COUNT(*) as count FROM conductores WHERE experiencia_anos <= 2 AND estado = 'activo'")['count'],
            'experimentados' => $this->db->fetch("SELECT COUNT(*) as count FROM conductores WHERE experiencia_anos BETWEEN 3 AND 7 AND estado = 'activo'")['count'],
            'veteranos' => $this->db->fetch("SELECT COUNT(*) as count FROM conductores WHERE experiencia_anos > 7 AND estado = 'activo'")['count']
        ];

        // Licencias próximas a vencer (30 días)
        $stats['licencias_por_vencer'] = $this->db->fetch(
            "SELECT COUNT(*) as count FROM conductores 
             WHERE licencia_vigencia <= DATE_ADD(NOW(), INTERVAL 30 DAY) 
             AND licencia_vigencia >= NOW() 
             AND estado = 'activo'"
        )['count'];

        return $stats;
    }

    public function buscar($termino)
    {
        return $this->db->fetchAll(
            "SELECT c.*, u.email 
             FROM conductores c 
             LEFT JOIN usuarios u ON c.usuario_id = u.id 
             WHERE c.nombre LIKE ? OR c.apellido LIKE ? OR c.cedula LIKE ? 
             OR c.telefono LIKE ? OR c.licencia_numero LIKE ?
             ORDER BY c.nombre, c.apellido",
            ["%$termino%", "%$termino%", "%$termino%", "%$termino%", "%$termino%"]
        );
    }

    public function activar($id)
    {
        return $this->update($id, ['estado' => 'activo']);
    }

    public function desactivar($id)
    {
        return $this->update($id, ['estado' => 'inactivo']);
    }

    public function suspender($id, $observaciones = '')
    {
        return $this->update($id, [
            'estado' => 'suspendido',
            'observaciones' => $observaciones
        ]);
    }

    public function obtenerViajesRealizados($conductorId, $fechaInicio = null, $fechaFin = null)
    {
        $sql = "SELECT COUNT(*) as total_viajes, SUM(valor_total) as total_ingresos 
                FROM viajes 
                WHERE conductor_id = ? AND estado = 'completado'";
        
        $params = [$conductorId];

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

    public function obtenerVehiculoAsignado($conductorId)
    {
        return $this->db->fetch(
            "SELECT v.*, av.turno, av.hora_inicio, av.hora_fin, av.dias_semana 
             FROM vehiculos v 
             INNER JOIN asignaciones_vehiculo av ON v.id = av.vehiculo_id 
             WHERE av.conductor_id = ? AND av.estado = 'activa'",
            [$conductorId]
        );
    }

    public function obtenerHistorialVehiculos($conductorId)
    {
        return $this->db->fetchAll(
            "SELECT v.placa, v.marca, v.modelo, av.fecha_inicio, av.fecha_fin, av.turno 
             FROM vehiculos v 
             INNER JOIN asignaciones_vehiculo av ON v.id = av.vehiculo_id 
             WHERE av.conductor_id = ? 
             ORDER BY av.fecha_inicio DESC",
            [$conductorId]
        );
    }

    public function obtenerLicenciasPorVencer($dias = 30)
    {
        return $this->db->fetchAll(
            "SELECT c.*, DATEDIFF(c.licencia_vigencia, NOW()) as dias_restantes 
             FROM conductores c 
             WHERE c.licencia_vigencia <= DATE_ADD(NOW(), INTERVAL ? DAY) 
             AND c.licencia_vigencia >= NOW() 
             AND c.estado = 'activo'
             ORDER BY c.licencia_vigencia ASC",
            [$dias]
        );
    }

    public function obtenerCalificacionPromedio($conductorId)
    {
        return $this->db->fetch(
            "SELECT AVG(calificacion) as promedio, COUNT(*) as total_calificaciones 
             FROM viajes 
             WHERE conductor_id = ? AND calificacion IS NOT NULL",
            [$conductorId]
        );
    }

    public function obtenerTopConductores($limite = 10, $fechaInicio = null, $fechaFin = null)
    {
        $sql = "SELECT c.*, COUNT(v.id) as total_viajes, 
                       SUM(v.valor_total) as total_ingresos,
                       AVG(v.calificacion) as calificacion_promedio
                FROM conductores c 
                INNER JOIN viajes v ON c.id = v.conductor_id 
                WHERE v.estado = 'completado' AND c.estado = 'activo'";
        
        $params = [];

        if ($fechaInicio) {
            $sql .= " AND v.fecha_hora_inicio >= ?";
            $params[] = $fechaInicio;
        }

        if ($fechaFin) {
            $sql .= " AND v.fecha_hora_inicio <= ?";
            $params[] = $fechaFin;
        }

        $sql .= " GROUP BY c.id 
                  ORDER BY total_viajes DESC, total_ingresos DESC 
                  LIMIT ?";
        
        $params[] = $limite;

        return $this->db->fetchAll($sql, $params);
    }
}