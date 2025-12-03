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
            PagosTarifaDiariaSeeder::class,
            TurnosSeeder::class,
            ReportesIncidentesSeeder::class,
            CampanasSeeder::class,
            AudiosSeeder::class,
            HistorialReproduccionesSeeder::class,
        ]);
    }
}
