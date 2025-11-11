-- Seed: 010_create_configuraciones.sql
-- Datos iniciales para la tabla configuraciones

INSERT INTO configuraciones (clave, valor, descripcion, tipo, categoria) VALUES
-- Información de la Empresa/Asociación
('empresa_nombre', 'PRIMERO DE JUNIO - Asociación de Mototaxis', 'Nombre oficial de la empresa', 'string', 'empresa'),
('empresa_nit', '900123456-7', 'NIT de la empresa', 'string', 'empresa'),
('empresa_telefono', '601-2345678', 'Teléfono principal de la empresa', 'string', 'empresa'),
('empresa_direccion', 'Calle 123 #45-67, Bogotá D.C.', 'Dirección principal de la empresa', 'string', 'empresa'),
('empresa_email', 'info@primerodejunio.com', 'Email principal de la empresa', 'string', 'empresa'),
('empresa_representante', 'Carlos Alberto Rodríguez', 'Representante legal de la empresa', 'string', 'empresa'),
('empresa_telefono_movil', '300-123-4567', 'Teléfono móvil de contacto', 'string', 'empresa'),

-- Configuraciones del Sistema
('sistema_nombre', 'Sistema de Gestión PRIMERO DE JUNIO', 'Nombre del sistema', 'string', 'sistema'),
('sistema_version', '1.0.0', 'Versión actual del sistema', 'string', 'sistema'),
('zona_horaria', 'America/Bogota', 'Zona horaria del sistema', 'string', 'sistema'),
('moneda', 'COP', 'Moneda utilizada en el sistema', 'string', 'sistema'),
('backup_automatico', 'true', 'Realizar backup automático de la base de datos', 'boolean', 'sistema'),
('mantenimiento_activo', 'false', 'Modo mantenimiento del sistema activado', 'boolean', 'sistema'),
('debug_mode', 'false', 'Modo debug activado para desarrollo', 'boolean', 'sistema'),

-- Configuraciones de Tarifas
('tarifa_minima_global', '4500', 'Tarifa mínima por viaje en pesos', 'integer', 'tarifas'),
('tarifa_por_km', '1800', 'Tarifa por kilómetro recorrido', 'integer', 'tarifas'),
('tarifa_minuto_espera', '150', 'Tarifa por minuto de espera', 'integer', 'tarifas'),
('tarifa_nocturna_inicio', '22:00', 'Hora de inicio de tarifa nocturna', 'string', 'tarifas'),
('tarifa_nocturna_fin', '06:00', 'Hora de fin de tarifa nocturna', 'string', 'tarifas'),
('recargo_nocturno_porcentaje', '20', 'Porcentaje de recargo nocturno', 'integer', 'tarifas'),
('tarifa_diaria_conductor', '15000', 'Tarifa diaria que paga cada conductor', 'integer', 'tarifas'),
('descuento_cliente_frecuente', '5', 'Porcentaje descuento cliente frecuente', 'integer', 'tarifas'),
('descuento_corporativo_max', '25', 'Máximo descuento corporativo permitido', 'integer', 'tarifas'),

-- Configuraciones de Operación
('max_viajes_dia_conductor', '15', 'Máximo número de viajes por día por conductor', 'integer', 'operacion'),
('tiempo_max_viaje_minutos', '120', 'Tiempo máximo de un viaje en minutos', 'integer', 'operacion'),
('distancia_max_viaje_km', '50', 'Distancia máxima de un viaje en kilómetros', 'integer', 'operacion'),
('tiempo_espera_max_minutos', '15', 'Tiempo máximo de espera de cliente en minutos', 'integer', 'operacion'),
('horario_operacion_inicio', '05:00', 'Hora de inicio de operaciones diarias', 'string', 'operacion'),
('horario_operacion_fin', '23:00', 'Hora de fin de operaciones diarias', 'string', 'operacion'),
('dias_operacion', 'L,M,X,J,V,S,D', 'Días de operación de la semana', 'string', 'operacion'),

-- Configuraciones de Mantenimiento
('kilometraje_mantenimiento_preventivo', '3000', 'Cada cuántos km programar mantenimiento preventivo', 'integer', 'mantenimiento'),
('kilometraje_mantenimiento_mayor', '10000', 'Cada cuántos km hacer mantenimiento mayor', 'integer', 'mantenimiento'),
('dias_alerta_mantenimiento', '15', 'Días antes para alertar mantenimiento programado', 'integer', 'mantenimiento'),
('talleres_autorizados', '["Taller Motos Express", "Mecánica Los Hermanos", "CDA Automotriz"]', 'Lista de talleres autorizados', 'json', 'mantenimiento'),

