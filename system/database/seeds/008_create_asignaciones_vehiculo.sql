-- Seed: 008_create_asignaciones_vehiculo.sql
-- Datos iniciales para la tabla asignaciones_vehiculo

INSERT INTO asignaciones_vehiculo (conductor_id, vehiculo_id, fecha_inicio, fecha_fin, turno, hora_inicio, hora_fin, dias_semana, estado) VALUES
(1, 1, '2025-01-01', NULL, 'manana', '06:00:00', '14:00:00', 'L,M,X,J,V', 'activa'),
(2, 2, '2025-01-01', NULL, 'tarde', '14:00:00', '22:00:00', 'L,M,X,J,V,S', 'activa'),
(3, 3, '2025-01-15', NULL, 'completo', '06:00:00', '18:00:00', 'M,X,J,V,S,D', 'activa'),
(4, 4, '2025-02-01', NULL, 'manana', '07:00:00', '15:00:00', 'L,M,X,J,V', 'activa'),
(5, 5, '2025-01-20', NULL, 'noche', '18:00:00', '02:00:00', 'V,S,D', 'activa');