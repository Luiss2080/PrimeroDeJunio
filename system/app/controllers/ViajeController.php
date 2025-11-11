<?php

/**
 * Controlador Viaje - Sistema PRIMERO DE JUNIO
 */
class ViajeController extends Controller
{
    private $viaje;
    private $conductor;
    private $vehiculo;
    private $cliente;
    private $tarifa;

    public function __construct()
    {
        parent::__construct();
        $this->viaje = new Viaje();
        $this->conductor = new Conductor();
        $this->vehiculo = new Vehiculo();
        $this->cliente = new Cliente();
        $this->tarifa = new Tarifa();
    }

    public function index()
    {
        $this->verificarPermiso('viajes.ver');
        
        $filtros = [
            'buscar' => $_GET['buscar'] ?? '',
            'estado' => $_GET['estado'] ?? '',
            'conductor_id' => $_GET['conductor_id'] ?? '',
            'fecha_inicio' => $_GET['fecha_inicio'] ?? '',
            'fecha_fin' => $_GET['fecha_fin'] ?? ''
        ];

        $viajes = $this->viaje->listarConFiltros($filtros);
        $conductores = $this->conductor->obtenerActivos();
        $estadisticas = $this->viaje->obtenerEstadisticas();

        $this->view('admin/viajes/index', [
            'viajes' => $viajes,
            'conductores' => $conductores,
            'filtros' => $filtros,
            'estadisticas' => $estadisticas
        ]);
    }

    public function crear()
    {
        $this->verificarPermiso('viajes.crear');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'conductor_id' => $_POST['conductor_id'],
                    'vehiculo_id' => $_POST['vehiculo_id'],
                    'cliente_id' => $_POST['cliente_id'] ?? null,
                    'cliente_nombre' => trim($_POST['cliente_nombre'] ?? ''),
                    'cliente_telefono' => trim($_POST['cliente_telefono'] ?? ''),
                    'origen' => trim($_POST['origen']),
                    'destino' => trim($_POST['destino']),
                    'fecha_hora_inicio' => $_POST['fecha_hora_inicio'],
                    'fecha_hora_fin' => $_POST['fecha_hora_fin'] ?? null,
                    'distancia_km' => $_POST['distancia_km'] ?? 0,
                    'duracion_minutos' => $_POST['duracion_minutos'] ?? 0,
                    'tarifa_aplicada_id' => $_POST['tarifa_aplicada_id'],
                    'valor_total' => $_POST['valor_total'],
                    'observaciones' => trim($_POST['observaciones'] ?? ''),
                    'estado' => $_POST['estado'] ?? 'pendiente'
                ];

                // Si no hay cliente seleccionado pero sí datos, crear cliente temporal
                if (!$datos['cliente_id'] && $datos['cliente_nombre']) {
                    $clienteData = [
                        'nombre' => $datos['cliente_nombre'],
                        'telefono' => $datos['cliente_telefono'],
                        'tipo' => 'temporal'
                    ];
                    $datos['cliente_id'] = $this->cliente->create($clienteData);
                }

                $this->viaje->create($datos);
                $this->setFlash('success', 'Viaje creado exitosamente');
                $this->redirect('/admin/viajes');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $conductores = $this->conductor->obtenerActivos();
        $vehiculos = $this->vehiculo->obtenerDisponibles();
        $clientes = $this->cliente->obtenerActivos();
        $tarifas = $this->tarifa->obtenerActivas();

