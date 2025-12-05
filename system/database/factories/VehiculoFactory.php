<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehiculo>
 */
class VehiculoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Marcas y modelos reales para Colombia
        $marcasModelos = [
            'Toyota' => ['Corolla', 'Yaris', 'Prius', 'Camry', 'RAV4', 'Prado', 'Fortuner', 'Hilux', 'Innova'],
            'Chevrolet' => ['Spark', 'Aveo', 'Cruze', 'Onix', 'Captiva', 'Tracker', 'Tahoe', 'Orlando', 'Sail'],
            'Nissan' => ['Versa', 'March', 'Sentra', 'Altima', 'X-Trail', 'Kicks', 'Frontier', 'Pathfinder', 'Tiida'],
            'Kia' => ['Picanto', 'Rio', 'Cerato', 'Optima', 'Sportage', 'Sorento', 'Soul', 'Stonic', 'Grand Carnival'],
            'Hyundai' => ['i10', 'i25', 'Accent', 'Elantra', 'Sonata', 'Tucson', 'Santa Fe', 'Veloster', 'H1'],
            'Mazda' => ['2', '3', '6', 'CX-3', 'CX-5', 'CX-9', 'BT-50', 'MX-5'],
            'Ford' => ['Fiesta', 'Focus', 'Fusion', 'EcoSport', 'Explorer', 'F-150', 'Ranger', 'Edge'],
            'Volkswagen' => ['Gol', 'Polo', 'Jetta', 'Passat', 'Tiguan', 'Amarok', 'CrossFox', 'Vento'],
            'Renault' => ['Logan', 'Sandero', 'Duster', 'Fluence', 'Megane', 'Koleos', 'Captur', 'Stepway'],
            'Honda' => ['City', 'Civic', 'Accord', 'CR-V', 'Pilot', 'Fit', 'HR-V', 'Ridgeline'],
        ];

        $marca = $this->faker->randomKey($marcasModelos);
        $modelo = $this->faker->randomElement($marcasModelos[$marca]);
        $ano = $this->faker->numberBetween(2010, 2024);
        
        // Colores realistas en español
        $colores = [
            'Blanco', 'Negro', 'Gris', 'Plata', 'Rojo', 'Azul', 'Beige', 'Dorado',
            'Verde', 'Café', 'Amarillo', 'Naranja', 'Morado', 'Rosa', 'Vino Tinto',
            'Azul Marino', 'Gris Oscuro', 'Blanco Perla', 'Negro Metalizado'
        ];

        $ciudadesColombianas = [
            'Bogotá', 'Medellín', 'Cali', 'Barranquilla', 'Cartagena', 'Bucaramanga',
            'Pereira', 'Ibagué', 'Santa Marta', 'Manizales', 'Villavicencio', 'Neiva',
            'Armenia', 'Pasto', 'Montería', 'Sincelejo', 'Popayán', 'Tunja',
            'Valledupar', 'Quibdó', 'Florencia', 'Yopal', 'Riohacha', 'Arauca'
        ];

        $aseguradoras = [
            'SURA', 'Bolivar', 'Mapfre', 'AXA Colpatria', 'Allianz', 'La Previsora',
            'Liberty Seguros', 'SBS Seguros', 'HDI Seguros', 'QBE Seguros',
            'Seguros del Estado', 'Mundial de Seguros'
        ];

        $nombresColombianosHombres = [
            'Carlos Andrés', 'Luis Fernando', 'Jorge Enrique', 'Juan Pablo', 'Miguel Ángel',
            'José María', 'Diego Alejandro', 'Andrés Felipe', 'Ricardo Antonio', 'Fernando José',
            'Gabriel Eduardo', 'Sebastián David', 'Alejandro José', 'Daniel Eduardo', 'Oscar Mauricio'
        ];

        $nombresColombianosMujeres = [
            'María Elena', 'Ana María', 'Luz Marina', 'Patricia Andrea', 'Carmen Rosa',
            'Gloria Esperanza', 'Sandra Milena', 'Claudia Patricia', 'Martha Lucía', 'Diana Carolina',
            'Adriana Marcela', 'Paola Andrea', 'Liliana María', 'Beatriz Elena', 'Rosa María'
        ];

        $apellidosColombianosComunes = [
            'García', 'Rodríguez', 'González', 'Hernández', 'López', 'Martínez', 'Pérez', 'Sánchez',
            'Ramírez', 'Cruz', 'Flores', 'Gómez', 'Díaz', 'Reyes', 'Morales', 'Jiménez',
            'Herrera', 'Medina', 'Gutiérrez', 'Castillo', 'Vargas', 'Rojas', 'Ortiz', 'Torres'
        ];

        $esHombre = $this->faker->boolean();
        $nombrePropietario = ($esHombre ? $this->faker->randomElement($nombresColombianosHombres) : $this->faker->randomElement($nombresColombianosMujeres))
            . ' ' . $this->faker->randomElement($apellidosColombianosComunes)
            . ' ' . $this->faker->randomElement($apellidosColombianosComunes);

        $kilometrajeActual = $this->faker->numberBetween(0, 300000);
        $ultimoMantenimiento = $this->faker->dateTimeBetween('-6 months', 'now');
        $kmUltimoMantenimiento = $this->faker->numberBetween(max(0, $kilometrajeActual - 15000), $kilometrajeActual);
        
        $equipamientoAdicional = [];
        if ($this->faker->boolean(30)) $equipamientoAdicional[] = 'Llantas de repuesto';
        if ($this->faker->boolean(40)) $equipamientoAdicional[] = 'Kit de herramientas';
        if ($this->faker->boolean(20)) $equipamientoAdicional[] = 'Extintor';
        if ($this->faker->boolean(15)) $equipamientoAdicional[] = 'Botiquín';
        if ($this->faker->boolean(25)) $equipamientoAdicional[] = 'Radio AM/FM';
        if ($this->faker->boolean(35)) $equipamientoAdicional[] = 'Bluetooth';
        if ($this->faker->boolean(10)) $equipamientoAdicional[] = 'Cámara de reversa';

        $documentosVehiculo = [];
        if ($this->faker->boolean(90)) $documentosVehiculo[] = 'Tarjeta de propiedad';
        if ($this->faker->boolean(85)) $documentosVehiculo[] = 'SOAT vigente';
        if ($this->faker->boolean(80)) $documentosVehiculo[] = 'Tecnomecánica vigente';
        if ($this->faker->boolean(75)) $documentosVehiculo[] = 'Revisión de gases';
        if ($this->faker->boolean(40)) $documentosVehiculo[] = 'Póliza de seguro';

        return [
            // Información básica del vehículo
            'placa' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'marca' => $marca,
            'modelo' => $modelo,
            'linea' => $this->faker->optional(0.7)->randomElement(['Base', 'Full', 'GLX', 'GLS', 'Sport', 'Luxury', 'Premium', 'Executive']),
            'color' => $this->faker->randomElement($colores),
            'color_secundario' => $this->faker->optional(0.3)->randomElement($colores),
            'ano' => $ano,
            'cilindraje' => $this->faker->randomElement([1000, 1200, 1300, 1400, 1500, 1600, 1800, 2000, 2400, 2500, 3000]),
            'tipo_combustible' => $this->faker->randomElement(['Gasolina', 'Gas', 'Diesel', 'Electrico', 'Hibrido', 'GNV']),
            'transmision' => $this->faker->randomElement(['manual', 'automatica', 'semi_automatica']),
            'capacidad_pasajeros' => $this->faker->numberBetween(2, 8),
            'capacidad_tanque_litros' => $this->faker->randomFloat(1, 35, 80),
            'rendimiento_km_galon' => $this->faker->randomFloat(1, 25, 45),

            // Identificación del vehículo
            'numero_motor' => $this->faker->unique()->bothify($marca . '-MOT-########'),
            'numero_chasis' => $this->faker->unique()->bothify($marca . '-' . strtoupper($modelo) . '-########'),
            'numero_serie' => $this->faker->optional(0.8)->bothify('SER-########'),
            'tarjeta_propiedad' => $this->faker->optional(0.9)->numerify('TP-########'),

            // Información del propietario
            'propietario_nombre' => $nombrePropietario,
            'propietario_cedula' => $this->faker->numerify('##########'),
            'propietario_telefono' => $this->faker->randomElement([
                '3' . $this->faker->numerify('#########'),  // Celular
                '60' . $this->faker->numerify('#') . $this->faker->numerify('#######'),  // Fijo Bogotá
                '604' . $this->faker->numerify('#######'),  // Fijo Medellín
                '602' . $this->faker->numerify('#######'),  // Fijo Cali
            ]),
            'propietario_email' => $this->faker->optional(0.7)->email(),
            'propietario_direccion' => $this->faker->optional(0.8)->streetAddress() . ', ' . $this->faker->randomElement($ciudadesColombianas),
            'propietario_ciudad' => $this->faker->randomElement($ciudadesColombianas),

            // Información comercial
            'valor_comercial' => $this->faker->randomFloat(0, 15000000, 180000000), // 15M a 180M COP
            'valor_asegurado' => $this->faker->optional(0.8)->randomFloat(0, 12000000, 150000000),
            'aseguradora' => $this->faker->optional(0.8)->randomElement($aseguradoras),
            'poliza_numero' => $this->faker->optional(0.8)->bothify('POL-########'),
            'poliza_vencimiento' => $this->faker->optional(0.8)->dateTimeBetween('now', '+2 years'),

            // Documentación vehicular
            'soat_vencimiento' => $this->faker->optional(0.9)->dateTimeBetween('-6 months', '+1 year'),
            'soat_numero' => $this->faker->optional(0.9)->numerify('SOAT########'),
            'tecnomecanica_vencimiento' => $this->faker->optional(0.85)->dateTimeBetween('-1 year', '+1 year'),
            'tecnomecanica_numero' => $this->faker->optional(0.85)->numerify('TEC########'),
            'revision_gases_vencimiento' => $this->faker->optional(0.75)->dateTimeBetween('-6 months', '+6 months'),
            'documentos_vehiculo' => json_encode($documentosVehiculo),

            // Control operativo
            'kilometraje_actual' => $kilometrajeActual,
            'ultimo_mantenimiento' => $ultimoMantenimiento->format('Y-m-d'),
            'kilometraje_ultimo_mantenimiento' => $kmUltimoMantenimiento,
            'proximo_mantenimiento' => $this->faker->dateTimeBetween('now', '+3 months'),
            'kilometraje_proximo_mantenimiento' => $kilometrajeActual + $this->faker->numberBetween(5000, 15000),
            'costo_mantenimiento_total' => $this->faker->randomFloat(0, 0, 5000000),

            // Estadísticas operativas
            'total_viajes' => $this->faker->numberBetween(0, 2000),
            'total_kilometros_recorridos' => $this->faker->randomFloat(1, 0, $kilometrajeActual),
            'total_ingresos_generados' => $this->faker->randomFloat(0, 0, 50000000),
            'total_gastos_operativos' => $this->faker->randomFloat(0, 0, 15000000),
            'promedio_consumo_combustible' => $this->faker->optional(0.8)->randomFloat(1, 6, 15),
            'ultima_utilizacion' => $this->faker->optional(0.9)->dateTimeBetween('-1 month', 'now'),

            // Estados y disponibilidad
            'estado' => $this->faker->randomElement([
                'activo', 'activo', 'activo', 'activo', 'activo', // Más probabilidad de activo
                'mantenimiento', 'inactivo', 'documentos_vencidos'
            ]),
            'estado_operativo' => $this->faker->randomElement([
                'disponible', 'disponible', 'disponible', 'en_servicio', 
                'mantenimiento', 'fuera_servicio', 'limpieza'
            ]),
            'ultimo_cambio_estado' => $this->faker->optional(0.7)->dateTimeBetween('-3 months', 'now'),
            'motivo_estado' => $this->faker->optional(0.5)->randomElement([
                'Mantenimiento preventivo', 'Reparación menor', 'Cambio de llantas',
                'Revisión técnica', 'Documentos por vencer', 'Limpieza general'
            ]),

            // Características y equipamiento
            'tiene_aire_acondicionado' => $this->faker->boolean(70),
            'tiene_gps' => $this->faker->boolean(40),
            'tiene_camara_seguridad' => $this->faker->boolean(25),
            'tiene_wifi' => $this->faker->boolean(15),
            'tiene_cargador_usb' => $this->faker->boolean(60),
            'es_blindado' => $this->faker->boolean(5),
            'equipamiento_adicional' => json_encode($equipamientoAdicional),

            // Ubicación y asignación
            'ubicacion_actual' => $this->faker->optional(0.8)->streetAddress() . ', ' . $this->faker->randomElement($ciudadesColombianas),
            'latitud' => $this->faker->optional(0.6)->latitude(1, 12), // Coordenadas de Colombia
            'longitud' => $this->faker->optional(0.6)->longitude(-79, -66),
            'ultima_ubicacion_actualizada' => $this->faker->optional(0.6)->dateTimeBetween('-1 week', 'now'),
            'parqueadero_asignado' => $this->faker->optional(0.4)->randomElement([
                'Parqueadero Central', 'Zona Norte', 'Zona Sur', 'Terminal', 'Aeropuerto'
            ]),

            // Costos y tarifas
            'tarifa_km' => $this->faker->randomFloat(0, 2000, 8000), // COP por km
            'tarifa_hora' => $this->faker->randomFloat(0, 15000, 45000), // COP por hora
            'tarifa_minima' => $this->faker->randomFloat(0, 8000, 25000), // Tarifa mínima COP
            'porcentaje_comision_conductor' => $this->faker->randomFloat(1, 60, 80),

            // Auditoría y control
            'creado_por' => null, // Se asignará por seeder si es necesario
            'actualizado_por' => null,
            'fecha_adquisicion' => $this->faker->optional(0.8)->dateTimeBetween('-5 years', '-1 month'),
            'fecha_baja' => null,
            'motivo_baja' => null,
            'observaciones' => $this->faker->optional(0.3)->realText(200),
            'historial_propietarios' => $this->faker->optional(0.2)->passthrough(json_encode([
                [
                    'nombre' => $this->faker->name(),
                    'cedula' => $this->faker->numerify('##########'),
                    'fecha_inicio' => $this->faker->dateTimeBetween('-3 years', '-1 year')->format('Y-m-d'),
                    'fecha_fin' => $this->faker->dateTimeBetween('-1 year', '-6 months')->format('Y-m-d')
                ]
            ])),
            'historial_incidentes' => $this->faker->optional(0.15)->passthrough(json_encode([
                [
                    'tipo' => $this->faker->randomElement(['Accidente menor', 'Daño mecánico', 'Robo parcial']),
                    'fecha' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
                    'descripcion' => $this->faker->sentence(),
                    'costo_reparacion' => $this->faker->randomFloat(0, 100000, 2000000)
                ]
            ]))
        ];
    }

    /**
     * Indica que el vehículo está en mantenimiento
     */
    public function enMantenimiento()
    {
        return $this->state(function (array $attributes) {
            return [
                'estado' => 'mantenimiento',
                'estado_operativo' => 'mantenimiento',
                'ultimo_cambio_estado' => now(),
                'motivo_estado' => 'Mantenimiento programado'
            ];
        });
    }

    /**
     * Indica que el vehículo está inactivo
     */
    public function inactivo()
    {
        return $this->state(function (array $attributes) {
            return [
                'estado' => 'inactivo',
                'estado_operativo' => 'fuera_servicio',
                'ultimo_cambio_estado' => now(),
                'motivo_estado' => 'Vehículo temporalmente fuera de servicio'
            ];
        });
    }

    /**
     * Indica que el vehículo tiene documentos vencidos
     */
    public function documentosVencidos()
    {
        return $this->state(function (array $attributes) {
            return [
                'estado' => 'documentos_vencidos',
                'estado_operativo' => 'fuera_servicio',
                'soat_vencimiento' => $this->faker->dateTimeBetween('-6 months', '-1 month'),
                'tecnomecanica_vencimiento' => $this->faker->dateTimeBetween('-1 year', '-2 months'),
                'ultimo_cambio_estado' => now(),
                'motivo_estado' => 'Documentos vencidos - requiere actualización'
            ];
        });
    }

    /**
     * Crea un vehículo premium con mejores características
     */
    public function premium()
    {
        return $this->state(function (array $attributes) {
            return [
                'marca' => $this->faker->randomElement(['Mercedes-Benz', 'BMW', 'Audi', 'Lexus', 'Jaguar']),
                'modelo' => $this->faker->randomElement(['C-Class', 'Serie 3', 'A4', 'ES', 'XE']),
                'ano' => $this->faker->numberBetween(2018, 2024),
                'tiene_aire_acondicionado' => true,
                'tiene_gps' => true,
                'tiene_camara_seguridad' => true,
                'tiene_wifi' => true,
                'tiene_cargador_usb' => true,
                'valor_comercial' => $this->faker->randomFloat(0, 80000000, 300000000),
                'tarifa_km' => $this->faker->randomFloat(0, 5000, 12000),
                'tarifa_hora' => $this->faker->randomFloat(0, 35000, 80000),
                'tarifa_minima' => $this->faker->randomFloat(0, 20000, 50000)
            ];
        });
    }

    /**
     * Crea un vehículo económico
     */
    public function economico()
    {
        return $this->state(function (array $attributes) {
            return [
                'marca' => $this->faker->randomElement(['Chevrolet', 'Kia', 'Hyundai']),
                'modelo' => $this->faker->randomElement(['Spark', 'Picanto', 'i10']),
                'ano' => $this->faker->numberBetween(2010, 2018),
                'cilindraje' => $this->faker->randomElement([1000, 1200]),
                'tiene_aire_acondicionado' => $this->faker->boolean(40),
                'tiene_gps' => false,
                'tiene_camara_seguridad' => false,
                'tiene_wifi' => false,
                'valor_comercial' => $this->faker->randomFloat(0, 15000000, 35000000),
                'tarifa_km' => $this->faker->randomFloat(0, 1500, 4000),
                'tarifa_hora' => $this->faker->randomFloat(0, 12000, 25000),
                'tarifa_minima' => $this->faker->randomFloat(0, 6000, 15000)
            ];
        });
    }
}
