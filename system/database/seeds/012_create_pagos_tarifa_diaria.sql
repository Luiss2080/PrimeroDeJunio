-- Seed: 012_create_pagos_tarifa_diaria.sql
-- Datos de prueba para la tabla pagos_tarifa_diaria

-- Pagos de tarifa diaria de los ultimos 7 dias
-- Nota: Los IDs de conductor y usuario deben coincidir con los creados en seeds anteriores

-- Pagos del dia actual (algunos pagados, algunos pendientes)
INSERT INTO pagos_tarifa_diaria (conductor_id, fecha_pago, monto_tarifa, metodo_pago, registrado_por, observaciones, estado) VALUES
(1, '2025-11-17', 15000.00, 'efectivo', 1, 'Pago realizado en la manana', 'pagado'),
(2, '2025-11-17', 15000.00, 'transferencia', 2, 'Transferencia bancaria', 'pagado'),
(3, '2025-11-17', 15000.00, 'efectivo', 2, 'Pago pendiente de registro', 'pendiente'),
(4, '2025-11-17', 15000.00, 'efectivo', 1, '', 'pendiente'),
(5, '2025-11-17', 0.00, 'efectivo', 1, 'Exonerado por mantenimiento de vehiculo', 'exonerado');

-- Pagos de ayer (la mayoria pagados)
INSERT INTO pagos_tarifa_diaria (conductor_id, fecha_pago, monto_tarifa, metodo_pago, registrado_por, observaciones, estado) VALUES
(1, DATE_SUB('2025-11-17', INTERVAL 1 DAY), 15000.00, 'efectivo', 2, 'Pago completo', 'pagado'),
(2, DATE_SUB('2025-11-17', INTERVAL 1 DAY), 15000.00, 'transferencia', 1, 'Transferencia verificada', 'pagado'),
(3, DATE_SUB('2025-11-17', INTERVAL 1 DAY), 15000.00, 'efectivo', 1, 'Pago tarde pero completo', 'pagado'),
(4, DATE_SUB('2025-11-17', INTERVAL 1 DAY), 15000.00, 'descuento_viajes', 2, 'Descontado de comisiones de viajes', 'pagado'),
(5, DATE_SUB('2025-11-17', INTERVAL 1 DAY), 15000.00, 'efectivo', 2, 'Pago normal', 'pagado');

-- Pagos de hace 2 dias
INSERT INTO pagos_tarifa_diaria (conductor_id, fecha_pago, monto_tarifa, metodo_pago, registrado_por, observaciones, estado) VALUES
(1, DATE_SUB('2025-11-17', INTERVAL 2 DAY), 15000.00, 'efectivo', 1, 'Pago matutino', 'pagado'),
(2, DATE_SUB('2025-11-17', INTERVAL 2 DAY), 15000.00, 'efectivo', 2, 'Pago completo', 'pagado'),
(3, DATE_SUB('2025-11-17', INTERVAL 2 DAY), 15000.00, 'transferencia', 1, 'Transferencia del dia anterior', 'pagado'),
(4, DATE_SUB('2025-11-17', INTERVAL 2 DAY), 0.00, 'efectivo', 1, 'Dia de descanso autorizado', 'exonerado'),
(5, DATE_SUB('2025-11-17', INTERVAL 2 DAY), 15000.00, 'efectivo', 2, 'Pago normal', 'pagado');

-- Pagos de hace 3 dias (algunos con retrasos)
INSERT INTO pagos_tarifa_diaria (conductor_id, fecha_pago, monto_tarifa, metodo_pago, registrado_por, observaciones, estado) VALUES
(1, DATE_SUB('2025-11-17', INTERVAL 3 DAY), 15000.00, 'efectivo', 2, 'Pago con retraso pero completo', 'pagado'),
(2, DATE_SUB('2025-11-17', INTERVAL 3 DAY), 15000.00, 'transferencia', 1, 'Transferencia verificada', 'pagado'),
(3, DATE_SUB('2025-11-17', INTERVAL 3 DAY), 15000.00, 'efectivo', 2, 'Pago regular', 'pagado'),
(4, DATE_SUB('2025-11-17', INTERVAL 3 DAY), 15000.00, 'efectivo', 1, 'Pago completo', 'pagado'),
(5, DATE_SUB('2025-11-17', INTERVAL 3 DAY), 15000.00, 'descuento_viajes', 2, 'Descontado de comisiones', 'pagado');

