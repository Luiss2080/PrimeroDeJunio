-- Seed: 011_create_logs.sql
-- Datos iniciales para la tabla logs (ejemplos de logs del sistema)

INSERT INTO logs (usuario_id, accion, tabla_afectada, registro_id, datos_anteriores, datos_nuevos, ip_address, user_agent) VALUES
(1, 'CREATE', 'conductores', 1, NULL, '{"nombre": "Juan Manuel", "apellido": "Pérez García", "cedula": "12345678"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(1, 'CREATE', 'vehiculos', 1, NULL, '{"placa": "ABC123", "marca": "Honda", "modelo": "CB125F"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(2, 'CREATE', 'viajes', 1, NULL, '{"conductor_id": 1, "vehiculo_id": 1, "origen": "Centro Comercial Plaza Mayor"}', '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(2, 'UPDATE', 'viajes', 1, '{"estado": "en_curso"}', '{"estado": "completado", "fecha_hora_fin": "2025-11-08 08:55:00"}', '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(1, 'UPDATE', 'configuraciones', 5, '{"valor": "4000"}', '{"valor": "4500"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');