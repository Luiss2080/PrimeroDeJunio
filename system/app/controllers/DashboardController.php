<?php

/**
 * Controlador Dashboard - Sistema PRIMERO DE JUNIO
 */
class DashboardController extends Controller
{
    private $usuario;
    private $conductor;
    private $vehiculo;
    private $viaje;
    private $cliente;
    private $pagoTarifaDiaria;

    public function __construct()
    {
        parent::__construct();
        $this->usuario = new Usuario();
        $this->conductor = new Conductor();
        $this->vehiculo = new Vehiculo();
        $this->viaje = new Viaje();
        $this->cliente = new Cliente();
        $this->pagoTarifaDiaria = new PagoTarifaDiaria();
    }

    public function index()
    {
        $this->verificarPermiso('dashboard.ver');
        
        $usuarioActual = $this->getUsuarioActual();
        $hoy = date('Y-m-d');

        // Datos según el rol del usuario
        switch ($usuarioActual['rol_nombre']) {
            case 'Administrador':
            case 'Super Administrador':
                $data = $this->getDashboardAdmin($hoy);
                break;
            case 'Operador':
                $data = $this->getDashboardOperador($hoy);
                break;
            case 'Conductor':
                $data = $this->getDashboardConductor($usuarioActual['id'], $hoy);
                break;
            default:
                $data = $this->getDashboardBasico($hoy);
        }

        $this->view('dashboard/index', $data);
    }

    private function getDashboardAdmin($fecha)
    {
        return [
            'tipo_dashboard' => 'admin',
            'fecha' => $fecha,
            'resumen_general' => [
                'total_conductores' => $this->conductor->count(['estado' => 'activo']),
                'total_vehiculos' => $this->vehiculo->count(['estado' => 'activo']),
                'total_clientes' => $this->cliente->count(['estado' => 'activo']),
                'viajes_hoy' => $this->viaje->count([
                    'DATE(fecha_hora_inicio)' => $fecha,
                    'estado' => 'completado'
                ])
            ],
            'viajes_hoy' => $this->viaje->obtenerViajesDelDia($fecha),
            'estadisticas_viajes' => $this->viaje->obtenerEstadisticasDia($fecha),
            'tarifa_diaria' => $this->pagoTarifaDiaria->obtenerResumenDiario($fecha),
            'conductores_activos' => $this->conductor->obtenerActivos(),
            'vehiculos_mantenimiento' => $this->vehiculo->obtenerVehiculosMantenimiento(),
            'alertas' => $this->getAlertas(),
            'estadisticas_mensuales' => $this->viaje->obtenerEstadisticasMensuales(),
            'ingresos_mensuales' => $this->viaje->obtenerIngresosMensuales(),
            'top_conductores' => $this->conductor->obtenerTopConductores(5)
        ];
    }

    private function getDashboardOperador($fecha)
    {
        return [
            'tipo_dashboard' => 'operador',
            'fecha' => $fecha,
            'resumen_operacion' => [
                'viajes_pendientes' => $this->viaje->count(['estado' => 'pendiente']),
                'viajes_en_curso' => $this->viaje->count(['estado' => 'en_curso']),
                'conductores_disponibles' => $this->conductor->obtenerDisponibles(),
                'vehiculos_disponibles' => $this->vehiculo->obtenerDisponibles()
            ],
            'viajes_hoy' => $this->viaje->obtenerViajesDelDia($fecha),
            'tarifa_diaria' => $this->pagoTarifaDiaria->obtenerResumenDiario($fecha),
            'conductores_sin_pagar' => $this->pagoTarifaDiaria->obtenerPendientesPorFecha($fecha),
            'viajes_recientes' => $this->viaje->obtenerRecientes(10),
            'alertas_operacion' => $this->getAlertasOperacion(),
            'estadisticas_dia' => $this->viaje->obtenerEstadisticasDia($fecha)
        ];
    }

    private function getDashboardConductor($conductorId, $fecha)
    {
        return [
            'tipo_dashboard' => 'conductor',
            'fecha' => $fecha,
            'conductor_info' => $this->conductor->obtenerConUsuario($conductorId),
            'pago_tarifa_hoy' => $this->pagoTarifaDiaria->verificarPagoHoy($conductorId),
            'vehiculo_asignado' => $this->conductor->obtenerVehiculoAsignado($conductorId),
            'viajes_hoy' => $this->viaje->obtenerViajesConductor($conductorId, $fecha, $fecha),
            'estadisticas_conductor' => $this->conductor->obtenerEstadisticasViajes($conductorId),
            'viajes_recientes' => $this->viaje->obtenerViajesConductorRecientes($conductorId, 5),
            'ingresos_mes' => $this->viaje->obtenerIngresosConductorMes($conductorId),
            'alertas_conductor' => $this->getAlertasConductor($conductorId)
        ];
    }

