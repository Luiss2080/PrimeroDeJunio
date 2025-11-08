<?php

/**
 * Modelo Permiso - Sistema PRIMERO DE JUNIO
 */
class Permiso extends Model
{
    protected $table = 'permisos';
    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria',
        'estado'
    ];

    public function obtenerActivos()
    {
        return $this->where(['estado' => 'activo'], 'categoria ASC, nombre ASC');
    }

    public function obtenerPorCategoria()
    {
        $permisos = $this->obtenerActivos();
        $agrupados = [];

        foreach ($permisos as $permiso) {
            $categoria = $permiso['categoria'];
            if (!isset($agrupados[$categoria])) {
                $agrupados[$categoria] = [];
            }
            $agrupados[$categoria][] = $permiso;
        }

        return $agrupados;
    }

    public function obtenerCategorias()
    {
        return $this->db->fetchAll(
            "SELECT DISTINCT categoria 
             FROM permisos 
             WHERE estado = 'activo' 
             ORDER BY categoria"
        );
    }

    public function obtenerRoles($permisoId)
    {
        return $this->db->fetchAll(
            "SELECT r.* 
             FROM roles r
             INNER JOIN rol_permisos rp ON r.id = rp.rol_id
             WHERE rp.permiso_id = ? AND r.estado = 'activo'
             ORDER BY r.nombre",
            [$permisoId]
        );
    }

    public function contarRoles($permisoId)
    {
        $resultado = $this->db->fetch(
            "SELECT COUNT(*) as total 
             FROM rol_permisos 
             WHERE permiso_id = ?",
            [$permisoId]
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
        $rolesCount = $this->contarRoles($id);
        return $rolesCount == 0;
    }

    public function delete($id)
    {
        if (!$this->puedeEliminar($id)) {
            throw new Exception("No se puede eliminar el permiso porque está asignado a roles");
        }

        return parent::delete($id);
    }

    public function obtenerEstadisticas()
    {
        $stats = [
            'total' => $this->count(),
            'activos' => $this->count(['estado' => 'activo']),
            'inactivos' => $this->count(['estado' => 'inactivo'])
        ];

        // Contar por categoría
        $porCategoria = $this->db->fetchAll(
            "SELECT categoria, COUNT(*) as total
             FROM permisos 
             WHERE estado = 'activo'
             GROUP BY categoria
             ORDER BY total DESC"
        );

        $stats['por_categoria'] = $porCategoria;

        // Permiso más asignado
        $masAsignado = $this->db->fetch(
            "SELECT p.nombre, COUNT(rp.rol_id) as asignaciones
             FROM permisos p
             LEFT JOIN rol_permisos rp ON p.id = rp.permiso_id
             WHERE p.estado = 'activo'
             GROUP BY p.id
             ORDER BY asignaciones DESC
             LIMIT 1"
        );

        $stats['mas_asignado'] = $masAsignado;

        return $stats;
    }

    public function crearPermisosBasicos()
    {
        $permisosBasicos = [
            // Gestión de Usuarios
            ['nombre' => 'usuarios.ver', 'descripcion' => 'Ver usuarios', 'categoria' => 'Usuarios'],
            ['nombre' => 'usuarios.crear', 'descripcion' => 'Crear usuarios', 'categoria' => 'Usuarios'],
            ['nombre' => 'usuarios.editar', 'descripcion' => 'Editar usuarios', 'categoria' => 'Usuarios'],
            ['nombre' => 'usuarios.eliminar', 'descripcion' => 'Eliminar usuarios', 'categoria' => 'Usuarios'],
            
            // Gestión de Conductores
            ['nombre' => 'conductores.ver', 'descripcion' => 'Ver conductores', 'categoria' => 'Conductores'],
            ['nombre' => 'conductores.crear', 'descripcion' => 'Crear conductores', 'categoria' => 'Conductores'],
            ['nombre' => 'conductores.editar', 'descripcion' => 'Editar conductores', 'categoria' => 'Conductores'],
            ['nombre' => 'conductores.eliminar', 'descripcion' => 'Eliminar conductores', 'categoria' => 'Conductores'],
            
            // Gestión de Vehículos
            ['nombre' => 'vehiculos.ver', 'descripcion' => 'Ver vehículos', 'categoria' => 'Vehículos'],
            ['nombre' => 'vehiculos.crear', 'descripcion' => 'Crear vehículos', 'categoria' => 'Vehículos'],
            ['nombre' => 'vehiculos.editar', 'descripcion' => 'Editar vehículos', 'categoria' => 'Vehículos'],
            ['nombre' => 'vehiculos.eliminar', 'descripcion' => 'Eliminar vehículos', 'categoria' => 'Vehículos'],
            
            // Gestión de Clientes
            ['nombre' => 'clientes.ver', 'descripcion' => 'Ver clientes', 'categoria' => 'Clientes'],
            ['nombre' => 'clientes.crear', 'descripcion' => 'Crear clientes', 'categoria' => 'Clientes'],
            ['nombre' => 'clientes.editar', 'descripcion' => 'Editar clientes', 'categoria' => 'Clientes'],
            ['nombre' => 'clientes.eliminar', 'descripcion' => 'Eliminar clientes', 'categoria' => 'Clientes'],
            
            // Gestión de Viajes
            ['nombre' => 'viajes.ver', 'descripcion' => 'Ver viajes', 'categoria' => 'Viajes'],
            ['nombre' => 'viajes.crear', 'descripcion' => 'Crear viajes', 'categoria' => 'Viajes'],
            ['nombre' => 'viajes.editar', 'descripcion' => 'Editar viajes', 'categoria' => 'Viajes'],
            ['nombre' => 'viajes.eliminar', 'descripcion' => 'Eliminar viajes', 'categoria' => 'Viajes'],
            
            // Gestión de Tarifas
            ['nombre' => 'tarifas.ver', 'descripcion' => 'Ver tarifas', 'categoria' => 'Tarifas'],
            ['nombre' => 'tarifas.crear', 'descripcion' => 'Crear tarifas', 'categoria' => 'Tarifas'],
            ['nombre' => 'tarifas.editar', 'descripcion' => 'Editar tarifas', 'categoria' => 'Tarifas'],
            ['nombre' => 'tarifas.eliminar', 'descripcion' => 'Eliminar tarifas', 'categoria' => 'Tarifas'],
            
            // Reportes
            ['nombre' => 'reportes.ver', 'descripcion' => 'Ver reportes', 'categoria' => 'Reportes'],
            ['nombre' => 'reportes.exportar', 'descripcion' => 'Exportar reportes', 'categoria' => 'Reportes'],
            
            // Configuración
            ['nombre' => 'config.ver', 'descripcion' => 'Ver configuración', 'categoria' => 'Configuración'],
            ['nombre' => 'config.editar', 'descripcion' => 'Editar configuración', 'categoria' => 'Configuración'],
            
            // Dashboard
            ['nombre' => 'dashboard.ver', 'descripcion' => 'Ver dashboard', 'categoria' => 'Dashboard'],
            ['nombre' => 'dashboard.admin', 'descripcion' => 'Dashboard administrativo', 'categoria' => 'Dashboard'],
            
            // Roles y Permisos
            ['nombre' => 'roles.ver', 'descripcion' => 'Ver roles', 'categoria' => 'Roles y Permisos'],
            ['nombre' => 'roles.crear', 'descripcion' => 'Crear roles', 'categoria' => 'Roles y Permisos'],
            ['nombre' => 'roles.editar', 'descripcion' => 'Editar roles', 'categoria' => 'Roles y Permisos'],
            ['nombre' => 'roles.eliminar', 'descripcion' => 'Eliminar roles', 'categoria' => 'Roles y Permisos'],
            ['nombre' => 'permisos.ver', 'descripcion' => 'Ver permisos', 'categoria' => 'Roles y Permisos'],
            ['nombre' => 'permisos.crear', 'descripcion' => 'Crear permisos', 'categoria' => 'Roles y Permisos'],
            ['nombre' => 'permisos.editar', 'descripcion' => 'Editar permisos', 'categoria' => 'Roles y Permisos'],
            ['nombre' => 'permisos.eliminar', 'descripcion' => 'Eliminar permisos', 'categoria' => 'Roles y Permisos']
        ];

        foreach ($permisosBasicos as $permiso) {
            // Verificar si ya existe
            $existe = $this->db->fetch(
                "SELECT id FROM permisos WHERE nombre = ?",
                [$permiso['nombre']]
            );

            if (!$existe) {
                $this->create($permiso);
            }
        }

        return true;
    }

    public function buscar($termino)
    {
        return $this->db->fetchAll(
            "SELECT * FROM permisos 
             WHERE nombre LIKE ? OR descripcion LIKE ? OR categoria LIKE ?
             ORDER BY categoria, nombre",
            ["%$termino%", "%$termino%", "%$termino%"]
        );
    }

    public function validarNombreUnico($nombre, $excludeId = null)
    {
        $sql = "SELECT COUNT(*) as total FROM permisos WHERE nombre = ?";
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
            "SELECT * FROM permisos WHERE nombre = ? AND estado = 'activo'",
            [$nombre]
        );
    }

    public function obtenerSinAsignar($rolId)
    {
        return $this->db->fetchAll(
            "SELECT p.* 
             FROM permisos p
             WHERE p.estado = 'activo'
             AND p.id NOT IN (
                 SELECT rp.permiso_id 
                 FROM rol_permisos rp 
                 WHERE rp.rol_id = ?
             )
             ORDER BY p.categoria, p.nombre",
            [$rolId]
        );
    }

    public function cambiarCategoria($permisoId, $nuevaCategoria)
    {
        return $this->update($permisoId, ['categoria' => $nuevaCategoria]);
    }

    public function moverACategoria($permisosIds, $categoria)
    {
        foreach ($permisosIds as $permisoId) {
            $this->cambiarCategoria($permisoId, $categoria);
        }
        return true;
    }
}