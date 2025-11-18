<?php

/**
 * Controlador Operador - Dashboard de Operaciones
 * Sistema PRIMERO DE JUNIO
 */
class OperadorController extends Controller
{
    private $conductor;
    private $vehiculo;
    private $cliente;
    private $viaje;
    private $pagoTarifa;

    public function __construct()
    {
        parent::__construct();

        // Verificar autenticación y rol de operador
        Auth::requireAuth();
        Auth::requireRole('operador');

        // Inicializar modelos
        $this->conductor = new Conductor();
        $this->vehiculo = new Vehiculo();
        $this->cliente = new Cliente();
        $this->viaje = new Viaje();
        $this->pagoTarifa = new PagoTarifaDiaria();
    }

    /**
     * Dashboard principal del operador
     */
    public function index()
    {
        $this->dashboard();
    }

    /**
     * Dashboard operativo simple
     */
    public function dashboard()
    {
        try {
            // Datos básicos para el dashboard
            $data = [
                'usuario_actual' => Auth::user(),
                'titulo' => 'Dashboard Operador',
                'mensaje' => '¡Panel de operaciones listo!'
            ];

            $this->view('dashboard/operador', $data);
        } catch (Exception $e) {
            $this->setFlash('error', 'Error al cargar el dashboard: ' . $e->getMessage());
            $this->view('dashboard/index');
        }
    }

    /**
     * Gestión de viajes
     */
    public function viajes()
    {
        $this->requirePermission('viajes.ver');

        $filtros = [
            'fecha' => $_GET['fecha'] ?? date('Y-m-d'),
            'estado' => $_GET['estado'] ?? '',
            'conductor' => $_GET['conductor'] ?? ''
        ];

        $viajes = $this->viaje->listarConFiltros($filtros);
        $estadisticas = $this->viaje->obtenerEstadisticas($filtros['fecha'], $filtros['fecha']);
        $conductores = $this->conductor->obtenerActivos();

        $this->view('operador/viajes/index', [
            'viajes' => $viajes,
            'filtros' => $filtros,
            'estadisticas' => $estadisticas,
            'conductores' => $conductores
        ]);
    }

    /**
     * Crear nuevo viaje
     */
    public function crearViaje()
    {
        $this->requirePermission('viajes.crear');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'conductor_id' => $_POST['conductor_id'],
                    'vehiculo_id' => $_POST['vehiculo_id'],
                    'cliente_id' => $_POST['cliente_id'] ?? null,
                    'cliente_nombre' => $_POST['cliente_nombre'] ?? '',
                    'cliente_telefono' => $_POST['cliente_telefono'] ?? '',
                    'origen' => trim($_POST['origen']),
                    'destino' => trim($_POST['destino']),
                    'valor_base' => $_POST['valor_base'],
                    'recargos' => $_POST['recargos'] ?? 0,
                    'descuentos' => $_POST['descuentos'] ?? 0,
                    'metodo_pago' => $_POST['metodo_pago'] ?? 'efectivo',
                    'fecha_hora_inicio' => $_POST['fecha_hora_inicio'] ?? date('Y-m-d H:i:s'),
                    'observaciones' => $_POST['observaciones'] ?? ''
                ];

                // Calcular valor total
                $datos['valor_total'] = $datos['valor_base'] + $datos['recargos'] - $datos['descuentos'];

