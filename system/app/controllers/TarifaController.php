<?php

/**
 * Controlador Tarifa - Sistema PRIMERO DE JUNIO
 */
class TarifaController extends Controller
{
    private $tarifa;

    public function __construct()
    {
        parent::__construct();
        $this->tarifa = new Tarifa();
    }

    public function index()
    {
        $this->requirePermission('tarifas.ver');

        $filtros = [
            'buscar' => $_GET['buscar'] ?? '',
            'estado' => $_GET['estado'] ?? ''
        ];

        $tarifas = $this->tarifa->listarConFiltros($filtros);
        $estadisticas = $this->tarifa->obtenerEstadisticas();

        $this->view('tarifas/index', [
            'tarifas' => $tarifas,
            'filtros' => $filtros,
            'estadisticas' => $estadisticas
        ]);
    }

    public function crear()
    {
        $this->requirePermission('tarifas.crear');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'nombre' => trim($_POST['nombre']),
                    'descripcion' => trim($_POST['descripcion'] ?? ''),
                    'tarifa_base' => floatval($_POST['tarifa_base']),
                    'tarifa_por_km' => floatval($_POST['tarifa_por_km'] ?? 0),
                    'tarifa_por_minuto' => floatval($_POST['tarifa_por_minuto'] ?? 0),
                    'tarifa_minima' => floatval($_POST['tarifa_minima'] ?? 0),
                    'tarifa_maxima' => floatval($_POST['tarifa_maxima'] ?? 0),
                    'recargo_nocturno' => floatval($_POST['recargo_nocturno'] ?? 0),
                    'recargo_festivo' => floatval($_POST['recargo_festivo'] ?? 0),
                    'recargo_lluvia' => floatval($_POST['recargo_lluvia'] ?? 0),
                    'hora_inicio_nocturno' => $_POST['hora_inicio_nocturno'] ?? '22:00',
                    'hora_fin_nocturno' => $_POST['hora_fin_nocturno'] ?? '06:00',
                    'estado' => 'activa'
                ];

                // Validaciones
                $errores = $this->validarDatosTarifa($datos);
                if (!empty($errores)) {
                    throw new Exception(implode('<br>', $errores));
                }

                $id = $this->tarifa->create($datos);

