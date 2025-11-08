<?php

/**
 * Modelo Perfil - Sistema PRIMERO DE JUNIO
 */
class Perfil extends Model
{
    protected $table = 'perfiles';
    protected $fillable = [
        'usuario_id',
        'avatar',
        'telefono_personal',
        'telefono_emergencia',
        'direccion_residencia',
        'fecha_nacimiento',
        'tipo_sangre',
        'contacto_emergencia_nombre',
        'contacto_emergencia_telefono',
        'observaciones'
    ];

    public function obtenerPorUsuario($usuarioId)
    {
        return $this->db->fetch(
            "SELECT p.*, u.nombre, u.apellido, u.email, u.documento_identidad
             FROM perfiles p
             INNER JOIN usuarios u ON p.usuario_id = u.id
             WHERE p.usuario_id = ?",
            [$usuarioId]
        );
    }

    public function crearOActualizar($usuarioId, $datos)
    {
        $perfilExistente = $this->db->fetch(
            "SELECT id FROM perfiles WHERE usuario_id = ?",
            [$usuarioId]
        );

        $datos['usuario_id'] = $usuarioId;

        if ($perfilExistente) {
            return $this->update($perfilExistente['id'], $datos);
        } else {
            return $this->create($datos);
        }
    }

    public function subirAvatar($usuarioId, $archivo)
    {
        // Esta función se implementaría para manejar la subida de archivos
        // Por ahora solo actualizamos el nombre del archivo
        $nombreArchivo = 'avatar_' . $usuarioId . '_' . time() . '.' . pathinfo($archivo['name'], PATHINFO_EXTENSION);
        
        $perfil = $this->obtenerPorUsuario($usuarioId);
        if ($perfil) {
            return $this->update($perfil['id'], ['avatar' => $nombreArchivo]);
        } else {
            return $this->create([
                'usuario_id' => $usuarioId,
                'avatar' => $nombreArchivo
            ]);
        }
    }

    public function eliminarAvatar($usuarioId)
    {
        $perfil = $this->obtenerPorUsuario($usuarioId);
        if ($perfil) {
            return $this->update($perfil['id'], ['avatar' => null]);
        }
        return false;
    }

    public function obtenerConUsuario()
    {
        return $this->db->fetchAll(
            "SELECT p.*, u.nombre, u.apellido, u.email, u.documento_identidad, u.estado as usuario_estado
             FROM perfiles p
             INNER JOIN usuarios u ON p.usuario_id = u.id
             ORDER BY u.nombre, u.apellido"
        );
    }

    public function buscarPorTelefono($telefono)
    {
        return $this->db->fetchAll(
            "SELECT p.*, u.nombre, u.apellido, u.email
             FROM perfiles p
             INNER JOIN usuarios u ON p.usuario_id = u.id
             WHERE p.telefono_personal LIKE ? OR p.telefono_emergencia LIKE ?",
            ["%$telefono%", "%$telefono%"]
        );
    }

    public function obtenerPorTipoSangre($tipoSangre)
    {
        return $this->db->fetchAll(
            "SELECT p.*, u.nombre, u.apellido, u.email
             FROM perfiles p
             INNER JOIN usuarios u ON p.usuario_id = u.id
             WHERE p.tipo_sangre = ?
             ORDER BY u.nombre, u.apellido",
            [$tipoSangre]
        );
    }

    public function obtenerCumpleanos($mes = null, $dia = null)
    {
        $sql = "SELECT p.*, u.nombre, u.apellido, u.email
                FROM perfiles p
                INNER JOIN usuarios u ON p.usuario_id = u.id
                WHERE p.fecha_nacimiento IS NOT NULL";
        
        $params = [];

        if ($mes !== null) {
            $sql .= " AND MONTH(p.fecha_nacimiento) = ?";
            $params[] = $mes;
        }

        if ($dia !== null) {
            $sql .= " AND DAY(p.fecha_nacimiento) = ?";
            $params[] = $dia;
        }

        $sql .= " ORDER BY MONTH(p.fecha_nacimiento), DAY(p.fecha_nacimiento)";

        return $this->db->fetchAll($sql, $params);
    }

    public function obtenerCumpleanosHoy()
    {
        return $this->obtenerCumpleanos(date('n'), date('j'));
    }

    public function obtenerCumpleanosMes($mes = null)
    {
        if (!$mes) {
            $mes = date('n');
        }
        return $this->obtenerCumpleanos($mes);
    }

