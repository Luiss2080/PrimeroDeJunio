<?php

namespace Database\Seeders;

use App\Models\GastoOperativo;
use App\Models\Vehiculo;
use Illuminate\Database\Seeder;

class GastosOperativosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Vehiculo::count() == 0) {
            return;
        }

        GastoOperativo::factory()
            ->count(30)
            ->recycle(Vehiculo::all())
            ->create();
            
        $this->command->info('Se crearon 30 gastos operativos');
    }
}
