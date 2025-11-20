<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'nombre' => 'administrador',
                'descripcion' => 'Administrador del sistema con acceso completo a todas las funciones',
                'permisos' => json_encode([
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
                ]),
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'operador',
                'descripcion' => 'Operador con acceso a gestión diaria y registros operativos',
                'permisos' => json_encode([
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
                ]),
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'conductor',
                'descripcion' => 'Conductor con acceso limitado solo a sus datos y viajes',
                'permisos' => json_encode([
                    'usuarios' => ['crear' => false, 'editar' => false, 'eliminar' => false, 'listar' => false, 'cambiar_rol' => false],
                    'conductores' => ['crear' => false, 'editar' => 'own', 'eliminar' => false, 'listar' => false, 'activar_inactivar' => false],
                    'vehiculos' => ['crear' => false, 'editar' => false, 'eliminar' => false, 'listar' => 'assigned', 'asignar' => false],
                    'viajes' => ['crear' => false, 'editar' => false, 'eliminar' => false, 'listar' => 'own', 'todos' => false],
                    'clientes' => ['crear' => false, 'editar' => false, 'eliminar' => false, 'listar' => false],
                    'tarifas' => ['crear' => false, 'editar' => false, 'eliminar' => false, 'listar' => true],
                    'configuracion' => ['editar' => false, 'sistema' => false, 'empresa' => false, 'seguridad' => false],
                    'reportes' => ['ventas' => false, 'conductores' => false, 'vehiculos' => false, 'financiero' => false, 'exportar' => false],
                    'mantenimientos' => ['crear' => false, 'editar' => false, 'eliminar' => false, 'listar' => 'own', 'programar' => false],
                    'pagos' => ['crear' => false, 'editar' => false, 'listar' => 'own', 'confirmar' => false, 'exonerar' => false],
                    'dashboard' => ['admin' => false, 'estadisticas' => false, 'alertas' => false],
                    'perfil' => ['editar' => true, 'cambiar_password' => true]
                ]),
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'supervisor',
                'descripcion' => 'Supervisor con acceso a monitoreo y control operativo',
                'permisos' => json_encode([
                    'usuarios' => ['crear' => false, 'editar' => false, 'eliminar' => false, 'listar' => true, 'cambiar_rol' => false],
                    'conductores' => ['crear' => false, 'editar' => true, 'eliminar' => false, 'listar' => true, 'activar_inactivar' => true],
                    'vehiculos' => ['crear' => false, 'editar' => true, 'eliminar' => false, 'listar' => true, 'asignar' => true],
                    'viajes' => ['crear' => false, 'editar' => true, 'eliminar' => false, 'listar' => true, 'todos' => true],
                    'clientes' => ['crear' => true, 'editar' => true, 'eliminar' => false, 'listar' => true],
                    'tarifas' => ['crear' => false, 'editar' => false, 'eliminar' => false, 'listar' => true],
                    'configuracion' => ['editar' => false, 'sistema' => false, 'empresa' => false, 'seguridad' => false],
                    'reportes' => ['ventas' => true, 'conductores' => true, 'vehiculos' => true, 'financiero' => true, 'exportar' => true],
                    'mantenimientos' => ['crear' => true, 'editar' => true, 'eliminar' => false, 'listar' => true, 'programar' => true],
                    'pagos' => ['crear' => false, 'editar' => true, 'listar' => true, 'confirmar' => true, 'exonerar' => true],
                    'dashboard' => ['admin' => false, 'estadisticas' => true, 'alertas' => true]
                ]),
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
