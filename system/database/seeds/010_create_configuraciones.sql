-- Seed: 010_create_configuraciones.sql
-- Datos iniciales para la tabla configuraciones

INSERT INTO configuraciones (clave, valor, descripcion, tipo, categoria) VALUES
('empresa_nombre', 'PRIMERO DE JUNIO - Asociación de Mototaxis', 'Nombre oficial de la empresa', 'string', 'empresa'),
('empresa_nit', '900123456-7', 'NIT de la empresa', 'string', 'empresa'),
('empresa_telefono', '601-2345678', 'Teléfono principal de la empresa', 'string', 'empresa'),
('empresa_direccion', 'Calle 123 #45-67, Bogotá D.C.', 'Dirección principal de la empresa', 'string', 'empresa'),
('tarifa_minima_global', '4500', 'Tarifa mínima por viaje en pesos', 'number', 'tarifas'),
('kilometraje_mantenimiento', '3000', 'Cada cuántos km programar mantenimiento preventivo', 'number', 'mantenimiento'),
('backup_automatico', 'true', 'Realizar backup automático de la base de datos', 'boolean', 'sistema'),
('moneda', 'COP', 'Moneda utilizada en el sistema', 'string', 'general'),
('zona_horaria', 'America/Bogota', 'Zona horaria del sistema', 'string', 'general'),
('dias_alerta_vencimiento', '30', 'Días de anticipación para alertas de vencimiento', 'number', 'alertas'),
('email_notificaciones', 'admin@primero1dejunio.com', 'Email para recibir notificaciones del sistema', 'string', 'notificaciones'),
('max_viajes_dia_conductor', '15', 'Máximo número de viajes por día por conductor', 'number', 'operacion');