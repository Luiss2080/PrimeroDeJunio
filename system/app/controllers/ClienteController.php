<?php

/**
 * Controlador Cliente - Sistema PRIMERO DE JUNIO
 */
class ClienteController extends Controller
{
    private $cliente;

    public function __construct()
    {
        parent::__construct();
        $this->cliente = new Cliente();
    }

    public function index()
    {
        $this->verificarPermiso('clientes.ver');
        
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

    public function crear()
    {
        $this->verificarPermiso('clientes.crear');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'nombre' => trim($_POST['nombre']),
                    'apellido' => trim($_POST['apellido'] ?? ''),
                    'telefono' => trim($_POST['telefono']),
                    'email' => trim($_POST['email'] ?? ''),
                    'direccion_habitual' => trim($_POST['direccion_habitual'] ?? ''),
                    'tipo_cliente' => $_POST['tipo_cliente'] ?? 'particular',
                    'observaciones' => trim($_POST['observaciones'] ?? ''),
                    'descuento_porcentaje' => $_POST['descuento_porcentaje'] ?? 0,
                    'estado' => $_POST['estado'] ?? 'activo'
                ];

                $this->cliente->create($datos);
                $this->setFlash('success', 'Cliente creado exitosamente');
                $this->redirect('/admin/clientes');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $this->view('admin/clientes/crear');
    }

    public function editar($id)
    {
        $this->verificarPermiso('clientes.editar');
        
        $cliente = $this->cliente->find($id);
        if (!$cliente) {
            $this->setFlash('error', 'Cliente no encontrado');
            $this->redirect('/admin/clientes');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'nombre' => trim($_POST['nombre']),
                    'apellido' => trim($_POST['apellido'] ?? ''),
                    'telefono' => trim($_POST['telefono']),
                    'email' => trim($_POST['email'] ?? ''),
                    'direccion_habitual' => trim($_POST['direccion_habitual'] ?? ''),
                    'tipo_cliente' => $_POST['tipo_cliente'],
                    'observaciones' => trim($_POST['observaciones'] ?? ''),
                    'descuento_porcentaje' => $_POST['descuento_porcentaje'] ?? 0,
                    'estado' => $_POST['estado']
                ];

                $this->cliente->update($id, $datos);
                $this->setFlash('success', 'Cliente actualizado exitosamente');
                $this->redirect('/admin/clientes');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $this->view('admin/clientes/editar', ['cliente' => $cliente]);
    }

    public function ver($id)
    {
        $this->verificarPermiso('clientes.ver');
        
        $cliente = $this->cliente->find($id);
        if (!$cliente) {
            $this->setFlash('error', 'Cliente no encontrado');
            $this->redirect('/admin/clientes');
            return;
        }

        $historialViajes = $this->cliente->obtenerHistorialViajes($id);
        $estadisticasViajes = $this->cliente->obtenerEstadisticasViajes($id);
        $lugaresComunes = $this->cliente->obtenerLugaresComunes($id);

        $this->view('admin/clientes/ver', [
            'cliente' => $cliente,
            'historial_viajes' => $historialViajes,
            'estadisticas' => $estadisticasViajes,
            'lugares_comunes' => $lugaresComunes
        ]);
    }

