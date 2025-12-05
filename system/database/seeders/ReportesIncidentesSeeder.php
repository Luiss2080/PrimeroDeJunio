<?php

namespace Database\Seeders;

use App\Models\ReporteIncidente;
use App\Models\User;
use App\Models\Viaje;
use App\Models\Vehiculo;
use Illuminate\Database\Seeder;

class ReportesIncidentesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() == 0) {
            return;
        }

        ReporteIncidente::factory()
            ->count(20)
            ->recycle(User::all())
            ->create([
                'viaje_id' => Viaje::inRandomOrder()->first()?->id,
                'vehiculo_id' => Vehiculo::inRandomOrder()->first()?->id,
            ]);
            
        $this->command->info('Se crearon 20 reportes de incidentes');
    }
}
