<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Seeders base - deben ejecutarse primero
            RolesSeeder::class,
            UsuariosSeeder::class,
            ConfiguracionesSeeder::class, // Configuraciones del sistema
            
            // Seeders de entidades principales
            ConductoresSeeder::class,
            VehiculosSeeder::class,
            ClientesSeeder::class,
            TarifasSeeder::class,
            
            // Seeders que dependen de las entidades principales
            AsignacionesVehiculoSeeder::class,
            ViajesSeeder::class,
            MantenimientosSeeder::class,
            PagosConductoresSeeder::class,
            
            // Seeders complementarios (si existen)
            // DocumentosSeeder::class,
            // GastosOperativosSeeder::class,
            // TurnosSeeder::class,
            // ReportesIncidentesSeeder::class,
        ]);
    }
}
