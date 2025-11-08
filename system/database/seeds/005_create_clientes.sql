-- Seed: 005_create_clientes.sql
-- Datos iniciales para la tabla clientes

INSERT INTO clientes (nombre, apellido, telefono, email, direccion_habitual, tipo_cliente, estado, descuento_porcentaje) VALUES
('Andrea', 'Gómez', '3201234567', 'andrea.gomez@email.com', 'Centro Comercial Plaza Mayor - Local 105', 'frecuente', 'activo', 5.00),
('Carlos Andrés', 'Ruiz', '3189876543', 'carlos.ruiz@email.com', 'Universidad Nacional - Edificio de Ingenierías', 'particular', 'activo', 0.00),
('Empresa Logística', 'Total S.A.S', '3156789012', 'contacto@logisticatotal.com', 'Zona Industrial - Bodega 15', 'corporativo', 'activo', 10.00),
('María José', 'Hernández', '3143218765', 'majo.hernandez@email.com', 'Hospital San Rafael - Torre A', 'frecuente', 'activo', 3.00),
('Pedro', 'Sánchez', '3165432109', '', 'Aeropuerto Internacional - Terminal 1', 'particular', 'activo', 0.00),
('Gloria', 'Mendez', '3178901234', 'gloria.mendez@email.com', 'Centro Histórico - Calle de la Catedral #8-25', 'frecuente', 'activo', 5.00),
('Consultoría', 'Empresarial LTDA', '3192345678', 'info@consultoria.com', 'Zona Rosa - Edificio Torre del Parque Piso 12', 'corporativo', 'activo', 15.00);