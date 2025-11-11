<?php

/**
 * Controlador PagoTarifaDiaria - Sistema PRIMERO DE JUNIO
 */
class PagoTarifaDiariaController extends Controller
{
    private $pagoTarifaDiaria;
    private $conductor;
    private $configuracion;

    public function __construct()
    {
        parent::__construct();
        $this->pagoTarifaDiaria = new PagoTarifaDiaria();
        $this->conductor = new Conductor();
        $this->configuracion = new Configuracion();
    }

    public function index()
    {
        $this->verificarPermiso('conductores.ver');
        
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $resumen = $this->pagoTarifaDiaria->obtenerResumenDiario($fecha);
        $pagados = $this->pagoTarifaDiaria->obtenerPagadosPorFecha($fecha);
        $pendientes = $this->pagoTarifaDiaria->obtenerPendientesPorFecha($fecha);

        $this->view('admin/tarifa-diaria/index', [
            'fecha' => $fecha,
            'resumen' => $resumen,
            'pagados' => $pagados,
            'pendientes' => $pendientes,
            'monto_tarifa' => $this->pagoTarifaDiaria->obtenerMontoTarifaDiaria()
        ]);
    }

    public function registrarPago($conductorId)
    {
        $this->verificarPermiso('conductores.editar');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datosRegistro = [
                    'fecha_pago' => $_POST['fecha_pago'] ?? date('Y-m-d'),
                    'monto_tarifa' => $_POST['monto_tarifa'] ?? $this->pagoTarifaDiaria->obtenerMontoTarifaDiaria(),
                    'metodo_pago' => $_POST['metodo_pago'] ?? 'efectivo',
                    'observaciones' => trim($_POST['observaciones'] ?? '')
                ];

                $usuarioActual = $this->getUsuarioActual();
                $this->pagoTarifaDiaria->registrarPago($conductorId, $datosRegistro, $usuarioActual['id']);
                
                $this->setFlash('success', 'Pago registrado exitosamente');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $this->redirect('/admin/tarifa-diaria');
    }