    private function getDashboardBasico($fecha)
    {
        return [
            'tipo_dashboard' => 'basico',
            'fecha' => $fecha,
            'resumen_basico' => [
                'viajes_hoy' => $this->viaje->count([
                    'DATE(fecha_hora_inicio)' => $fecha
                ]),
                'conductores_activos' => $this->conductor->count(['estado' => 'activo']),
                'vehiculos_activos' => $this->vehiculo->count(['estado' => 'activo'])
            ]
        ];
    }

    public function estadisticasAjax()
    {
        $this->verificarPermiso('dashboard.ver');
        
        $tipo = $_GET['tipo'] ?? 'general';
        $periodo = $_GET['periodo'] ?? 'dia';
        $fecha = $_GET['fecha'] ?? date('Y-m-d');

        $datos = [];

        switch ($tipo) {
            case 'viajes':
                $datos = $this->viaje->obtenerEstadisticasPeriodo($periodo, $fecha);
                break;
            case 'ingresos':
                $datos = $this->viaje->obtenerIngresosPeriodo($periodo, $fecha);
                break;
            case 'conductores':
                $datos = $this->conductor->obtenerEstadisticasActividad($periodo, $fecha);
                break;
            case 'tarifa_diaria':
                $datos = $this->pagoTarifaDiaria->obtenerEstadisticasMensuales();
                break;
            default:
                $datos = $this->getEstadisticasGenerales($periodo, $fecha);
        }

        $this->jsonResponse($datos);
    }

    public function resumenTarifaDiaria()
    {
        $this->verificarPermiso('dashboard.ver');
        
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $resumen = $this->pagoTarifaDiaria->obtenerResumenDiario($fecha);
        
        $this->jsonResponse($resumen);
    }

    public function viajesEnTiempoReal()
    {
        $this->verificarPermiso('dashboard.ver');
        
        $viajesEnCurso = $this->viaje->obtenerEnCurso();
        $viajesPendientes = $this->viaje->obtenerPendientes();
        
        $this->jsonResponse([
            'en_curso' => $viajesEnCurso,
            'pendientes' => $viajesPendientes,
            'timestamp' => time()
        ]);
    }

    public function alertas()
    {
        $this->verificarPermiso('dashboard.ver');
        
        $usuarioActual = $this->getUsuarioActual();
        
        switch ($usuarioActual['rol_nombre']) {
            case 'Administrador':
            case 'Super Administrador':
                $alertas = $this->getAlertas();
                break;
            case 'Operador':
                $alertas = $this->getAlertasOperacion();
                break;
            case 'Conductor':
                $alertas = $this->getAlertasConductor($usuarioActual['id']);
                break;
            default:
                $alertas = [];
        }

        $this->jsonResponse($alertas);
    }

    private function getAlertas()
    {
        $alertas = [];
        
        // Licencias próximas a vencer
        $licenciasVencer = $this->conductor->obtenerLicenciasProximasVencer(30);
        if (!empty($licenciasVencer)) {
            $alertas[] = [
                'tipo' => 'warning',
                'titulo' => 'Licencias por vencer',
                'mensaje' => count($licenciasVencer) . ' conductores con licencias próximas a vencer',
                'url' => '/admin/conductores/licencias-vencer',
                'icono' => 'fas fa-id-card'
            ];
        }

        // Vehículos en mantenimiento
        $vehiculosMantenimiento = $this->vehiculo->obtenerVehiculosMantenimiento();
        if (!empty($vehiculosMantenimiento)) {
            $alertas[] = [
                'tipo' => 'info',
                'titulo' => 'Vehículos en mantenimiento',
                'mensaje' => count($vehiculosMantenimiento) . ' vehículos en mantenimiento',
                'url' => '/admin/vehiculos',
                'icono' => 'fas fa-wrench'
            ];
        }

        // SOAT y Tecnicomecanica próximos a vencer
        $vencimientos = $this->vehiculo->obtenerProximosVencimientosTodos(30);
        if (!empty($vencimientos)) {
            $alertas[] = [
                'tipo' => 'warning',
                'titulo' => 'Documentos por vencer',
                'mensaje' => count($vencimientos) . ' vehículos con documentos próximos a vencer',
                'url' => '/admin/vehiculos/vencimientos',
                'icono' => 'fas fa-file-alt'
            ];
        }

        // Conductores sin pagar tarifa diaria
        $sinPagar = $this->pagoTarifaDiaria->obtenerPendientesPorFecha(date('Y-m-d'));
        if (!empty($sinPagar)) {
            $alertas[] = [
                'tipo' => 'danger',
                'titulo' => 'Tarifa diaria pendiente',
                'mensaje' => count($sinPagar) . ' conductores no han pagado su tarifa diaria',
                'url' => '/admin/conductores/tarifa-diaria',
                'icono' => 'fas fa-money-bill'
            ];
        }

        return $alertas;
    }

