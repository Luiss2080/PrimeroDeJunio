-- Seed: 008_create_asignaciones_vehiculo.sql
-- Datos iniciales para la tabla asignaciones_vehiculo

INSERT INTO asignaciones_vehiculo (conductor_id, vehiculo_id, fecha_inicio, fecha_fin, turno, hora_inicio, hora_fin, dias_semana, estado) VALUES
(11, 1, '2025-01-01', NULL, 'manana', '06:00:00', '14:00:00', 'L,M,X,J,V', 'activa'),
(12, 2, '2025-01-01', NULL, 'tarde', '14:00:00', '22:00:00', 'L,M,X,J,V,S', 'activa'),
(13, 3, '2025-01-15', NULL, 'completo', '06:00:00', '18:00:00', 'M,X,J,V,S,D', 'activa'),
(14, 4, '2025-02-01', NULL, 'manana', '07:00:00', '15:00:00', 'L,M,X,J,V', 'activa'),
(15, 5, '2025-01-20', NULL, 'noche', '18:00:00', '02:00:00', 'V,S,D', 'activa'),
(16, 6, '2025-02-10', NULL, 'tarde', '14:00:00', '22:00:00', 'L,M,X,J,V,S', 'activa'),
(17, 7, '2025-01-25', NULL, 'manana', '06:00:00', '14:00:00', 'L,M,X,J,V', 'activa'),
(18, 8, '2025-02-15', NULL, 'completo', '08:00:00', '20:00:00', 'L,M,X,J,V,S,D', 'activa'),
(19, 9, '2025-01-30', NULL, 'tarde', '15:00:00', '23:00:00', 'L,M,X,J,V,S', 'activa'),
(20, 10, '2025-02-05', NULL, 'manana', '05:00:00', '13:00:00', 'L,M,X,J,V', 'activa'),
-- Algunas asignaciones históricas (finalizadas)
(11, 11, '2024-10-01', '2024-12-31', 'manana', '06:00:00', '14:00:00', 'L,M,X,J,V', 'finalizada'),
(13, 2, '2024-11-01', '2025-01-14', 'tarde', '14:00:00', '22:00:00', 'L,M,X,J,V,S', 'finalizada');