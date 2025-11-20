<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeders en orden correcto respetando las dependencias
        $this->call([
            RolesSeeder::class,           // 1. Primero los roles
            UsuariosSeeder::class,        // 2. Usuarios (depende de roles)
            TarifasSeeder::class,         // 3. Tarifas (independiente)
            ConfiguracionesSeeder::class, // 4. Configuraciones (independiente)
            // ConductoresSeeder::class,     // 5. Conductores (depende de usuarios)
            // VehiculosSeeder::class,       // 6. Vehículos (independiente)
            // ClientesSeeder::class,        // 7. Clientes (independiente)
        ]);
    }
}