                $viajeId = $this->viaje->create($datos);
                $this->setFlash('success', 'Viaje creado exitosamente');
                $this->redirect('/operador/viajes/ver/' . $viajeId);
            } catch (Exception $e) {
                $this->setFlash('error', 'Error al crear viaje: ' . $e->getMessage());
            }
        }

        $conductores = $this->conductor->obtenerActivos();
        $vehiculos = $this->vehiculo->obtenerDisponibles();
        $clientes = $this->cliente->obtenerActivos();

        $this->view('operador/viajes/crear', [
            'conductores' => $conductores,
            'vehiculos' => $vehiculos,
            'clientes' => $clientes
        ]);
    }

    /**
     * Ver detalles de un viaje
     */
    public function verViaje($id)
    {
        $this->requirePermission('viajes.ver');

        $viaje = $this->viaje->obtenerCompleto($id);
        if (!$viaje) {
            $this->setFlash('error', 'Viaje no encontrado');
            $this->redirect('/operador/viajes');
            return;
        }

        $this->view('operador/viajes/ver', [
            'viaje' => $viaje
        ]);
    }

    /**
     * Gestión de conductores
     */
    public function conductores()
    {
        $this->requirePermission('conductores.ver');

        $filtros = [
            'buscar' => $_GET['buscar'] ?? '',
            'estado' => $_GET['estado'] ?? 'activo',
            'tiene_vehiculo' => $_GET['tiene_vehiculo'] ?? ''
        ];

        $conductores = $this->conductor->listarConFiltros($filtros);
        $estadisticas = $this->conductor->obtenerEstadisticas();

        $this->view('operador/conductores/index', [
            'conductores' => $conductores,
            'filtros' => $filtros,
            'estadisticas' => $estadisticas
        ]);
    }

    /**
     * Ver perfil de conductor
     */
    public function verConductor($id)
    {
        $this->requirePermission('conductores.ver');

        $conductor = $this->conductor->obtenerConUsuario($id);
        if (!$conductor) {
            $this->setFlash('error', 'Conductor no encontrado');
            $this->redirect('/operador/conductores');
            return;
        }

        // Estadísticas del conductor
        $estadisticas = $this->conductor->obtenerEstadisticasViajes($id);
        $viajesRecientes = $this->viaje->obtenerPorConductor($id, null, null);
        $vehiculoAsignado = $this->conductor->obtenerVehiculoAsignado($id);

        $this->view('operador/conductores/ver', [
            'conductor' => $conductor,
            'estadisticas' => $estadisticas,
            'viajes_recientes' => array_slice($viajesRecientes, 0, 10),
            'vehiculo_asignado' => $vehiculoAsignado
        ]);
    }

    /**
     * Gestión de vehículos
     */
    public function vehiculos()
    {
        $this->requirePermission('vehiculos.ver');

        $filtros = [
            'buscar' => $_GET['buscar'] ?? '',
            'estado' => $_GET['estado'] ?? 'activo',
            'tiene_conductor' => $_GET['tiene_conductor'] ?? ''
        ];

        $vehiculos = $this->vehiculo->listarConFiltros($filtros);
        $estadisticas = $this->vehiculo->obtenerEstadisticas();

        $this->view('operador/vehiculos/index', [
            'vehiculos' => $vehiculos,
            'filtros' => $filtros,
            'estadisticas' => $estadisticas
        ]);
    }

    /**
     * Ver detalles de vehículo
     */
    public function verVehiculo($id)
    {
        $this->requirePermission('vehiculos.ver');

        $vehiculo = $this->vehiculo->find($id);
        if (!$vehiculo) {
            $this->setFlash('error', 'Vehículo no encontrado');
            $this->redirect('/operador/vehiculos');
            return;
        }

        // Información adicional
        $conductorAsignado = $this->vehiculo->obtenerAsignado($id);
        $estadisticasViajes = $this->vehiculo->obtenerViajesRealizados($id);
        $proximosVencimientos = $this->vehiculo->obtenerProximosVencimientos($id);

        $this->view('operador/vehiculos/ver', [
            'vehiculo' => $vehiculo,
            'conductor_asignado' => $conductorAsignado,
            'estadisticas' => $estadisticasViajes,
            'vencimientos' => $proximosVencimientos
        ]);
    }

    /**
     * Gestión de clientes
     */
    public function clientes()
    {
        $this->requirePermission('clientes.ver');

        $filtros = [
            'buscar' => $_GET['buscar'] ?? '',
            'tipo' => $_GET['tipo'] ?? '',
            'estado' => $_GET['estado'] ?? 'activo'
        ];

        $clientes = $this->cliente->listarConFiltros($filtros);
        $estadisticas = $this->cliente->obtenerEstadisticas();

        $this->view('operador/clientes/index', [
            'clientes' => $clientes,
            'filtros' => $filtros,
            'estadisticas' => $estadisticas
        ]);
    }

    /**
     * Crear nuevo cliente
     */
    public function crearCliente()
    {
        $this->requirePermission('clientes.crear');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'nombre' => trim($_POST['nombre']),
                    'apellido' => trim($_POST['apellido'] ?? ''),
                    'telefono' => trim($_POST['telefono']),
                    'email' => trim($_POST['email'] ?? ''),
                    'direccion_habitual' => trim($_POST['direccion_habitual'] ?? ''),
                    'tipo_cliente' => $_POST['tipo_cliente'] ?? 'particular',
                    'observaciones' => trim($_POST['observaciones'] ?? '')
                ];

                $clienteId = $this->cliente->create($datos);
                $this->setFlash('success', 'Cliente creado exitosamente');
                $this->redirect('/operador/clientes/ver/' . $clienteId);
            } catch (Exception $e) {
                $this->setFlash('error', 'Error al crear cliente: ' . $e->getMessage());
            }
        }

        $this->view('operador/clientes/crear');
    }

    /**
     * Ver perfil de cliente
     */
    public function verCliente($id)
    {
        $this->requirePermission('clientes.ver');

        $cliente = $this->cliente->find($id);
        if (!$cliente) {
            $this->setFlash('error', 'Cliente no encontrado');
            $this->redirect('/operador/clientes');
            return;
        }

        // Estadísticas del cliente
        $estadisticas = $this->cliente->obtenerEstadisticasViajes($id);
        $historialViajes = $this->cliente->obtenerHistorialViajes($id, 20);
        $lugaresComunes = $this->cliente->obtenerLugaresComunes($id);

        $this->view('operador/clientes/ver', [
            'cliente' => $cliente,
            'estadisticas' => $estadisticas,
            'historial_viajes' => $historialViajes,
            'lugares_comunes' => $lugaresComunes
        ]);
    }

    /**
     * Panel de pagos diarios
     */
    public function pagos()
    {
        $this->requirePermission('pagos.ver');

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $estado = $_GET['estado'] ?? '';

        $filtros = [
            'fecha' => $fecha,
            'estado' => $estado
        ];

        $pagos = $this->pagoTarifa->listarConFiltros($filtros);
        $estadisticas = $this->pagoTarifa->obtenerEstadisticasDia($fecha);

        $this->view('operador/pagos/index', [
            'pagos' => $pagos,
            'filtros' => $filtros,
            'estadisticas' => $estadisticas
        ]);
    }

    /**
     * Registrar pago de tarifa diaria
     */
    public function registrarPago()
    {
        $this->requirePermission('pagos.crear');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'conductor_id' => $_POST['conductor_id'],
                    'fecha_pago' => $_POST['fecha_pago'] ?? date('Y-m-d'),
                    'monto' => $_POST['monto'],
                    'metodo_pago' => $_POST['metodo_pago'] ?? 'efectivo',
                    'observaciones' => $_POST['observaciones'] ?? '',
                    'recibido_por' => Auth::id()
                ];

                $pagoId = $this->pagoTarifa->create($datos);
                $this->setFlash('success', 'Pago registrado exitosamente');
                $this->redirect('/operador/pagos/ver/' . $pagoId);
            } catch (Exception $e) {
                $this->setFlash('error', 'Error al registrar pago: ' . $e->getMessage());
            }
        }

        $conductores = $this->conductor->obtenerActivos();

        $this->view('operador/pagos/crear', [
            'conductores' => $conductores
        ]);
    }

    /**
     * Reportes operativos
     */
    public function reportes()
    {
        $this->requirePermission('reportes.ver');

        $tipo = $_GET['tipo'] ?? 'diario';
        $fecha = $_GET['fecha'] ?? date('Y-m-d');

        $reportes = [];

        switch ($tipo) {
            case 'diario':
                $reportes = $this->generarReporteDiario($fecha);
                break;
            case 'conductores':
                $reportes = $this->generarReporteConductores($fecha);
                break;
            case 'vehiculos':
                $reportes = $this->generarReporteVehiculos($fecha);
                break;
            case 'ingresos':
                $reportes = $this->generarReporteIngresos($fecha);
                break;
        }

        $this->view('operador/reportes/index', [
            'reportes' => $reportes,
            'tipo' => $tipo,
            'fecha' => $fecha
        ]);
    }

    /**
     * Monitor en tiempo real
     */
    public function monitor()
    {
        // Viajes en curso
        $viajesEnCurso = $this->viaje->obtenerEnCurso();

        // Conductores activos
        $conductoresActivos = $this->conductor->obtenerActivos();

        // Vehículos en uso
        $vehiculosEnUso = $this->vehiculo->obtenerEnUso();

        // Alertas operativas
        $alertas = $this->obtenerAlertasOperativas();

        $this->view('operador/monitor/index', [
            'viajes_en_curso' => $viajesEnCurso,
            'conductores_activos' => $conductoresActivos,
            'vehiculos_en_uso' => $vehiculosEnUso,
            'alertas' => $alertas
        ]);
    }

    /**
     * API para datos en tiempo real
     */
    public function api($endpoint)
    {
        try {
            switch ($endpoint) {
                case 'estadisticas-hoy':
                    $data = $this->obtenerEstadisticasHoy();
                    break;
                case 'viajes-en-curso':
                    $data = $this->viaje->obtenerEnCurso();
                    break;
                case 'alertas':
                    $data = $this->obtenerAlertasOperativas();
                    break;
                case 'conductores-disponibles':
                    $data = $this->conductor->obtenerDisponibles();
                    break;
                default:
                    throw new Exception('Endpoint no encontrado');
            }

            $this->jsonResponse($data);
        } catch (Exception $e) {
            $this->jsonResponse(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Obtener alertas operativas
     */
    private function obtenerAlertasOperativas()
    {
        $alertas = [];

        // Viajes pendientes hace más de 15 minutos
        $viajesPendientes = $this->viaje->obtenerPendientesAntes(15);
        if (!empty($viajesPendientes)) {
            $alertas[] = [
                'tipo' => 'warning',
                'titulo' => 'Viajes pendientes',
                'mensaje' => count($viajesPendientes) . ' viajes pendientes requieren atención',
                'url' => '/operador/viajes?estado=pendiente'
            ];
        }

        // Conductores sin viajes en el día
        $conductoresSinViajes = $this->conductor->obtenerSinViajesHoy();
        if (!empty($conductoresSinViajes)) {
            $alertas[] = [
                'tipo' => 'info',
                'titulo' => 'Conductores inactivos',
                'mensaje' => count($conductoresSinViajes) . ' conductores sin viajes hoy',
                'url' => '/operador/conductores?activos=false'
            ];
        }

        // Vehículos que necesitan atención
        $vehiculosAtencion = $this->vehiculo->obtenerQueNecesitanAtencion();
        if (!empty($vehiculosAtencion)) {
            $alertas[] = [
                'tipo' => 'warning',
                'titulo' => 'Vehículos requieren atención',
                'mensaje' => count($vehiculosAtencion) . ' vehículos con documentos próximos a vencer',
                'url' => '/operador/vehiculos?atencion=true'
            ];
        }

        return $alertas;
    }

    /**
     * Obtener estadísticas del día actual
     */
    private function obtenerEstadisticasHoy()
    {
        $hoy = date('Y-m-d');

        return [
            'viajes_completados' => $this->viaje->count(['estado' => 'completado', 'fecha' => $hoy]),
            'viajes_en_curso' => count($this->viaje->obtenerEnCurso()),
            'ingresos_dia' => $this->viaje->obtenerEstadisticasDia($hoy)['ingresos']['total_ingresos'] ?? 0,
            'conductores_activos' => count($this->conductor->obtenerActivos()),
            'vehiculos_en_uso' => count($this->vehiculo->obtenerEnUso())
        ];
    }

    /**
     * Generar reporte diario
     */
    private function generarReporteDiario($fecha)
    {
        return [
            'fecha' => $fecha,
            'viajes' => $this->viaje->obtenerReporteDiario($fecha, $fecha),
            'estadisticas' => $this->viaje->obtenerEstadisticasDia($fecha),
            'conductores' => $this->conductor->obtenerEstadisticasActividad('dia', $fecha),
            'ingresos' => $this->viaje->obtenerIngresosPeriodo('dia', $fecha)
        ];
    }

    /**
     * Generar reporte de conductores
     */
    private function generarReporteConductores($fecha)
    {
        return [
            'conductores_activos' => $this->conductor->obtenerActivos(),
            'estadisticas' => $this->conductor->obtenerEstadisticas(),
            'top_conductores' => $this->conductor->obtenerTopConductores(10, $fecha, $fecha)
        ];
    }

    /**
     * Generar reporte de vehículos
     */
    private function generarReporteVehiculos($fecha)
    {
        return [
            'vehiculos_activos' => $this->vehiculo->obtenerTodos(),
            'estadisticas' => $this->vehiculo->obtenerEstadisticas(),
            'mas_utilizados' => $this->vehiculo->obtenerMasUtilizados(10, $fecha, $fecha)
        ];
    }

    /**
     * Generar reporte de ingresos
     */
    private function generarReporteIngresos($fecha)
    {
        return [
            'ingresos_dia' => $this->viaje->obtenerIngresosPeriodo('dia', $fecha),
            'detalle_viajes' => $this->viaje->obtenerViajesDelDia($fecha),
            'metodos_pago' => $this->viaje->obtenerEstadisticasDia($fecha)['metodos_pago'] ?? []
        ];
    }

    /**
     * Verificar permiso específico
     */
    protected function requirePermission($permiso)
    {
        if (!Auth::hasPermission($permiso)) {
            $this->setFlash('error', 'No tienes permisos para realizar esta acción');
            $this->redirect('/operador/dashboard');
            exit;
        }
    }
}
