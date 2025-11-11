<?php

/**
 * Controlador Usuario - Sistema PRIMERO DE JUNIO
 */
class UsuarioController extends Controller
{
    private $usuario;
    private $rol;
    private $perfil;

    public function __construct()
    {
        parent::__construct();
        $this->usuario = new Usuario();
        $this->rol = new Rol();
        $this->perfil = new Perfil();
    }

    public function index()
    {
        $this->verificarPermiso('usuarios.ver');
        
        $filtros = [
            'buscar' => $_GET['buscar'] ?? '',
            'rol_id' => $_GET['rol_id'] ?? '',
            'estado' => $_GET['estado'] ?? ''
        ];

        $usuarios = $this->usuario->listarConFiltros($filtros);
        $roles = $this->rol->obtenerActivos();
        $estadisticas = $this->usuario->obtenerEstadisticas();

        $this->view('admin/usuarios/index', [
            'usuarios' => $usuarios,
            'roles' => $roles,
            'filtros' => $filtros,
            'estadisticas' => $estadisticas
        ]);
    }

    public function crear()
    {
        $this->verificarPermiso('usuarios.crear');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'nombre' => trim($_POST['nombre']),
                    'apellido' => trim($_POST['apellido']),
                    'email' => trim($_POST['email']),
                    'telefono' => trim($_POST['telefono'] ?? ''),
                    'direccion' => trim($_POST['direccion'] ?? ''),
                    'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? null,
                    'rol_id' => $_POST['rol_id'],
                    'password' => $_POST['password'],
                    'estado' => $_POST['estado'] ?? 'activo'
                ];

                $usuarioId = $this->usuario->create($datos);

                // Crear perfil si hay datos adicionales
                if (!empty($_POST['telefono_personal']) || !empty($_POST['direccion_residencia'])) {
                    $datosPerfil = [
                        'telefono_personal' => $_POST['telefono_personal'] ?? '',
                        'direccion_residencia' => $_POST['direccion_residencia'] ?? '',
                        'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? null,
                        'tipo_sangre' => $_POST['tipo_sangre'] ?? '',
                        'contacto_emergencia_nombre' => $_POST['contacto_emergencia_nombre'] ?? '',
                        'contacto_emergencia_telefono' => $_POST['contacto_emergencia_telefono'] ?? ''
                    ];
                    $this->perfil->crearOActualizar($usuarioId, $datosPerfil);
                }

