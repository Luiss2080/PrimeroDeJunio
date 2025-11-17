<?php

/**
 * Controlador Reportes - Sistema PRIMERO DE JUNIO
 */
class ReporteController extends Controller
{
    private $viaje;
    private $conductor;
    private $vehiculo;
    private $cliente;

    public function __construct()
    {
        parent::__construct();
        $this->viaje = new Viaje();
        $this->conductor = new Conductor();
        $this->vehiculo = new Vehiculo();
        $this->cliente = new Cliente();
    }

    public function index()
    {
        $this->requirePermission('reportes.ver');

        $this->view('admin/reportes/index', [
            'titulo' => 'Reportes del Sistema'
        ]);
    }

    /**
     * Reporte de viajes
     */
    public function viajes()
    {
        $this->requirePermission('reportes.ver');

        $filtros = [
            'fecha_inicio' => $_GET['fecha_inicio'] ?? date('Y-m-01'),
            'fecha_fin' => $_GET['fecha_fin'] ?? date('Y-m-d'),
            'conductor_id' => $_GET['conductor_id'] ?? '',
            'estado' => $_GET['estado'] ?? '',
            'tipo_reporte' => $_GET['tipo_reporte'] ?? 'detallado'
        ];

        // Obtener datos según los filtros
        $viajes = $this->viaje->obtenerReporte($filtros);
        $estadisticas = $this->viaje->obtenerEstadisticasReporte($filtros);
        $conductores = $this->conductor->listarActivos();

        // Si se solicita exportar
        if (isset($_GET['exportar'])) {
            $this->exportarReporteViajes($viajes, $filtros);
            return;
        }

        $this->view('admin/reportes/viajes', [
            'viajes' => $viajes,
            'estadisticas' => $estadisticas,
            'conductores' => $conductores,
            'filtros' => $filtros
        ]);
    }

    /**
     * Reporte de conductores
     */
    public function conductores()
    {
        $this->requirePermission('reportes.ver');

        $filtros = [
            'fecha_inicio' => $_GET['fecha_inicio'] ?? date('Y-m-01'),
            'fecha_fin' => $_GET['fecha_fin'] ?? date('Y-m-d'),
            'conductor_id' => $_GET['conductor_id'] ?? '',
            'tipo_reporte' => $_GET['tipo_reporte'] ?? 'rendimiento'
        ];

        // Obtener datos del reporte
        $datosReporte = $this->conductor->obtenerReporteRendimiento($filtros);
        $conductores = $this->conductor->listarActivos();

        // Si se solicita exportar
        if (isset($_GET['exportar'])) {
            $this->exportarReporteConductores($datosReporte, $filtros);
            return;
        }

        $this->view('admin/reportes/conductores', [
            'datos_reporte' => $datosReporte,
            'conductores' => $conductores,
            'filtros' => $filtros
        ]);
    }

    /**
     * Reporte de ingresos
     */
    public function ingresos()
    {
        $this->requirePermission('reportes.ver');

        $filtros = [
            'fecha_inicio' => $_GET['fecha_inicio'] ?? date('Y-m-01'),
            'fecha_fin' => $_GET['fecha_fin'] ?? date('Y-m-d'),
            'tipo_agrupacion' => $_GET['tipo_agrupacion'] ?? 'diario',
            'conductor_id' => $_GET['conductor_id'] ?? ''
        ];

        // Obtener datos de ingresos
        $ingresos = $this->viaje->obtenerReporteIngresos($filtros);
        $resumen = $this->viaje->obtenerResumenIngresos($filtros);
        $conductores = $this->conductor->listarActivos();

        // Si se solicita exportar
        if (isset($_GET['exportar'])) {
            $this->exportarReporteIngresos($ingresos, $resumen, $filtros);
            return;
        }

        $this->view('admin/reportes/ingresos', [
            'ingresos' => $ingresos,
            'resumen' => $resumen,
            'conductores' => $conductores,
            'filtros' => $filtros
        ]);
    }

    /**
     * Reporte de vehículos
     */
    public function vehiculos()
    {
        $this->requirePermission('reportes.ver');

        $filtros = [
            'fecha_inicio' => $_GET['fecha_inicio'] ?? date('Y-m-01'),
            'fecha_fin' => $_GET['fecha_fin'] ?? date('Y-m-d'),
            'vehiculo_id' => $_GET['vehiculo_id'] ?? '',
            'tipo_reporte' => $_GET['tipo_reporte'] ?? 'uso'
        ];

        // Obtener datos del reporte
        $datosReporte = $this->vehiculo->obtenerReporteUso($filtros);
        $vehiculos = $this->vehiculo->listarActivos();

        // Si se solicita exportar
        if (isset($_GET['exportar'])) {
            $this->exportarReporteVehiculos($datosReporte, $filtros);
            return;
        }

        $this->view('admin/reportes/vehiculos', [
            'datos_reporte' => $datosReporte,
            'vehiculos' => $vehiculos,
            'filtros' => $filtros
        ]);
    }

