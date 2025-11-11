<?php

/**
 * Modelo PagoTarifaDiaria - Sistema PRIMERO DE JUNIO
 */
class PagoTarifaDiaria extends Model
{
    protected $table = 'pagos_tarifa_diaria';
    protected $fillable = [
        'conductor_id',
        'fecha_pago',
        'monto_tarifa',
        'metodo_pago',
        'registrado_por',
        'observaciones',
        'estado'
    ];

    public function registrarPago($conductorId, $datosRegistro, $usuarioRegistra)
    {
        // Verificar si ya existe un pago para esta fecha
        $fecha = $datosRegistro['fecha_pago'] ?? date('Y-m-d');
        $pagoExistente = $this->obtenerPagoPorFecha($conductorId, $fecha);
        
        if ($pagoExistente && $pagoExistente['estado'] == 'pagado') {
            throw new Exception("Ya existe un pago registrado para esta fecha");
        }

        $datos = [
            'conductor_id' => $conductorId,
            'fecha_pago' => $fecha,
            'monto_tarifa' => $datosRegistro['monto_tarifa'] ?? $this->obtenerMontoTarifaDiaria(),
            'metodo_pago' => $datosRegistro['metodo_pago'] ?? 'efectivo',
            'registrado_por' => $usuarioRegistra,
            'observaciones' => $datosRegistro['observaciones'] ?? '',
            'estado' => 'pagado'
        ];

        if ($pagoExistente) {
            return $this->update($pagoExistente['id'], $datos);
        } else {
            return $this->create($datos);
        }
    }

    public function obtenerPagoPorFecha($conductorId, $fecha)
    {
        return $this->db->fetch(
            "SELECT ptd.*, c.nombre as conductor_nombre, c.apellido as conductor_apellido,
                    u.nombre as registrado_por_nombre
             FROM pagos_tarifa_diaria ptd
             INNER JOIN conductores c ON ptd.conductor_id = c.id
             LEFT JOIN usuarios u ON ptd.registrado_por = u.id
             WHERE ptd.conductor_id = ? AND ptd.fecha_pago = ?",
            [$conductorId, $fecha]
        );
    }

    public function verificarPagoHoy($conductorId)
    {
        $hoy = date('Y-m-d');
        $pago = $this->obtenerPagoPorFecha($conductorId, $hoy);
        
        return [
            'ha_pagado' => $pago && $pago['estado'] == 'pagado',
            'puede_trabajar' => $this->puedeTrabajar($conductorId),
            'pago_info' => $pago
        ];
    }

    public function puedeTrabajar($conductorId)
    {
        // Verificar si la tarifa diaria es obligatoria
        $configuracion = new Configuracion();
        $esObligatoria = $configuracion->obtener('tarifa_diaria_obligatoria', true);
        
        if (!$esObligatoria) {
            return true;
        }

        $pago = $this->verificarPagoHoy($conductorId);
        return $pago['ha_pagado'];
    }

    public function obtenerPendientesPorFecha($fecha = null)
    {
        if (!$fecha) {
            $fecha = date('Y-m-d');
        }

        return $this->db->fetchAll(
            "SELECT c.id, c.nombre, c.apellido, c.documento_identidad, c.telefono,
                    ptd.estado, ptd.fecha_pago
             FROM conductores c
             LEFT JOIN pagos_tarifa_diaria ptd ON c.id = ptd.conductor_id AND ptd.fecha_pago = ?
             WHERE c.estado = 'activo' AND (ptd.estado IS NULL OR ptd.estado = 'pendiente')
             ORDER BY c.nombre, c.apellido",
            [$fecha]
        );
    }

    public function obtenerPagadosPorFecha($fecha = null)
    {
        if (!$fecha) {
            $fecha = date('Y-m-d');
        }

        return $this->db->fetchAll(
            "SELECT ptd.*, c.nombre as conductor_nombre, c.apellido as conductor_apellido,
                    c.documento_identidad, u.nombre as registrado_por_nombre
             FROM pagos_tarifa_diaria ptd
             INNER JOIN conductores c ON ptd.conductor_id = c.id
             LEFT JOIN usuarios u ON ptd.registrado_por = u.id
             WHERE ptd.fecha_pago = ? AND ptd.estado = 'pagado'
             ORDER BY ptd.fecha_registro DESC",
            [$fecha]
        );
    }

