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

    public function obtenerConUsuario($id = null)
    {
        if ($id !== null) {
            return $this->db->fetch(
                "SELECT c.*, u.email, u.avatar 
                 FROM conductores c 
                 LEFT JOIN usuarios u ON c.usuario_id = u.id 
                 WHERE c.id = ?",
                [$id]
            );
        }
        
        return $this->db->fetchAll(
            "SELECT c.*, u.email, u.avatar 
             FROM conductores c 
             LEFT JOIN usuarios u ON c.usuario_id = u.id 
             ORDER BY c.nombre, c.apellido"
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

    /**
     * Obtener conductores activos
     */
    public function obtenerActivos()
    {
        return $this->where(['estado' => 'activo'], 'nombre, apellido');
    }

    /**
     * Obtener conductores disponibles (sin vehículo asignado)
     */
    public function obtenerDisponibles()
    {
        return $this->db->fetchAll(
            "SELECT c.* FROM conductores c 
             LEFT JOIN asignaciones_vehiculo av ON c.id = av.conductor_id AND av.estado = 'activa'
             WHERE c.estado = 'activo' AND av.id IS NULL
             ORDER BY c.nombre, c.apellido"
        );
    }

    /**
     * Obtener estadísticas de viajes de un conductor
     */
    public function obtenerEstadisticasViajes($conductorId, $fechaInicio = null, $fechaFin = null)
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
     * Asignar vehículo a conductor
     */
    public function asignarVehiculo($conductorId, $vehiculoId, $fechaAsignacion, $turno = 'diurno')
    {
        // Primero desasignar vehículo actual si existe
        $this->db->execute(
            "UPDATE asignaciones_vehiculo SET estado = 'inactiva', fecha_fin = NOW() 
             WHERE conductor_id = ? AND estado = 'activa'",
            [$conductorId]
        );

        // Crear nueva asignación
        return $this->db->insert(
            "INSERT INTO asignaciones_vehiculo (conductor_id, vehiculo_id, turno, fecha_inicio, estado) 
             VALUES (?, ?, ?, ?, 'activa')",
            [$conductorId, $vehiculoId, $turno, $fechaAsignacion]
        );
    }

    /**
     * Desasignar vehículo de conductor
     */
    public function desasignarVehiculo($conductorId)
    {
        return $this->db->execute(
            "UPDATE asignaciones_vehiculo SET estado = 'inactiva', fecha_fin = NOW() 
             WHERE conductor_id = ? AND estado = 'activa'",
            [$conductorId]
        );
    }

    /**
     * Obtener licencias próximas a vencer
     */
    public function obtenerLicenciasProximasVencer($dias = 30)
    {
        return $this->obtenerLicenciasPorVencer($dias);
    }

    /**
     * Verificar si se puede eliminar un conductor
     */
    public function puedeEliminar($id)
    {
        $viajes = $this->db->fetch(
            "SELECT COUNT(*) as count FROM viajes WHERE conductor_id = ?",
            [$id]
        );
        
        return $viajes['count'] == 0;
    }

    /**
     * Obtener campos buscables
     */
    protected function getSearchableFields()
    {
        return ['nombre', 'apellido', 'cedula', 'telefono', 'licencia_numero'];
    }

    /**
     * Obtener estadísticas de actividad por período
     */
    public function obtenerEstadisticasActividad($periodo, $fecha = null)
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

        return $this->db->fetchAll(
            "SELECT c.id, c.nombre, c.apellido,
                    COUNT(v.id) as total_viajes,
                    SUM(CASE WHEN v.estado = 'completado' THEN 1 ELSE 0 END) as viajes_completados
             FROM conductores c
             LEFT JOIN viajes v ON c.id = v.conductor_id 
             AND DATE(v.fecha_hora_inicio) BETWEEN ? AND ?
             WHERE c.estado = 'activo'
             GROUP BY c.id",
            [$fechaInicio, $fechaFin]
        );
    }

    /**
     * Obtener días para vencimiento de licencia
     */
    public function diasParaVencimientoLicencia($conductorId)
    {
        $conductor = $this->find($conductorId);
        if (!$conductor || empty($conductor['licencia_vigencia'])) {
            return null;
        }

        $hoy = new DateTime();
        $vencimiento = new DateTime($conductor['licencia_vigencia']);
        
        if ($vencimiento < $hoy) {
            return -1; // Ya venció
        }

        return $hoy->diff($vencimiento)->days;
    }

    /**
     * Obtener conductores activos en un período
     */
    public function obtenerConductoresActivosPeriodo($periodo, $fecha = null)
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
            "SELECT COUNT(DISTINCT v.conductor_id) as cantidad
             FROM viajes v
             INNER JOIN conductores c ON v.conductor_id = c.id
             WHERE DATE(v.fecha_hora_inicio) BETWEEN ? AND ?
             AND c.estado = 'activo'",
            [$fechaInicio, $fechaFin]
        )['cantidad'];
    }
}