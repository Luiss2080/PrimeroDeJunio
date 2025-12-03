<?php

namespace Database\Seeders;

use App\Models\Mantenimiento;
use App\Models\Vehiculo;
use Illuminate\Database\Seeder;

class MantenimientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Vehiculo::count() == 0) {
            return;
        }

        Mantenimiento::factory()
            ->count(15)
            ->recycle(Vehiculo::all())
            ->create();
    }
}