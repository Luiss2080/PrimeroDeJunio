<?php

/**
 * Rutas del Sistema PRIMERO DE JUNIO
 * Configuración de todas las rutas de la aplicación
 */

return [
    // ========================================
    // RUTAS DE AUTENTICACIÓN
    // ========================================
    'GET|' => 'LoginController@index',
    'GET|login' => 'LoginController@index',
    'POST|login' => 'LoginController@login',
    'GET|logout' => 'LoginController@logout',
    'POST|logout' => 'LoginController@logout',

    // Rutas de Recuperación de Contraseña
    'GET|recuperar' => 'LoginController@recuperar',
    'POST|recuperar' => 'LoginController@recuperar',
    'GET|reset/{token}' => 'LoginController@reset',
    'POST|reset/{token}' => 'LoginController@reset',

    // Cambio de Contraseña
    'GET|cambiar-password' => 'LoginController@cambiarPassword',
    'POST|cambiar-password' => 'LoginController@cambiarPassword',

    // API de Sesión (AJAX)
    'GET|api/verificar-sesion' => 'LoginController@verificarSesion',
    'POST|api/extender-sesion' => 'LoginController@extenderSesion',

    // ========================================
    // RUTAS ADMINISTRATIVAS
    // ========================================

    // Dashboard Admin
    'GET|admin' => 'AdminController@index',
    'GET|admin/dashboard' => 'AdminController@dashboard',

    // Gestión de Usuarios (Admin)
    'GET|admin/usuarios' => 'AdminController@usuarios',
    'GET|admin/usuarios/crear' => 'AdminController@crearUsuario',
    'POST|admin/usuarios/crear' => 'AdminController@crearUsuario',
    'GET|admin/usuarios/{id}' => 'AdminController@verUsuario',
    'GET|admin/usuarios/{id}/editar' => 'AdminController@editarUsuario',
    'POST|admin/usuarios/{id}/editar' => 'AdminController@editarUsuario',
    'POST|admin/usuarios/{id}/activar' => 'AdminController@activarUsuario',
    'POST|admin/usuarios/{id}/desactivar' => 'AdminController@desactivarUsuario',
    'DELETE|admin/usuarios/{id}' => 'AdminController@eliminarUsuario',

    // Gestión de Roles y Permisos (Admin)
    'GET|admin/roles' => 'AdminController@roles',
    'GET|admin/permisos' => 'AdminController@permisos',
    'POST|admin/roles/{id}/permisos' => 'AdminController@asignarPermisos',

    // Gestión de Conductores (Admin)
    'GET|admin/conductores' => 'AdminController@conductores',
    'GET|admin/conductores/crear' => 'AdminController@crearConductor',
    'POST|admin/conductores/crear' => 'AdminController@crearConductor',
    'GET|admin/conductores/{id}' => 'AdminController@verConductor',
    'GET|admin/conductores/{id}/editar' => 'AdminController@editarConductor',
    'POST|admin/conductores/{id}/editar' => 'AdminController@editarConductor',

    // Gestión de Vehículos (Admin)
    'GET|admin/vehiculos' => 'AdminController@vehiculos',
    'GET|admin/vehiculos/crear' => 'AdminController@crearVehiculo',
    'POST|admin/vehiculos/crear' => 'AdminController@crearVehiculo',
    'GET|admin/vehiculos/{id}' => 'AdminController@verVehiculo',
    'GET|admin/vehiculos/{id}/editar' => 'AdminController@editarVehiculo',
    'POST|admin/vehiculos/{id}/editar' => 'AdminController@editarVehiculo',

    // Gestión de Clientes (Admin)
    'GET|admin/clientes' => 'AdminController@clientes',
    'GET|admin/clientes/crear' => 'AdminController@crearCliente',
    'POST|admin/clientes/crear' => 'AdminController@crearCliente',
    'GET|admin/clientes/{id}' => 'AdminController@verCliente',
    'GET|admin/clientes/{id}/editar' => 'AdminController@editarCliente',
    'POST|admin/clientes/{id}/editar' => 'AdminController@editarCliente',

    // Gestión de Viajes (Admin)
    'GET|admin/viajes' => 'AdminController@viajes',
    'GET|admin/viajes/{id}' => 'AdminController@verViaje',

    // Configuración del Sistema (Admin)
    'GET|admin/configuracion' => 'AdminController@configuracion',
    'POST|admin/configuracion' => 'AdminController@guardarConfiguracion',

    // Reportes (Admin)
    'GET|admin/reportes' => 'AdminController@reportes',
    'GET|admin/reportes/{tipo}' => 'AdminController@generarReporte',
    'POST|admin/reportes/generar' => 'AdminController@generarReportePersonalizado',

    // Monitor y Alertas (Admin)
    'GET|admin/monitor' => 'AdminController@monitor',
    'GET|admin/alertas' => 'AdminController@alertas',

    // API Admin (AJAX)
    'GET|admin/api/estadisticas' => 'AdminController@api',
    'GET|admin/api/alertas' => 'AdminController@api',
    'GET|admin/api/viajes-tiempo-real' => 'AdminController@api',
    'GET|admin/api/usuarios-activos' => 'AdminController@api',

    // ========================================
    // RUTAS DE OPERADOR
    // ========================================

    // Dashboard Operador
    'GET|operador' => 'OperadorController@index',
    'GET|operador/dashboard' => 'OperadorController@dashboard',

    // Gestión de Viajes (Operador)
    'GET|operador/viajes' => 'OperadorController@viajes',
    'GET|operador/viajes/crear' => 'OperadorController@crearViaje',
    'POST|operador/viajes/crear' => 'OperadorController@crearViaje',
    'GET|operador/viajes/{id}' => 'OperadorController@verViaje',

    // Gestión de Conductores (Operador - Lectura)
    'GET|operador/conductores' => 'OperadorController@conductores',
    'GET|operador/conductores/{id}' => 'OperadorController@verConductor',

    // Gestión de Vehículos (Operador - Lectura)
    'GET|operador/vehiculos' => 'OperadorController@vehiculos',
    'GET|operador/vehiculos/{id}' => 'OperadorController@verVehiculo',

    // Gestión de Clientes (Operador)
    'GET|operador/clientes' => 'OperadorController@clientes',
    'GET|operador/clientes/crear' => 'OperadorController@crearCliente',
    'POST|operador/clientes/crear' => 'OperadorController@crearCliente',
    'GET|operador/clientes/{id}' => 'OperadorController@verCliente',

    // Gestión de Pagos Diarios (Operador)
    'GET|operador/pagos' => 'OperadorController@pagos',
    'GET|operador/pagos/registrar' => 'OperadorController@registrarPago',
    'POST|operador/pagos/registrar' => 'OperadorController@registrarPago',
    'GET|operador/pagos/{id}' => 'OperadorController@verPago',

    // Reportes (Operador)
    'GET|operador/reportes' => 'OperadorController@reportes',

    // Monitor (Operador)
    'GET|operador/monitor' => 'OperadorController@monitor',

    // API Operador (AJAX)
    'GET|operador/api/estadisticas-hoy' => 'OperadorController@api',
    'GET|operador/api/viajes-en-curso' => 'OperadorController@api',
    'GET|operador/api/alertas' => 'OperadorController@api',
    'GET|operador/api/conductores-disponibles' => 'OperadorController@api',

    // ========================================
    // RUTAS GENÉRICAS DE RECURSOS
    // ========================================

    // Rutas de Usuario (cualquier rol autenticado)
    'GET|perfil' => 'UsuarioController@perfil',
    'POST|perfil' => 'UsuarioController@actualizarPerfil',
    'GET|notificaciones' => 'UsuarioController@notificaciones',
    'POST|notificaciones/{id}/marcar-leida' => 'UsuarioController@marcarLeida',

    // ========================================
    // RUTAS DE ERROR
    // ========================================
    'GET|error/404' => function() {
        http_response_code(404);
        echo "Página no encontrada - 404";
    },
    
    'GET|error/403' => function() {
        http_response_code(403);
        echo "Acceso denegado - 403";
    },
    
    'GET|error/500' => function() {
        http_response_code(500);
        echo "Error interno del servidor - 500";
    }
];