    public function obtenerResumenDiario($fecha = null)
    {
        if (!$fecha) {
            $fecha = date('Y-m-d');
        }

        $totalConductores = $this->db->fetch(
            "SELECT COUNT(*) as total FROM conductores WHERE estado = 'activo'"
        )['total'];

        $pagados = $this->db->fetch(
            "SELECT COUNT(*) as total, SUM(monto_tarifa) as total_recaudado
             FROM pagos_tarifa_diaria 
             WHERE fecha_pago = ? AND estado = 'pagado'",
            [$fecha]
        );

        $pendientes = $totalConductores - ($pagados['total'] ?? 0);

        return [
            'fecha' => $fecha,
            'total_conductores' => $totalConductores,
            'pagados' => $pagados['total'] ?? 0,
            'pendientes' => $pendientes,
            'total_recaudado' => $pagados['total_recaudado'] ?? 0,
            'porcentaje_cumplimiento' => $totalConductores > 0 ? round((($pagados['total'] ?? 0) / $totalConductores) * 100, 2) : 0
        ];
    }

    public function marcarComoPendiente($conductorId, $fecha = null, $usuarioRegistra = null)
    {
        if (!$fecha) {
            $fecha = date('Y-m-d');
        }

        $pagoExistente = $this->obtenerPagoPorFecha($conductorId, $fecha);
        
        $datos = [
            'conductor_id' => $conductorId,
            'fecha_pago' => $fecha,
            'monto_tarifa' => $this->obtenerMontoTarifaDiaria(),
            'estado' => 'pendiente'
        ];

        if ($usuarioRegistra) {
            $datos['registrado_por'] = $usuarioRegistra;
        }

        if ($pagoExistente) {
            return $this->update($pagoExistente['id'], ['estado' => 'pendiente']);
        } else {
            return $this->create($datos);
        }
    }

    public function exonerar($conductorId, $fecha, $motivo, $usuarioRegistra)
    {
        $pagoExistente = $this->obtenerPagoPorFecha($conductorId, $fecha);
        
        $datos = [
            'estado' => 'exonerado',
            'observaciones' => $motivo,
            'registrado_por' => $usuarioRegistra
        ];

        if ($pagoExistente) {
            return $this->update($pagoExistente['id'], $datos);
        } else {
            $datos['conductor_id'] = $conductorId;
            $datos['fecha_pago'] = $fecha;
            $datos['monto_tarifa'] = 0;
            return $this->create($datos);
        }
    }

    public function obtenerHistorialConductor($conductorId, $fechaInicio = null, $fechaFin = null)
    {
        $sql = "SELECT ptd.*, u.nombre as registrado_por_nombre
                FROM pagos_tarifa_diaria ptd
                LEFT JOIN usuarios u ON ptd.registrado_por = u.id
                WHERE ptd.conductor_id = ?";
        
        $params = [$conductorId];

        if ($fechaInicio) {
            $sql .= " AND ptd.fecha_pago >= ?";
            $params[] = $fechaInicio;
        }

        if ($fechaFin) {
            $sql .= " AND ptd.fecha_pago <= ?";
            $params[] = $fechaFin;
        }

        $sql .= " ORDER BY ptd.fecha_pago DESC";

        return $this->db->fetchAll($sql, $params);
    }

    public function obtenerEstadisticasMensuales($mes = null, $ano = null)
    {
        if (!$mes) $mes = date('m');
        if (!$ano) $ano = date('Y');

        return $this->db->fetchAll(
            "SELECT 
                DAY(fecha_pago) as dia,
                COUNT(*) as total_pagos,
                SUM(CASE WHEN estado = 'pagado' THEN 1 ELSE 0 END) as pagados,
                SUM(CASE WHEN estado = 'pendiente' THEN 1 ELSE 0 END) as pendientes,
                SUM(CASE WHEN estado = 'exonerado' THEN 1 ELSE 0 END) as exonerados,
                SUM(CASE WHEN estado = 'pagado' THEN monto_tarifa ELSE 0 END) as recaudado
             FROM pagos_tarifa_diaria 
             WHERE MONTH(fecha_pago) = ? AND YEAR(fecha_pago) = ?
             GROUP BY DAY(fecha_pago)
             ORDER BY DAY(fecha_pago)",
            [$mes, $ano]
        );
    }

