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
            
            // Seeders de entidades independientes
            ChalecosSeeder::class, // Chalecos disponibles
            
            // Seeders de entidades principales
            ConductoresSeeder::class,
            VehiculosSeeder::class,
            ClientesSeeder::class,
            TarifasSeeder::class,
            
            // Seeders que dependen de las entidades principales
            AsignarChalecosAConductoresSeeder::class, // Asignar chalecos a conductores
            AsignacionesVehiculoSeeder::class,
            ViajesSeeder::class,
            MantenimientosSeeder::class,
            PagosConductoresSeeder::class,
            
            // Seeders complementarios que requieren datos base
            DocumentosSeeder::class,
            GastosOperativosSeeder::class,
            TurnosSeeder::class,
            ReportesIncidentesSeeder::class,
            
            // Seeders de logs (al final)
            LogsSeeder::class,
        ]);
    }
}
