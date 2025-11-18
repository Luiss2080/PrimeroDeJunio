<?php

/**
 * Controlador Admin - Dashboard Administrativo
 * Sistema PRIMERO DE JUNIO
 */
class AdminController extends Controller
{
    private $usuario;
    private $conductor;
    private $vehiculo;
    private $cliente;
    private $viaje;
    private $configuracion;

    public function __construct()
    {
        parent::__construct();

        // Verificar autenticación y rol de administrador
        Auth::requireAuth();
        Auth::requireRole('administrador');

        // Inicializar modelos
        $this->usuario = new Usuario();
        $this->conductor = new Conductor();
        $this->vehiculo = new Vehiculo();
        $this->cliente = new Cliente();
        $this->viaje = new Viaje();
        $this->configuracion = new Configuracion();
    }

    /**
     * Dashboard principal del administrador
     */
    public function index()
    {
        $this->dashboard();
    }

    /**
     * Dashboard principal con estadísticas generales
     */
    public function dashboard()
    {
        try {
            // Datos básicos para el dashboard
            $data = [
                'usuario_actual' => Auth::user(),
                'titulo' => 'Dashboard Administrativo',
                'mensaje' => '¡Bienvenido al sistema de gestión de mototaxis!'
            ];

            $this->view('dashboard/administrador', $data);
        } catch (Exception $e) {
            $this->setFlash('error', 'Error al cargar el dashboard: ' . $e->getMessage());
            $this->view('dashboard/index');
        }
    }

    /**
     * Panel de gestión de usuarios
     */
    public function usuarios()
    {
        $filtros = [
            'buscar' => $_GET['buscar'] ?? '',
            'rol' => $_GET['rol'] ?? '',
            'estado' => $_GET['estado'] ?? ''
        ];

        $usuarios = $this->usuario->listarConFiltros($filtros);
        $estadisticas = $this->usuario->obtenerEstadisticas();

        $this->view('admin/usuarios/index', [
            'usuarios' => $usuarios,
            'filtros' => $filtros,
            'estadisticas' => $estadisticas
        ]);
    }

    /**
     * Panel de gestión de conductores
     */
    public function conductores()
    {
        $filtros = [
            'buscar' => $_GET['buscar'] ?? '',
            'estado' => $_GET['estado'] ?? '',
            'tiene_vehiculo' => $_GET['tiene_vehiculo'] ?? ''
        ];

        $conductores = $this->conductor->listarConFiltros($filtros);
        $estadisticas = $this->conductor->obtenerEstadisticas();

        $this->view('admin/conductores/index', [
            'conductores' => $conductores,
            'filtros' => $filtros,
            'estadisticas' => $estadisticas
        ]);
    }

    /**
     * Panel de gestión de vehículos
     */
    public function vehiculos()
    {
        $filtros = [
            'buscar' => $_GET['buscar'] ?? '',
            'estado' => $_GET['estado'] ?? '',
            'marca' => $_GET['marca'] ?? ''
        ];

        $vehiculos = $this->vehiculo->listarConFiltros($filtros);
        $estadisticas = $this->vehiculo->obtenerEstadisticas();

        $this->view('admin/vehiculos/index', [
            'vehiculos' => $vehiculos,
            'filtros' => $filtros,
            'estadisticas' => $estadisticas
        ]);
    }

    /**
     * Panel de gestión de clientes
     */
    public function clientes()
    {
        $filtros = [
            'buscar' => $_GET['buscar'] ?? '',
            'tipo' => $_GET['tipo'] ?? '',
            'estado' => $_GET['estado'] ?? ''
        ];

        $clientes = $this->cliente->listarConFiltros($filtros);
        $estadisticas = $this->cliente->obtenerEstadisticas();

        $this->view('admin/clientes/index', [
            'clientes' => $clientes,
            'filtros' => $filtros,
            'estadisticas' => $estadisticas
        ]);
    }

    /**
     * Panel de gestión de viajes
     */
    public function viajes()
    {
        $filtros = [
            'fecha_inicio' => $_GET['fecha_inicio'] ?? '',
            'fecha_fin' => $_GET['fecha_fin'] ?? '',
            'estado' => $_GET['estado'] ?? '',
            'conductor' => $_GET['conductor'] ?? ''
        ];

        $viajes = $this->viaje->listarConFiltros($filtros);
        $estadisticas = $this->viaje->obtenerEstadisticas();

        $this->view('admin/viajes/index', [
            'viajes' => $viajes,
            'filtros' => $filtros,
            'estadisticas' => $estadisticas
        ]);
    }