    public function registrarPagoAjax()
    {
        $this->verificarPermiso('conductores.editar');
        
        try {
            $conductorId = $_POST['conductor_id'];
            $datosRegistro = [
                'fecha_pago' => $_POST['fecha_pago'] ?? date('Y-m-d'),
                'monto_tarifa' => $_POST['monto_tarifa'] ?? $this->pagoTarifaDiaria->obtenerMontoTarifaDiaria(),
                'metodo_pago' => $_POST['metodo_pago'] ?? 'efectivo',
                'observaciones' => trim($_POST['observaciones'] ?? '')
            ];

            $usuarioActual = $this->getUsuarioActual();
            $resultado = $this->pagoTarifaDiaria->registrarPago($conductorId, $datosRegistro, $usuarioActual['id']);
            
            $this->jsonResponse([
                'success' => true,
                'message' => 'Pago registrado exitosamente',
                'pago_id' => $resultado
            ]);
        } catch (Exception $e) {
            $this->jsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function exonerar($conductorId)
    {
        $this->verificarPermiso('conductores.editar');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $fecha = $_POST['fecha'] ?? date('Y-m-d');
                $motivo = trim($_POST['motivo']);
                $usuarioActual = $this->getUsuarioActual();
                
                $this->pagoTarifaDiaria->exonerar($conductorId, $fecha, $motivo, $usuarioActual['id']);
                
                $this->setFlash('success', 'Conductor exonerado exitosamente');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $this->redirect('/admin/tarifa-diaria');
    }

    public function registroMasivo()
    {
        $this->verificarPermiso('conductores.editar');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $fecha = $_POST['fecha'] ?? date('Y-m-d');
                $conductoresPagados = $_POST['conductores_pagados'] ?? [];
                $conductoresExonerados = $_POST['conductores_exonerados'] ?? [];
                $usuarioActual = $this->getUsuarioActual();

                $registrados = 0;
                $errores = [];

                // Registrar pagos
                foreach ($conductoresPagados as $conductorId) {
                    try {
                        $datosRegistro = [
                            'fecha_pago' => $fecha,
                            'monto_tarifa' => $this->pagoTarifaDiaria->obtenerMontoTarifaDiaria(),
                            'metodo_pago' => 'efectivo'
                        ];
                        
                        $this->pagoTarifaDiaria->registrarPago($conductorId, $datosRegistro, $usuarioActual['id']);
                        $registrados++;
                    } catch (Exception $e) {
                        $errores[] = "Conductor ID $conductorId: " . $e->getMessage();
                    }
                }

                // Registrar exoneraciones
                foreach ($conductoresExonerados as $conductorId => $motivo) {
                    try {
                        $this->pagoTarifaDiaria->exonerar($conductorId, $fecha, $motivo, $usuarioActual['id']);
                        $registrados++;
                    } catch (Exception $e) {
                        $errores[] = "Conductor ID $conductorId: " . $e->getMessage();
                    }
                }

                if (empty($errores)) {
                    $this->setFlash('success', "Se registraron $registrados pagos exitosamente");
                } else {
                    $this->setFlash('warning', "Se registraron $registrados pagos. Errores: " . implode(', ', $errores));
                }
                
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $this->redirect('/admin/tarifa-diaria');
    }

    public function historial($conductorId = null)
    {
        $this->verificarPermiso('conductores.ver');
        
        $fechaInicio = $_GET['fecha_inicio'] ?? date('Y-m-01'); // Primer día del mes
        $fechaFin = $_GET['fecha_fin'] ?? date('Y-m-d');
        
        if ($conductorId) {
            $conductor = $this->conductor->find($conductorId);
            $historial = $this->pagoTarifaDiaria->obtenerHistorialConductor($conductorId, $fechaInicio, $fechaFin);
            $conductores = null;
        } else {
            $conductor = null;
            $historial = $this->pagoTarifaDiaria->buscar('', $fechaInicio);
            $conductores = $this->conductor->obtenerActivos();
        }

        $this->view('admin/tarifa-diaria/historial', [
            'conductor' => $conductor,
            'historial' => $historial,
            'conductores' => $conductores,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin
        ]);
    }

    public function reportes()
    {
        $this->verificarPermiso('reportes.ver');
        
        $mes = $_GET['mes'] ?? date('m');
        $ano = $_GET['ano'] ?? date('Y');
        
        $estadisticasMensuales = $this->pagoTarifaDiaria->obtenerEstadisticasMensuales($mes, $ano);
        $recaudacion = $this->pagoTarifaDiaria->obtenerRecaudacionPeriodo(
            "$ano-$mes-01",
            date('Y-m-t', mktime(0, 0, 0, $mes, 1, $ano))
        );
        $morosos = $this->pagoTarifaDiaria->obtenerMorosos(3); // 3 días de atraso

        $this->view('admin/tarifa-diaria/reportes', [
            'mes' => $mes,
            'ano' => $ano,
            'estadisticas' => $estadisticasMensuales,
            'recaudacion' => $recaudacion,
            'morosos' => $morosos
        ]);
    }

    public function configuracion()
    {
        $this->verificarPermiso('config.editar');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $nuevoMonto = $_POST['monto_tarifa'];
                $obligatoria = isset($_POST['obligatoria']) ? 1 : 0;
                $horaLimite = $_POST['hora_limite'];
                
                $this->configuracion->establecer('tarifa_diaria_monto', $nuevoMonto, 'integer');
                $this->configuracion->establecer('tarifa_diaria_obligatoria', $obligatoria, 'boolean');
                $this->configuracion->establecer('tarifa_diaria_hora_limite', $horaLimite, 'string');
                
                $this->setFlash('success', 'Configuración actualizada exitosamente');
                $this->redirect('/admin/tarifa-diaria/configuracion');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $configuraciones = [
            'monto' => $this->configuracion->obtener('tarifa_diaria_monto', 15000),
            'obligatoria' => $this->configuracion->obtener('tarifa_diaria_obligatoria', true),
            'hora_limite' => $this->configuracion->obtener('tarifa_diaria_hora_limite', '08:00')
        ];

        $this->view('admin/tarifa-diaria/configuracion', [
            'configuraciones' => $configuraciones
        ]);
    }

    public function buscar()
    {
        $this->verificarPermiso('conductores.ver');
        
        $termino = $_GET['q'] ?? '';
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        
        $resultados = [];
        if (strlen($termino) >= 2) {
            $resultados = $this->pagoTarifaDiaria->buscar($termino, $fecha);
        }

        $this->jsonResponse($resultados);
    }

    public function verificarPago($conductorId)
    {
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $pago = $this->pagoTarifaDiaria->verificarPagoHoy($conductorId);
        
        $this->jsonResponse([
            'ha_pagado' => $pago['ha_pagado'],
            'puede_trabajar' => $pago['puede_trabajar'],
            'pago_info' => $pago['pago_info']
        ]);
    }

    public function estadisticas()
    {
        $this->verificarPermiso('reportes.ver');
        
        $periodo = $_GET['periodo'] ?? 'mes';
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        
        $stats = [];
        
        switch ($periodo) {
            case 'dia':
                $stats = $this->pagoTarifaDiaria->obtenerResumenDiario($fecha);
                break;
            case 'mes':
                $mes = date('m', strtotime($fecha));
                $ano = date('Y', strtotime($fecha));
                $stats = $this->pagoTarifaDiaria->obtenerEstadisticasMensuales($mes, $ano);
                break;
        }

        $this->jsonResponse($stats);
    }

    public function exportar()
    {
        $this->verificarPermiso('reportes.exportar');
        
        $fechaInicio = $_GET['fecha_inicio'] ?? date('Y-m-01');
        $fechaFin = $_GET['fecha_fin'] ?? date('Y-m-d');
        $conductorId = $_GET['conductor_id'] ?? null;
        
        if ($conductorId) {
            $datos = $this->pagoTarifaDiaria->obtenerHistorialConductor($conductorId, $fechaInicio, $fechaFin);
        } else {
            // Obtener todos los pagos del período
            $datos = $this->pagoTarifaDiaria->buscar('', $fechaInicio);
        }

        $this->jsonResponse([
            'datos' => $datos,
            'periodo' => "$fechaInicio al $fechaFin",
            'total_registros' => count($datos)
        ]);
    }

    public function marcarPendiente($conductorId)
    {
        $this->verificarPermiso('conductores.editar');
        
        try {
            $fecha = $_POST['fecha'] ?? date('Y-m-d');
            $usuarioActual = $this->getUsuarioActual();
            
            $this->pagoTarifaDiaria->marcarComoPendiente($conductorId, $fecha, $usuarioActual['id']);
            
            $this->jsonResponse([
                'success' => true,
                'message' => 'Marcado como pendiente'
            ]);
        } catch (Exception $e) {
            $this->jsonResponse([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
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