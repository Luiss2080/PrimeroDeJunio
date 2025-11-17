-- Seed: 009_create_mantenimientos.sql
-- Datos iniciales para la tabla mantenimientos

INSERT INTO mantenimientos (vehiculo_id, tipo_mantenimiento, descripcion, kilometraje_actual, costo, taller_nombre, taller_telefono, fecha_programada, fecha_realizada, estado, proximo_mantenimiento_km, proximo_mantenimiento_fecha) VALUES
-- Mantenimientos completados
(1, 'preventivo', 'Cambio de aceite y filtros', 15000, 85000.00, 'Taller Motos Express', '3145678901', '2025-11-10', '2025-11-10', 'completado', 18000, '2025-12-15'),
(2, 'correctivo', 'Reparación de frenos delanteros', 22000, 120000.00, 'Mecánica Los Hermanos', '3167890123', '2025-11-05', '2025-11-06', 'completado', NULL, NULL),
(4, 'preventivo', 'Mantenimiento general 10,000 km', 10000, 95000.00, 'Taller Motos Express', '3145678901', '2025-11-12', '2025-11-12', 'completado', 15000, '2025-12-20'),
(5, 'emergencia', 'Reparación de llanta trasera', 25000, 45000.00, 'Vulcanizadora Central', '3134567890', '2025-11-07', '2025-11-07', 'completado', NULL, NULL),
(6, 'preventivo', 'Cambio de cadena y piñones', 18500, 150000.00, 'Taller Yamaha Oficial', '3156789012', '2025-11-01', '2025-11-01', 'completado', 23000, '2025-12-30'),
(7, 'correctivo', 'Reparación sistema eléctrico', 12800, 75000.00, 'Electromoto Servicios', '3178901234', '2025-10-28', '2025-10-29', 'completado', NULL, NULL),
(8, 'revision', 'Revisión técnico-mecánica anual', 16200, 55000.00, 'CDA Metropolitano', '3189012345', '2025-10-25', '2025-10-25', 'completado', NULL, NULL),
(9, 'preventivo', 'Sincronización de motor', 21000, 110000.00, 'Centro de Diagnóstico', '3190123456', '2025-10-20', '2025-10-20', 'completado', 26000, '2026-01-15'),
(10, 'correctivo', 'Cambio de embrague', 19500, 180000.00, 'Taller Especializado Honda', '3201234567', '2025-10-15', '2025-10-16', 'completado', NULL, NULL),

-- Mantenimientos programados (próximos)
(3, 'revision', 'Revisión técnico-mecánica', 18500, 55000.00, 'CDA Automotriz', '3189012345', '2025-11-25', NULL, 'programado', NULL, NULL),
(1, 'preventivo', 'Cambio de llantas trasera', 17800, 95000.00, 'Llantas y Servicios', '3212345678', '2025-11-28', NULL, 'programado', NULL, NULL),
(11, 'preventivo', 'Mantenimiento 5,000 km', 5000, 75000.00, 'Taller Motos Express', '3145678901', '2025-12-01', NULL, 'programado', 10000, NULL),
(12, 'correctivo', 'Reparación de escape', 8500, 65000.00, 'Mecánica Dos Hermanos', '3223344556', '2025-11-20', NULL, 'programado', NULL, NULL),
(2, 'preventivo', 'Cambio de aceite 22,500 km', 22500, 85000.00, 'Taller Motos Express', '3145678901', '2025-11-22', NULL, 'programado', 27500, NULL),

-- Mantenimientos en progreso
(13, 'correctivo', 'Reparación sistema de refrigeración', 14200, 135000.00, 'Taller Especializado', '3234455667', '2025-11-17', NULL, 'en_proceso', NULL, NULL),

-- Mantenimientos de emergencia recientes
(4, 'emergencia', 'Reparación de ponchadura', 15200, 25000.00, 'Vulcanizadora 24 Horas', '3245566778', '2025-11-15', '2025-11-15', 'completado', NULL, NULL),
(7, 'emergencia', 'Cambio de bombillo delantero', 13100, 15000.00, 'Autopartes Rápidas', '3256677889', '2025-11-16', '2025-11-16', 'completado', NULL, NULL),

-- Mantenimientos históricos (más antiguos)
(1, 'preventivo', 'Mantenimiento 12,000 km', 12000, 90000.00, 'Taller Motos Express', '3145678901', '2025-10-03', '2025-10-03', 'completado', 15000, NULL),
(2, 'correctivo', 'Cambio de batería', 20500, 85000.00, 'Baterías Express', '3267788990', '2025-10-18', '2025-10-18', 'completado', NULL, NULL),
(3, 'preventivo', 'Cambio de aceite', 16000, 80000.00, 'Lubricantes del Norte', '3278899001', '2025-10-23', '2025-10-23', 'completado', 19000, NULL),
(5, 'revision', 'Inspección general', 23500, 45000.00, 'Centro de Inspección', '3289900112', '2025-10-28', '2025-10-28', 'completado', NULL, NULL),

-- Mantenimientos cancelados (para datos realistas)
(6, 'preventivo', 'Cambio de pastillas de freno', 17200, 95000.00, 'Frenos Seguros', '3290011223', '2025-11-07', NULL, 'cancelado', NULL, NULL);