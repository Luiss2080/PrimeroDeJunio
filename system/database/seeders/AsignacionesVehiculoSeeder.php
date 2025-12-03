<?php

namespace Database\Seeders;

use App\Models\AsignacionVehiculo;
use App\Models\Conductor;
use App\Models\Vehiculo;
use Illuminate\Database\Seeder;

class AsignacionesVehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Conductor::count() == 0 || Vehiculo::count() == 0) {
            return;
        }

        AsignacionVehiculo::factory()
            ->count(15)
            ->recycle(Conductor::all())
            ->recycle(Vehiculo::all())
            ->create();
    }
}