    public function calcularEdad($usuarioId)
    {
        $perfil = $this->obtenerPorUsuario($usuarioId);
        
        if (!$perfil || !$perfil['fecha_nacimiento']) {
            return null;
        }

        $fechaNac = new DateTime($perfil['fecha_nacimiento']);
        $fechaActual = new DateTime();
        $edad = $fechaActual->diff($fechaNac);

        return $edad->y;
    }

    public function obtenerEstadisticasEdades()
    {
        $edades = $this->db->fetchAll(
            "SELECT YEAR(CURDATE()) - YEAR(fecha_nacimiento) as edad
             FROM perfiles 
             WHERE fecha_nacimiento IS NOT NULL"
        );

        $stats = [
            'total_con_fecha' => count($edades),
            'edad_promedio' => 0,
            'edad_minima' => null,
            'edad_maxima' => null,
            'rangos' => [
                '18-25' => 0,
                '26-35' => 0,
                '36-45' => 0,
                '46-55' => 0,
                '56+' => 0
            ]
        ];

        if (!empty($edades)) {
            $arrayEdades = array_column($edades, 'edad');
            $stats['edad_promedio'] = round(array_sum($arrayEdades) / count($arrayEdades), 1);
            $stats['edad_minima'] = min($arrayEdades);
            $stats['edad_maxima'] = max($arrayEdades);

            foreach ($arrayEdades as $edad) {
                if ($edad >= 18 && $edad <= 25) {
                    $stats['rangos']['18-25']++;
                } elseif ($edad >= 26 && $edad <= 35) {
                    $stats['rangos']['26-35']++;
                } elseif ($edad >= 36 && $edad <= 45) {
                    $stats['rangos']['36-45']++;
                } elseif ($edad >= 46 && $edad <= 55) {
                    $stats['rangos']['46-55']++;
                } else {
                    $stats['rangos']['56+']++;
                }
            }
        }

        return $stats;
    }

    public function obtenerSinPerfil()
    {
        return $this->db->fetchAll(
            "SELECT u.id, u.nombre, u.apellido, u.email
             FROM usuarios u
             LEFT JOIN perfiles p ON u.id = p.usuario_id
             WHERE p.id IS NULL
             ORDER BY u.nombre, u.apellido"
        );
    }

    public function validarTelefono($telefono)
    {
        // Validación básica de teléfono colombiano
        $patron = '/^(\+57|0057|57)?[1-9]\d{6,9}$/';
        return preg_match($patron, $telefono);
    }

    public function formatearTelefono($telefono)
    {
        // Limpiar el teléfono
        $telefono = preg_replace('/[^0-9]/', '', $telefono);
        
        // Si comienza con 57, quitarlo
        if (substr($telefono, 0, 2) == '57') {
            $telefono = substr($telefono, 2);
        }

        // Formatear según el tipo
        if (strlen($telefono) == 10) {
            // Móvil: 3XX XXX XXXX
            return substr($telefono, 0, 3) . ' ' . substr($telefono, 3, 3) . ' ' . substr($telefono, 6);
        } elseif (strlen($telefono) == 7) {
            // Fijo: XXX XXXX
            return substr($telefono, 0, 3) . ' ' . substr($telefono, 3);
        }

        return $telefono;
    }

    public function buscar($termino)
    {
        return $this->db->fetchAll(
            "SELECT p.*, u.nombre, u.apellido, u.email
             FROM perfiles p
             INNER JOIN usuarios u ON p.usuario_id = u.id
             WHERE u.nombre LIKE ? OR u.apellido LIKE ? 
             OR p.telefono_personal LIKE ? OR p.telefono_emergencia LIKE ?
             OR p.contacto_emergencia_nombre LIKE ?
             ORDER BY u.nombre, u.apellido",
            ["%$termino%", "%$termino%", "%$termino%", "%$termino%", "%$termino%"]
        );
    }

    public function obtenerTiposSangre()
    {
        return ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
    }

    public function obtenerEstadisticasTipoSangre()
    {
        return $this->db->fetchAll(
            "SELECT tipo_sangre, COUNT(*) as total
             FROM perfiles 
             WHERE tipo_sangre IS NOT NULL AND tipo_sangre != ''
             GROUP BY tipo_sangre
             ORDER BY total DESC"
        );
    }
}