-- Seed: 007_create_viajes.sql
-- Datos iniciales para la tabla viajes

INSERT INTO viajes (conductor_id, vehiculo_id, cliente_id, cliente_nombre, cliente_telefono, origen, destino, distancia_km, duracion_minutos, tarifa_aplicada_id, valor_base, recargos, descuentos, valor_total, metodo_pago, estado, fecha_hora_inicio, fecha_hora_fin, calificacion, comentario_cliente) VALUES
(1, 1, 1, NULL, NULL, 'Centro Comercial Plaza Mayor', 'Universidad Nacional', 8.5, 25, 1, 13700.00, 0.00, 685.00, 13015.00, 'efectivo', 'completado', '2025-11-08 08:30:00', '2025-11-08 08:55:00', 5, 'Excelente servicio, muy puntual'),
(2, 2, NULL, 'Cliente Ocasional', '3209876543', 'Terminal de Transporte', 'Hospital San Rafael', 12.2, 35, 1, 18140.00, 0.00, 0.00, 18140.00, 'tarjeta', 'completado', '2025-11-08 10:15:00', '2025-11-08 10:50:00', 4, 'Buen servicio'),
(3, 3, 3, NULL, NULL, 'Zona Industrial', 'Aeropuerto Internacional', 15.8, 40, 3, 31700.00, 0.00, 3170.00, 28530.00, 'transferencia', 'completado', '2025-11-08 14:20:00', '2025-11-08 15:00:00', 5, 'Conductor muy profesional'),
(1, 1, 2, NULL, NULL, 'Universidad Nacional', 'Centro Histórico', 6.3, 20, 1, 11060.00, 0.00, 0.00, 11060.00, 'efectivo', 'completado', '2025-11-08 16:45:00', '2025-11-08 17:05:00', 4, 'Todo bien'),
(4, 4, NULL, 'Pasajero Express', '3187654321', 'Plaza de Bolívar', 'Zona Rosa', 9.1, 28, 1, 14420.00, 2884.00, 0.00, 17304.00, 'efectivo', 'completado', '2025-11-08 19:30:00', '2025-11-08 19:58:00', 3, 'Recargo nocturno aplicado'),
(5, 5, 4, NULL, NULL, 'Hospital San Rafael', 'Centro Comercial', 7.8, 22, 1, 12860.00, 0.00, 386.00, 12474.00, 'tarjeta', 'completado', '2025-11-08 11:20:00', '2025-11-08 11:42:00', 5, 'Muy recomendado'),
(2, 2, NULL, 'Usuario Temporal', '3176543210', 'Estación de Policía', 'Clínica del Norte', 5.2, 18, 1, 9740.00, 0.00, 0.00, 9740.00, 'efectivo', 'en_curso', '2025-11-08 15:30:00', NULL, NULL, NULL);