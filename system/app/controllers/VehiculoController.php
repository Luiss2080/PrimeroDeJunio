<?php

/**
 * Controlador Vehiculo - Sistema PRIMERO DE JUNIO
 */
class VehiculoController extends Controller
{
    private $vehiculo;
    private $conductor;

    public function __construct()
    {
        parent::__construct();
        $this->vehiculo = new Vehiculo();
        $this->conductor = new Conductor();
    }

    public function index()
    {
        $this->verificarPermiso('vehiculos.ver');
        
        $filtros = [
            'buscar' => $_GET['buscar'] ?? '',
            'estado' => $_GET['estado'] ?? '',
            'tipo' => $_GET['tipo'] ?? '',
            'tiene_conductor' => $_GET['tiene_conductor'] ?? ''
        ];

        $vehiculos = $this->vehiculo->listarConFiltros($filtros);
        $estadisticas = $this->vehiculo->obtenerEstadisticas();

        $this->view('admin/vehiculos/index', [
            'vehiculos' => $vehiculos,
            'filtros' => $filtros,
            'estadisticas' => $estadisticas
        ]);
    }

    public function crear()
    {
        $this->verificarPermiso('vehiculos.crear');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'placa' => strtoupper(trim($_POST['placa'])),
                    'marca' => trim($_POST['marca']),
                    'modelo' => trim($_POST['modelo']),
                    'color' => trim($_POST['color']),
                    'ano' => $_POST['ano'],
                    'cilindraje' => $_POST['cilindraje'],
                    'numero_motor' => trim($_POST['numero_motor']),
                    'numero_chasis' => trim($_POST['numero_chasis']),
                    'propietario_nombre' => trim($_POST['propietario_nombre']),
                    'propietario_cedula' => trim($_POST['propietario_cedula']),
                    'propietario_telefono' => trim($_POST['propietario_telefono'] ?? ''),
                    'seguro_numero' => trim($_POST['seguro_numero'] ?? ''),
                    'seguro_vigencia' => $_POST['seguro_vigencia'] ?? null,
                    'soat_numero' => trim($_POST['soat_numero'] ?? ''),
                    'soat_vigencia' => $_POST['soat_vigencia'] ?? null,
                    'tecnicomecanica_numero' => trim($_POST['tecnicomecanica_numero'] ?? ''),
                    'tecnicomecanica_vigencia' => $_POST['tecnicomecanica_vigencia'] ?? null,
                    'tarjeta_propiedad' => trim($_POST['tarjeta_propiedad'] ?? ''),
                    'estado' => $_POST['estado'] ?? 'activo',
                    'observaciones' => trim($_POST['observaciones'] ?? '')
                ];

