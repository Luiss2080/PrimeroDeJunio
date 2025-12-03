<?php

namespace Database\Seeders;

use App\Models\HistorialReproduccion;
use App\Models\Audio;
use App\Models\Vehiculo;
use App\Models\Viaje;
use Illuminate\Database\Seeder;

class HistorialReproduccionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Audio::count() == 0 || Vehiculo::count() == 0) {
            return;
        }

        HistorialReproduccion::factory()
            ->count(100)
            ->recycle(Audio::all())
            ->recycle(Vehiculo::all())
            ->create([
                'viaje_id' => Viaje::inRandomOrder()->first()?->id,
            ]);
    }
}
