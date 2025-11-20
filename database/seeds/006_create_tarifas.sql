-- Seed: 006_create_tarifas.sql
-- Datos iniciales para la tabla tarifas

INSERT INTO tarifas (nombre, descripcion, tarifa_base, tarifa_por_km, tarifa_por_minuto, tarifa_minima, tarifa_maxima, recargo_nocturno, recargo_festivo, recargo_lluvia, hora_inicio_nocturno, hora_fin_nocturno, estado, fecha_vigencia_inicio) VALUES
('Tarifa Estandar 2025', 'Tarifa regular para servicios urbanos', 3500.00, 1200.00, 50.00, 4500.00, 50000.00, 20.00, 15.00, 10.00, '18:00:00', '06:00:00', 'activa', '2025-01-01'),
('Tarifa Corporativa', 'Tarifa especial para empresas afiliadas', 3000.00, 1000.00, 40.00, 4000.00, 45000.00, 15.00, 10.00, 5.00, '18:00:00', '06:00:00', 'activa', '2025-01-01'),
('Tarifa Aeropuerto', 'Tarifa especifica para servicios al aeropuerto', 8000.00, 1500.00, 60.00, 12000.00, 80000.00, 25.00, 20.00, 15.00, '18:00:00', '06:00:00', 'activa', '2025-01-01'),
('Tarifa Promocional', 'Tarifa promocional para nuevos clientes', 2500.00, 900.00, 30.00, 3500.00, 35000.00, 10.00, 5.00, 5.00, '18:00:00', '06:00:00', 'inactiva', '2024-12-01');
