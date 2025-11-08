-- Seed: 009_create_mantenimientos.sql
-- Datos iniciales para la tabla mantenimientos

INSERT INTO mantenimientos (vehiculo_id, tipo_mantenimiento, descripcion, kilometraje_actual, costo, taller_nombre, taller_telefono, fecha_programada, fecha_realizada, estado, proximo_mantenimiento_km, proximo_mantenimiento_fecha) VALUES
(1, 'preventivo', 'Cambio de aceite y filtros', 15000, 85000.00, 'Taller Motos Express', '3145678901', '2025-11-10', '2025-11-10', 'completado', 18000, '2025-12-15'),
(2, 'correctivo', 'Reparación de frenos delanteros', 22000, 120000.00, 'Mecánica Los Hermanos', '3167890123', '2025-11-05', '2025-11-06', 'completado', NULL, NULL),
(3, 'revision', 'Revisión técnico-mecánica', 18500, 55000.00, 'CDA Automotriz', '3189012345', '2025-11-15', NULL, 'programado', NULL, NULL),
(4, 'preventivo', 'Mantenimiento general 10,000 km', 10000, 95000.00, 'Taller Motos Express', '3145678901', '2025-11-12', '2025-11-12', 'completado', 15000, '2025-12-20'),
(5, 'emergencia', 'Reparación de llanta trasera', 25000, 45000.00, 'Vulcanizadora Central', '3134567890', '2025-11-07', '2025-11-07', 'completado', NULL, NULL);