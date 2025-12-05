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
                'ano' => 2020,
                'color' => 'Rojo',
                'numero_motor' => 'CB125E-001',
                'numero_chasis' => 'HCB125001',
                'cilindraje' => 125,
                'tipo_combustible' => 'Gasolina',
                'capacidad_tanque_litros' => 12.0,
                'kilometraje_actual' => 45000,
                'estado' => 'activo',
                'estado_operativo' => 'disponible',
                'fecha_adquisicion' => '2020-03-15',
                'valor_comercial' => 8500000.00,
                'soat_numero' => 'SOAT001',
                'soat_vencimiento' => '2025-03-15',
                'tecnomecanica_numero' => 'TM001',
                'tecnomecanica_vencimiento' => '2025-03-15',
                'propietario_nombre' => 'Empresa Primero de Junio',
                'propietario_cedula' => '900123456',
                'observaciones' => 'Motocicleta en excelente estado',
            ],
            [
                'placa' => 'DEF456',
                'marca' => 'Yamaha',
                'modelo' => 'XTZ 125',
                'ano' => 2021,
                'color' => 'Azul',
                'numero_motor' => 'XTZ125-002',
                'numero_chasis' => 'YXTZ125002',
                'cilindraje' => 125,
                'tipo_combustible' => 'Gasolina',
                'capacidad_tanque_litros' => 13.0,
                'kilometraje_actual' => 32000,
                'estado' => 'activo',
                'estado_operativo' => 'en_servicio',
                'fecha_adquisicion' => '2021-01-20',
                'valor_comercial' => 9200000.00,
                'soat_numero' => 'SOAT002',
                'soat_vencimiento' => '2025-01-20',
                'tecnomecanica_numero' => 'TM002',
                'tecnomecanica_vencimiento' => '2025-01-20',
                'propietario_nombre' => 'Empresa Primero de Junio',
                'propietario_cedula' => '900123456',
                'observaciones' => 'Motocicleta ideal para rutas urbanas',
            ],
            [
                'placa' => 'GHI789',
                'marca' => 'Suzuki',
                'modelo' => 'AX 100',
                'ano' => 2019,
                'color' => 'Negro',
                'numero_motor' => 'AX100-003',
                'numero_chasis' => 'SAX100003',
                'cilindraje' => 100,
                'tipo_combustible' => 'Gasolina',
                'capacidad_tanque_litros' => 10.5,
                'kilometraje_actual' => 58000,
                'estado' => 'activo',
                'estado_operativo' => 'disponible',
                'fecha_adquisicion' => '2019-08-10',
                'valor_comercial' => 6800000.00,
                'soat_numero' => 'SOAT003',
                'soat_vencimiento' => '2025-08-10',
                'tecnomecanica_numero' => 'TM003',
                'tecnomecanica_vencimiento' => '2025-08-10',
                'propietario_nombre' => 'Empresa Primero de Junio',
                'propietario_cedula' => '900123456',
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
