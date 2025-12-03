<?php

namespace Database\Seeders;

use App\Models\Conductor;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class ConductoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleConductor = Role::where('nombre', 'conductor')->first();
        
        if (!$roleConductor) {
            return;
        }

        // Create users for conductors first
        $users = User::factory()->count(15)->create([
            'rol_id' => $roleConductor->id,
        ]);

        \Illuminate\Database\Eloquent\Model::unguard();
        foreach ($users as $user) {
            Conductor::factory()->create([
                'usuario_id' => $user->id,
                'nombre' => $user->nombre,
                'apellido' => $user->apellido,
                'cedula' => $user->cedula ?? \Illuminate\Support\Str::numerify('##########'),
                'telefono' => $user->telefono ?? '0000000000',
                'direccion' => $user->direccion,
                'fecha_nacimiento' => '1990-01-01',
            ]);
        }
        \Illuminate\Database\Eloquent\Model::reguard();
    }
}
