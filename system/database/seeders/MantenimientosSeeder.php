<?php

namespace Database\Seeders;

use App\Models\Mantenimiento;
use App\Models\Vehiculo;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MantenimientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Vehiculo::count() == 0) {
            return;
        }

        $vehiculos = Vehiculo::all();
        
        $mantenimientos = [
            // Mantenimientos preventivos programados (8 registros)
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'preventivo',
                'descripcion' => 'Cambio de aceite y filtros - Mantenimiento de 10,000 km',
                'fecha_programada' => Carbon::now()->subDays(15),
                'fecha_inicio' => Carbon::now()->subDays(15),
                'fecha_fin' => Carbon::now()->subDays(15),
                'estado' => 'completado',
                'costo_total' => 150000.00,
                'kilometraje_actual' => 45000,
                'repuestos_utilizados' => json_encode([
                    ['nombre' => 'Aceite motor 20W50', 'cantidad' => 4, 'precio_unitario' => 15000],
                    ['nombre' => 'Filtro de aceite', 'cantidad' => 1, 'precio_unitario' => 25000],
                    ['nombre' => 'Filtro de aire', 'cantidad' => 1, 'precio_unitario' => 18000],
                    ['nombre' => 'Filtro de combustible', 'cantidad' => 1, 'precio_unitario' => 22000]
                ]),
                'servicios_realizados' => json_encode([
                    'Cambio de aceite de motor',
                    'Reemplazo de filtro de aceite',
                    'Reemplazo de filtro de aire',
                    'Reemplazo de filtro de combustible',
                    'Inspección general del motor'
                ]),
                'proveedor_servicio' => 'Taller Automotriz El Mecánico',
                'observaciones' => 'Mantenimiento realizado según cronograma. Vehículo en excelentes condiciones.',
                'proximo_mantenimiento' => Carbon::now()->addDays(90),
                'creado_por' => 1
            ],
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'preventivo',
                'descripcion' => 'Revisión y mantenimiento de frenos completo',
                'fecha_programada' => Carbon::now()->subDays(8),
                'fecha_inicio' => Carbon::now()->subDays(8),
                'fecha_fin' => Carbon::now()->subDays(7),
                'estado' => 'completado',
                'costo_total' => 280000.00,
                'kilometraje_actual' => 38500,
                'repuestos_utilizados' => json_encode([
                    ['nombre' => 'Pastillas de freno delanteras', 'cantidad' => 1, 'precio_unitario' => 85000],
                    ['nombre' => 'Pastillas de freno traseras', 'cantidad' => 1, 'precio_unitario' => 75000],
                    ['nombre' => 'Líquido de frenos DOT 4', 'cantidad' => 1, 'precio_unitario' => 25000],
                    ['nombre' => 'Mangueras de freno', 'cantidad' => 2, 'precio_unitario' => 30000]
                ]),
                'servicios_realizados' => json_encode([
                    'Inspección completa del sistema de frenos',
                    'Reemplazo de pastillas delanteras y traseras',
                    'Cambio de líquido de frenos',
                    'Revisión de discos de freno',
                    'Calibración del sistema ABS'
                ]),
                'proveedor_servicio' => 'Frenos Especializados S.A.S.',
                'observaciones' => 'Sistema de frenos renovado completamente. Excelente respuesta de frenado.',
                'proximo_mantenimiento' => Carbon::now()->addDays(120),
                'creado_por' => 1
            ],
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'preventivo',
                'descripcion' => 'Mantenimiento de sistema de suspensión y dirección',
                'fecha_programada' => Carbon::now()->subDays(20),
                'fecha_inicio' => Carbon::now()->subDays(20),
                'fecha_fin' => Carbon::now()->subDays(18),
                'estado' => 'completado',
                'costo_total' => 420000.00,
                'kilometraje_actual' => 67800,
                'repuestos_utilizados' => json_encode([
                    ['nombre' => 'Amortiguadores delanteros', 'cantidad' => 2, 'precio_unitario' => 120000],
                    ['nombre' => 'Bujes de suspensión', 'cantidad' => 4, 'precio_unitario' => 25000],
                    ['nombre' => 'Rotulas de dirección', 'cantidad' => 2, 'precio_unitario' => 40000],
                    ['nombre' => 'Aceite hidráulico dirección', 'cantidad' => 1, 'precio_unitario' => 30000]
                ]),
                'servicios_realizados' => json_encode([
                    'Reemplazo de amortiguadores delanteros',
                    'Cambio de bujes de suspensión',
                    'Reparación de rótulas de dirección',
                    'Alineación y balanceo completo',
                    'Revisión de geometría'
                ]),
                'proveedor_servicio' => 'Suspensión y Dirección Ltda.',
                'observaciones' => 'Suspensión y dirección completamente renovadas. Manejo suave y preciso.',
                'proximo_mantenimiento' => Carbon::now()->addDays(150),
                'creado_por' => 1
            ],
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'preventivo',
                'descripcion' => 'Revisión técnico-mecánica y de gases',
                'fecha_programada' => Carbon::now()->subDays(5),
                'fecha_inicio' => Carbon::now()->subDays(5),
                'fecha_fin' => Carbon::now()->subDays(5),
                'estado' => 'completado',
                'costo_total' => 85000.00,
                'kilometraje_actual' => 52300,
                'repuestos_utilizados' => json_encode([]),
                'servicios_realizados' => json_encode([
                    'Revisión técnico-mecánica completa',
                    'Prueba de emisiones de gases',
                    'Inspección de luces y señalización',
                    'Verificación de sistemas de seguridad',
                    'Documentación y certificados'
                ]),
                'proveedor_servicio' => 'CDA Medellín Centro',
                'observaciones' => 'Vehículo aprobado en revisión técnico-mecánica. Certificados al día.',
                'proximo_mantenimiento' => Carbon::now()->addYear(),
                'creado_por' => 1
            ],
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'preventivo',
                'descripcion' => 'Mantenimiento de sistema eléctrico y aire acondicionado',
                'fecha_programada' => Carbon::now()->subDays(12),
                'fecha_inicio' => Carbon::now()->subDays(12),
                'fecha_fin' => Carbon::now()->subDays(11),
                'estado' => 'completado',
                'costo_total' => 195000.00,
                'kilometraje_actual' => 41200,
                'repuestos_utilizados' => json_encode([
                    ['nombre' => 'Gas refrigerante R134a', 'cantidad' => 1, 'precio_unitario' => 45000],
                    ['nombre' => 'Filtro deshidratante A/C', 'cantidad' => 1, 'precio_unitario' => 35000],
                    ['nombre' => 'Correa del alternador', 'cantidad' => 1, 'precio_unitario' => 25000],
                    ['nombre' => 'Bujías de encendido', 'cantidad' => 4, 'precio_unitario' => 15000]
                ]),
                'servicios_realizados' => json_encode([
                    'Carga completa de aire acondicionado',
                    'Limpieza de evaporador y condensador',
                    'Revisión del sistema eléctrico',
                    'Cambio de bujías',
                    'Calibración de sensores'
                ]),
                'proveedor_servicio' => 'Electro Auto Refrigeración',
                'observaciones' => 'Sistema de A/C funcionando perfectamente. Sistema eléctrico optimizado.',
                'proximo_mantenimiento' => Carbon::now()->addDays(100),
                'creado_por' => 1
            ],
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'preventivo',
                'descripcion' => 'Cambio de llantas y alineación completa',
                'fecha_programada' => Carbon::now()->subDays(25),
                'fecha_inicio' => Carbon::now()->subDays(25),
                'fecha_fin' => Carbon::now()->subDays(25),
                'estado' => 'completado',
                'costo_total' => 650000.00,
                'kilometraje_actual' => 78500,
                'repuestos_utilizados' => json_encode([
                    ['nombre' => 'Llanta 205/55R16 Michelin', 'cantidad' => 4, 'precio_unitario' => 150000],
                    ['nombre' => 'Válvulas de llanta', 'cantidad' => 4, 'precio_unitario' => 2500]
                ]),
                'servicios_realizados' => json_encode([
                    'Cambio completo de llantas',
                    'Balanceo computarizado',
                    'Alineación 3D',
                    'Calibración de presión',
                    'Inspección de rines'
                ]),
                'proveedor_servicio' => 'Llantas y Servicios Premium',
                'observaciones' => 'Llantas nuevas de alta calidad. Alineación perfecta para óptimo rendimiento.',
                'proximo_mantenimiento' => Carbon::now()->addDays(180),
                'creado_por' => 1
            ],
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'preventivo',
                'descripcion' => 'Limpieza profunda y encerado completo',
                'fecha_programada' => Carbon::now()->subDays(3),
                'fecha_inicio' => Carbon::now()->subDays(3),
                'fecha_fin' => Carbon::now()->subDays(3),
                'estado' => 'completado',
                'costo_total' => 80000.00,
                'kilometraje_actual' => 34800,
                'repuestos_utilizados' => json_encode([
                    ['nombre' => 'Cera protectora', 'cantidad' => 1, 'precio_unitario' => 25000],
                    ['nombre' => 'Limpiador de tapicería', 'cantidad' => 1, 'precio_unitario' => 15000],
                    ['nombre' => 'Aromatizante', 'cantidad' => 1, 'precio_unitario' => 8000]
                ]),
                'servicios_realizados' => json_encode([
                    'Lavado exterior completo',
                    'Limpieza profunda de tapicería',
                    'Encerado y brillado',
                    'Limpieza de motor',
                    'Detallado interior'
                ]),
                'proveedor_servicio' => 'Auto Spa Deluxe',
                'observaciones' => 'Vehículo impecable, como nuevo. Excelente presentación para el servicio.',
                'proximo_mantenimiento' => Carbon::now()->addDays(30),
                'creado_por' => 1
            ],
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'preventivo',
                'descripcion' => 'Sincronización y afinación completa del motor',
                'fecha_programada' => Carbon::now()->subDays(18),
                'fecha_inicio' => Carbon::now()->subDays(18),
                'fecha_fin' => Carbon::now()->subDays(17),
                'estado' => 'completado',
                'costo_total' => 220000.00,
                'kilometraje_actual' => 56700,
                'repuestos_utilizados' => json_encode([
                    ['nombre' => 'Kit de sincronización', 'cantidad' => 1, 'precio_unitario' => 85000],
                    ['nombre' => 'Bujías iridium', 'cantidad' => 4, 'precio_unitario' => 25000],
                    ['nombre' => 'Cables de bujía', 'cantidad' => 1, 'precio_unitario' => 45000],
                    ['nombre' => 'Filtro de combustible', 'cantidad' => 1, 'precio_unitario' => 20000]
                ]),
                'servicios_realizados' => json_encode([
                    'Sincronización completa del motor',
                    'Cambio de kit de distribución',
                    'Afinación completa',
                    'Limpieza de inyectores',
                    'Calibración de sensores'
                ]),
                'proveedor_servicio' => 'Motores Especializado Ltda.',
                'observaciones' => 'Motor funcionando como nuevo. Excelente rendimiento y consumo optimizado.',
                'proximo_mantenimiento' => Carbon::now()->addDays(110),
                'creado_por' => 1
            ],

            // Mantenimientos correctivos (7 registros)
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'correctivo',
                'descripcion' => 'Reparación de sistema de transmisión',
                'fecha_programada' => Carbon::now()->subDays(30),
                'fecha_inicio' => Carbon::now()->subDays(30),
                'fecha_fin' => Carbon::now()->subDays(27),
                'estado' => 'completado',
                'costo_total' => 850000.00,
                'kilometraje_actual' => 89200,
                'repuestos_utilizados' => json_encode([
                    ['nombre' => 'Kit de embrague completo', 'cantidad' => 1, 'precio_unitario' => 320000],
                    ['nombre' => 'Aceite de transmisión', 'cantidad' => 4, 'precio_unitario' => 18000],
                    ['nombre' => 'Filtro de transmisión', 'cantidad' => 1, 'precio_unitario' => 35000],
                    ['nombre' => 'Sellos y empaques', 'cantidad' => 1, 'precio_unitario' => 45000]
                ]),
                'servicios_realizados' => json_encode([
                    'Desmonte completo de transmisión',
                    'Reemplazo de kit de embrague',
                    'Reparación de caja de cambios',
                    'Cambio de aceite y filtros',
                    'Pruebas de funcionamiento'
                ]),
                'proveedor_servicio' => 'Transmisiones Especializadas',
                'observaciones' => 'Transmisión completamente reparada. Cambios suaves y precisos.',
                'proximo_mantenimiento' => Carbon::now()->addDays(60),
                'creado_por' => 1
            ],
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'correctivo',
                'descripcion' => 'Reparación de radiador y sistema de refrigeración',
                'fecha_programada' => Carbon::now()->subDays(22),
                'fecha_inicio' => Carbon::now()->subDays(22),
                'fecha_fin' => Carbon::now()->subDays(21),
                'estado' => 'completado',
                'costo_total' => 380000.00,
                'kilometraje_actual' => 63400,
                'repuestos_utilizados' => json_encode([
                    ['nombre' => 'Radiador completo', 'cantidad' => 1, 'precio_unitario' => 180000],
                    ['nombre' => 'Termostato', 'cantidad' => 1, 'precio_unitario' => 25000],
                    ['nombre' => 'Refrigerante motor', 'cantidad' => 6, 'precio_unitario' => 12000],
                    ['nombre' => 'Mangueras radiador', 'cantidad' => 3, 'precio_unitario' => 18000]
                ]),
                'servicios_realizados' => json_encode([
                    'Reemplazo completo del radiador',
                    'Cambio de termostato',
                    'Renovación de mangueras',
                    'Lavado del sistema',
                    'Pruebas de presión'
                ]),
                'proveedor_servicio' => 'Radiadores del Valle',
                'observaciones' => 'Sistema de refrigeración funcionando perfectamente. Temperatura estable.',
                'proximo_mantenimiento' => Carbon::now()->addDays(90),
                'creado_por' => 1
            ],
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'correctivo',
                'descripcion' => 'Reparación de sistema de escape completo',
                'fecha_programada' => Carbon::now()->subDays(14),
                'fecha_inicio' => Carbon::now()->subDays(14),
                'fecha_fin' => Carbon::now()->subDays(14),
                'estado' => 'completado',
                'costo_total' => 290000.00,
                'kilometraje_actual' => 71800,
                'repuestos_utilizados' => json_encode([
                    ['nombre' => 'Silenciador trasero', 'cantidad' => 1, 'precio_unitario' => 120000],
                    ['nombre' => 'Tubo de escape central', 'cantidad' => 1, 'precio_unitario' => 85000],
                    ['nombre' => 'Soportes de escape', 'cantidad' => 4, 'precio_unitario' => 12000],
                    ['nombre' => 'Empaque del múltiple', 'cantidad' => 1, 'precio_unitario' => 15000]
                ]),
                'servicios_realizados' => json_encode([
                    'Reemplazo del sistema de escape',
                    'Soldadura especializada',
                    'Ajuste de soportes',
                    'Prueba de emisiones',
                    'Calibración acústica'
                ]),
                'proveedor_servicio' => 'Escapes y Silenciadores SA',
                'observaciones' => 'Sistema de escape nuevo. Reducción significativa de ruido y emisiones.',
                'proximo_mantenimiento' => Carbon::now()->addDays(120),
                'creado_por' => 1
            ],
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'correctivo',
                'descripcion' => 'Reparación de alternador y sistema de carga',
                'fecha_programada' => Carbon::now()->subDays(9),
                'fecha_inicio' => Carbon::now()->subDays(9),
                'fecha_fin' => Carbon::now()->subDays(8),
                'estado' => 'completado',
                'costo_total' => 185000.00,
                'kilometraje_actual' => 47600,
                'repuestos_utilizados' => json_encode([
                    ['nombre' => 'Alternador reconstruido', 'cantidad' => 1, 'precio_unitario' => 120000],
                    ['nombre' => 'Correa del alternador', 'cantidad' => 1, 'precio_unitario' => 25000],
                    ['nombre' => 'Regulador de voltaje', 'cantidad' => 1, 'precio_unitario' => 30000]
                ]),
                'servicios_realizados' => json_encode([
                    'Reemplazo del alternador',
                    'Cambio de correa',
                    'Instalación de regulador',
                    'Pruebas eléctricas',
                    'Calibración del sistema'
                ]),
                'proveedor_servicio' => 'Eléctricos Automotrices',
                'observaciones' => 'Sistema de carga funcionando perfectamente. Batería cargando correctamente.',
                'proximo_mantenimiento' => Carbon::now()->addDays(80),
                'creado_por' => 1
            ],
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'correctivo',
                'descripcion' => 'Reparación de bomba de combustible',
                'fecha_programada' => Carbon::now()->subDays(6),
                'fecha_inicio' => Carbon::now()->subDays(6),
                'fecha_fin' => Carbon::now()->subDays(6),
                'estado' => 'completado',
                'costo_total' => 320000.00,
                'kilometraje_actual' => 55900,
                'repuestos_utilizados' => json_encode([
                    ['nombre' => 'Bomba de gasolina', 'cantidad' => 1, 'precio_unitario' => 180000],
                    ['nombre' => 'Filtro de combustible', 'cantidad' => 1, 'precio_unitario' => 35000],
                    ['nombre' => 'Empaque tanque', 'cantidad' => 1, 'precio_unitario' => 25000],
                    ['nombre' => 'Mangueras combustible', 'cantidad' => 2, 'precio_unitario' => 20000]
                ]),
                'servicios_realizados' => json_encode([
                    'Reemplazo de bomba de combustible',
                    'Limpieza del tanque',
                    'Cambio de filtros',
                    'Pruebas de presión',
                    'Verificación del flujo'
                ]),
                'proveedor_servicio' => 'Sistemas de Combustible Pro',
                'observaciones' => 'Bomba nueva instalada. Suministro de combustible óptimo.',
                'proximo_mantenimiento' => Carbon::now()->addDays(100),
                'creado_por' => 1
            ],
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'correctivo',
                'descripcion' => 'Reparación de sistema de dirección hidráulica',
                'fecha_programada' => Carbon::now()->subDays(16),
                'fecha_inicio' => Carbon::now()->subDays(16),
                'fecha_fin' => Carbon::now()->subDays(15),
                'estado' => 'completado',
                'costo_total' => 450000.00,
                'kilometraje_actual' => 68300,
                'repuestos_utilizados' => json_encode([
                    ['nombre' => 'Bomba dirección hidráulica', 'cantidad' => 1, 'precio_unitario' => 220000],
                    ['nombre' => 'Mangueras alta presión', 'cantidad' => 2, 'precio_unitario' => 45000],
                    ['nombre' => 'Aceite dirección hidráulica', 'cantidad' => 2, 'precio_unitario' => 18000],
                    ['nombre' => 'Filtro dirección', 'cantidad' => 1, 'precio_unitario' => 25000]
                ]),
                'servicios_realizados' => json_encode([
                    'Reemplazo de bomba hidráulica',
                    'Cambio de mangueras',
                    'Renovación de aceite',
                    'Purga del sistema',
                    'Alineación de dirección'
                ]),
                'proveedor_servicio' => 'Dirección Especializada Ltda.',
                'observaciones' => 'Dirección hidráulica funcionando suavemente. Manejo preciso y cómodo.',
                'proximo_mantenimiento' => Carbon::now()->addDays(110),
                'creado_por' => 1
            ],
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'correctivo',
                'descripcion' => 'Reparación de sistema de arranque',
                'fecha_programada' => Carbon::now()->subDays(4),
                'fecha_inicio' => Carbon::now()->subDays(4),
                'fecha_fin' => Carbon::now()->subDays(4),
                'estado' => 'completado',
                'costo_total' => 165000.00,
                'kilometraje_actual' => 42100,
                'repuestos_utilizados' => json_encode([
                    ['nombre' => 'Motor de arranque', 'cantidad' => 1, 'precio_unitario' => 120000],
                    ['nombre' => 'Solenoide arranque', 'cantidad' => 1, 'precio_unitario' => 25000],
                    ['nombre' => 'Cables de batería', 'cantidad' => 2, 'precio_unitario' => 10000]
                ]),
                'servicios_realizados' => json_encode([
                    'Reemplazo del motor de arranque',
                    'Cambio de solenoide',
                    'Renovación de cables',
                    'Pruebas eléctricas',
                    'Verificación de conexiones'
                ]),
                'proveedor_servicio' => 'Arranques y Baterías Express',
                'observaciones' => 'Sistema de arranque funcionando perfectamente. Encendido inmediato.',
                'proximo_mantenimiento' => Carbon::now()->addDays(90),
                'creado_por' => 1
            ],

            // Mantenimientos programados (5 registros)
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'preventivo',
                'descripcion' => 'Mantenimiento programado de 50,000 km',
                'fecha_programada' => Carbon::now()->addDays(10),
                'fecha_inicio' => null,
                'fecha_fin' => null,
                'estado' => 'programado',
                'costo_total' => 0.00,
                'kilometraje_actual' => 49800,
                'repuestos_utilizados' => json_encode([]),
                'servicios_realizados' => json_encode([]),
                'proveedor_servicio' => 'Taller Automotriz El Mecánico',
                'observaciones' => 'Mantenimiento mayor programado. Incluye cambio de kit de distribución.',
                'proximo_mantenimiento' => null,
                'creado_por' => 1
            ],
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'preventivo',
                'descripcion' => 'Cambio de aceite programado',
                'fecha_programada' => Carbon::now()->addDays(5),
                'fecha_inicio' => null,
                'fecha_fin' => null,
                'estado' => 'programado',
                'costo_total' => 0.00,
                'kilometraje_actual' => 33200,
                'repuestos_utilizados' => json_encode([]),
                'servicios_realizados' => json_encode([]),
                'proveedor_servicio' => 'Cambios de Aceite Express',
                'observaciones' => 'Cambio de aceite y filtros según cronograma.',
                'proximo_mantenimiento' => null,
                'creado_por' => 1
            ],
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'correctivo',
                'descripcion' => 'Revisión de ruido en suspensión',
                'fecha_programada' => Carbon::now()->addDays(3),
                'fecha_inicio' => null,
                'fecha_fin' => null,
                'estado' => 'programado',
                'costo_total' => 0.00,
                'kilometraje_actual' => 61400,
                'repuestos_utilizados' => json_encode([]),
                'servicios_realizados' => json_encode([]),
                'proveedor_servicio' => 'Suspensión y Dirección Ltda.',
                'observaciones' => 'Conductor reporta ruido en parte delantera. Requiere diagnóstico.',
                'proximo_mantenimiento' => null,
                'creado_por' => 1
            ],
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'preventivo',
                'descripcion' => 'Lavado y encerado mensual',
                'fecha_programada' => Carbon::now()->addDays(2),
                'fecha_inicio' => null,
                'fecha_fin' => null,
                'estado' => 'programado',
                'costo_total' => 0.00,
                'kilometraje_actual' => 28700,
                'repuestos_utilizados' => json_encode([]),
                'servicios_realizados' => json_encode([]),
                'proveedor_servicio' => 'Auto Spa Deluxe',
                'observaciones' => 'Mantenimiento estético programado mensualmente.',
                'proximo_mantenimiento' => null,
                'creado_por' => 1
            ],
            [
                'vehiculo_id' => $vehiculos->random()->id,
                'tipo_mantenimiento' => 'preventivo',
                'descripcion' => 'Revisión técnico-mecánica anual',
                'fecha_programada' => Carbon::now()->addDays(15),
                'fecha_inicio' => null,
                'fecha_fin' => null,
                'estado' => 'programado',
                'costo_total' => 0.00,
                'kilometraje_actual' => 44600,
                'repuestos_utilizados' => json_encode([]),
                'servicios_realizados' => json_encode([]),
                'proveedor_servicio' => 'CDA Medellín Centro',
                'observaciones' => 'Revisión técnico-mecánica anual obligatoria.',
                'proximo_mantenimiento' => null,
                'creado_por' => 1
            ]
        ];

        foreach ($mantenimientos as $mantenimiento) {
            Mantenimiento::create(array_merge($mantenimiento, [
                'actualizado_por' => 1,
            ]));
        }
    }
}