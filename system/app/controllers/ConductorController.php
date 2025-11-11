<?php

/**
 * Controlador Conductor - Sistema PRIMERO DE JUNIO
 */
class ConductorController extends Controller
{
    private $conductor;
    private $usuario;
    private $vehiculo;
    private $pagoTarifaDiaria;

    public function __construct()
    {
        parent::__construct();
        $this->conductor = new Conductor();
        $this->usuario = new Usuario();
        $this->vehiculo = new Vehiculo();
        $this->pagoTarifaDiaria = new PagoTarifaDiaria();
    }

    public function index()
    {
        $this->verificarPermiso('conductores.ver');
        
        $filtros = [
            'buscar' => $_GET['buscar'] ?? '',
            'estado' => $_GET['estado'] ?? '',
            'tiene_vehiculo' => $_GET['tiene_vehiculo'] ?? '',
            'activo_hoy' => $_GET['activo_hoy'] ?? ''
        ];

        $conductores = $this->conductor->listarConFiltros($filtros);
        $estadisticas = $this->conductor->obtenerEstadisticas();

        $this->view('admin/conductores/index', [
            'conductores' => $conductores,
            'filtros' => $filtros,
            'estadisticas' => $estadisticas
        ]);
    }

    public function crear()
    {
        $this->verificarPermiso('conductores.crear');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Crear conductor directamente sin usuario
                $datosConductor = [
                    'nombre' => trim($_POST['nombre']),
                    'apellido' => trim($_POST['apellido']),
                    'cedula' => trim($_POST['cedula']),
                    'telefono' => trim($_POST['telefono']),
                    'direccion' => trim($_POST['direccion']),
                    'fecha_nacimiento' => $_POST['fecha_nacimiento'],
                    'licencia_numero' => trim($_POST['licencia_numero']),
                    'licencia_categoria' => $_POST['licencia_categoria'],
                    'licencia_vigencia' => $_POST['licencia_vigencia'],
                    'experiencia_anos' => $_POST['experiencia_anos'] ?? 0,
                    'fecha_ingreso' => $_POST['fecha_ingreso'] ?? date('Y-m-d'),
                    'estado' => $_POST['estado'] ?? 'activo',
                    'observaciones' => trim($_POST['observaciones'] ?? '')
                ];

                // Si se va a crear usuario asociado
                if (isset($_POST['crear_usuario']) && $_POST['crear_usuario'] == '1') {
                    $datosUsuario = [
                        'nombre' => $datosConductor['nombre'],
                        'apellido' => $datosConductor['apellido'],
                        'email' => trim($_POST['email']),
                        'password' => $_POST['password'] ?? $this->generarPasswordTemporal(),
                        'telefono' => $datosConductor['telefono'],
                        'direccion' => $datosConductor['direccion'],
                        'fecha_nacimiento' => $datosConductor['fecha_nacimiento'],
                        'rol_id' => $this->obtenerRolConductor()
                    ];

                    $usuarioId = $this->usuario->create($datosUsuario);
                    $datosConductor['usuario_id'] = $usuarioId;
                }

                $this->conductor->create($datosConductor);

                $this->setFlash('success', 'Conductor creado exitosamente');
                $this->redirect('/admin/conductores');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $this->view('admin/conductores/crear');
    }

