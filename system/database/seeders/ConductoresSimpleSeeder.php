<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConductoresSimpleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 25; $i++) {
            $user = \App\Models\User::factory()->create();
            \App\Models\Conductor::create([
                'usuario_id' => $user->id,
                'nombre' => $user->nombre,
                'apellido' => $user->apellido,
                'cedula' => $user->cedula ?? '10000' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'telefono' => $user->telefono,
                'email' => $user->email,
                'direccion' => $user->direccion,
                'fecha_nacimiento' => $user->fecha_nacimiento ?? now()->subYears(30)->format('Y-m-d'),
                'numero_licencia' => 'LIC' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'fecha_vencimiento_licencia' => now()->addYears(2)->format('Y-m-d'),
                'tipo_licencia' => 'C1',
                'estado' => 'activo'
            ]);
        }
    }
}
