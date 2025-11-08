-- Seed: 001_create_roles.sql
-- Datos iniciales para la tabla roles

INSERT INTO roles (nombre, descripcion, permisos) VALUES
('administrador', 'Administrador del sistema con acceso completo', '{"usuarios": true, "conductores": true, "vehiculos": true, "viajes": true, "tarifas": true, "reportes": true, "configuracion": true}'),
('operador', 'Operador con acceso a registros diarios', '{"conductores": true, "vehiculos": false, "viajes": true, "clientes": true, "reportes": false, "configuracion": false}'),
('conductor', 'Conductor con acceso limitado a sus datos', '{"viajes": "own", "vehiculos": "assigned", "perfil": true}');