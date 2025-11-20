<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConductoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('conductores')->insert([
            [
                'usuario_id' => 4, // Juan Manuel Perez Garcia (conductor1)
                'nombre' => 'Juan Manuel',
                'apellido' => 'Perez Garcia',
                'cedula' => '12345678',
                'telefono' => '3012345678',
                'direccion' => 'Barrio La Esperanza - Calle 8 #12-34',
                'fecha_nacimiento' => '1985-03-15',
                'licencia_numero' => 'LIC123456789',
                'licencia_categoria' => 'A2',
                'licencia_vigencia' => '2026-06-30',
                'experiencia_anos' => 8,
                'estado' => 'activo',
                'fecha_ingreso' => '2020-01-15',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'usuario_id' => 5, // Maria Elena Gonzalez Lopez (conductor2)
                'nombre' => 'Maria Elena',
                'apellido' => 'Gonzalez Lopez',
                'cedula' => '87654321',
                'telefono' => '3154567890',
                'direccion' => 'Sector El Progreso - Carrera 20 #15-40',
                'fecha_nacimiento' => '1990-08-22',
                'licencia_numero' => 'LIC987654321',
                'licencia_categoria' => 'A2',
                'licencia_vigencia' => '2025-12-15',
                'experiencia_anos' => 5,
                'estado' => 'activo',
                'fecha_ingreso' => '2021-03-10',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'usuario_id' => null,
                'nombre' => 'Roberto Carlos',
                'apellido' => 'Martinez Silva',
                'cedula' => '11223344',
                'telefono' => '3187654321',
                'direccion' => 'Barrio San Jose - Calle 25 #8-15',
                'fecha_nacimiento' => '1988-11-10',
                'licencia_numero' => 'LIC456789123',
                'licencia_categoria' => 'A2',
                'licencia_vigencia' => '2026-02-28',
                'experiencia_anos' => 6,
                'estado' => 'activo',
                'fecha_ingreso' => '2020-06-20',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'usuario_id' => null,
                'nombre' => 'Ana Patricia',
                'apellido' => 'Ramirez Torres',
                'cedula' => '55667788',
                'telefono' => '3176543210',
                'direccion' => 'Urbanización Los Pinos - Carrera 30 #18-45',
                'fecha_nacimiento' => '1992-05-18',
                'licencia_numero' => 'LIC789123456',
                'licencia_categoria' => 'A2',
                'licencia_vigencia' => '2025-09-10',
                'experiencia_anos' => 4,
                'estado' => 'activo',
                'fecha_ingreso' => '2022-01-08',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'usuario_id' => null,
                'nombre' => 'Luis Fernando',
                'apellido' => 'Vargas Moreno',
                'cedula' => '99887766',
                'telefono' => '3198765432',
                'direccion' => 'Sector La Victoria - Calle 12 #22-30',
                'fecha_nacimiento' => '1987-12-03',
                'licencia_numero' => 'LIC321654987',
                'licencia_categoria' => 'A2',
                'licencia_vigencia' => '2026-04-20',
                'experiencia_anos' => 7,
                'estado' => 'activo',
                'fecha_ingreso' => '2019-11-12',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'usuario_id' => null,
                'nombre' => 'Carlos Eduardo',
                'apellido' => 'Hernandez Lopez',
                'cedula' => '22334455',
                'telefono' => '3145678901',
                'direccion' => 'Barrio El Carmen - Calle 18 #10-25',
                'fecha_nacimiento' => '1984-07-14',
                'licencia_numero' => 'LIC654987321',
                'licencia_categoria' => 'A2',
                'licencia_vigencia' => '2026-08-15',
                'experiencia_anos' => 9,
                'estado' => 'activo',
                'fecha_ingreso' => '2018-09-05',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'usuario_id' => null,
                'nombre' => 'Diego Alejandro',
                'apellido' => 'Morales Castro',
                'cedula' => '33445566',
                'telefono' => '3156789012',
                'direccion' => 'Sector Bella Vista - Carrera 25 #35-18',
                'fecha_nacimiento' => '1991-02-28',
                'licencia_numero' => 'LIC147258369',
                'licencia_categoria' => 'A2',
                'licencia_vigencia' => '2025-11-30',
                'experiencia_anos' => 6,
                'estado' => 'activo',
                'fecha_ingreso' => '2021-07-22',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'usuario_id' => null,
                'nombre' => 'Sandra Milena',
                'apellido' => 'Jimenez Ruiz',
                'cedula' => '44556677',
                'telefono' => '3167890123',
                'direccion' => 'Barrio Los Rosales - Calle 5 #14-32',
                'fecha_nacimiento' => '1989-09-12',
                'licencia_numero' => 'LIC369258147',
                'licencia_categoria' => 'A2',
                'licencia_vigencia' => '2026-01-10',
                'experiencia_anos' => 5,
                'estado' => 'activo',
                'fecha_ingreso' => '2022-03-18',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'usuario_id' => null,
                'nombre' => 'Andres Felipe',
                'apellido' => 'Gomez Pena',
                'cedula' => '55667799',
                'telefono' => '3178901234',
                'direccion' => 'Urbanización El Dorado - Carrera 40 #28-16',
                'fecha_nacimiento' => '1986-06-25',
                'licencia_numero' => 'LIC258147369',
                'licencia_categoria' => 'A2',
                'licencia_vigencia' => '2025-10-20',
                'experiencia_anos' => 8,
                'estado' => 'activo',
                'fecha_ingreso' => '2019-12-08',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'usuario_id' => null,
                'nombre' => 'Claudia Patricia',
                'apellido' => 'Rojas Vega',
                'cedula' => '66778899',
                'telefono' => '3189012345',
                'direccion' => 'Sector La Paz - Calle 30 #22-14',
                'fecha_nacimiento' => '1993-04-03',
                'licencia_numero' => 'LIC741852963',
                'licencia_categoria' => 'A2',
                'licencia_vigencia' => '2026-05-05',
                'experiencia_anos' => 3,
                'estado' => 'activo',
                'fecha_ingreso' => '2023-01-15',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
