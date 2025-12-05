<?php

namespace Database\Seeders;

use App\Models\Vehiculo;
use Illuminate\Database\Seeder;

class VehiculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vehículos específicos con datos completos
        $vehiculosEspecificos = [
            [
                'placa' => 'ABC123',
                'marca' => 'Honda',
                'modelo' => 'CB 125',
                'año' => 2020,
                'color' => 'Rojo',
                'numero_motor' => 'CB125E-001',
                'numero_chasis' => 'HCB125001',
                'cilindraje' => 125,
                'tipo_combustible' => 'gasolina',
                'capacidad_tanque' => 12.0,
                'kilometraje' => 45000.0,
                'estado' => 'activo',
                'estado_operativo' => 'disponible',
                'fecha_adquisicion' => '2020-03-15',
                'valor_comercial' => 8500000.00,
                'numero_soat' => 'SOAT001',
                'fecha_vencimiento_soat' => '2025-03-15',
                'numero_tecnomecanica' => 'TM001',
                'fecha_vencimiento_tecnomecanica' => '2025-03-15',
                'propietario' => 'Empresa Primero de Junio',
                'observaciones' => 'Motocicleta en excelente estado',
            ],
            [
                'placa' => 'DEF456',
                'marca' => 'Yamaha',
                'modelo' => 'XTZ 125',
                'año' => 2021,
                'color' => 'Azul',
                'numero_motor' => 'XTZ125-002',
                'numero_chasis' => 'YXTZ125002',
                'cilindraje' => 125,
                'tipo_combustible' => 'gasolina',
                'capacidad_tanque' => 13.0,
                'kilometraje' => 32000.0,
                'estado' => 'activo',
                'estado_operativo' => 'en_servicio',
                'fecha_adquisicion' => '2021-01-20',
                'valor_comercial' => 9200000.00,
                'numero_soat' => 'SOAT002',
                'fecha_vencimiento_soat' => '2025-01-20',
                'numero_tecnomecanica' => 'TM002',
                'fecha_vencimiento_tecnomecanica' => '2025-01-20',
                'propietario' => 'Empresa Primero de Junio',
                'observaciones' => 'Motocicleta ideal para rutas urbanas',
            ],
            [
                'placa' => 'GHI789',
                'marca' => 'Suzuki',
                'modelo' => 'AX 100',
                'año' => 2019,
                'color' => 'Negro',
                'numero_motor' => 'AX100-003',
                'numero_chasis' => 'SAX100003',
                'cilindraje' => 100,
                'tipo_combustible' => 'gasolina',
                'capacidad_tanque' => 10.5,
                'kilometraje' => 58000.0,
                'estado' => 'activo',
                'estado_operativo' => 'disponible',
                'fecha_adquisicion' => '2019-08-10',
                'valor_comercial' => 6800000.00,
                'numero_soat' => 'SOAT003',
                'fecha_vencimiento_soat' => '2025-08-10',
                'numero_tecnomecanica' => 'TM003',
                'fecha_vencimiento_tecnomecanica' => '2025-08-10',
                'propietario' => 'Empresa Primero de Junio',
                'observaciones' => 'Vehículo económico y confiable',
            ]
        ];

        foreach ($vehiculosEspecificos as $vehiculoData) {
            Vehiculo::create($vehiculoData);
        }

        // Crear vehículos adicionales usando factory
        Vehiculo::factory()->count(17)->create();
        
        $this->command->info('Se crearon 20 vehículos: 3 específicos + 17 generados');
    }
}
