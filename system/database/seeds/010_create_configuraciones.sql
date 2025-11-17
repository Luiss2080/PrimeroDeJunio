-- Seed: 010_create_configuraciones.sql
-- Datos iniciales para la tabla configuraciones

INSERT INTO configuraciones (clave, valor, descripcion, tipo, categoria) VALUES
-- Informacion de la Empresa/Asociacion
('empresa_nombre', 'PRIMERO DE JUNIO - Asociacion de Mototaxis', 'Nombre oficial de la empresa', 'string', 'empresa'),
('empresa_nit', '900123456-7', 'NIT de la empresa', 'string', 'empresa'),
('empresa_telefono', '601-2345678', 'Telefono principal de la empresa', 'string', 'empresa'),
('empresa_direccion', 'Calle 123 #45-67, Bogota D.C.', 'Direccion principal de la empresa', 'string', 'empresa'),
('empresa_email', 'info@primerodejunio.com', 'Email principal de la empresa', 'string', 'empresa'),
('empresa_representante', 'Carlos Alberto Rodriguez', 'Representante legal de la empresa', 'string', 'empresa'),
('empresa_telefono_movil', '300-123-4567', 'Telefono movil de contacto', 'string', 'empresa'),

-- Configuraciones del Sistema
('sistema_nombre', 'Sistema de Gestion PRIMERO DE JUNIO', 'Nombre del sistema', 'string', 'sistema'),
('sistema_version', '1.0.0', 'Version actual del sistema', 'string', 'sistema'),
('zona_horaria', 'America/Bogota', 'Zona horaria del sistema', 'string', 'sistema'),
('moneda', 'COP', 'Moneda utilizada en el sistema', 'string', 'sistema'),
('backup_automatico', 'true', 'Realizar backup automatico de la base de datos', 'boolean', 'sistema'),
('mantenimiento_activo', 'false', 'Modo mantenimiento del sistema activado', 'boolean', 'sistema'),
('debug_mode', 'false', 'Modo debug activado para desarrollo', 'boolean', 'sistema'),

-- Configuraciones de Tarifas
('tarifa_minima_global', '4500', 'Tarifa minima por viaje en pesos', 'number', 'tarifas'),
('tarifa_por_km', '1800', 'Tarifa por kilometro recorrido', 'number', 'tarifas'),
('tarifa_minuto_espera', '150', 'Tarifa por minuto de espera', 'number', 'tarifas'),
('tarifa_nocturna_inicio', '22:00', 'Hora de inicio de tarifa nocturna', 'string', 'tarifas'),
('tarifa_nocturna_fin', '06:00', 'Hora de fin de tarifa nocturna', 'string', 'tarifas'),
('recargo_nocturno_porcentaje', '20', 'Porcentaje de recargo nocturno', 'number', 'tarifas'),
('tarifa_diaria_conductor', '15000', 'Tarifa diaria que paga cada conductor', 'number', 'tarifas'),
('descuento_cliente_frecuente', '5', 'Porcentaje descuento cliente frecuente', 'number', 'tarifas'),
('descuento_corporativo_max', '25', 'Maximo descuento corporativo permitido', 'number', 'tarifas'),

-- Configuraciones de Operacion
('max_viajes_dia_conductor', '15', 'Maximo numero de viajes por dia por conductor', 'number', 'operacion'),
('tiempo_max_viaje_minutos', '120', 'Tiempo maximo de un viaje en minutos', 'number', 'operacion'),
('distancia_max_viaje_km', '50', 'Distancia maxima de un viaje en kilometros', 'number', 'operacion'),
('tiempo_espera_max_minutos', '15', 'Tiempo maximo de espera de cliente en minutos', 'number', 'operacion'),
('horario_operacion_inicio', '05:00', 'Hora de inicio de operaciones diarias', 'string', 'operacion'),
('horario_operacion_fin', '23:00', 'Hora de fin de operaciones diarias', 'string', 'operacion'),
('dias_operacion', 'L,M,X,J,V,S,D', 'Dias de operacion de la semana', 'string', 'operacion'),

-- Configuraciones de Mantenimiento
('kilometraje_mantenimiento_preventivo', '3000', 'Cada cuantos km programar mantenimiento preventivo', 'number', 'mantenimiento'),
('kilometraje_mantenimiento_mayor', '10000', 'Cada cuantos km hacer mantenimiento mayor', 'number', 'mantenimiento'),
('dias_alerta_mantenimiento', '15', 'Dias antes para alertar mantenimiento programado', 'number', 'mantenimiento'),
('talleres_autorizados', '["Taller Motos Express", "Mecanica Los Hermanos", "CDA Automotriz"]', 'Lista de talleres autorizados', 'json', 'mantenimiento'),