    private function getAlertasOperacion()
    {
        $alertas = [];
        
        // Viajes pendientes por mucho tiempo
        $viajesPendientes = $this->viaje->obtenerPendientesAntes(30); // 30 minutos
        if (!empty($viajesPendientes)) {
            $alertas[] = [
                'tipo' => 'warning',
                'titulo' => 'Viajes pendientes',
                'mensaje' => count($viajesPendientes) . ' viajes pendientes por más de 30 minutos',
                'url' => '/admin/viajes',
                'icono' => 'fas fa-clock'
            ];
        }

        // Conductores sin pagar tarifa
        $sinPagar = $this->pagoTarifaDiaria->obtenerPendientesPorFecha(date('Y-m-d'));
        if (!empty($sinPagar)) {
            $alertas[] = [
                'tipo' => 'danger',
                'titulo' => 'Pagos pendientes',
                'mensaje' => count($sinPagar) . ' conductores sin pagar tarifa diaria',
                'url' => '/admin/conductores/tarifa-diaria',
                'icono' => 'fas fa-money-bill'
            ];
        }

        return $alertas;
    }

    private function getAlertasConductor($conductorId)
    {
        $alertas = [];
        
        // Verificar pago de tarifa diaria
        $pagoHoy = $this->pagoTarifaDiaria->verificarPagoHoy($conductorId);
        if (!$pagoHoy['ha_pagado']) {
            $alertas[] = [
                'tipo' => 'danger',
                'titulo' => 'Tarifa diaria pendiente',
                'mensaje' => 'Debe pagar su tarifa diaria antes de trabajar',
                'url' => '/dashboard',
                'icono' => 'fas fa-exclamation-triangle'
            ];
        }

        // Verificar vencimiento de licencia
        $conductor = $this->conductor->find($conductorId);
        if ($conductor) {
            $diasVencimiento = $this->conductor->diasParaVencimientoLicencia($conductorId);
            if ($diasVencimiento <= 30 && $diasVencimiento > 0) {
                $alertas[] = [
                    'tipo' => 'warning',
                    'titulo' => 'Licencia próxima a vencer',
                    'mensaje' => "Su licencia vence en $diasVencimiento días",
                    'url' => '/dashboard',
                    'icono' => 'fas fa-id-card'
                ];
            }
        }

        return $alertas;
    }

    private function getEstadisticasGenerales($periodo, $fecha)
    {
        return [
            'viajes' => $this->viaje->obtenerEstadisticasPeriodo($periodo, $fecha),
            'ingresos' => $this->viaje->obtenerIngresosPeriodo($periodo, $fecha),
            'conductores_activos' => $this->conductor->obtenerConductoresActivosPeriodo($periodo, $fecha),
            'vehiculos_utilizados' => $this->vehiculo->obtenerVehiculosUtilizadosPeriodo($periodo, $fecha)
        ];
    }

    public function cambiarPeriodo()
    {
        $this->verificarPermiso('dashboard.ver');
        
        $periodo = $_GET['periodo'] ?? 'dia';
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        
        $data = $this->getEstadisticasGenerales($periodo, $fecha);
        $this->jsonResponse($data);
    }

    private function verificarPermiso($permiso)
    {
        if (!$this->tienePermiso($permiso)) {
            $this->setFlash('error', 'No tienes permisos para acceder al dashboard');
            $this->redirect('/login');
            exit;
        }
    }
}