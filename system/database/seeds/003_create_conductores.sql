-- Seed: 003_create_conductores.sql
-- Datos iniciales para la tabla conductores

INSERT INTO conductores (usuario_id, nombre, apellido, cedula, telefono, direccion, fecha_nacimiento, licencia_numero, licencia_categoria, licencia_vigencia, experiencia_anos, estado, fecha_ingreso) VALUES
(3, 'Juan Manuel', 'Pérez García', '12345678', '3012345678', 'Barrio La Esperanza - Calle 8 #12-34', '1985-03-15', 'LIC123456789', 'A2', '2026-06-30', 8, 'activo', '2020-01-15'),
(4, 'María Elena', 'González López', '87654321', '3154567890', 'Sector El Progreso - Carrera 20 #15-40', '1990-08-22', 'LIC987654321', 'A2', '2025-12-15', 5, 'activo', '2021-03-10'),
(NULL, 'Roberto Carlos', 'Martínez Silva', '11223344', '3187654321', 'Barrio San José - Calle 25 #8-15', '1988-11-10', 'LIC456789123', 'A2', '2026-02-28', 6, 'activo', '2020-06-20'),
(NULL, 'Ana Patricia', 'Ramírez Torres', '55667788', '3176543210', 'Urbanización Los Pinos - Carrera 30 #18-45', '1992-05-18', 'LIC789123456', 'A2', '2025-09-10', 4, 'activo', '2022-01-08'),
(NULL, 'Luis Fernando', 'Vargas Moreno', '99887766', '3198765432', 'Sector La Victoria - Calle 12 #22-30', '1987-12-03', 'LIC321654987', 'A2', '2026-04-20', 7, 'activo', '2019-11-12');