-- Configuraciones de Alertas y Notificaciones
('dias_alerta_vencimiento_licencia', '30', 'Días antes para alertar vencimiento de licencia', 'integer', 'alertas'),
('dias_alerta_vencimiento_soat', '60', 'Días antes para alertar vencimiento de SOAT', 'integer', 'alertas'),
('dias_alerta_vencimiento_tecnicomecanica', '45', 'Días antes para alertar vencimiento de tecnomecánica', 'integer', 'alertas'),
('email_notificaciones', 'admin@primerodejunio.com', 'Email para recibir notificaciones del sistema', 'string', 'notificaciones'),
('notificaciones_sms_activas', 'false', 'Activar notificaciones por SMS', 'boolean', 'notificaciones'),
('notificaciones_email_activas', 'true', 'Activar notificaciones por email', 'boolean', 'notificaciones'),

-- Configuraciones de Seguridad
('session_timeout_minutos', '30', 'Tiempo de expiración de sesión en minutos', 'integer', 'seguridad'),
('max_intentos_login', '5', 'Máximo número de intentos de login fallidos', 'integer', 'seguridad'),
('tiempo_bloqueo_minutos', '15', 'Tiempo de bloqueo después de intentos fallidos', 'integer', 'seguridad'),
('password_min_longitud', '6', 'Longitud mínima de contraseñas', 'integer', 'seguridad'),
('backup_retention_dias', '30', 'Días de retención de backups', 'integer', 'seguridad'),

-- Configuraciones de Reportes
('reportes_formato_default', 'PDF', 'Formato por defecto para reportes', 'string', 'reportes'),
('reportes_max_registros', '1000', 'Máximo número de registros por reporte', 'integer', 'reportes'),
('reportes_logo_empresa', 'logo_empresa.png', 'Logo para incluir en reportes', 'string', 'reportes'),

-- Configuraciones de Clientes
('descuento_max_cliente_frecuente', '10', 'Descuento máximo para cliente frecuente', 'integer', 'clientes'),
('viajes_minimos_cliente_frecuente', '10', 'Número mínimo de viajes para ser cliente frecuente', 'integer', 'clientes'),
('dias_inactividad_cliente', '90', 'Días de inactividad para marcar cliente como inactivo', 'integer', 'clientes'),

-- Configuraciones de Conductores
('edad_minima_conductor', '21', 'Edad mínima para ser conductor', 'integer', 'conductores'),
('experiencia_minima_anos', '2', 'Años mínimos de experiencia requeridos', 'integer', 'conductores'),
('licencia_categoria_requerida', 'A2', 'Categoría de licencia requerida', 'string', 'conductores'),
('score_minimo_conductor', '4.0', 'Calificación mínima para conductor activo', 'decimal', 'conductores'),

-- Configuraciones de Vehículos
('ano_minimo_vehiculo', '2015', 'Año mínimo permitido para vehículos', 'integer', 'vehiculos'),
('cilindraje_minimo', '110', 'Cilindraje mínimo permitido en cc', 'integer', 'vehiculos'),
('cilindraje_maximo', '200', 'Cilindraje máximo permitido en cc', 'integer', 'vehiculos'),
('marcas_permitidas', '["Honda", "Yamaha", "Suzuki", "Kawasaki", "Bajaj"]', 'Marcas de motos permitidas', 'json', 'vehiculos'),

-- Configuraciones de Integración
('api_maps_key', '', 'API Key para servicios de mapas', 'string', 'integracion'),
('sms_provider', 'local', 'Proveedor de SMS configurado', 'string', 'integracion'),
('email_provider', 'local', 'Proveedor de email configurado', 'string', 'integracion'),
('payment_gateway', 'manual', 'Gateway de pagos configurado', 'string', 'integracion'),

-- Configuraciones de Facturación
('iva_porcentaje', '19', 'Porcentaje de IVA aplicable', 'integer', 'facturacion'),
('facturacion_electronica', 'false', 'Facturación electrónica habilitada', 'boolean', 'facturacion'),
('resolucion_dian', '', 'Número de resolución DIAN para facturación', 'string', 'facturacion'),

-- Configuraciones de Dashboard
('refresh_dashboard_segundos', '30', 'Frecuencia de actualización del dashboard', 'integer', 'dashboard'),
('viajes_recientes_mostrar', '10', 'Número de viajes recientes a mostrar', 'integer', 'dashboard'),
('alertas_max_mostrar', '5', 'Número máximo de alertas en dashboard', 'integer', 'dashboard');