    /**
     * Reportes y análisis
     */
    public function reportes()
    {
        $tipoReporte = $_GET['tipo'] ?? 'general';
        $periodo = $_GET['periodo'] ?? 'mes';

        $reportes = [];

        switch ($tipoReporte) {
            case 'ingresos':
                $reportes = $this->generarReporteIngresos($periodo);
                break;
            case 'conductores':
                $reportes = $this->generarReporteConductores($periodo);
                break;
            case 'vehiculos':
                $reportes = $this->generarReporteVehiculos($periodo);
                break;
            case 'clientes':
                $reportes = $this->generarReporteClientes($periodo);
                break;
            default:
                $reportes = $this->generarReporteGeneral($periodo);
        }

        $this->view('admin/reportes/index', [
            'reportes' => $reportes,
            'tipo_reporte' => $tipoReporte,
            'periodo' => $periodo
        ]);
    }

    /**
     * Configuración del sistema
     */
    public function configuracion()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $configuraciones = $_POST['configuracion'] ?? [];

                foreach ($configuraciones as $clave => $valor) {
                    $this->configuracion->establecer($clave, $valor);
                }

                $this->setFlash('success', 'Configuración actualizada correctamente');
                $this->redirect('/admin/configuracion');
            } catch (Exception $e) {
                $this->setFlash('error', 'Error al actualizar configuración: ' . $e->getMessage());
            }
        }

        $configuraciones = $this->configuracion->obtenerTodas();

        $this->view('admin/configuracion/index', [
            'configuraciones' => $configuraciones
        ]);
    }

    /**
     * Gestión de permisos y roles
     */
    public function permisos()
    {
        $this->requirePermission('permisos.ver');

        $permiso = new Permiso();
        $rol = new Rol();

        $permisos = $permiso->obtenerPorCategoria();
        $roles = $rol->obtenerTodos();

        $this->view('admin/permisos/index', [
            'permisos' => $permisos,
            'roles' => $roles
        ]);
    }

    /**
     * Monitor del sistema en tiempo real
     */
    public function monitor()
    {
        // Viajes en curso
        $viajesEnCurso = $this->viaje->obtenerEnCurso();

        // Conductores conectados/activos
        $conductoresActivos = $this->conductor->obtenerActivos();

        // Alertas del sistema
        $alertas = $this->obtenerAlertas();

        // Estadísticas en tiempo real
        $estadisticasReal = [
            'viajes_hoy' => $this->viaje->obtenerViajesDelDia(date('Y-m-d')),
            'ingresos_hoy' => $this->viaje->obtenerEstadisticasDia(date('Y-m-d'))['ingresos']['total_ingresos'] ?? 0,
            'conductores_trabajando' => count($viajesEnCurso),
            'clientes_atendidos' => $this->obtenerClientesAtendidosHoy()
        ];

        $this->view('admin/monitor/index', [
            'viajes_en_curso' => $viajesEnCurso,
            'conductores_activos' => $conductoresActivos,
            'alertas' => $alertas,
            'estadisticas_real' => $estadisticasReal
        ]);
    }

    /**
     * API para datos en tiempo real (AJAX)
     */
    public function api($endpoint)
    {
        $this->requirePermission('dashboard.admin');

        try {
            switch ($endpoint) {
                case 'estadisticas':
                    $data = $this->obtenerEstadisticasApi();
                    break;
                case 'alertas':
                    $data = $this->obtenerAlertas();
                    break;
                case 'viajes-en-curso':
                    $data = $this->viaje->obtenerEnCurso();
                    break;
                case 'actividad-reciente':
                    $data = $this->obtenerActividadReciente();
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
     * Obtener alertas del sistema
     */
    private function obtenerAlertas()
    {
        $alertas = [];

        // Licencias próximas a vencer
        $licenciasVencer = $this->conductor->obtenerLicenciasPorVencer(30);
        if (!empty($licenciasVencer)) {
            $alertas[] = [
                'tipo' => 'warning',
                'titulo' => 'Licencias por vencer',
                'mensaje' => count($licenciasVencer) . ' licencias vencen en los próximos 30 días',
                'url' => '/admin/conductores?alerta=licencias'
            ];
        }

        // SOAT próximos a vencer
        $soatVencer = $this->vehiculo->obtenerVencimientosSoat(30);
        if (!empty($soatVencer)) {
            $alertas[] = [
                'tipo' => 'warning',
                'titulo' => 'SOAT por vencer',
                'mensaje' => count($soatVencer) . ' SOAT vencen en los próximos 30 días',
                'url' => '/admin/vehiculos?alerta=soat'
            ];
        }

        // Vehículos en mantenimiento
        $vehiculosMantenimiento = $this->vehiculo->obtenerVehiculosMantenimiento();
        if (!empty($vehiculosMantenimiento)) {
            $alertas[] = [
                'tipo' => 'info',
                'titulo' => 'Vehículos en mantenimiento',
                'mensaje' => count($vehiculosMantenimiento) . ' vehículos en mantenimiento',
                'url' => '/admin/vehiculos?estado=mantenimiento'
            ];
        }

        // Viajes pendientes de hace más de 30 minutos
        $viajesPendientes = $this->viaje->obtenerPendientesAntes(30);
        if (!empty($viajesPendientes)) {
            $alertas[] = [
                'tipo' => 'danger',
                'titulo' => 'Viajes pendientes',
                'mensaje' => count($viajesPendientes) . ' viajes llevan más de 30 minutos pendientes',
                'url' => '/admin/viajes?estado=pendiente'
            ];
        }

        return $alertas;
    }

    /**
     * Obtener actividad reciente del sistema
     */
    private function obtenerActividadReciente()
    {
        return [
            'usuarios_nuevos' => $this->usuario->obtenerRecientes(5),
            'viajes_recientes' => $this->viaje->obtenerRecientes(10),
            'conductores_nuevos' => $this->conductor->obtenerRecientes(5),
            'clientes_nuevos' => $this->cliente->obtenerClientesNuevos(7)
        ];
    }

    /**
     * Obtener clientes atendidos hoy
     */
    private function obtenerClientesAtendidosHoy()
    {
        $result = $this->db->fetch(
            "SELECT COUNT(DISTINCT cliente_id) as total 
             FROM viajes 
             WHERE DATE(fecha_hora_inicio) = CURDATE() 
             AND estado = 'completado'"
        );

        return $result['total'] ?? 0;
    }

    /**
     * Generar reporte general
     */
    private function generarReporteGeneral($periodo)
    {
        // Implementar lógica de reporte general
        return [
            'resumen' => 'Reporte general del período seleccionado',
            'datos' => []
        ];
    }

    /**
     * Generar reporte de ingresos
     */
    private function generarReporteIngresos($periodo)
    {
        // Implementar lógica de reporte de ingresos
        return [
            'resumen' => 'Reporte de ingresos del período seleccionado',
            'datos' => []
        ];
    }

    /**
     * Generar reporte de conductores
     */
    private function generarReporteConductores($periodo)
    {
        // Implementar lógica de reporte de conductores
        return [
            'resumen' => 'Reporte de conductores del período seleccionado',
            'datos' => []
        ];
    }

    /**
     * Generar reporte de vehículos
     */
    private function generarReporteVehiculos($periodo)
    {
        // Implementar lógica de reporte de vehículos
        return [
            'resumen' => 'Reporte de vehículos del período seleccionado',
            'datos' => []
        ];
    }

    /**
     * Generar reporte de clientes
     */
    private function generarReporteClientes($periodo)
    {
        // Implementar lógica de reporte de clientes
        return [
            'resumen' => 'Reporte de clientes del período seleccionado',
            'datos' => []
        ];
    }

    /**
     * Obtener estadísticas para API
     */
    private function obtenerEstadisticasApi()
    {
        return [
            'viajes_hoy' => $this->viaje->obtenerViajesDelDia(date('Y-m-d')),
            'ingresos_hoy' => $this->viaje->obtenerEstadisticasDia(date('Y-m-d')),
            'conductores_activos' => count($this->conductor->obtenerActivos()),
            'vehiculos_disponibles' => count($this->vehiculo->obtenerDisponibles()),
            'clientes_nuevos_mes' => count($this->cliente->obtenerClientesNuevos(30))
        ];
    }

    /**
     * Verificar permiso específico  
     */
    protected function requirePermission($permiso)
    {
        if (!Auth::hasPermission($permiso)) {
            $this->setFlash('error', 'No tienes permisos para realizar esta acción');
            $this->redirect('/admin/dashboard');
            exit;
        }
    }
}
