-- Seed: 003_create_conductores.sql
-- Datos iniciales para la tabla conductores

INSERT INTO conductores (usuario_id, nombre, apellido, cedula, telefono, direccion, fecha_nacimiento, licencia_numero, licencia_categoria, licencia_vigencia, experiencia_anos, estado, fecha_ingreso) VALUES
(3, 'Juan Manuel', 'Pérez García', '12345678', '3012345678', 'Barrio La Esperanza - Calle 8 #12-34', '1985-03-15', 'LIC123456789', 'A2', '2026-06-30', 8, 'activo', '2020-01-15'),
(4, 'María Elena', 'González López', '87654321', '3154567890', 'Sector El Progreso - Carrera 20 #15-40', '1990-08-22', 'LIC987654321', 'A2', '2025-12-15', 5, 'activo', '2021-03-10'),
(NULL, 'Roberto Carlos', 'Martínez Silva', '11223344', '3187654321', 'Barrio San José - Calle 25 #8-15', '1988-11-10', 'LIC456789123', 'A2', '2026-02-28', 6, 'activo', '2020-06-20'),
(NULL, 'Ana Patricia', 'Ramírez Torres', '55667788' , '3176543210', 'Urbanización Los Pinos - Carrera 30 #18-45', '1992-05-18', 'LIC789123456', 'A2', '2025-09-10', 4, 'activo', '2022-01-08'),
(NULL, 'Luis Fernando', 'Vargas Moreno', '99887766', '3198765432', 'Sector La Victoria - Calle 12 #22-30', '1987-12-03', 'LIC321654987', 'A2', '2026-04-20', 7, 'activo', '2019-11-12'),
(NULL, 'Carlos Eduardo', 'Hernández López', '22334455', '3145678901', 'Barrio El Carmen - Calle 18 #10-25', '1984-07-14', 'LIC654987321', 'A2', '2026-08-15', 9, 'activo', '2018-09-05'),
(NULL, 'Diego Alejandro', 'Morales Castro', '33445566', '3156789012', 'Sector Bella Vista - Carrera 25 #35-18', '1991-02-28', 'LIC147258369', 'A2', '2025-11-30', 6, 'activo', '2021-07-22'),
(NULL, 'Sandra Milena', 'Jiménez Ruiz', '44556677', '3167890123', 'Barrio Los Rosales - Calle 5 #14-32', '1989-09-12', 'LIC369258147', 'A2', '2026-01-10', 5, 'activo', '2022-03-18'),
(NULL, 'Andrés Felipe', 'Gómez Peña', '55667799', '3178901234', 'Urbanización El Dorado - Carrera 40 #28-16', '1986-06-25', 'LIC258147369', 'A2', '2025-10-20', 8, 'activo', '2019-12-08'),
(NULL, 'Claudia Patricia', 'Rojas Vega', '66778899', '3189012345', 'Sector La Paz - Calle 30 #22-14', '1993-04-03', 'LIC741852963', 'A2', '2026-05-05', 3, 'activo', '2023-01-15');