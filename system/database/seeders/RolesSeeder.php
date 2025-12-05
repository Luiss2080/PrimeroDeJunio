<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'nombre' => 'administrador',
                'slug' => 'administrador',
                'descripcion' => 'Administrador del sistema con acceso completo a todas las funciones',
                'color' => '#DC2626',
                'icono' => 'shield-check',
                'permisos' => [
                    'usuarios' => ['crear', 'editar', 'eliminar', 'listar', 'cambiar_rol'],
                    'conductores' => ['crear', 'editar', 'eliminar', 'listar', 'activar_inactivar'],
                    'vehiculos' => ['crear', 'editar', 'eliminar', 'listar', 'asignar'],
                    'viajes' => ['crear', 'editar', 'eliminar', 'listar', 'todos'],
                    'clientes' => ['crear', 'editar', 'eliminar', 'listar'],
                    'tarifas' => ['crear', 'editar', 'eliminar', 'listar'],
                    'configuracion' => ['editar', 'sistema', 'empresa', 'seguridad'],
                    'reportes' => ['ventas', 'conductores', 'vehiculos', 'financiero', 'exportar'],
                    'mantenimientos' => ['crear', 'editar', 'eliminar', 'listar', 'programar'],
                    'pagos' => ['crear', 'editar', 'listar', 'confirmar', 'exonerar'],
                    'dashboard' => ['admin', 'estadisticas', 'alertas'],
                    'logs' => ['ver', 'exportar', 'eliminar']
                ],
                'modulos_acceso' => ['usuarios', 'conductores', 'vehiculos', 'viajes', 'clientes', 'tarifas', 'configuracion', 'reportes', 'mantenimientos', 'pagos', 'logs'],
                'nivel_jerarquia' => 10,
                'es_super_admin' => true,
                'puede_crear_usuarios' => true,
                'puede_ver_reportes' => true,
                'estado' => 'activo',
                'es_sistema' => true,
            ],
            [
                'nombre' => 'supervisor',
                'slug' => 'supervisor', 
                'descripcion' => 'Supervisor con permisos de gestión y supervisión operativa',
                'color' => '#2563EB',
                'icono' => 'user-check',
                'permisos' => [
                    'usuarios' => ['listar', 'editar'],
                    'conductores' => ['crear', 'editar', 'listar', 'activar_inactivar'],
                    'vehiculos' => ['crear', 'editar', 'listar', 'asignar'],
                    'viajes' => ['crear', 'editar', 'listar', 'todos'],
                    'clientes' => ['crear', 'editar', 'listar'],
                    'tarifas' => ['listar', 'editar'],
                    'reportes' => ['ventas', 'conductores', 'vehiculos', 'exportar'],
                    'mantenimientos' => ['crear', 'editar', 'listar', 'programar'],
                    'pagos' => ['crear', 'editar', 'listar', 'confirmar'],
                    'dashboard' => ['estadisticas', 'alertas']
                ],
                'modulos_acceso' => ['conductores', 'vehiculos', 'viajes', 'clientes', 'reportes', 'mantenimientos', 'pagos'],
                'nivel_jerarquia' => 7,
                'puede_crear_usuarios' => false,
                'puede_ver_reportes' => true,
                'estado' => 'activo',
            ],
            [
                'nombre' => 'operador',
                'slug' => 'operador',
                'descripcion' => 'Operador con acceso a gestión diaria y registros operativos',
                'color' => '#059669',
                'icono' => 'user-cog',
                'permisos' => [
                    'conductores' => ['crear', 'editar', 'listar'],
                    'vehiculos' => ['editar', 'listar', 'asignar'],
                    'viajes' => ['crear', 'editar', 'listar'],
                    'clientes' => ['crear', 'editar', 'listar'],
                    'tarifas' => ['listar'],
                    'reportes' => ['ventas', 'conductores', 'vehiculos'],
                    'mantenimientos' => ['crear', 'editar', 'listar'],
                    'pagos' => ['crear', 'listar'],
                    'dashboard' => ['estadisticas']
                ],
                'modulos_acceso' => ['conductores', 'vehiculos', 'viajes', 'clientes', 'mantenimientos', 'pagos'],
                'nivel_jerarquia' => 5,
                'puede_ver_reportes' => true,
                'estado' => 'activo',
            ],
            [
                'nombre' => 'conductor',
                'slug' => 'conductor',
                'descripcion' => 'Conductor con acceso limitado a sus propios datos y viajes',
                'color' => '#F59E0B',
                'icono' => 'truck',
                'permisos' => [
                    'viajes' => ['listar', 'ver_propios'],
                    'vehiculos' => ['ver_asignado'],
                    'perfil' => ['editar', 'cambiar_password'],
                    'documentos' => ['ver_propios', 'subir'],
                    'pagos' => ['ver_propios'],
                    'dashboard' => ['conductor']
                ],
                'modulos_acceso' => ['viajes', 'perfil', 'documentos', 'pagos'],
                'nivel_jerarquia' => 2,
                'puede_ver_reportes' => false,
                'estado' => 'activo',
            ],
            [
                'nombre' => 'cliente',
                'slug' => 'cliente',
                'descripcion' => 'Cliente con acceso a solicitar viajes y ver historial',
                'color' => '#8B5CF6',
                'icono' => 'user',
                'permisos' => [
                    'viajes' => ['crear', 'ver_propios', 'calificar'],
                    'perfil' => ['editar', 'cambiar_password'],
                    'dashboard' => ['cliente']
                ],
                'modulos_acceso' => ['viajes', 'perfil'],
                'nivel_jerarquia' => 1,
                'puede_ver_reportes' => false,
                'estado' => 'activo',
            ],
        ];

        foreach ($roles as $roleData) {
            Role::updateOrCreate(
                ['nombre' => $roleData['nombre']], 
                $roleData
            );
        }
    }
}
