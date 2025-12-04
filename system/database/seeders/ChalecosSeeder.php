<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChalecosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chalecos = [];
        
        // Crear 50 chalecos iniciales (0001 - 0050)
        for ($i = 1; $i <= 50; $i++) {
            $chalecos[] = [
                'cod_chaleco' => str_pad($i, 4, '0', STR_PAD_LEFT),
                'estado' => 'disponible',
                'descripcion' => "Chaleco mototaxi #{$i} - Color amarillo reflectivo",
                'fecha_adquisicion' => now()->subDays(rand(0, 365)),
                'costo' => rand(15000, 25000), // Entre $15,000 y $25,000
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        \App\Models\Chaleco::insert($chalecos);
        
        $this->command->info('Se crearon 50 chalecos (0001-0050)');
    }
}