    /**
     * Reporte de clientes
     */
    public function clientes()
    {
        $this->requirePermission('reportes.ver');

        $filtros = [
            'fecha_inicio' => $_GET['fecha_inicio'] ?? date('Y-m-01'),
            'fecha_fin' => $_GET['fecha_fin'] ?? date('Y-m-d'),
            'cliente_id' => $_GET['cliente_id'] ?? '',
            'tipo_cliente' => $_GET['tipo_cliente'] ?? ''
        ];

        // Obtener datos del reporte
        $datosReporte = $this->cliente->obtenerReporteActividad($filtros);
        $clientesList = $this->cliente->listarActivos();

        // Si se solicita exportar
        if (isset($_GET['exportar'])) {
            $this->exportarReporteClientes($datosReporte, $filtros);
            return;
        }

        $this->view('admin/reportes/clientes', [
            'datos_reporte' => $datosReporte,
            'clientes_list' => $clientesList,
            'filtros' => $filtros
        ]);
    }

    /**
     * Dashboard ejecutivo con métricas generales
     */
    public function dashboard()
    {
        $this->requirePermission('reportes.dashboard');

        $periodo = $_GET['periodo'] ?? 'mes_actual';

        // Definir fechas según el período
        switch ($periodo) {
            case 'hoy':
                $fechaInicio = date('Y-m-d');
                $fechaFin = date('Y-m-d');
                break;
            case 'semana':
                $fechaInicio = date('Y-m-d', strtotime('monday this week'));
                $fechaFin = date('Y-m-d');
                break;
            case 'mes_actual':
                $fechaInicio = date('Y-m-01');
                $fechaFin = date('Y-m-d');
                break;
            case 'mes_anterior':
                $fechaInicio = date('Y-m-01', strtotime('first day of last month'));
                $fechaFin = date('Y-m-t', strtotime('last day of last month'));
                break;
            case 'personalizado':
                $fechaInicio = $_GET['fecha_inicio'] ?? date('Y-m-01');
                $fechaFin = $_GET['fecha_fin'] ?? date('Y-m-d');
                break;
            default:
                $fechaInicio = date('Y-m-01');
                $fechaFin = date('Y-m-d');
        }

        // Obtener métricas generales
        $metricas = [
            'viajes' => $this->viaje->obtenerMetricasGenerales($fechaInicio, $fechaFin),
            'ingresos' => $this->viaje->obtenerMetricasIngresos($fechaInicio, $fechaFin),
            'conductores' => $this->conductor->obtenerMetricas($fechaInicio, $fechaFin),
            'vehiculos' => $this->vehiculo->obtenerMetricas($fechaInicio, $fechaFin),
            'clientes' => $this->cliente->obtenerMetricas($fechaInicio, $fechaFin)
        ];

        // Datos para gráficos
        $graficos = [
            'viajes_por_dia' => $this->viaje->obtenerViajesPorDia($fechaInicio, $fechaFin),
            'ingresos_por_dia' => $this->viaje->obtenerIngresosPorDia($fechaInicio, $fechaFin),
            'top_conductores' => $this->conductor->obtenerTopConductores(10, $fechaInicio, $fechaFin),
            'distribucion_viajes' => $this->viaje->obtenerDistribucionPorHora($fechaInicio, $fechaFin)
        ];

        $this->view('admin/reportes/dashboard', [
            'metricas' => $metricas,
            'graficos' => $graficos,
            'periodo' => $periodo,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin
        ]);
    }

    /**
     * Exportar reporte de viajes a Excel
     */
    private function exportarReporteViajes($viajes, $filtros)
    {
        $nombreArchivo = 'reporte_viajes_' . date('Y-m-d_H-i-s') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $nombreArchivo);

        $output = fopen('php://output', 'w');

        // Escribir BOM para UTF-8
        fputs($output, "\xEF\xBB\xBF");

        // Cabeceras
        fputcsv($output, [
            'ID Viaje',
            'Fecha',
            'Conductor',
            'Vehículo',
            'Cliente',
            'Origen',
            'Destino',
            'Distancia (km)',
            'Tiempo (min)',
            'Tarifa',
            'Total',
            'Estado'
        ]);

