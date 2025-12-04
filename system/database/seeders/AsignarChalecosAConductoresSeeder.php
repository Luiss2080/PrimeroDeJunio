<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AsignarChalecosAConductoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los conductores activos
        $conductores = \App\Models\Conductor::where('estado', 'activo')->get();
        
        // Obtener chalecos disponibles
        $chalecos = \App\Models\Chaleco::where('estado', 'disponible')->get();
        
        $asignados = 0;
        
        foreach ($conductores as $index => $conductor) {
            // Verificar que hay chalecos disponibles
            if (isset($chalecos[$index])) {
                $chaleco = $chalecos[$index];
                
                // Asignar chaleco al conductor usando el método del modelo
                if ($chaleco->asignarAConductor($conductor)) {
                    $asignados++;
                }
            } else {
                // No hay más chalecos disponibles
                break;
            }
        }
        
        $this->command->info("Se asignaron {$asignados} chalecos a conductores activos");
        
        if ($conductores->count() > $chalecos->count()) {
            $faltantes = $conductores->count() - $chalecos->count();
            $this->command->warn("Faltan {$faltantes} chalecos para asignar a todos los conductores");
        }
    }
}