        $this->view('admin/viajes/crear', [
            'conductores' => $conductores,
            'vehiculos' => $vehiculos,
            'clientes' => $clientes,
            'tarifas' => $tarifas
        ]);
    }

    public function editar($id)
    {
        $this->verificarPermiso('viajes.editar');
        
        $viaje = $this->viaje->obtenerCompleto($id);
        if (!$viaje) {
            $this->setFlash('error', 'Viaje no encontrado');
            $this->redirect('/admin/viajes');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'conductor_id' => $_POST['conductor_id'],
                    'vehiculo_id' => $_POST['vehiculo_id'],
                    'cliente_id' => $_POST['cliente_id'] ?? null,
                    'cliente_nombre' => trim($_POST['cliente_nombre'] ?? ''),
                    'cliente_telefono' => trim($_POST['cliente_telefono'] ?? ''),
                    'origen' => trim($_POST['origen']),
                    'destino' => trim($_POST['destino']),
                    'fecha_hora_inicio' => $_POST['fecha_hora_inicio'],
                    'fecha_hora_fin' => $_POST['fecha_hora_fin'] ?? null,
                    'distancia_km' => $_POST['distancia_km'],
                    'duracion_minutos' => $_POST['duracion_minutos'],
                    'tarifa_aplicada_id' => $_POST['tarifa_aplicada_id'],
                    'valor_total' => $_POST['valor_total'],
                    'observaciones' => trim($_POST['observaciones'] ?? ''),
                    'estado' => $_POST['estado']
                ];

                $this->viaje->update($id, $datos);
                $this->setFlash('success', 'Viaje actualizado exitosamente');
                $this->redirect('/admin/viajes');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $conductores = $this->conductor->obtenerActivos();
        $vehiculos = $this->vehiculo->obtenerTodos();
        $clientes = $this->cliente->obtenerActivos();
        $tarifas = $this->tarifa->obtenerActivas();

        $this->view('admin/viajes/editar', [
            'viaje' => $viaje,
            'conductores' => $conductores,
            'vehiculos' => $vehiculos,
            'clientes' => $clientes,
            'tarifas' => $tarifas
        ]);
    }

    public function ver($id)
    {
        $this->verificarPermiso('viajes.ver');
        
        $viaje = $this->viaje->obtenerCompleto($id);
        if (!$viaje) {
            $this->setFlash('error', 'Viaje no encontrado');
            $this->redirect('/admin/viajes');
            return;
        }

        $this->view('admin/viajes/ver', ['viaje' => $viaje]);
    }

    public function eliminar($id)
    {
        $this->verificarPermiso('viajes.eliminar');
        
        try {
            $viaje = $this->viaje->find($id);
            if ($viaje['estado'] === 'en_curso') {
                throw new Exception('No se puede eliminar un viaje en curso');
            }

            $this->viaje->delete($id);
            $this->setFlash('success', 'Viaje eliminado exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/viajes');
    }

    public function iniciar($id)
    {
        $this->verificarPermiso('viajes.editar');
        
        try {
            $this->viaje->iniciar($id);
            $this->setFlash('success', 'Viaje iniciado exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/viajes/ver/' . $id);
    }

    public function completar($id)
    {
        $this->verificarPermiso('viajes.editar');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'fecha_hora_fin' => $_POST['fecha_hora_fin'] ?? date('Y-m-d H:i:s'),
                    'distancia_km' => $_POST['distancia_km'],
                    'duracion_minutos' => $_POST['duracion_minutos'],
                    'valor_total' => $_POST['valor_total'],
                    'observaciones' => trim($_POST['observaciones'] ?? '')
                ];

                $this->viaje->completar($id, $datos);
                $this->setFlash('success', 'Viaje completado exitosamente');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $this->redirect('/admin/viajes/ver/' . $id);
    }

    public function cancelar($id)
    {
        $this->verificarPermiso('viajes.editar');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $motivo = trim($_POST['motivo_cancelacion'] ?? '');
                $this->viaje->cancelar($id, $motivo);
                $this->setFlash('success', 'Viaje cancelado exitosamente');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $this->redirect('/admin/viajes/ver/' . $id);
    }

    public function calcularTarifa()
    {
        $this->verificarPermiso('viajes.crear');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $tarifaId = $_POST['tarifa_id'];
                $distanciaKm = $_POST['distancia_km'];
                $duracionMinutos = $_POST['duracion_minutos'];
                
                $opciones = [
                    'es_nocturno' => isset($_POST['es_nocturno']),
                    'es_festivo' => isset($_POST['es_festivo']),
                    'hay_lluvia' => isset($_POST['hay_lluvia'])
                ];

                $calculo = $this->tarifa->calcularTarifa($tarifaId, $distanciaKm, $duracionMinutos, $opciones);
                $this->jsonResponse($calculo);
            } catch (Exception $e) {
                $this->jsonResponse(['error' => $e->getMessage()], 400);
            }
        }
    }

    public function reporteDiario()
    {
        $this->verificarPermiso('viajes.ver');
        
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $reporte = $this->viaje->obtenerReporteDiario($fecha);
        
        $this->view('admin/viajes/reporte-diario', [
            'fecha' => $fecha,
            'reporte' => $reporte
        ]);
    }

    public function reporteMensual()
    {
        $this->verificarPermiso('viajes.ver');
        
        $mes = $_GET['mes'] ?? date('m');
        $ano = $_GET['ano'] ?? date('Y');
        
        $reporte = $this->viaje->obtenerReporteMensual($mes, $ano);
        
        $this->view('admin/viajes/reporte-mensual', [
            'mes' => $mes,
            'ano' => $ano,
            'reporte' => $reporte
        ]);
    }

    public function reporteConductor($conductorId)
    {
        $this->verificarPermiso('viajes.ver');
        
        $fechaInicio = $_GET['fecha_inicio'] ?? date('Y-m-01');
        $fechaFin = $_GET['fecha_fin'] ?? date('Y-m-d');
        
        $conductor = $this->conductor->find($conductorId);
        if (!$conductor) {
            $this->setFlash('error', 'Conductor no encontrado');
            $this->redirect('/admin/viajes');
            return;
        }

        $estadisticas = $this->viaje->obtenerEstadisticasConductor($conductorId, $fechaInicio, $fechaFin);
        $viajes = $this->viaje->obtenerViajesConductor($conductorId, $fechaInicio, $fechaFin);
        
        $this->view('admin/viajes/reporte-conductor', [
            'conductor' => $conductor,
            'estadisticas' => $estadisticas,
            'viajes' => $viajes,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin
        ]);
    }

    public function buscar()
    {
        $this->verificarPermiso('viajes.ver');
        
        $termino = $_GET['q'] ?? '';
        $viajes = [];
        
        if (strlen($termino) >= 2) {
            $viajes = $this->viaje->buscar($termino);
        }

        $this->jsonResponse($viajes);
    }

    public function exportar()
    {
        $this->verificarPermiso('viajes.ver');
        
        $filtros = [
            'fecha_inicio' => $_GET['fecha_inicio'] ?? null,
            'fecha_fin' => $_GET['fecha_fin'] ?? null,
            'conductor_id' => $_GET['conductor_id'] ?? null,
            'estado' => $_GET['estado'] ?? null
        ];

        $viajes = $this->viaje->listarConFiltros($filtros);
        $this->jsonResponse($viajes);
    }

    public function estadisticas()
    {
        $this->verificarPermiso('viajes.ver');
        
        $periodo = $_GET['periodo'] ?? 'mes'; // dia, semana, mes, ano
        $stats = $this->viaje->obtenerEstadisticasPeriodo($periodo);
        
        $this->jsonResponse($stats);
    }

    public function mapa()
    {
        $this->verificarPermiso('viajes.ver');
        
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $viajes = $this->viaje->obtenerViajesParaMapa($fecha);
        
        $this->view('admin/viajes/mapa', [
            'viajes' => $viajes,
            'fecha' => $fecha
        ]);
    }

    public function dashboard()
    {
        $this->verificarPermiso('viajes.ver');
        
        $hoy = date('Y-m-d');
        $viajesHoy = $this->viaje->obtenerViajesDelDia($hoy);
        $estadisticasHoy = $this->viaje->obtenerEstadisticasDia($hoy);
        $viajesEnCurso = $this->viaje->obtenerEnCurso();
        
        $this->view('admin/viajes/dashboard', [
            'viajes_hoy' => $viajesHoy,
            'estadisticas_hoy' => $estadisticasHoy,
            'viajes_en_curso' => $viajesEnCurso,
            'fecha' => $hoy
        ]);
    }

    public function obtenerClientes()
    {
        $this->verificarPermiso('viajes.crear');
        
        $termino = $_GET['q'] ?? '';
        $clientes = [];
        
        if (strlen($termino) >= 2) {
            $clientes = $this->cliente->buscar($termino);
        }

        $this->jsonResponse($clientes);
    }

    public function obtenerVehiculosConductor($conductorId)
    {
        $this->verificarPermiso('viajes.crear');
        
        $vehiculo = $this->conductor->obtenerVehiculoAsignado($conductorId);
        $this->jsonResponse($vehiculo ? [$vehiculo] : []);
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