<?php

/**
 * Modelo Rol - Sistema PRIMERO DE JUNIO
 */
class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado'
    ];

    public function obtenerActivos()
    {
        return $this->where(['estado' => 'activo'], 'nombre ASC');
    }

    public function obtenerConPermisos()
    {
        return $this->db->fetchAll(
            "SELECT r.*, 
                    GROUP_CONCAT(p.nombre SEPARATOR ', ') as permisos
             FROM roles r
             LEFT JOIN rol_permisos rp ON r.id = rp.rol_id
             LEFT JOIN permisos p ON rp.permiso_id = p.id
             WHERE r.estado = 'activo'
             GROUP BY r.id
             ORDER BY r.nombre"
        );
    }

    public function obtenerPermisos($rolId)
    {
        return $this->db->fetchAll(
            "SELECT p.* 
             FROM permisos p
             INNER JOIN rol_permisos rp ON p.id = rp.permiso_id
             WHERE rp.rol_id = ? AND p.estado = 'activo'
             ORDER BY p.categoria, p.nombre",
            [$rolId]
        );
    }

    public function asignarPermiso($rolId, $permisoId)
    {
        // Verificar si ya existe la relación
        $existe = $this->db->fetch(
            "SELECT id FROM rol_permisos WHERE rol_id = ? AND permiso_id = ?",
            [$rolId, $permisoId]
        );

        if (!$existe) {
            return $this->db->insert('rol_permisos', [
                'rol_id' => $rolId,
                'permiso_id' => $permisoId,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        return true;
    }

    public function removerPermiso($rolId, $permisoId)
    {
        return $this->db->execute(
            'DELETE FROM rol_permisos WHERE rol_id = ? AND permiso_id = ?',
            [$rolId, $permisoId]
        );
    }

    public function sincronizarPermisos($rolId, $permisosIds)
    {
        try {
            // Eliminar permisos actuales
            $this->db->execute('DELETE FROM rol_permisos WHERE rol_id = ?', [$rolId]);

            // Asignar nuevos permisos
            foreach ($permisosIds as $permisoId) {
                $this->asignarPermiso($rolId, $permisoId);
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function tienePermiso($rolId, $permisoNombre)
    {
        $permiso = $this->db->fetch(
            "SELECT COUNT(*) as tiene
             FROM rol_permisos rp
             INNER JOIN permisos p ON rp.permiso_id = p.id
             WHERE rp.rol_id = ? AND p.nombre = ? AND p.estado = 'activo'",
            [$rolId, $permisoNombre]
        );

        return $permiso['tiene'] > 0;
    }

    public function obtenerUsuarios($rolId)
    {
        return $this->db->fetchAll(
            "SELECT u.id, u.nombre, u.apellido, u.email, u.estado
             FROM usuarios u
             WHERE u.rol_id = ?
             ORDER BY u.nombre, u.apellido",
            [$rolId]
        );
    }

    public function contarUsuarios($rolId)
    {
        $resultado = $this->db->fetch(
            "SELECT COUNT(*) as total FROM usuarios WHERE rol_id = ?",
            [$rolId]
        );
        return $resultado['total'];
    }

    public function activar($id)
    {
        return $this->update($id, ['estado' => 'activo']);
    }

    public function desactivar($id)
    {
        return $this->update($id, ['estado' => 'inactivo']);
    }

    public function puedeEliminar($id)
    {
        $usuariosCount = $this->contarUsuarios($id);
        return $usuariosCount == 0;
    }

    public function delete($id)
    {
        if (!$this->puedeEliminar($id)) {
            throw new Exception("No se puede eliminar el rol porque tiene usuarios asignados");
        }

        // Eliminar relaciones con permisos
        $this->db->execute('DELETE FROM rol_permisos WHERE rol_id = ?', [$id]);

        return parent::delete($id);
    }

    public function obtenerEstadisticas()
    {
        $stats = [
            'total' => $this->count(),
            'activos' => $this->count(['estado' => 'activo']),
            'inactivos' => $this->count(['estado' => 'inactivo'])
        ];

        // Rol con más usuarios
        $conMasUsuarios = $this->db->fetch(
            "SELECT r.nombre, COUNT(u.id) as usuarios_count
             FROM roles r
             LEFT JOIN usuarios u ON r.id = u.rol_id
             WHERE r.estado = 'activo'
             GROUP BY r.id
             ORDER BY usuarios_count DESC
             LIMIT 1"
        );

        $stats['con_mas_usuarios'] = $conMasUsuarios;

        // Distribución de usuarios por rol
        $distribucion = $this->db->fetchAll(
            "SELECT r.nombre, COUNT(u.id) as usuarios_count
             FROM roles r
             LEFT JOIN usuarios u ON r.id = u.rol_id
             WHERE r.estado = 'activo'
             GROUP BY r.id
             ORDER BY usuarios_count DESC"
        );

        $stats['distribucion_usuarios'] = $distribucion;

        return $stats;
    }

    public function duplicar($rolId, $nuevoNombre)
    {
        $rol = $this->find($rolId);
        if (!$rol) {
            throw new Exception("Rol original no encontrado");
        }

        // Crear nuevo rol
        $nuevoRol = [
            'nombre' => $nuevoNombre,
            'descripcion' => $rol['descripcion'] . ' (Copia)',
            'estado' => 'inactivo'
        ];

        $nuevoRolId = $this->create($nuevoRol);

        if ($nuevoRolId) {
            // Copiar permisos
            $permisos = $this->obtenerPermisos($rolId);
            foreach ($permisos as $permiso) {
                $this->asignarPermiso($nuevoRolId, $permiso['id']);
            }
        }

        return $nuevoRolId;
    }

    public function obtenerJerarquia()
    {
        $roles = $this->where(['estado' => 'activo'], 'nombre ASC');
        
        // Definir jerarquía básica para mototaxis
        $jerarquia = [
            'Super Administrador' => 1,
            'Administrador' => 2,
            'Operador' => 3,
            'Conductor' => 4
        ];

        foreach ($roles as &$rol) {
            $rol['nivel'] = isset($jerarquia[$rol['nombre']]) ? $jerarquia[$rol['nombre']] : 5;
        }

        usort($roles, function($a, $b) {
            return $a['nivel'] - $b['nivel'];
        });

        return $roles;
    }

    public function buscar($termino)
    {
        return $this->db->fetchAll(
            "SELECT * FROM roles 
             WHERE nombre LIKE ? OR descripcion LIKE ?
             ORDER BY nombre",
            ["%$termino%", "%$termino%"]
        );
    }

    public function validarNombreUnico($nombre, $excludeId = null)
    {
        $sql = "SELECT COUNT(*) as total FROM roles WHERE nombre = ?";
        $params = [$nombre];

        if ($excludeId) {
            $sql .= " AND id != ?";
            $params[] = $excludeId;
        }

        $resultado = $this->db->fetch($sql, $params);
        return $resultado['total'] == 0;
    }

    public function obtenerPorNombre($nombre)
    {
        return $this->db->fetch(
            "SELECT * FROM roles WHERE nombre = ? AND estado = 'activo'",
            [$nombre]
        );
    }

    /**
     * Alias para all() para compatibilidad
     */
    public function obtenerTodos($orderBy = 'nombre ASC')
    {
        return $this->all($orderBy);
    }

    /**
     * Sobrescribir getSearchableFields para búsquedas
     */
    protected function getSearchableFields()
    {
        return ['nombre', 'descripcion'];
    }
}