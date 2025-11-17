<?php

/**
 * Modelo Tarifa - Sistema PRIMERO DE JUNIO
 */
class Tarifa extends Model
{
    protected $table = 'tarifas';
    protected $fillable = [
        'nombre',
        'descripcion',
        'tarifa_base',
        'tarifa_por_km',
        'tarifa_por_minuto',
        'tarifa_minima',
        'tarifa_maxima',
        'recargo_nocturno',
        'recargo_festivo',
        'recargo_lluvia',
        'hora_inicio_nocturno',
        'hora_fin_nocturno',
        'estado',
        'fecha_vigencia_inicio',
        'fecha_vigencia_fin'
    ];

    public function obtenerActivas()
    {
        return $this->where([
            'estado' => 'activa'
        ], 'nombre ASC');
    }

    public function obtenerVigentes($fecha = null)
    {
        if (!$fecha) {
            $fecha = date('Y-m-d');
        }

        return $this->db->fetchAll(
            "SELECT * FROM tarifas 
             WHERE estado = 'activa' 
             AND fecha_vigencia_inicio <= ? 
             AND (fecha_vigencia_fin IS NULL OR fecha_vigencia_fin >= ?)
             ORDER BY nombre",
            [$fecha, $fecha]
        );
    }

    public function obtenerPorDefecto()
    {
        return $this->db->fetch(
            "SELECT * FROM tarifas 
             WHERE estado = 'activa' 
             AND fecha_vigencia_inicio <= CURDATE() 
             AND (fecha_vigencia_fin IS NULL OR fecha_vigencia_fin >= CURDATE())
             ORDER BY fecha_vigencia_inicio ASC 
             LIMIT 1"
        );
    }

    public function calcularTarifa($tarifaId, $distanciaKm, $duracionMinutos, $opciones = [])
    {
        $tarifa = $this->find($tarifaId);
        if (!$tarifa) {
            throw new Exception("Tarifa no encontrada");
        }

        // Cálculo base
        $valorBase = $tarifa['tarifa_base'];
        $valorKm = $distanciaKm * $tarifa['tarifa_por_km'];
        $valorMinutos = $duracionMinutos * $tarifa['tarifa_por_minuto'];

        $valorCalculado = $valorBase + $valorKm + $valorMinutos;

        // Aplicar tarifa mínima
        if ($valorCalculado < $tarifa['tarifa_minima']) {
            $valorCalculado = $tarifa['tarifa_minima'];
        }

        // Aplicar tarifa máxima si existe
        if ($tarifa['tarifa_maxima'] && $valorCalculado > $tarifa['tarifa_maxima']) {
            $valorCalculado = $tarifa['tarifa_maxima'];
        }

        $recargos = 0;

        // Recargo nocturno
        if (isset($opciones['es_nocturno']) && $opciones['es_nocturno']) {
            $recargos += $valorCalculado * ($tarifa['recargo_nocturno'] / 100);
        }

        // Recargo festivo
        if (isset($opciones['es_festivo']) && $opciones['es_festivo']) {
            $recargos += $valorCalculado * ($tarifa['recargo_festivo'] / 100);
        }

        // Recargo por lluvia
        if (isset($opciones['hay_lluvia']) && $opciones['hay_lluvia']) {
            $recargos += $valorCalculado * ($tarifa['recargo_lluvia'] / 100);
        }

        return [
            'valor_base' => $valorCalculado,
            'recargos' => $recargos,
            'valor_total' => $valorCalculado + $recargos,
            'tarifa_aplicada' => $tarifa
        ];
    }

    public function esHorarioNocturno($hora, $tarifaId)
    {
        $tarifa = $this->find($tarifaId);
        if (!$tarifa) {
            return false;
        }

        $horaInicio = $tarifa['hora_inicio_nocturno'];
        $horaFin = $tarifa['hora_fin_nocturno'];

        // Convertir a formato comparable
        $horaActual = date('H:i:s', strtotime($hora));

        // Si la hora de fin es menor que la de inicio, significa que cruza medianoche
        if ($horaFin < $horaInicio) {
            return $horaActual >= $horaInicio || $horaActual <= $horaFin;
        } else {
            return $horaActual >= $horaInicio && $horaActual <= $horaFin;
        }
    }