-- Pagos de hace 4 dias
INSERT INTO pagos_tarifa_diaria (conductor_id, fecha_pago, monto_tarifa, metodo_pago, registrado_por, observaciones, estado) VALUES
(1, DATE_SUB('2025-11-17', INTERVAL 4 DAY), 15000.00, 'efectivo', 1, 'Pago matutino', 'pagado'),
(2, DATE_SUB('2025-11-17', INTERVAL 4 DAY), 15000.00, 'efectivo', 2, 'Pago normal', 'pagado'),
(3, DATE_SUB('2025-11-17', INTERVAL 4 DAY), 15000.00, 'transferencia', 1, 'Transferencia PSE', 'pagado'),
(4, DATE_SUB('2025-11-17', INTERVAL 4 DAY), 15000.00, 'efectivo', 2, 'Pago completo', 'pagado'),
(5, DATE_SUB('2025-11-17', INTERVAL 4 DAY), 15000.00, 'efectivo', 1, 'Pago regular', 'pagado');

-- Pagos de hace 5 dias
INSERT INTO pagos_tarifa_diaria (conductor_id, fecha_pago, monto_tarifa, metodo_pago, registrado_por, observaciones, estado) VALUES
(1, DATE_SUB('2025-11-17', INTERVAL 5 DAY), 15000.00, 'transferencia', 2, 'Transferencia bancaria', 'pagado'),
(2, DATE_SUB('2025-11-17', INTERVAL 5 DAY), 15000.00, 'efectivo', 1, 'Pago en efectivo', 'pagado'),
(3, DATE_SUB('2025-11-17', INTERVAL 5 DAY), 0.00, 'efectivo', 2, 'Exonerado por problemas familiares', 'exonerado'),
(4, DATE_SUB('2025-11-17', INTERVAL 5 DAY), 15000.00, 'efectivo', 1, 'Pago normal', 'pagado'),
(5, DATE_SUB('2025-11-17', INTERVAL 5 DAY), 15000.00, 'descuento_viajes', 2, 'Descontado de viajes', 'pagado');

-- Pagos de hace 6 dias  
INSERT INTO pagos_tarifa_diaria (conductor_id, fecha_pago, monto_tarifa, metodo_pago, registrado_por, observaciones, estado) VALUES
(1, DATE_SUB('2025-11-17', INTERVAL 6 DAY), 15000.00, 'efectivo', 1, 'Pago temprano', 'pagado'),
(2, DATE_SUB('2025-11-17', INTERVAL 6 DAY), 15000.00, 'efectivo', 2, 'Pago completo', 'pagado'),
(3, DATE_SUB('2025-11-17', INTERVAL 6 DAY), 15000.00, 'transferencia', 1, 'Transferencia verificada', 'pagado'),
(4, DATE_SUB('2025-11-17', INTERVAL 6 DAY), 15000.00, 'efectivo', 2, 'Pago normal', 'pagado'),
(5, DATE_SUB('2025-11-17', INTERVAL 6 DAY), 15000.00, 'efectivo', 1, 'Pago regular', 'pagado');

-- Pagos de hace 7 dias (semana completa)
INSERT INTO pagos_tarifa_diaria (conductor_id, fecha_pago, monto_tarifa, metodo_pago, registrado_por, observaciones, estado) VALUES
(1, DATE_SUB('2025-11-17', INTERVAL 7 DAY), 15000.00, 'efectivo', 2, 'Inicio de semana', 'pagado'),
(2, DATE_SUB('2025-11-17', INTERVAL 7 DAY), 15000.00, 'transferencia', 1, 'Transferencia del domingo', 'pagado'),
(3, DATE_SUB('2025-11-17', INTERVAL 7 DAY), 15000.00, 'efectivo', 2, 'Pago semanal', 'pagado'),
(4, DATE_SUB('2025-11-17', INTERVAL 7 DAY), 15000.00, 'efectivo', 1, 'Pago completo', 'pagado'),
(5, DATE_SUB('2025-11-17', INTERVAL 7 DAY), 15000.00, 'descuento_viajes', 2, 'Descuento semanal', 'pagado');
