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
            RolesSeeder::class,
            UsuariosSeeder::class,
            ConductoresSeeder::class,
            VehiculosSeeder::class,
            ClientesSeeder::class,
            TarifasSeeder::class,
            AsignacionesVehiculoSeeder::class,
            ViajesSeeder::class,
            MantenimientosSeeder::class,
            DocumentosSeeder::class, // New
            GastosOperativosSeeder::class, // New
            PagosConductoresSeeder::class, // Renamed
            TurnosSeeder::class,
            ReportesIncidentesSeeder::class,
        ]);
    }
}
