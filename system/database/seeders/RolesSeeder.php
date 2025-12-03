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
                'descripcion' => 'Administrador del sistema con acceso completo a todas las funciones',
                'permisos' => [
                    'usuarios' => ['crear' => true, 'editar' => true, 'eliminar' => true, 'listar' => true, 'cambiar_rol' => true],
                    'conductores' => ['crear' => true, 'editar' => true, 'eliminar' => true, 'listar' => true, 'activar_inactivar' => true],
                    'vehiculos' => ['crear' => true, 'editar' => true, 'eliminar' => true, 'listar' => true, 'asignar' => true],
                    'viajes' => ['crear' => true, 'editar' => true, 'eliminar' => true, 'listar' => true, 'todos' => true],
                    'clientes' => ['crear' => true, 'editar' => true, 'eliminar' => true, 'listar' => true],
                    'tarifas' => ['crear' => true, 'editar' => true, 'eliminar' => true, 'listar' => true],
                    'configuracion' => ['editar' => true, 'sistema' => true, 'empresa' => true, 'seguridad' => true],
                    'reportes' => ['ventas' => true, 'conductores' => true, 'vehiculos' => true, 'financiero' => true, 'exportar' => true],
                    'mantenimientos' => ['crear' => true, 'editar' => true, 'eliminar' => true, 'listar' => true, 'programar' => true],
                    'pagos' => ['crear' => true, 'editar' => true, 'listar' => true, 'confirmar' => true, 'exonerar' => true],
                    'dashboard' => ['admin' => true, 'estadisticas' => true, 'alertas' => true]
                ],
                'estado' => 'activo',
            ],
            [
                'nombre' => 'operador',
                'descripcion' => 'Operador con acceso a gestión diaria y registros operativos',
                'permisos' => [
                    'usuarios' => ['crear' => false, 'editar' => false, 'eliminar' => false, 'listar' => true, 'cambiar_rol' => false],
                    'conductores' => ['crear' => true, 'editar' => true, 'eliminar' => false, 'listar' => true, 'activar_inactivar' => false],
                    'vehiculos' => ['crear' => false, 'editar' => true, 'eliminar' => false, 'listar' => true, 'asignar' => true],
                    'viajes' => ['crear' => true, 'editar' => true, 'eliminar' => false, 'listar' => true, 'todos' => true],
                    'clientes' => ['crear' => true, 'editar' => true, 'eliminar' => false, 'listar' => true],
                    'tarifas' => ['crear' => false, 'editar' => false, 'eliminar' => false, 'listar' => true],
                    'configuracion' => ['editar' => false, 'sistema' => false, 'empresa' => false, 'seguridad' => false],
                    'reportes' => ['ventas' => true, 'conductores' => true, 'vehiculos' => true, 'financiero' => false, 'exportar' => false],
                    'mantenimientos' => ['crear' => true, 'editar' => true, 'eliminar' => false, 'listar' => true, 'programar' => true],
                    'pagos' => ['crear' => true, 'editar' => false, 'listar' => true, 'confirmar' => false, 'exonerar' => false],
                    'dashboard' => ['admin' => false, 'estadisticas' => true, 'alertas' => true]
                ],
                'estado' => 'activo',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