        // Datos
        foreach ($viajes as $viaje) {
            fputcsv($output, [
                $viaje['id'],
                $viaje['fecha_viaje'],
                $viaje['conductor_nombre'],
                $viaje['vehiculo_placa'],
                $viaje['cliente_nombre'],
                $viaje['direccion_origen'],
                $viaje['direccion_destino'],
                $viaje['distancia_km'],
                $viaje['tiempo_minutos'],
                $viaje['tarifa_nombre'],
                '$' . number_format($viaje['total'], 2),
                $viaje['estado']
            ]);
        }

        fclose($output);
        exit;
    }

    /**
     * Exportar reporte de conductores
     */
    private function exportarReporteConductores($datos, $filtros)
    {
        $nombreArchivo = 'reporte_conductores_' . date('Y-m-d_H-i-s') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $nombreArchivo);

        $output = fopen('php://output', 'w');
        fputs($output, "\xEF\xBB\xBF");

        fputcsv($output, [
            'Conductor',
            'Total Viajes',
            'Ingresos Totales',
            'Promedio por Viaje',
            'Horas Trabajadas',
            'Km Recorridos',
            'Calificación Promedio'
        ]);

        foreach ($datos as $fila) {
            fputcsv($output, [
                $fila['conductor_nombre'],
                $fila['total_viajes'],
                '$' . number_format($fila['ingresos_totales'], 2),
                '$' . number_format($fila['promedio_viaje'], 2),
                $fila['horas_trabajadas'],
                $fila['km_recorridos'],
                number_format($fila['calificacion_promedio'], 1)
            ]);
        }

        fclose($output);
        exit;
    }

    /**
     * Exportar reporte de ingresos
     */
    private function exportarReporteIngresos($ingresos, $resumen, $filtros)
    {
        $nombreArchivo = 'reporte_ingresos_' . date('Y-m-d_H-i-s') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $nombreArchivo);

        $output = fopen('php://output', 'w');
        fputs($output, "\xEF\xBB\xBF");

        fputcsv($output, [
            'Período',
            'Total Viajes',
            'Ingresos Brutos',
            'Descuentos',
            'Ingresos Netos',
            'Promedio por Viaje'
        ]);

        foreach ($ingresos as $fila) {
            fputcsv($output, [
                $fila['periodo'],
                $fila['total_viajes'],
                '$' . number_format($fila['ingresos_brutos'], 2),
                '$' . number_format($fila['descuentos'], 2),
                '$' . number_format($fila['ingresos_netos'], 2),
                '$' . number_format($fila['promedio_viaje'], 2)
            ]);
        }

        fclose($output);
        exit;
    }

    /**
     * Exportar reporte de vehículos
     */
    private function exportarReporteVehiculos($datos, $filtros)
    {
        $nombreArchivo = 'reporte_vehiculos_' . date('Y-m-d_H-i-s') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $nombreArchivo);

        $output = fopen('php://output', 'w');
        fputs($output, "\xEF\xBB\xBF");

        fputcsv($output, [
            'Vehículo',
            'Conductor Asignado',
            'Total Viajes',
            'Km Recorridos',
            'Horas de Uso',
            'Ingresos Generados',
            'Estado'
        ]);

        foreach ($datos as $fila) {
            fputcsv($output, [
                $fila['vehiculo_info'],
                $fila['conductor_asignado'],
                $fila['total_viajes'],
                $fila['km_recorridos'],
                $fila['horas_uso'],
                '$' . number_format($fila['ingresos_generados'], 2),
                $fila['estado']
            ]);
        }

        fclose($output);
        exit;
    }

    /**
     * Exportar reporte de clientes
     */
    private function exportarReporteClientes($datos, $filtros)
    {
        $nombreArchivo = 'reporte_clientes_' . date('Y-m-d_H-i-s') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $nombreArchivo);

        $output = fopen('php://output', 'w');
        fputs($output, "\xEF\xBB\xBF");

        fputcsv($output, [
            'Cliente',
            'Tipo Cliente',
            'Total Viajes',
            'Gasto Total',
            'Promedio por Viaje',
            'Último Viaje',
            'Estado'
        ]);

        foreach ($datos as $fila) {
            fputcsv($output, [
                $fila['cliente_nombre'],
                $fila['tipo_cliente'],
                $fila['total_viajes'],
                '$' . number_format($fila['gasto_total'], 2),
                '$' . number_format($fila['promedio_viaje'], 2),
                $fila['ultimo_viaje'],
                $fila['estado']
            ]);
        }

        fclose($output);
        exit;
    }
}