    public function eliminar($id)
    {
        $this->verificarPermiso('clientes.eliminar');
        
        try {
            if (!$this->cliente->puedeEliminar($id)) {
                throw new Exception('No se puede eliminar este cliente porque tiene viajes asociados');
            }

            $this->cliente->delete($id);
            $this->setFlash('success', 'Cliente eliminado exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/clientes');
    }

    public function activar($id)
    {
        $this->verificarPermiso('clientes.editar');
        
        try {
            $this->cliente->activar($id);
            $this->setFlash('success', 'Cliente activado exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/clientes');
    }

    public function desactivar($id)
    {
        $this->verificarPermiso('clientes.editar');
        
        try {
            $this->cliente->desactivar($id);
            $this->setFlash('success', 'Cliente desactivado exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/clientes');
    }

    public function historialViajes($id)
    {
        $this->verificarPermiso('clientes.ver');
        
        $cliente = $this->cliente->find($id);
        if (!$cliente) {
            $this->setFlash('error', 'Cliente no encontrado');
            $this->redirect('/admin/clientes');
            return;
        }

        $fechaInicio = $_GET['fecha_inicio'] ?? null;
        $fechaFin = $_GET['fecha_fin'] ?? null;
        
        $viajes = $this->cliente->obtenerHistorialViajes($id, null, null, $fechaInicio, $fechaFin);
        $estadisticas = $this->cliente->obtenerEstadisticasViajes($id, $fechaInicio, $fechaFin);

        $this->view('admin/clientes/historial-viajes', [
            'cliente' => $cliente,
            'viajes' => $viajes,
            'estadisticas' => $estadisticas,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin
        ]);
    }

    public function frecuentes()
    {
        $this->verificarPermiso('clientes.ver');
        
        $limite = $_GET['limite'] ?? 50;
        $clientesFrecuentes = $this->cliente->obtenerClientesFrecuentes($limite);
        
        $this->view('admin/clientes/frecuentes', [
            'clientes' => $clientesFrecuentes,
            'limite' => $limite
        ]);
    }

    public function inactivos()
    {
        $this->verificarPermiso('clientes.ver');
        
        $diasInactividad = $_GET['dias'] ?? 90;
        $clientesInactivos = $this->cliente->obtenerInactivos($diasInactividad);
        
        $this->view('admin/clientes/inactivos', [
            'clientes' => $clientesInactivos,
            'dias' => $diasInactividad
        ]);
    }

    public function buscar()
    {
        $this->verificarPermiso('clientes.ver');
        
        $termino = $_GET['q'] ?? '';
        $clientes = [];
        
        if (strlen($termino) >= 2) {
            $clientes = $this->cliente->buscar($termino);
        }

        $this->jsonResponse($clientes);
    }

    public function exportar()
    {
        $this->verificarPermiso('clientes.ver');
        
        $tipo = $_GET['tipo'] ?? '';
        $estado = $_GET['estado'] ?? '';
        
        $filtros = [
            'tipo' => $tipo,
            'estado' => $estado
        ];

        $clientes = $this->cliente->listarConFiltros($filtros);
        $this->jsonResponse($clientes);
    }

    public function estadisticas()
    {
        $this->verificarPermiso('clientes.ver');
        
        $stats = $this->cliente->obtenerEstadisticas();
        $this->jsonResponse($stats);
    }

    public function reporteGeneral()
    {
        $this->verificarPermiso('clientes.ver');
        
        $estadisticas = $this->cliente->obtenerEstadisticas();
        $frecuentes = $this->cliente->obtenerClientesFrecuentes(10);
        $nuevos = $this->cliente->obtenerClientesNuevos(30);
        $inactivos = $this->cliente->obtenerInactivos(90);
        $distribucionTipos = $this->cliente->obtenerDistribucionTipos();

        $this->view('admin/clientes/reporte-general', [
            'estadisticas' => $estadisticas,
            'frecuentes' => $frecuentes,
            'nuevos' => $nuevos,
            'inactivos' => $inactivos,
            'distribucion_tipos' => $distribucionTipos
        ]);
    }

    public function marcarComoVip($id)
    {
        $this->verificarPermiso('clientes.editar');
        
        try {
            $this->cliente->update($id, ['tipo_cliente' => 'frecuente']);
            $this->setFlash('success', 'Cliente marcado como VIP');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/clientes/ver/' . $id);
    }

    public function quitarVip($id)
    {
        $this->verificarPermiso('clientes.editar');
        
        try {
            $this->cliente->update($id, ['tipo_cliente' => 'particular']);
            $this->setFlash('success', 'Cliente marcado como particular');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/clientes/ver/' . $id);
    }

    public function agregarObservacion($id)
    {
        $this->verificarPermiso('clientes.editar');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $cliente = $this->cliente->find($id);
                $observacionActual = $cliente['observaciones'] ?? '';
                $nuevaObservacion = trim($_POST['observacion']);
                
                if ($nuevaObservacion) {
                    $fecha = date('Y-m-d H:i:s');
                    $usuario = $this->getUsuarioActual()['nombre'];
                    $observacionCompleta = "[$fecha - $usuario] $nuevaObservacion";
                    
                    if ($observacionActual) {
                        $observaciones = $observacionActual . "\n" . $observacionCompleta;
                    } else {
                        $observaciones = $observacionCompleta;
                    }
                    
                    $this->cliente->update($id, ['observaciones' => $observaciones]);
                    $this->setFlash('success', 'Observación agregada exitosamente');
                }
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $this->redirect('/admin/clientes/ver/' . $id);
    }

    public function duplicar($id)
    {
        $this->verificarPermiso('clientes.crear');
        
        try {
            $cliente = $this->cliente->find($id);
            if (!$cliente) {
                throw new Exception('Cliente no encontrado');
            }

            // Limpiar datos para duplicar
            unset($cliente['id']);
            unset($cliente['created_at']);
            unset($cliente['updated_at']);
            
            $cliente['nombre'] = $cliente['nombre'] . ' (Copia)';
            $cliente['telefono'] = ''; // Limpiar teléfono para evitar duplicados
            $cliente['tipo_cliente'] = 'particular';
            
            $nuevoId = $this->cliente->create($cliente);
            $this->setFlash('success', 'Cliente duplicado exitosamente');
            $this->redirect('/admin/clientes/editar/' . $nuevoId);
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
            $this->redirect('/admin/clientes/ver/' . $id);
        }
    }

    public function validarDocumento()
    {
        $documento = $_GET['documento'] ?? '';
        $excludeId = $_GET['exclude_id'] ?? null;
        
        $existe = $this->cliente->validarDocumentoUnico($documento, $excludeId);
        $this->jsonResponse(['disponible' => $existe]);
    }

    public function validarTelefono()
    {
        $telefono = $_GET['telefono'] ?? '';
        $excludeId = $_GET['exclude_id'] ?? null;
        
        $existe = $this->cliente->validarTelefonoUnico($telefono, $excludeId);
        $this->jsonResponse(['disponible' => $existe]);
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