    public function activar($id)
    {
        return $this->update($id, ['estado' => 'activa']);
    }

    public function desactivar($id)
    {
        return $this->update($id, ['estado' => 'inactiva']);
    }

    public function obtenerEstadisticas()
    {
        $stats = [
            'total' => $this->count(),
            'activas' => $this->count(['estado' => 'activa']),
            'inactivas' => $this->count(['estado' => 'inactiva'])
        ];

        // Tarifa más utilizada
        $masUtilizada = $this->db->fetch(
            "SELECT t.nombre, COUNT(v.id) as uso_count 
             FROM tarifas t 
             INNER JOIN viajes v ON t.id = v.tarifa_aplicada_id 
             GROUP BY t.id 
             ORDER BY uso_count DESC 
             LIMIT 1"
        );

        $stats['mas_utilizada'] = $masUtilizada;

        return $stats;
    }

    public function duplicar($tarifaId, $nuevoNombre)
    {
        $tarifa = $this->find($tarifaId);
        if (!$tarifa) {
            throw new Exception("Tarifa original no encontrada");
        }

        unset($tarifa['id']);
        unset($tarifa['created_at']);
        unset($tarifa['updated_at']);

        $tarifa['nombre'] = $nuevoNombre;
        $tarifa['estado'] = 'inactiva';
        $tarifa['fecha_vigencia_inicio'] = date('Y-m-d');
        $tarifa['fecha_vigencia_fin'] = null;

        return $this->create($tarifa);
    }

    public function obtenerHistorialUso($tarifaId, $fechaInicio = null, $fechaFin = null)
    {
        $sql = "SELECT DATE(v.fecha_hora_inicio) as fecha,
                       COUNT(v.id) as viajes_count,
                       SUM(v.valor_total) as ingresos_total,
                       AVG(v.valor_total) as valor_promedio
                FROM viajes v 
                WHERE v.tarifa_aplicada_id = ? AND v.estado = 'completado'";

        $params = [$tarifaId];

        if ($fechaInicio) {
            $sql .= " AND DATE(v.fecha_hora_inicio) >= ?";
            $params[] = $fechaInicio;
        }

        if ($fechaFin) {
            $sql .= " AND DATE(v.fecha_hora_inicio) <= ?";
            $params[] = $fechaFin;
        }

        $sql .= " GROUP BY DATE(v.fecha_hora_inicio)
                  ORDER BY fecha DESC";

        return $this->db->fetchAll($sql, $params);
    }

    public function compararTarifas($tarifa1Id, $tarifa2Id, $distanciaKm, $duracionMinutos)
    {
        $tarifa1 = $this->calcularTarifa($tarifa1Id, $distanciaKm, $duracionMinutos);
        $tarifa2 = $this->calcularTarifa($tarifa2Id, $distanciaKm, $duracionMinutos);

        return [
            'tarifa1' => $tarifa1,
            'tarifa2' => $tarifa2,
            'diferencia' => $tarifa1['valor_total'] - $tarifa2['valor_total'],
            'porcentaje_diferencia' => (($tarifa1['valor_total'] - $tarifa2['valor_total']) / $tarifa2['valor_total']) * 100
        ];
    }

    public function obtenerRangosPrecios()
    {
        return $this->db->fetch(
            "SELECT 
                MIN(tarifa_minima) as precio_minimo,
                MAX(tarifa_maxima) as precio_maximo,
                AVG(tarifa_base) as precio_base_promedio,
                AVG(tarifa_por_km) as precio_km_promedio
             FROM tarifas 
             WHERE estado = 'activa'"
        );
    }

    public function buscar($termino)
    {
        return $this->db->fetchAll(
            "SELECT * FROM tarifas 
             WHERE nombre LIKE ? OR descripcion LIKE ?
             ORDER BY nombre",
            ["%$termino%", "%$termino%"]
        );
    }

