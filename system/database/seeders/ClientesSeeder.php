<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clientes')->insert([
            [
                'nombre' => 'Andrea',
                'apellido' => 'Gomez',
                'telefono' => '3201234567',
                'email' => 'andrea.gomez@email.com',
                'direccion_habitual' => 'Centro Comercial Plaza Mayor - Local 105',
                'tipo_cliente' => 'frecuente',
                'estado' => 'activo',
                'descuento_porcentaje' => 5.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Carlos Andres',
                'apellido' => 'Ruiz',
                'telefono' => '3189876543',
                'email' => 'carlos.ruiz@email.com',
                'direccion_habitual' => 'Universidad Nacional - Edificio de Ingenierías',
                'tipo_cliente' => 'particular',
                'estado' => 'activo',
                'descuento_porcentaje' => 0.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Empresa Logística',
                'apellido' => 'Total S.A.S',
                'telefono' => '3156789012',
                'email' => 'contacto@logisticatotal.com',
                'direccion_habitual' => 'Zona Industrial - Bodega 15',
                'tipo_cliente' => 'corporativo',
                'estado' => 'activo',
                'descuento_porcentaje' => 10.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Maria Jose',
                'apellido' => 'Hernandez',
                'telefono' => '3143218765',
                'email' => 'majo.hernandez@email.com',
                'direccion_habitual' => 'Hospital San Rafael - Torre A',
                'tipo_cliente' => 'frecuente',
                'estado' => 'activo',
                'descuento_porcentaje' => 3.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Pedro',
                'apellido' => 'Sanchez',
                'telefono' => '3165432109',
                'email' => null,
                'direccion_habitual' => 'Aeropuerto Internacional - Terminal 1',
                'tipo_cliente' => 'particular',
                'estado' => 'activo',
                'descuento_porcentaje' => 0.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Gloria',
                'apellido' => 'Mendez',
                'telefono' => '3178901234',
                'email' => 'gloria.mendez@email.com',
                'direccion_habitual' => 'Centro Histórico - Calle de la Catedral #8-25',
                'tipo_cliente' => 'frecuente',
                'estado' => 'activo',
                'descuento_porcentaje' => 5.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Consultoría',
                'apellido' => 'Empresarial LTDA',
                'telefono' => '3192345678',
                'email' => 'info@consultoria.com',
                'direccion_habitual' => 'Zona Rosa - Edificio Torre del Parque Piso 12',
                'tipo_cliente' => 'corporativo',
                'estado' => 'activo',
                'descuento_porcentaje' => 15.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Isabella',
                'apellido' => 'Rodriguez',
                'telefono' => '3112233445',
                'email' => 'isabella.rodriguez@email.com',
                'direccion_habitual' => 'Barrio El Poblado - Avenida Las Palmas #45-23',
                'tipo_cliente' => 'frecuente',
                'estado' => 'activo',
                'descuento_porcentaje' => 8.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Miguel Angel',
                'apellido' => 'Torres',
                'telefono' => '3123344556',
                'email' => 'miguel.torres@email.com',
                'direccion_habitual' => 'Centro Médico La Sabana - Consultorio 302',
                'tipo_cliente' => 'particular',
                'estado' => 'activo',
                'descuento_porcentaje' => 0.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Distribuidora',
                'apellido' => 'El Éxito S.A',
                'telefono' => '3134455667',
                'email' => 'ventas@elexito.com',
                'direccion_habitual' => 'Gran Estación - Nivel 2',
                'tipo_cliente' => 'corporativo',
                'estado' => 'activo',
                'descuento_porcentaje' => 12.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Alejandro',
                'apellido' => 'Castro',
                'telefono' => '3145566778',
                'email' => 'alejandro.castro@email.com',
                'direccion_habitual' => 'Conjunto Residencial Los Cedros - Torre 3 Apt 504',
                'tipo_cliente' => 'particular',
                'estado' => 'activo',
                'descuento_porcentaje' => 0.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Sofia',
                'apellido' => 'Vargas',
                'telefono' => '3156677889',
                'email' => 'sofia.vargas@email.com',
                'direccion_habitual' => 'Clínica del Country - Ala Sur',
                'tipo_cliente' => 'frecuente',
                'estado' => 'activo',
                'descuento_porcentaje' => 6.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Tecnológica',
                'apellido' => 'Innovar LTDA',
                'telefono' => '3167788990',
                'email' => 'contacto@innovar.com',
                'direccion_habitual' => 'Parque Tecnológico - Edificio Smart Office',
                'tipo_cliente' => 'corporativo',
                'estado' => 'activo',
                'descuento_porcentaje' => 18.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Fernando',
                'apellido' => 'Morales',
                'telefono' => '3178899001',
                'email' => 'fernando.morales@email.com',
                'direccion_habitual' => 'Estadio El Campín - Puerta 7',
                'tipo_cliente' => 'particular',
                'estado' => 'activo',
                'descuento_porcentaje' => 0.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Camila',
                'apellido' => 'Jimenez',
                'telefono' => '3189900112',
                'email' => 'camila.jimenez@email.com',
                'direccion_habitual' => 'Terminal de Transporte - Módulo 2',
                'tipo_cliente' => 'frecuente',
                'estado' => 'activo',
                'descuento_porcentaje' => 4.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Servicios',
                'apellido' => 'Integrales S.A.S',
                'telefono' => '3190011223',
                'email' => 'info@serviciosintegrales.com',
                'direccion_habitual' => 'Centro de Convenciones - Salón Principal',
                'tipo_cliente' => 'corporativo',
                'estado' => 'activo',
                'descuento_porcentaje' => 20.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Daniel',
                'apellido' => 'Perez',
                'telefono' => '3201122334',
                'email' => 'daniel.perez@email.com',
                'direccion_habitual' => 'Biblioteca Luis Ángel Arango - Entrada Principal',
                'tipo_cliente' => 'particular',
                'estado' => 'activo',
                'descuento_porcentaje' => 0.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Valentina',
                'apellido' => 'Lopez',
                'telefono' => '3212233445',
                'email' => 'valentina.lopez@email.com',
                'direccion_habitual' => 'Hotel Tequendama - Recepción',
                'tipo_cliente' => 'frecuente',
                'estado' => 'activo',
                'descuento_porcentaje' => 7.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Corporación',
                'apellido' => 'Financiera XYZ',
                'telefono' => '3223344556',
                'email' => 'atencion@financieraxyz.com',
                'direccion_habitual' => 'Centro Internacional - Torre B Piso 25',
                'tipo_cliente' => 'corporativo',
                'estado' => 'activo',
                'descuento_porcentaje' => 25.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Sebastian',
                'apellido' => 'Ramirez',
                'telefono' => '3234455667',
                'email' => 'sebastian.ramirez@email.com',
                'direccion_habitual' => 'Transmilenio Estación Portal Norte',
                'tipo_cliente' => 'particular',
                'estado' => 'activo',
                'descuento_porcentaje' => 0.00,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