                $this->setFlash('success', 'Tarifa creada exitosamente');
                $this->redirect('/admin/tarifas/editar/' . $id);
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
                $this->view('tarifas/crear', [
                    'datos' => $_POST,
                    'error' => $e->getMessage()
                ]);
                return;
            }
        }

        $this->view('tarifas/crear');
    }

    public function editar($id)
    {
        $this->requirePermission('tarifas.editar');

        $tarifa = $this->tarifa->find($id);
        if (!$tarifa) {
            $this->setFlash('error', 'Tarifa no encontrada');
            $this->redirect('/admin/tarifas');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'nombre' => trim($_POST['nombre']),
                    'descripcion' => trim($_POST['descripcion'] ?? ''),
                    'tarifa_base' => floatval($_POST['tarifa_base']),
                    'tarifa_por_km' => floatval($_POST['tarifa_por_km'] ?? 0),
                    'tarifa_por_minuto' => floatval($_POST['tarifa_por_minuto'] ?? 0),
                    'tarifa_minima' => floatval($_POST['tarifa_minima'] ?? 0),
                    'tarifa_maxima' => floatval($_POST['tarifa_maxima'] ?? 0),
                    'recargo_nocturno' => floatval($_POST['recargo_nocturno'] ?? 0),
                    'recargo_festivo' => floatval($_POST['recargo_festivo'] ?? 0),
                    'recargo_lluvia' => floatval($_POST['recargo_lluvia'] ?? 0),
                    'hora_inicio_nocturno' => $_POST['hora_inicio_nocturno'] ?? '22:00',
                    'hora_fin_nocturno' => $_POST['hora_fin_nocturno'] ?? '06:00',
                    'estado' => $_POST['estado'] ?? 'activa'
                ];

                // Validaciones
                $errores = $this->validarDatosTarifa($datos, $id);
                if (!empty($errores)) {
                    throw new Exception(implode('<br>', $errores));
                }

                $this->tarifa->update($id, $datos);

                $this->setFlash('success', 'Tarifa actualizada exitosamente');
                $this->redirect('/admin/tarifas/editar/' . $id);
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $this->view('tarifas/editar', [
            'tarifa' => $tarifa
        ]);
    }

    public function eliminar($id)
    {
        $this->requirePermission('tarifas.eliminar');

        try {
            $tarifa = $this->tarifa->find($id);
            if (!$tarifa) {
                throw new Exception('Tarifa no encontrada');
            }

            // Verificar si la tarifa está siendo utilizada en viajes
            $viajesAsociados = $this->tarifa->verificarUsoEnViajes($id);
            if ($viajesAsociados > 0) {
                throw new Exception('No se puede eliminar la tarifa porque está asociada a ' . $viajesAsociados . ' viaje(s)');
            }

            $this->tarifa->delete($id);

            $this->setFlash('success', 'Tarifa eliminada exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/tarifas');
    }

    public function cambiarEstado($id)
    {
        $this->requirePermission('tarifas.editar');

        try {
            $tarifa = $this->tarifa->find($id);
            if (!$tarifa) {
                throw new Exception('Tarifa no encontrada');
            }

            $nuevoEstado = $tarifa['estado'] === 'activa' ? 'inactiva' : 'activa';
            $this->tarifa->update($id, ['estado' => $nuevoEstado]);

            $this->setFlash('success', 'Estado de la tarifa actualizado exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/tarifas');
    }

    /**
     * Calcular tarifa para un viaje
     */
    public function calcular()
    {
        $this->requirePermission('tarifas.ver');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $tarifaId = $_POST['tarifa_id'] ?? null;
                $distancia = floatval($_POST['distancia'] ?? 0);
                $tiempoMinutos = intval($_POST['duracion_minutos'] ?? 0);
                $esNocturno = isset($_POST['es_nocturno']);
                $esFestivo = isset($_POST['es_festivo']);
                $hayLluvia = isset($_POST['hay_lluvia']);

                if (!$tarifaId) {
                    throw new Exception('Debe seleccionar una tarifa');
                }

                $tarifa = $this->tarifa->find($tarifaId);
                if (!$tarifa) {
                    throw new Exception('Tarifa no encontrada');
                }

                $calculo = $this->tarifa->calcularPrecio(
                    $tarifa,
                    $distancia,
                    $tiempoMinutos,
                    $esNocturno,
                    $esFestivo,
                    $hayLluvia
                );

                $this->jsonResponse([
                    'success' => true,
                    'calculo' => $calculo
                ]);
            } catch (Exception $e) {
                $this->jsonResponse([
                    'success' => false,
                    'error' => $e->getMessage()
                ]);
            }
            return;
        }

        $tarifasActivas = $this->tarifa->listarActivas();

        $this->view('tarifas/calcular', [
            'tarifas' => $tarifasActivas
        ]);
    }

    private function validarDatosTarifa($datos, $idExcluir = null)
    {
        $errores = [];

        // Validar nombre
        if (empty($datos['nombre'])) {
            $errores[] = 'El nombre es obligatorio';
        } elseif (strlen($datos['nombre']) < 3) {
            $errores[] = 'El nombre debe tener al menos 3 caracteres';
        } else {
            // Verificar nombre único
            $existente = $this->tarifa->buscarPorNombre($datos['nombre']);
            if ($existente && (!$idExcluir || $existente['id'] != $idExcluir)) {
                $errores[] = 'Ya existe una tarifa con ese nombre';
            }
        }

        // Validar tarifas
        if ($datos['tarifa_base'] < 0) {
            $errores[] = 'La tarifa base no puede ser negativa';
        }
        if ($datos['tarifa_por_km'] < 0) {
            $errores[] = 'La tarifa por km no puede ser negativa';
        }
        if ($datos['tarifa_por_minuto'] < 0) {
            $errores[] = 'La tarifa por minuto no puede ser negativa';
        }

        // Validar tarifas mínima y máxima
        if ($datos['tarifa_minima'] < 0) {
            $errores[] = 'La tarifa mínima no puede ser negativa';
        }
        if ($datos['tarifa_maxima'] > 0 && $datos['tarifa_maxima'] < $datos['tarifa_minima']) {
            $errores[] = 'La tarifa máxima debe ser mayor que la tarifa mínima';
        }

        // Validar recargos
        if ($datos['recargo_nocturno'] < 0) {
            $errores[] = 'El recargo nocturno no puede ser negativo';
        }
        if ($datos['recargo_festivo'] < 0) {
            $errores[] = 'El recargo festivo no puede ser negativo';
        }
        if ($datos['recargo_lluvia'] < 0) {
            $errores[] = 'El recargo por lluvia no puede ser negativo';
        }

        return $errores;
    }
}