-- Configuraciones de Alertas y Notificaciones
('dias_alerta_vencimiento_licencia', '30', 'Dias antes para alertar vencimiento de licencia', 'number', 'alertas'),
('dias_alerta_vencimiento_soat', '60', 'Dias antes para alertar vencimiento de SOAT', 'number', 'alertas'),
('dias_alerta_vencimiento_tecnicomecanica', '45', 'Dias antes para alertar vencimiento de tecnomecanica', 'number', 'alertas'),
('email_notificaciones', 'admin@primerodejunio.com', 'Email para recibir notificaciones del sistema', 'string', 'notificaciones'),
('notificaciones_sms_activas', 'false', 'Activar notificaciones por SMS', 'boolean', 'notificaciones'),
('notificaciones_email_activas', 'true', 'Activar notificaciones por email', 'boolean', 'notificaciones'),

-- Configuraciones de Seguridad
('session_timeout_minutos', '30', 'Tiempo de expiracion de sesion en minutos', 'number', 'seguridad'),
('max_intentos_login', '5', 'Maximo numero de intentos de login fallidos', 'number', 'seguridad'),
('tiempo_bloqueo_minutos', '15', 'Tiempo de bloqueo despues de intentos fallidos', 'number', 'seguridad'),
('password_min_longitud', '6', 'Longitud minima de contrasenas', 'number', 'seguridad'),
('backup_retention_dias', '30', 'Dias de retencion de backups', 'number', 'seguridad'),

-- Configuraciones de Reportes
('reportes_formato_default', 'PDF', 'Formato por defecto para reportes', 'string', 'reportes'),
('reportes_max_registros', '1000', 'Maximo numero de registros por reporte', 'number', 'reportes'),
('reportes_logo_empresa', 'logo_empresa.png', 'Logo para incluir en reportes', 'string', 'reportes'),

-- Configuraciones de Clientes
('descuento_max_cliente_frecuente', '10', 'Descuento maximo para cliente frecuente', 'number', 'clientes'),
('viajes_minimos_cliente_frecuente', '10', 'Numero minimo de viajes para ser cliente frecuente', 'number', 'clientes'),
('dias_inactividad_cliente', '90', 'Dias de inactividad para marcar cliente como inactivo', 'number', 'clientes'),

-- Configuraciones de Conductores
('edad_minima_conductor', '21', 'Edad minima para ser conductor', 'number', 'conductores'),
('experiencia_minima_anos', '2', 'Anos minimos de experiencia requeridos', 'number', 'conductores'),
('licencia_categoria_requerida', 'A2', 'Categoria de licencia requerida', 'string', 'conductores'),
('score_minimo_conductor', '4.0', 'Calificacion minima para conductor activo', 'number', 'conductores'),

-- Configuraciones de Vehiculos
('ano_minimo_vehiculo', '2015', 'Ano minimo permitido para vehiculos', 'number', 'vehiculos'),
('cilindraje_minimo', '110', 'Cilindraje minimo permitido en cc', 'number', 'vehiculos'),
('cilindraje_maximo', '200', 'Cilindraje maximo permitido en cc', 'number', 'vehiculos'),
('marcas_permitidas', '["Honda", "Yamaha", "Suzuki", "Kawasaki", "Bajaj"]', 'Marcas de motos permitidas', 'json', 'vehiculos'),

-- Configuraciones de Integracion
('api_maps_key', '', 'API Key para servicios de mapas', 'string', 'integracion'),
('sms_provider', 'local', 'Proveedor de SMS configurado', 'string', 'integracion'),
('email_provider', 'local', 'Proveedor de email configurado', 'string', 'integracion'),
('payment_gateway', 'manual', 'Gateway de pagos configurado', 'string', 'integracion'),

-- Configuraciones de Facturacion
('iva_porcentaje', '19', 'Porcentaje de IVA aplicable', 'number', 'facturacion'),
('facturacion_electronica', 'false', 'Facturacion electronica habilitada', 'boolean', 'facturacion'),
('resolucion_dian', '', 'Numero de resolucion DIAN para facturacion', 'string', 'facturacion'),

-- Configuraciones de Dashboard
('refresh_dashboard_segundos', '30', 'Frecuencia de actualizacion del dashboard', 'number', 'dashboard'),
('viajes_recientes_mostrar', '10', 'Numero de viajes recientes a mostrar', 'number', 'dashboard'),
('alertas_max_mostrar', '5', 'Numero maximo de alertas en dashboard', 'number', 'dashboard');
