<?php

/**
 * Modelo Usuario - Sistema PRIMERO DE JUNIO
 */
class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'password',
        'telefono',
        'direccion',
        'fecha_nacimiento',
        'avatar',
        'rol_id',
        'estado',
        'ultimo_acceso'
    ];

    public function crearUsuario($data)
    {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        return $this->create($data);
    }

    public function buscarPorEmail($email)
    {
        return $this->findBy('email', $email);
    }

    public function obtenerConRol($id)
    {
        return $this->db->fetch(
            "SELECT u.*, r.nombre as rol_nombre, r.descripcion as rol_descripcion 
             FROM usuarios u 
             LEFT JOIN roles r ON u.rol_id = r.id 
             WHERE u.id = ?",
            [$id]
        );
    }

    public function obtenerPorRol($rolId)
    {
        return $this->where(['rol_id' => $rolId, 'estado' => 'activo']);
    }

    public function obtenerEstadisticas()
    {
        $stats = [
            'total' => $this->count(),
            'activos' => $this->count(['estado' => 'activo']),
            'inactivos' => $this->count(['estado' => 'inactivo']),
            'pendientes' => $this->count(['estado' => 'pendiente'])
        ];

        // Estadísticas por rol
        $roles = $this->db->fetchAll("SELECT id, nombre FROM roles WHERE estado = 'activo'");
        foreach ($roles as $rol) {
            $stats['por_rol'][$rol['nombre']] = $this->count(['rol_id' => $rol['id'], 'estado' => 'activo']);
        }

        return $stats;
    }

    public function buscar($termino, $rol = null)
    {
        $sql = "SELECT u.*, r.nombre as rol_nombre 
                FROM usuarios u 
                LEFT JOIN roles r ON u.rol_id = r.id 
                WHERE (u.nombre LIKE ? OR u.apellido LIKE ? OR u.email LIKE ? OR u.telefono LIKE ?)";

        $params = ["%$termino%", "%$termino%", "%$termino%", "%$termino%"];

        if ($rol) {
            $sql .= " AND u.rol_id = ?";
            $params[] = $rol;
        }

        $sql .= " ORDER BY u.nombre, u.apellido";

        return $this->db->fetchAll($sql, $params);
    }

    public function activar($id)
    {
        return $this->update($id, ['estado' => 'activo']);
    }

    public function desactivar($id)
    {
        return $this->update($id, ['estado' => 'inactivo']);
    }

    public function actualizarUltimoAcceso($id)
    {
        return $this->update($id, ['ultimo_acceso' => date('Y-m-d H:i:s')]);
    }

    public function generarTokenRecuperacion($email)
    {
        $token = bin2hex(random_bytes(32));
        $expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $usuario = $this->buscarPorEmail($email);
        if ($usuario) {
            $this->update($usuario['id'], [
                'token_recuperacion' => $token,
                'token_expiracion' => $expiracion
            ]);
            return $token;
        }

        return false;
    }

    public function validarTokenRecuperacion($token)
    {
        return $this->db->fetch(
            "SELECT * FROM usuarios WHERE token_recuperacion = ? AND token_expiracion > NOW()",
            [$token]
        );
    }

    public function obtenerAdministradores()
    {
        return $this->db->fetchAll(
            "SELECT u.* FROM usuarios u 
             INNER JOIN roles r ON u.rol_id = r.id 
             WHERE r.nombre = 'administrador' AND u.estado = 'activo'"
        );
    }

    public function obtenerOperadores()
    {
        return $this->db->fetchAll(
            "SELECT u.* FROM usuarios u 
             INNER JOIN roles r ON u.rol_id = r.id 
             WHERE r.nombre = 'operador' AND u.estado = 'activo'"
        );
    }

    public function obtenerConductoresUsuarios()
    {
        return $this->db->fetchAll(
            "SELECT u.*, c.cedula, c.licencia_numero 
             FROM usuarios u 
             INNER JOIN roles r ON u.rol_id = r.id 
             LEFT JOIN conductores c ON u.id = c.usuario_id
             WHERE r.nombre = 'conductor' AND u.estado = 'activo'"
        );
    }

    /**
     * Obtener usuarios con sus roles
     */
    public function obtenerConRoles()
    {
        return $this->db->fetchAll(
            "SELECT u.*, r.nombre as rol_nombre, r.descripcion as rol_descripcion 
             FROM usuarios u 
             LEFT JOIN roles r ON u.rol_id = r.id 
             ORDER BY u.nombre, u.apellido"
        );
    }

    /**
     * Obtener distribución de usuarios por roles
     */
    public function obtenerDistribucionRoles()
    {
        return $this->db->fetchAll(
            "SELECT r.nombre as rol, COUNT(u.id) as cantidad
             FROM roles r
             LEFT JOIN usuarios u ON r.id = u.rol_id AND u.estado = 'activo'
             WHERE r.estado = 'activo'
             GROUP BY r.id, r.nombre
             ORDER BY cantidad DESC"
        );
    }

    /**
     * Obtener actividad reciente de usuarios
     */
    public function obtenerActividadReciente($limite = 10)
    {
        return $this->db->fetchAll(
            "SELECT u.*, r.nombre as rol_nombre, u.ultimo_acceso
             FROM usuarios u 
             LEFT JOIN roles r ON u.rol_id = r.id 
             WHERE u.estado = 'activo' AND u.ultimo_acceso IS NOT NULL
             ORDER BY u.ultimo_acceso DESC
             LIMIT ?",
            [$limite]
        );
    }

    /**
     * Verificar si se puede eliminar un usuario
     */
    public function puedeEliminar($id)
    {
        // Verificar si tiene viajes asociados como conductor
        $viajesConductor = $this->db->fetch(
            "SELECT COUNT(*) as count FROM viajes v
             INNER JOIN conductores c ON v.conductor_id = c.id
             WHERE c.usuario_id = ?",
            [$id]
        );

        return $viajesConductor['count'] == 0;
    }

    /**
     * Buscar usuario por nombre de usuario
     */
    public function buscarPorNombreUsuario($nombreUsuario)
    {
        $sql = "SELECT * FROM {$this->table} WHERE usuario = ?";
        return $this->db->fetch($sql, [$nombreUsuario]);
    }

    /**
     * Verificar contraseña
     */
    public function verificarPassword($usuarioId, $password)
    {
        $sql = "SELECT password FROM {$this->table} WHERE id = ?";
        $result = $this->db->fetch($sql, [$usuarioId]);

        if (!$result) {
            return false;
        }

        return password_verify($password, $result['password']);
    }

    /**
     * Actualizar contraseña
     */
    public function actualizarPassword($usuarioId, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE {$this->table} SET password = ?, updated_at = NOW() WHERE id = ?";
        return $this->db->execute($sql, [$passwordHash, $usuarioId]);
    }

    /**
     * Obtener usuarios recientes
     */
    public function obtenerRecientes($limite = 5)
    {
        $sql = "SELECT * FROM {$this->table} 
                WHERE estado = 'activo' 
                ORDER BY created_at DESC 
                LIMIT ?";
        return $this->db->fetchAll($sql, [$limite]);
    }

    /**
     * Obtener campos buscables
     */
    protected function getSearchableFields()
    {
        return ['nombre', 'apellido', 'email', 'telefono'];
    }
}