    public function buscarPorNombre($nombre)
    {
        return $this->db->fetch(
            "SELECT * FROM tarifas WHERE nombre = ?",
            [$nombre]
        );
    }

    public function listarConFiltros($filtros = [])
    {
        $sql = "SELECT * FROM tarifas WHERE 1=1";
        $params = [];

        if (!empty($filtros['buscar'])) {
            $sql .= " AND (nombre LIKE ? OR descripcion LIKE ?)";
            $params[] = "%{$filtros['buscar']}%";
            $params[] = "%{$filtros['buscar']}%";
        }

        if (!empty($filtros['estado'])) {
            $sql .= " AND estado = ?";
            $params[] = $filtros['estado'];
        }

        $sql .= " ORDER BY created_at DESC";

        return $this->db->fetchAll($sql, $params);
    }

    public function listarActivas()
    {
        return $this->db->fetchAll(
            "SELECT * FROM tarifas WHERE estado = 'activa' ORDER BY nombre"
        );
    }

    public function verificarUsoEnViajes($tarifaId)
    {
        $result = $this->db->fetch(
            "SELECT COUNT(*) as count FROM viajes WHERE tarifa_aplicada_id = ?",
            [$tarifaId]
        );
        return $result['count'];
    }

    public function calcularPrecio($tarifa, $distancia, $tiempoMinutos, $esNocturno = false, $esFestivo = false, $hayLluvia = false)
    {
        // Cálculo base
        $valorBase = floatval($tarifa['tarifa_base']);
        $valorKm = $distancia * floatval($tarifa['tarifa_por_km']);
        $valorMinutos = $tiempoMinutos * floatval($tarifa['tarifa_por_minuto']);

        $subtotal = $valorBase + $valorKm + $valorMinutos;

        // Aplicar tarifa mínima
        if ($subtotal < floatval($tarifa['tarifa_minima'])) {
            $subtotal = floatval($tarifa['tarifa_minima']);
        }

        // Aplicar tarifa máxima si existe
        if (floatval($tarifa['tarifa_maxima']) > 0 && $subtotal > floatval($tarifa['tarifa_maxima'])) {
            $subtotal = floatval($tarifa['tarifa_maxima']);
        }

        $recargos = [];
        $totalRecargos = 0;

        // Recargo nocturno
        if ($esNocturno && floatval($tarifa['recargo_nocturno']) > 0) {
            $recargoNocturno = $subtotal * (floatval($tarifa['recargo_nocturno']) / 100);
            $recargos['nocturno'] = $recargoNocturno;
            $totalRecargos += $recargoNocturno;
        }

        // Recargo festivo
        if ($esFestivo && floatval($tarifa['recargo_festivo']) > 0) {
            $recargoFestivo = $subtotal * (floatval($tarifa['recargo_festivo']) / 100);
            $recargos['festivo'] = $recargoFestivo;
            $totalRecargos += $recargoFestivo;
        }

        // Recargo por lluvia
        if ($hayLluvia && floatval($tarifa['recargo_lluvia']) > 0) {
            $recargoLluvia = $subtotal * (floatval($tarifa['recargo_lluvia']) / 100);
            $recargos['lluvia'] = $recargoLluvia;
            $totalRecargos += $recargoLluvia;
        }

        $total = $subtotal + $totalRecargos;

        return [
            'tarifa_base' => $valorBase,
            'valor_km' => $valorKm,
            'valor_minutos' => $valorMinutos,
            'subtotal' => $subtotal,
            'recargos' => $recargos,
            'total_recargos' => $totalRecargos,
            'total' => $total,
            'desglose' => [
                'distancia_km' => $distancia,
                'duracion_minutos' => $tiempoMinutos,
                'es_nocturno' => $esNocturno,
                'es_festivo' => $esFestivo,
                'hay_lluvia' => $hayLluvia
            ]
        ];
    }
}
