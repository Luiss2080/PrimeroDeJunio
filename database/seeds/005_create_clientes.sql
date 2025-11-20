-- Seed: 005_create_clientes.sql
-- Datos iniciales para la tabla clientes

INSERT INTO clientes (nombre, apellido, telefono, email, direccion_habitual, tipo_cliente, estado, descuento_porcentaje) VALUES
('Andrea', 'Gomez', '3201234567', 'andrea.gomez@email.com', 'Centro Comercial Plaza Mayor - Local 105', 'frecuente', 'activo', 5.00),
('Carlos Andres', 'Ruiz', '3189876543', 'carlos.ruiz@email.com', 'Universidad Nacional - Edificio de Ingenierias', 'particular', 'activo', 0.00),
('Empresa Logistica', 'Total S.A.S', '3156789012', 'contacto@logisticatotal.com', 'Zona Industrial - Bodega 15', 'corporativo', 'activo', 10.00),
('Maria Jose', 'Hernandez', '3143218765', 'majo.hernandez@email.com', 'Hospital San Rafael - Torre A', 'frecuente', 'activo', 3.00),
('Pedro', 'Sanchez', '3165432109', '', 'Aeropuerto Internacional - Terminal 1', 'particular', 'activo', 0.00),
('Gloria', 'Mendez', '3178901234', 'gloria.mendez@email.com', 'Centro Historico - Calle de la Catedral #8-25', 'frecuente', 'activo', 5.00),
('Consultoria', 'Empresarial LTDA', '3192345678', 'info@consultoria.com', 'Zona Rosa - Edificio Torre del Parque Piso 12', 'corporativo', 'activo', 15.00),
('Isabella', 'Rodriguez', '3112233445', 'isabella.rodriguez@email.com', 'Barrio El Poblado - Avenida Las Palmas #45-23', 'frecuente', 'activo', 8.00),
('Miguel Angel', 'Torres', '3123344556', 'miguel.torres@email.com', 'Centro Medico La Sabana - Consultorio 302', 'particular', 'activo', 0.00),
('Distribuidora', 'El exito S.A', '3134455667', 'ventas@elexito.com', 'Gran Estacion - Nivel 2', 'corporativo', 'activo', 12.00),
('Alejandro', 'Castro', '3145566778', 'alejandro.castro@email.com', 'Conjunto Residencial Los Cedros - Torre 3 Apt 504', 'particular', 'activo', 0.00),
('Sofia', 'Vargas', '3156677889', 'sofia.vargas@email.com', 'Clinica del Country - Ala Sur', 'frecuente', 'activo', 6.00),
('Tecnologica', 'Innovar LTDA', '3167788990', 'contacto@innovar.com', 'Parque Tecnologico - Edificio Smart Office', 'corporativo', 'activo', 18.00),
('Fernando', 'Morales', '3178899001', 'fernando.morales@email.com', 'Estadio El Campin - Puerta 7', 'particular', 'activo', 0.00),
('Camila', 'Jimenez', '3189900112', 'camila.jimenez@email.com', 'Terminal de Transporte - Modulo 2', 'frecuente', 'activo', 4.00),
('Servicios', 'Integrales S.A.S', '3190011223', 'info@serviciosintegrales.com', 'Centro de Convenciones - Salon Principal', 'corporativo', 'activo', 20.00),
('Daniel', 'Perez', '3201122334', 'daniel.perez@email.com', 'Biblioteca Luis angel Arango - Entrada Principal', 'particular', 'activo', 0.00),
('Valentina', 'Lopez', '3212233445', 'valentina.lopez@email.com', 'Hotel Tequendama - Recepcion', 'frecuente', 'activo', 7.00),
('Corporacion', 'Financiera XYZ', '3223344556', 'atencion@financieraxyz.com', 'Centro Internacional - Torre B Piso 25', 'corporativo', 'activo', 25.00),
('Sebastian', 'Ramirez', '3234455667', 'sebastian.ramirez@email.com', 'Transmilenio Estacion Portal Norte', 'particular', 'activo', 0.00);