                $this->vehiculo->create($datos);
                $this->setFlash('success', 'Vehículo creado exitosamente');
                $this->redirect('/admin/vehiculos');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $this->view('admin/vehiculos/crear');
    }

    public function editar($id)
    {
        $this->verificarPermiso('vehiculos.editar');
        
        $vehiculo = $this->vehiculo->find($id);
        if (!$vehiculo) {
            $this->setFlash('error', 'Vehículo no encontrado');
            $this->redirect('/admin/vehiculos');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'placa' => strtoupper(trim($_POST['placa'])),
                    'marca' => trim($_POST['marca']),
                    'modelo' => trim($_POST['modelo']),
                    'color' => trim($_POST['color']),
                    'ano' => $_POST['ano'],
                    'cilindraje' => $_POST['cilindraje'],
                    'numero_motor' => trim($_POST['numero_motor']),
                    'numero_chasis' => trim($_POST['numero_chasis']),
                    'propietario_nombre' => trim($_POST['propietario_nombre']),
                    'propietario_cedula' => trim($_POST['propietario_cedula']),
                    'propietario_telefono' => trim($_POST['propietario_telefono'] ?? ''),
                    'seguro_numero' => trim($_POST['seguro_numero'] ?? ''),
                    'seguro_vigencia' => $_POST['seguro_vigencia'] ?? null,
                    'soat_numero' => trim($_POST['soat_numero'] ?? ''),
                    'soat_vigencia' => $_POST['soat_vigencia'] ?? null,
                    'tecnicomecanica_numero' => trim($_POST['tecnicomecanica_numero'] ?? ''),
                    'tecnicomecanica_vigencia' => $_POST['tecnicomecanica_vigencia'] ?? null,
                    'tarjeta_propiedad' => trim($_POST['tarjeta_propiedad'] ?? ''),
                    'estado' => $_POST['estado'],
                    'observaciones' => trim($_POST['observaciones'] ?? '')
                ];

                $this->vehiculo->update($id, $datos);
                $this->setFlash('success', 'Vehículo actualizado exitosamente');
                $this->redirect('/admin/vehiculos');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $this->view('admin/vehiculos/editar', ['vehiculo' => $vehiculo]);
    }

    public function ver($id)
    {
        $this->verificarPermiso('vehiculos.ver');
        
        $vehiculo = $this->vehiculo->find($id);
        if (!$vehiculo) {
            $this->setFlash('error', 'Vehículo no encontrado');
            $this->redirect('/admin/vehiculos');
            return;
        }

        $conductorAsignado = $this->vehiculo->obtenerConductorAsignado($id);
        $historialMantenimientos = $this->vehiculo->obtenerHistorialMantenimientos($id);
        $estadisticasViajes = $this->vehiculo->obtenerEstadisticasViajes($id);
        $proximosVencimientos = $this->vehiculo->obtenerProximosVencimientos($id);

        $this->view('admin/vehiculos/ver', [
            'vehiculo' => $vehiculo,
            'conductor_asignado' => $conductorAsignado,
            'mantenimientos' => $historialMantenimientos,
            'estadisticas' => $estadisticasViajes,
            'vencimientos' => $proximosVencimientos
        ]);
    }

    public function eliminar($id)
    {
        $this->verificarPermiso('vehiculos.eliminar');
        
        try {
            if (!$this->vehiculo->puedeEliminar($id)) {
                throw new Exception('No se puede eliminar este vehículo porque tiene viajes asociados');
            }

            $this->vehiculo->delete($id);
            $this->setFlash('success', 'Vehículo eliminado exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/vehiculos');
    }

    public function asignarConductor($id)
    {
        $this->verificarPermiso('vehiculos.editar');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $conductorId = $_POST['conductor_id'];
                $fechaAsignacion = $_POST['fecha_asignacion'] ?? date('Y-m-d');
                
                $this->vehiculo->asignarConductor($id, $conductorId, $fechaAsignacion);
                $this->setFlash('success', 'Conductor asignado exitosamente');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
            
            $this->redirect('/admin/vehiculos/ver/' . $id);
            return;
        }

        $vehiculo = $this->vehiculo->find($id);
        $conductoresDisponibles = $this->conductor->obtenerDisponibles();
        
        $this->view('admin/vehiculos/asignar-conductor', [
            'vehiculo' => $vehiculo,
            'conductores' => $conductoresDisponibles
        ]);
    }

    public function desasignarConductor($id)
    {
        $this->verificarPermiso('vehiculos.editar');
        
        try {
            $this->vehiculo->desasignarConductor($id);
            $this->setFlash('success', 'Conductor desasignado exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/vehiculos/ver/' . $id);
    }

    public function registrarMantenimiento($id)
    {
        $this->verificarPermiso('vehiculos.editar');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'vehiculo_id' => $id,
                    'tipo_mantenimiento' => $_POST['tipo_mantenimiento'],
                    'descripcion' => trim($_POST['descripcion']),
                    'fecha_mantenimiento' => $_POST['fecha_mantenimiento'],
                    'costo' => $_POST['costo'] ?? 0,
                    'taller' => trim($_POST['taller'] ?? ''),
                    'kilometraje_mantenimiento' => $_POST['kilometraje_mantenimiento'] ?? null,
                    'observaciones' => trim($_POST['observaciones'] ?? '')
                ];

                $this->vehiculo->registrarMantenimiento($datos);
                $this->setFlash('success', 'Mantenimiento registrado exitosamente');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $this->redirect('/admin/vehiculos/ver/' . $id);
    }

    public function activar($id)
    {
        $this->verificarPermiso('vehiculos.editar');
        
        try {
            $this->vehiculo->activar($id);
            $this->setFlash('success', 'Vehículo activado exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/vehiculos');
    }

    public function desactivar($id)
    {
        $this->verificarPermiso('vehiculos.editar');
        
        try {
            $this->vehiculo->desactivar($id);
            $this->setFlash('success', 'Vehículo desactivado exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/vehiculos');
    }

    public function mantenimiento($id)
    {
        $this->verificarPermiso('vehiculos.editar');
        
        try {
            $this->vehiculo->marcarEnMantenimiento($id);
            $this->setFlash('success', 'Vehículo marcado en mantenimiento');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/vehiculos');
    }

    public function disponible($id)
    {
        $this->verificarPermiso('vehiculos.editar');
        
        try {
            $this->vehiculo->marcarDisponible($id);
            $this->setFlash('success', 'Vehículo marcado como disponible');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/vehiculos');
    }

    public function vencimientos()
    {
        $this->verificarPermiso('vehiculos.ver');
        
        $dias = $_GET['dias'] ?? 30;
        $vencimientos = $this->vehiculo->obtenerProximosVencimientosTodos($dias);
        
        $this->view('admin/vehiculos/vencimientos', [
            'vencimientos' => $vencimientos,
            'dias' => $dias
        ]);
    }

    public function mantenimientos()
    {
        $this->verificarPermiso('vehiculos.ver');
        
        $vehiculoId = $_GET['vehiculo_id'] ?? null;
        $fechaInicio = $_GET['fecha_inicio'] ?? null;
        $fechaFin = $_GET['fecha_fin'] ?? null;
        
        $mantenimientos = $this->vehiculo->obtenerHistorialMantenimientosTodos($vehiculoId, $fechaInicio, $fechaFin);
        $vehiculos = $this->vehiculo->obtenerTodos();
        
        $this->view('admin/vehiculos/mantenimientos', [
            'mantenimientos' => $mantenimientos,
            'vehiculos' => $vehiculos,
            'filtros' => [
                'vehiculo_id' => $vehiculoId,
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin
            ]
        ]);
    }

    public function actualizarKilometraje($id)
    {
        $this->verificarPermiso('vehiculos.editar');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $nuevoKilometraje = $_POST['kilometraje'];
                $observaciones = trim($_POST['observaciones'] ?? '');
                
                $this->vehiculo->actualizarKilometraje($id, $nuevoKilometraje, $observaciones);
                $this->setFlash('success', 'Kilometraje actualizado exitosamente');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $this->redirect('/admin/vehiculos/ver/' . $id);
    }

    public function buscar()
    {
        $this->verificarPermiso('vehiculos.ver');
        
        $termino = $_GET['q'] ?? '';
        $vehiculos = [];
        
        if (strlen($termino) >= 2) {
            $vehiculos = $this->vehiculo->buscar($termino);
        }

        $this->jsonResponse($vehiculos);
    }

    public function exportar()
    {
        $this->verificarPermiso('vehiculos.ver');
        
        $vehiculos = $this->vehiculo->obtenerTodos();
        $this->jsonResponse($vehiculos);
    }

    public function estadisticas()
    {
        $this->verificarPermiso('vehiculos.ver');
        
        $stats = $this->vehiculo->obtenerEstadisticas();
        $this->jsonResponse($stats);
    }

    public function reporteFlota()
    {
        $this->verificarPermiso('vehiculos.ver');
        
        $estadisticas = $this->vehiculo->obtenerEstadisticas();
        $vencimientos = $this->vehiculo->obtenerProximosVencimientosTodos(30);
        $mantenimientos = $this->vehiculo->obtenerVehiculosMantenimiento();
        $rendimiento = $this->vehiculo->obtenerRendimientoFlota();
        
        $this->view('admin/vehiculos/reporte-flota', [
            'estadisticas' => $estadisticas,
            'vencimientos' => $vencimientos,
            'mantenimientos' => $mantenimientos,
            'rendimiento' => $rendimiento
        ]);
    }

    private function verificarPermiso($permiso)
    {
        if (!$this->tienePermiso($permiso)) {
            $this->setFlash('error', 'No tienes permisos para realizar esta acción');
            $this->redirect('/dashboard');
            exit;
        }
    }
}