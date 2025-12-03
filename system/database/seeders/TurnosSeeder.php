<?php

namespace Database\Seeders;

use App\Models\Turno;
use App\Models\Conductor;
use App\Models\Vehiculo;
use Illuminate\Database\Seeder;

class TurnosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have conductors and vehicles
        if (Conductor::count() == 0 || Vehiculo::count() == 0) {
            return;
        }

        Turno::factory()
            ->count(20)
            ->recycle(Conductor::all())
            ->recycle(Vehiculo::all())
            ->create();
    }
}
