-- Seed: 004_create_vehiculos.sql
-- Datos iniciales para la tabla vehiculos

INSERT INTO vehiculos (placa, marca, modelo, color, ano, cilindraje, numero_motor, numero_chasis, propietario_nombre, propietario_cedula, propietario_telefono, seguro_numero, seguro_vigencia, soat_numero, soat_vigencia, tecnicomecanica_numero, tecnicomecanica_vigencia, tarjeta_propiedad, estado) VALUES
('ABC123', 'Honda', 'CB125F', 'Rojo', 2020, 125, 'MOT001ABC123', 'CHA001ABC123', 'Pedro Jiménez', '10203040', '3145678901', 'SEG001', '2025-12-31', 'SOAT001', '2025-06-30', 'TEC001', '2025-03-15', 'PROP001', 'activo'),
('XYZ789', 'Yamaha', 'XTZ125', 'Azul', 2019, 125, 'MOT002XYZ789', 'CHA002XYZ789', 'Carmen López', '50607080', '3167890123', 'SEG002', '2025-11-20', 'SOAT002', '2025-07-22', 'TEC002', '2025-04-10', 'PROP002', 'activo'),
('DEF456', 'Suzuki', 'AX100', 'Negro', 2021, 100, 'MOT003DEF456', 'CHA003DEF456', 'Miguel Torres', '90102030', '3189012345', 'SEG003', '2026-01-15', 'SOAT003', '2025-08-30', 'TEC003', '2025-05-25', 'PROP003', 'activo'),
('GHI012', 'Honda', 'XR150L', 'Verde', 2018, 150, 'MOT004GHI012', 'CHA004GHI012', 'Rosa Martínez', '40506070', '3134567890', 'SEG004', '2025-10-10', 'SOAT004', '2025-05-15', 'TEC004', '2025-02-20', 'PROP004', 'activo'),
('JKL345', 'Yamaha', 'FZ-FI', 'Blanco', 2020, 150, 'MOT005JKL345', 'CHA005JKL345', 'Diego Vargas', '80901020', '3198765432', 'SEG005', '2026-02-28', 'SOAT005', '2025-09-12', 'TEC005', '2025-06-08', 'PROP005', 'activo');