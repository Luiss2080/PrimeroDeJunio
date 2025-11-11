-- Seed: 011_create_logs.sql
-- Datos iniciales para la tabla logs (ejemplos de logs del sistema)

INSERT INTO logs (usuario_id, accion, tabla_afectada, registro_id, datos_anteriores, datos_nuevos, ip_address, user_agent, created_at) VALUES
-- Logs de creación de datos iniciales
(1, 'CREATE', 'conductores', 1, NULL, '{"nombre": "Juan Manuel", "apellido": "Pérez García", "cedula": "12345678"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 15 DAY)),
(1, 'CREATE', 'conductores', 2, NULL, '{"nombre": "María Elena", "apellido": "González López", "cedula": "87654321"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 15 DAY)),
(1, 'CREATE', 'vehiculos', 1, NULL, '{"placa": "ABC123", "marca": "Honda", "modelo": "CB125F"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 14 DAY)),
(1, 'CREATE', 'vehiculos', 2, NULL, '{"placa": "XYZ789", "marca": "Yamaha", "modelo": "XTZ125"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 14 DAY)),

-- Logs de asignaciones de vehículos
(2, 'CREATE', 'asignaciones_vehiculo', 1, NULL, '{"conductor_id": 1, "vehiculo_id": 1, "turno": "manana"}', '192.168.1.50', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 10 DAY)),
(2, 'CREATE', 'asignaciones_vehiculo', 2, NULL, '{"conductor_id": 2, "vehiculo_id": 2, "turno": "tarde"}', '192.168.1.50', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 10 DAY)),

-- Logs de creación y gestión de viajes
(2, 'CREATE', 'viajes', 1, NULL, '{"conductor_id": 1, "vehiculo_id": 1, "origen": "Centro Comercial Plaza Mayor", "destino": "Universidad Nacional"}', '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 3 DAY)),
(2, 'UPDATE', 'viajes', 1, '{"estado": "en_curso"}', '{"estado": "completado", "fecha_hora_fin": "2025-11-08 08:55:00", "valor_total": "13015.00"}', '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 3 DAY)),
(2, 'CREATE', 'viajes', 2, NULL, '{"conductor_id": 2, "vehiculo_id": 2, "origen": "Terminal de Transporte", "destino": "Hospital San Rafael"}', '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 3 DAY)),
(2, 'UPDATE', 'viajes', 2, '{"estado": "en_curso"}', '{"estado": "completado", "calificacion": 4}', '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 3 DAY)),

-- Logs de configuración del sistema
(1, 'UPDATE', 'configuraciones', 5, '{"valor": "4000"}', '{"valor": "4500"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 7 DAY)),
(1, 'UPDATE', 'configuraciones', 12, '{"valor": "10"}', '{"valor": "15"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 5 DAY)),
(1, 'CREATE', 'configuraciones', 25, NULL, '{"clave": "backup_automatico", "valor": "true", "categoria": "sistema"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 5 DAY)),

-- Logs de gestión de clientes
(2, 'CREATE', 'clientes', 1, NULL, '{"nombre": "Andrea", "apellido": "Gómez", "telefono": "3201234567", "tipo_cliente": "frecuente"}', '192.168.1.100', 'Mozilla/5.0 (Linux; Android 10; SM-G975F) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 8 DAY)),
(2, 'UPDATE', 'clientes', 1, '{"descuento_porcentaje": "0"}', '{"descuento_porcentaje": "5"}', '192.168.1.100', 'Mozilla/5.0 (Linux; Android 10; SM-G975F) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 6 DAY)),

-- Logs de mantenimientos
(2, 'CREATE', 'mantenimientos', 1, NULL, '{"vehiculo_id": 1, "tipo_mantenimiento": "preventivo", "descripcion": "Cambio de aceite y filtros"}', '192.168.1.100', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_7_1 like Mac OS X) AppleWebKit/605.1.15', DATE_SUB(NOW(), INTERVAL 4 DAY)),
(2, 'UPDATE', 'mantenimientos', 1, '{"estado": "programado"}', '{"estado": "completado", "fecha_realizada": "2025-11-10", "costo": "85000"}', '192.168.1.100', 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_7_1 like Mac OS X) AppleWebKit/605.1.15', DATE_SUB(NOW(), INTERVAL 3 DAY)),

-- Logs de pagos de tarifa diaria
(2, 'CREATE', 'pagos_tarifa_diaria', 1, NULL, '{"conductor_id": 1, "fecha_pago": "2025-11-11", "monto_tarifa": "15000", "estado": "pagado"}', '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', NOW()),
(2, 'CREATE', 'pagos_tarifa_diaria', 2, NULL, '{"conductor_id": 2, "fecha_pago": "2025-11-11", "monto_tarifa": "15000", "metodo_pago": "transferencia"}', '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', NOW()),
(1, 'UPDATE', 'pagos_tarifa_diaria', 3, '{"estado": "pendiente"}', '{"estado": "exonerado", "observaciones": "Exonerado por mantenimiento de vehículo"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', NOW()),

-- Logs de acceso y sesiones
(1, 'LOGIN', 'usuarios', 1, NULL, '{"ultimo_acceso": "2025-11-11 08:30:00"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', NOW() - INTERVAL 2 HOUR),
(2, 'LOGIN', 'usuarios', 2, NULL, '{"ultimo_acceso": "2025-11-11 09:15:00"}', '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', NOW() - INTERVAL 1 HOUR),
(3, 'LOGIN', 'usuarios', 3, NULL, '{"ultimo_acceso": "2025-11-11 10:00:00"}', '192.168.1.120', 'Mozilla/5.0 (Linux; Android 10; SM-G975F) AppleWebKit/537.36', NOW() - INTERVAL 30 MINUTE),

-- Logs de actualización de conductores
(1, 'UPDATE', 'conductores', 1, '{"telefono": "3012345678"}', '{"telefono": "3012345679", "direccion": "Nueva dirección actualizada"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 2 DAY)),
(1, 'UPDATE', 'conductores', 3, '{"estado": "activo"}', '{"estado": "inactivo", "motivo_inactivacion": "Suspendido temporalmente"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 1 DAY)),

-- Logs de actualización de vehículos
(1, 'UPDATE', 'vehiculos', 2, '{"estado": "activo"}', '{"estado": "mantenimiento"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 1 DAY)),
(2, 'UPDATE', 'vehiculos', 3, '{"soat_vigencia": "2025-08-30"}', '{"soat_vigencia": "2026-08-30", "soat_numero": "SOAT003-2026"}', '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 5 HOUR)),

-- Logs de cambios en roles y permisos
(1, 'UPDATE', 'usuarios', 4, '{"rol_id": 3}', '{"rol_id": 2}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 3 DAY)),
(1, 'UPDATE', 'roles', 2, '{"permisos": "old_permissions"}', '{"permisos": "updated_permissions"}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 1 DAY)),

-- Logs de eliminación/cancelación
(1, 'DELETE', 'viajes', 15, '{"estado": "pendiente", "motivo": "Cliente no se presentó"}', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 2 HOUR)),
(2, 'UPDATE', 'mantenimientos', 8, '{"estado": "programado"}', '{"estado": "cancelado", "motivo_cancelacion": "Cliente canceló cita"}', '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36', DATE_SUB(NOW(), INTERVAL 6 HOUR));