    public function editar($id)
    {
        $this->verificarPermiso('conductores.editar');
        
        $conductor = $this->conductor->obtenerConUsuario($id);
        if (!$conductor) {
            $this->setFlash('error', 'Conductor no encontrado');
            $this->redirect('/admin/conductores');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Actualizar datos del conductor
                $datosConductor = [
                    'nombre' => trim($_POST['nombre']),
                    'apellido' => trim($_POST['apellido']),
                    'cedula' => trim($_POST['cedula']),
                    'telefono' => trim($_POST['telefono']),
                    'direccion' => trim($_POST['direccion']),
                    'fecha_nacimiento' => $_POST['fecha_nacimiento'],
                    'licencia_numero' => trim($_POST['licencia_numero']),
                    'licencia_categoria' => $_POST['licencia_categoria'],
                    'licencia_vigencia' => $_POST['licencia_vigencia'],
                    'experiencia_anos' => $_POST['experiencia_anos'],
                    'estado' => $_POST['estado'],
                    'observaciones' => trim($_POST['observaciones'] ?? '')
                ];

                $this->conductor->update($id, $datosConductor);

                // Si hay usuario asociado, actualizar también
                if ($conductor['usuario_id']) {
                    $datosUsuario = [
                        'nombre' => $datosConductor['nombre'],
                        'apellido' => $datosConductor['apellido'],
                        'telefono' => $datosConductor['telefono'],
                        'direccion' => $datosConductor['direccion'],
                        'fecha_nacimiento' => $datosConductor['fecha_nacimiento']
                    ];

                    if (!empty($_POST['email'])) {
                        $datosUsuario['email'] = trim($_POST['email']);
                    }

                    if (!empty($_POST['password'])) {
                        $datosUsuario['password'] = $_POST['password'];
                    }

                    $this->usuario->update($conductor['usuario_id'], $datosUsuario);
                }

                $this->setFlash('success', 'Conductor actualizado exitosamente');
                $this->redirect('/admin/conductores');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $this->view('admin/conductores/editar', ['conductor' => $conductor]);
    }

    public function ver($id)
    {
        $this->verificarPermiso('conductores.ver');
        
        $conductor = $this->conductor->obtenerConUsuario($id);
        if (!$conductor) {
            $this->setFlash('error', 'Conductor no encontrado');
            $this->redirect('/admin/conductores');
            return;
        }

        $vehiculoAsignado = $this->conductor->obtenerVehiculoAsignado($id);
        $estadisticas = $this->conductor->obtenerEstadisticasViajes($id);
        $historialTarifas = $this->pagoTarifaDiaria->obtenerHistorialConductor($id, null, null);
        $pagoHoy = $this->pagoTarifaDiaria->verificarPagoHoy($id);

        $this->view('admin/conductores/ver', [
            'conductor' => $conductor,
            'vehiculo_asignado' => $vehiculoAsignado,
            'estadisticas' => $estadisticas,
            'historial_tarifas' => $historialTarifas,
            'pago_hoy' => $pagoHoy
        ]);
    }

    public function eliminar($id)
    {
        $this->verificarPermiso('conductores.eliminar');
        
        try {
            if (!$this->conductor->puedeEliminar($id)) {
                throw new Exception('No se puede eliminar este conductor porque tiene viajes asociados');
            }

            $conductor = $this->conductor->find($id);
            
            // Si tiene usuario asociado, decidir si eliminarlo también
            if ($conductor && $conductor['usuario_id']) {
                // Por seguridad, solo desactivamos el usuario
                $this->usuario->update($conductor['usuario_id'], ['estado' => 'inactivo']);
            }

            $this->conductor->delete($id);
            
            $this->setFlash('success', 'Conductor eliminado exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/conductores');
    }

    public function asignarVehiculo($id)
    {
        $this->verificarPermiso('conductores.editar');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $vehiculoId = $_POST['vehiculo_id'];
                $fechaAsignacion = $_POST['fecha_asignacion'] ?? date('Y-m-d');
                
                $this->conductor->asignarVehiculo($id, $vehiculoId, $fechaAsignacion);
                $this->setFlash('success', 'Vehículo asignado exitosamente');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
            
            $this->redirect('/admin/conductores/ver/' . $id);
            return;
        }

        $conductor = $this->conductor->find($id);
        $vehiculosDisponibles = $this->vehiculo->obtenerDisponibles();
        
        $this->view('admin/conductores/asignar-vehiculo', [
            'conductor' => $conductor,
            'vehiculos' => $vehiculosDisponibles
        ]);
    }

    public function desasignarVehiculo($id)
    {
        $this->verificarPermiso('conductores.editar');
        
        try {
            $this->conductor->desasignarVehiculo($id);
            $this->setFlash('success', 'Vehículo desasignado exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/conductores/ver/' . $id);
    }

    public function registrarPagoTarifa($id)
    {
        $this->verificarPermiso('conductores.editar');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datosRegistro = [
                    'fecha_pago' => $_POST['fecha_pago'] ?? date('Y-m-d'),
                    'monto_tarifa' => $_POST['monto_tarifa'],
                    'metodo_pago' => $_POST['metodo_pago'] ?? 'efectivo',
                    'observaciones' => $_POST['observaciones'] ?? ''
                ];

                $usuarioActual = $this->getUsuarioActual();
                $this->pagoTarifaDiaria->registrarPago($id, $datosRegistro, $usuarioActual['id']);
                
                $this->setFlash('success', 'Pago de tarifa registrado exitosamente');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $this->redirect('/admin/conductores/ver/' . $id);
    }

    public function activar($id)
    {
        $this->verificarPermiso('conductores.editar');
        
        try {
            $this->conductor->activar($id);
            
            // Si tiene usuario asociado, activarlo también
            $conductor = $this->conductor->find($id);
            if ($conductor && $conductor['usuario_id']) {
                $this->usuario->activar($conductor['usuario_id']);
            }
            
            $this->setFlash('success', 'Conductor activado exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/conductores');
    }

    public function desactivar($id)
    {
        $this->verificarPermiso('conductores.editar');
        
        try {
            $this->conductor->desactivar($id);
            
            // Si tiene usuario asociado, desactivarlo también
            $conductor = $this->conductor->find($id);
            if ($conductor && $conductor['usuario_id']) {
                $this->usuario->desactivar($conductor['usuario_id']);
            }
            
            $this->setFlash('success', 'Conductor desactivado exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/conductores');
    }

    public function controlTarifaDiaria()
    {
        $this->verificarPermiso('conductores.ver');
        
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $resumen = $this->pagoTarifaDiaria->obtenerResumenDiario($fecha);
        $pagados = $this->pagoTarifaDiaria->obtenerPagadosPorFecha($fecha);
        $pendientes = $this->pagoTarifaDiaria->obtenerPendientesPorFecha($fecha);

        $this->view('admin/conductores/tarifa-diaria', [
            'fecha' => $fecha,
            'resumen' => $resumen,
            'pagados' => $pagados,
            'pendientes' => $pendientes
        ]);
    }

    public function registrarPagos()
    {
        $this->verificarPermiso('conductores.editar');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $fecha = $_POST['fecha'] ?? date('Y-m-d');
                $conductoresPagados = $_POST['conductores_pagados'] ?? [];
                $conductoresExonerados = $_POST['conductores_exonerados'] ?? [];
                $usuarioActual = $this->getUsuarioActual();

                $registrados = 0;
                
                // Registrar pagos
                foreach ($conductoresPagados as $conductorId) {
                    $datosRegistro = [
                        'fecha_pago' => $fecha,
                        'monto_tarifa' => $this->pagoTarifaDiaria->obtenerMontoTarifaDiaria(),
                        'metodo_pago' => 'efectivo'
                    ];
                    
                    $this->pagoTarifaDiaria->registrarPago($conductorId, $datosRegistro, $usuarioActual['id']);
                    $registrados++;
                }

                // Registrar exoneraciones
                foreach ($conductoresExonerados as $conductorId => $motivo) {
                    $this->pagoTarifaDiaria->exonerar($conductorId, $fecha, $motivo, $usuarioActual['id']);
                    $registrados++;
                }

                $this->setFlash('success', "Se registraron $registrados pagos de tarifa diaria");
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $this->redirect('/admin/conductores/tarifa-diaria');
    }

    public function buscar()
    {
        $this->verificarPermiso('conductores.ver');
        
        $termino = $_GET['q'] ?? '';
        $conductores = [];
        
        if (strlen($termino) >= 2) {
            $conductores = $this->conductor->buscar($termino);
        }

        $this->jsonResponse($conductores);
    }

    public function exportar()
    {
        $this->verificarPermiso('conductores.ver');
        
        $conductores = $this->conductor->obtenerConUsuario();
        $this->jsonResponse($conductores);
    }

    public function estadisticas()
    {
        $this->verificarPermiso('conductores.ver');
        
        $stats = $this->conductor->obtenerEstadisticas();
        $this->jsonResponse($stats);
    }

    public function licenciasVencer()
    {
        $this->verificarPermiso('conductores.ver');
        
        $dias = $_GET['dias'] ?? 30;
        $licenciasVencer = $this->conductor->obtenerLicenciasProximasVencer($dias);
        
        $this->view('admin/conductores/licencias-vencer', [
            'licencias' => $licenciasVencer,
            'dias' => $dias
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

    private function obtenerRolConductor()
    {
        $rol = new Rol();
        $rolConductor = $rol->obtenerPorNombre('Conductor');
        return $rolConductor ? $rolConductor['id'] : null;
    }

    private function generarPasswordTemporal()
    {
        return 'temp' . rand(1000, 9999);
    }
}