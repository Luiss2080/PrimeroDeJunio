<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Contraseña por defecto: mototaxi123 (cambiar inmediatamente en producción)
        $password = Hash::make('mototaxi123');

        DB::table('users')->insert([
            [
                'nombre' => 'Administrador',
                'apellido' => 'Sistema',
                'email' => 'admin@primero1dejunio.com',
                'password' => $password,
                'telefono' => '3001234567',
                'direccion' => 'Oficina Principal - Calle 123 #45-67',
                'rol_id' => 1, // administrador
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Carlos Alberto',
                'apellido' => 'Rodriguez',
                'email' => 'operador@primero1dejunio.com',
                'password' => $password,
                'telefono' => '3009876543',
                'direccion' => 'Carrera 15 #30-25',
                'rol_id' => 2, // operador
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Ana Lucia',
                'apellido' => 'Martinez Silva',
                'email' => 'supervisor@primero1dejunio.com',
                'password' => $password,
                'telefono' => '3018765432',
                'direccion' => 'Avenida Principal #88-42',
                'rol_id' => 1, // administrador (era supervisor)
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Juan Manuel',
                'apellido' => 'Perez Garcia',
                'email' => 'conductor1@primero1dejunio.com',
                'password' => $password,
                'telefono' => '3012345678',
                'direccion' => 'Barrio La Esperanza - Calle 8 #12-34',
                'rol_id' => 2, // operador (era conductor)
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Maria Elena',
                'apellido' => 'Gonzalez Lopez',
                'email' => 'conductor2@primero1dejunio.com',
                'password' => $password,
                'telefono' => '3154567890',
                'direccion' => 'Sector El Progreso - Carrera 20 #15-40',
                'rol_id' => 2, // operador (era conductor)
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Roberto Carlos',
                'apellido' => 'Jimenez Torres',
                'email' => 'conductor3@primero1dejunio.com',
                'password' => $password,
                'telefono' => '3176543210',
                'direccion' => 'Barrio San Jose - Calle 25 #18-60',
                'rol_id' => 2, // operador (era conductor)
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Patricia Andrea',
                'apellido' => 'Hernandez Ruiz',
                'email' => 'conductor4@primero1dejunio.com',
                'password' => $password,
                'telefono' => '3198765432',
                'direccion' => 'Sector Villa Nueva - Carrera 8 #32-14',
                'rol_id' => 2, // operador (era conductor)
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Miguel Angel',
                'apellido' => 'Vargas Castro',
                'email' => 'operador2@primero1dejunio.com',
                'password' => $password,
                'telefono' => '3134567891',
                'direccion' => 'Centro - Avenida 19 #25-35',
                'rol_id' => 2, // operador
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