                $this->setFlash('success', 'Usuario creado exitosamente');
                $this->redirect('/admin/usuarios');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $roles = $this->rol->obtenerActivos();
        $this->view('admin/usuarios/crear', ['roles' => $roles]);
    }

    public function editar($id)
    {
        $this->verificarPermiso('usuarios.editar');
        
        $usuario = $this->usuario->find($id);
        if (!$usuario) {
            $this->setFlash('error', 'Usuario no encontrado');
            $this->redirect('/admin/usuarios');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'nombre' => trim($_POST['nombre']),
                    'apellido' => trim($_POST['apellido']),
                    'email' => trim($_POST['email']),
                    'telefono' => trim($_POST['telefono'] ?? ''),
                    'direccion' => trim($_POST['direccion'] ?? ''),
                    'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? null,
                    'rol_id' => $_POST['rol_id'],
                    'estado' => $_POST['estado']
                ];

                // Solo actualizar password si se proporciona
                if (!empty($_POST['password'])) {
                    $datos['password'] = $_POST['password'];
                }

                $this->usuario->update($id, $datos);

                // Actualizar perfil
                $datosPerfil = [
                    'telefono_personal' => $_POST['telefono_personal'] ?? '',
                    'direccion_residencia' => $_POST['direccion_residencia'] ?? '',
                    'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? null,
                    'tipo_sangre' => $_POST['tipo_sangre'] ?? '',
                    'contacto_emergencia_nombre' => $_POST['contacto_emergencia_nombre'] ?? '',
                    'contacto_emergencia_telefono' => $_POST['contacto_emergencia_telefono'] ?? ''
                ];
                $this->perfil->crearOActualizar($id, $datosPerfil);

                $this->setFlash('success', 'Usuario actualizado exitosamente');
                $this->redirect('/admin/usuarios');
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $roles = $this->rol->obtenerActivos();
        $perfilUsuario = $this->perfil->obtenerPorUsuario($id);
        
        $this->view('admin/usuarios/editar', [
            'usuario' => $usuario,
            'roles' => $roles,
            'perfil' => $perfilUsuario
        ]);
    }

    public function eliminar($id)
    {
        $this->verificarPermiso('usuarios.eliminar');
        
        try {
            if (!$this->usuario->puedeEliminar($id)) {
                throw new Exception('No se puede eliminar este usuario');
            }

            $this->usuario->delete($id);
            $this->setFlash('success', 'Usuario eliminado exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/usuarios');
    }

    public function activar($id)
    {
        $this->verificarPermiso('usuarios.editar');
        
        try {
            $this->usuario->activar($id);
            $this->setFlash('success', 'Usuario activado exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/usuarios');
    }

    public function desactivar($id)
    {
        $this->verificarPermiso('usuarios.editar');
        
        try {
            $this->usuario->desactivar($id);
            $this->setFlash('success', 'Usuario desactivado exitosamente');
        } catch (Exception $e) {
            $this->setFlash('error', $e->getMessage());
        }

        $this->redirect('/admin/usuarios');
    }

    public function perfil($id = null)
    {
        if (!$id) {
            $id = $this->getUsuarioActual()['id'];
        }

        $usuario = $this->usuario->find($id);
        if (!$usuario) {
            $this->setFlash('error', 'Usuario no encontrado');
            $this->redirect('/dashboard');
            return;
        }

        // Verificar permisos: solo puede ver su propio perfil o tener permisos de usuarios
        if ($id != $this->getUsuarioActual()['id']) {
            $this->verificarPermiso('usuarios.ver');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Actualizar datos básicos del usuario
                $datosUsuario = [
                    'nombre' => trim($_POST['nombre']),
                    'apellido' => trim($_POST['apellido']),
                    'email' => trim($_POST['email'])
                ];

                // Solo actualizar password si se proporciona
                if (!empty($_POST['password'])) {
                    $datosUsuario['password'] = $_POST['password'];
                }

                $this->usuario->update($id, $datosUsuario);

                // Actualizar perfil
                $datosPerfil = [
                    'telefono_personal' => $_POST['telefono_personal'] ?? '',
                    'telefono_emergencia' => $_POST['telefono_emergencia'] ?? '',
                    'direccion_residencia' => $_POST['direccion_residencia'] ?? '',
                    'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? null,
                    'tipo_sangre' => $_POST['tipo_sangre'] ?? '',
                    'contacto_emergencia_nombre' => $_POST['contacto_emergencia_nombre'] ?? '',
                    'contacto_emergencia_telefono' => $_POST['contacto_emergencia_telefono'] ?? '',
                    'observaciones' => $_POST['observaciones'] ?? ''
                ];

                $this->perfil->crearOActualizar($id, $datosPerfil);

                $this->setFlash('success', 'Perfil actualizado exitosamente');
                $this->redirect('/admin/usuarios/perfil/' . $id);
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
            }
        }

        $perfilUsuario = $this->perfil->obtenerPorUsuario($id);
        $this->view('admin/usuarios/perfil', [
            'usuario' => $usuario,
            'perfil' => $perfilUsuario,
            'tipos_sangre' => $this->perfil->obtenerTiposSangre()
        ]);
    }

    public function buscar()
    {
        $this->verificarPermiso('usuarios.ver');
        
        $termino = $_GET['q'] ?? '';
        $usuarios = [];
        
        if (strlen($termino) >= 2) {
            $usuarios = $this->usuario->buscar($termino);
        }

        $this->jsonResponse($usuarios);
    }

    public function exportar()
    {
        $this->verificarPermiso('usuarios.ver');
        
        $formato = $_GET['formato'] ?? 'excel';
        $usuarios = $this->usuario->obtenerConRoles();

        // Aquí implementarías la lógica de exportación
        // Por ahora, retornamos JSON
        if ($formato === 'json') {
            $this->jsonResponse($usuarios);
        } else {
            // Para Excel, CSV, etc., implementar según necesidades
            $this->setFlash('info', 'Funcionalidad de exportación en desarrollo');
            $this->redirect('/admin/usuarios');
        }
    }

    public function estadisticas()
    {
        $this->verificarPermiso('usuarios.ver');
        
        $stats = $this->usuario->obtenerEstadisticas();
        $distribucionRoles = $this->usuario->obtenerDistribucionRoles();
        $actividad = $this->usuario->obtenerActividadReciente();

        $this->jsonResponse([
            'estadisticas' => $stats,
            'distribucion_roles' => $distribucionRoles,
            'actividad_reciente' => $actividad
        ]);
    }

    public function cambiarPassword($id)
    {
        // Solo admin puede cambiar password de otros usuarios
        if ($id != $this->getUsuarioActual()['id']) {
            $this->verificarPermiso('usuarios.editar');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $passwordActual = $_POST['password_actual'] ?? '';
                $passwordNuevo = $_POST['password_nuevo'] ?? '';
                $passwordConfirmar = $_POST['password_confirmar'] ?? '';

                // Verificar password actual si es el mismo usuario
                if ($id == $this->getUsuarioActual()['id']) {
                    $usuario = $this->usuario->find($id);
                    if (!$this->usuario->verificarPassword($passwordActual, $usuario['password'])) {
                        throw new Exception('Password actual incorrecto');
                    }
                }

                // Validar nuevo password
                if (strlen($passwordNuevo) < 6) {
                    throw new Exception('El nuevo password debe tener al menos 6 caracteres');
                }

                if ($passwordNuevo !== $passwordConfirmar) {
                    throw new Exception('Los passwords no coinciden');
                }

                $this->usuario->update($id, ['password' => $passwordNuevo]);
                $this->setFlash('success', 'Password actualizado exitosamente');
                
                $this->redirect('/admin/usuarios/perfil/' . $id);
            } catch (Exception $e) {
                $this->setFlash('error', $e->getMessage());
                $this->redirect('/admin/usuarios/perfil/' . $id);
            }
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