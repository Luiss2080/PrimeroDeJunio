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

        try {
            // Create users for conductors first
            $users = User::factory()->count(15)->create([
                'rol_id' => $roleConductor->id,
            ]);
        } catch (\Exception $e) {
            dump('Error creating users: ' . $e->getMessage());
            throw $e;
        }

        foreach ($users as $user) {
            \Illuminate\Support\Facades\DB::table('conductores')->insert([
                'usuario_id' => $user->id,
                'nombre' => $user->nombre,
                'apellido' => $user->apellido,
                'cedula' => $user->cedula ?? \Illuminate\Support\Str::numerify('##########'),
                'telefono' => $user->telefono ?? '0000000000',
                'direccion' => $user->direccion,
                'fecha_nacimiento' => '1990-01-01',
                'email' => $user->email,
                'estado' => 'activo',
                'estado_pago' => 'al_dia',
                'fecha_ingreso' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