    public function obtenerRecaudacionPeriodo($fechaInicio, $fechaFin)
    {
        return $this->db->fetch(
            "SELECT 
                COUNT(*) as total_registros,
                SUM(CASE WHEN estado = 'pagado' THEN monto_tarifa ELSE 0 END) as total_recaudado,
                COUNT(CASE WHEN estado = 'pagado' THEN 1 END) as total_pagados,
                COUNT(CASE WHEN estado = 'pendiente' THEN 1 END) as total_pendientes,
                COUNT(CASE WHEN estado = 'exonerado' THEN 1 END) as total_exonerados,
                AVG(CASE WHEN estado = 'pagado' THEN monto_tarifa ELSE NULL END) as promedio_pago
             FROM pagos_tarifa_diaria 
             WHERE fecha_pago BETWEEN ? AND ?",
            [$fechaInicio, $fechaFin]
        );
    }

    public function obtenerMontoTarifaDiaria()
    {
        $configuracion = new Configuracion();
        return $configuracion->obtener('tarifa_diaria_monto', 15000);
    }

    public function actualizarMontoTarifaDiaria($nuevoMonto)
    {
        $configuracion = new Configuracion();
        return $configuracion->establecer('tarifa_diaria_monto', $nuevoMonto, 'integer');
    }

    public function buscar($termino, $fecha = null)
    {
        $sql = "SELECT ptd.*, c.nombre as conductor_nombre, c.apellido as conductor_apellido,
                       c.documento_identidad, u.nombre as registrado_por_nombre
                FROM pagos_tarifa_diaria ptd
                INNER JOIN conductores c ON ptd.conductor_id = c.id
                LEFT JOIN usuarios u ON ptd.registrado_por = u.id
                WHERE (c.nombre LIKE ? OR c.apellido LIKE ? OR c.documento_identidad LIKE ?)";
        
        $params = ["%$termino%", "%$termino%", "%$termino%"];

        if ($fecha) {
            $sql .= " AND ptd.fecha_pago = ?";
            $params[] = $fecha;
        }

        $sql .= " ORDER BY ptd.fecha_pago DESC, c.nombre";

        return $this->db->fetchAll($sql, $params);
    }

    public function obtenerMorosos($diasAtraso = 1)
    {
        $fechaLimite = date('Y-m-d', strtotime("-$diasAtraso days"));
        
        return $this->db->fetchAll(
            "SELECT c.*, 
                    COUNT(ptd.id) as dias_sin_pagar,
                    MAX(ptd.fecha_pago) as ultimo_pago
             FROM conductores c
             LEFT JOIN pagos_tarifa_diaria ptd ON c.id = ptd.conductor_id 
                 AND ptd.estado = 'pagado' 
                 AND ptd.fecha_pago >= ?
             WHERE c.estado = 'activo'
             GROUP BY c.id
             HAVING COUNT(ptd.id) = 0
             ORDER BY c.nombre, c.apellido",
            [$fechaLimite]
        );
    }

    public function generarReporteDiario($fecha)
    {
        return [
            'resumen' => $this->obtenerResumenDiario($fecha),
            'pagados' => $this->obtenerPagadosPorFecha($fecha),
            'pendientes' => $this->obtenerPendientesPorFecha($fecha),
            'configuracion' => [
                'monto_tarifa' => $this->obtenerMontoTarifaDiaria(),
                'fecha_reporte' => $fecha
            ]
        ];
    }

    /**
     * Obtener pagos del día
     */
    public function obtenerPagosDelDia($fecha)
    {
        $sql = "SELECT ptd.*, c.nombre as conductor_nombre, c.apellido as conductor_apellido,
                       u.nombre as registrado_por_nombre
                FROM {$this->table} ptd
                INNER JOIN conductores c ON ptd.conductor_id = c.id
                LEFT JOIN usuarios u ON ptd.registrado_por = u.id
                WHERE ptd.fecha_pago = ?
                ORDER BY ptd.estado, c.nombre";
        return $this->db->fetchAll($sql, [$fecha]);
    }

    /**
     * Obtener estadísticas del día
     */
    public function obtenerEstadisticasDia($fecha)
    {
        return $this->obtenerResumenDiario($fecha);
    }
}