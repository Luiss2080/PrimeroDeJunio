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
        $roleConductor = Role::where('nombre', 'operador')->first();
        
        if (!$roleConductor) {
            return;
        }

        try {
            // Create users for conductors first
            $users = User::factory()->count(15)->create([
                'rol_id' => $roleConductor->id,
            ]);
        } catch (\Exception $e) {
            echo 'Error creating users: ' . $e->getMessage() . PHP_EOL;
            throw $e;
        }

        \Illuminate\Database\Eloquent\Model::unguard();
        foreach ($users as $user) {
            try {
                Conductor::factory()->create([
                    'usuario_id' => $user->id,
                    'nombre' => $user->nombre,
                    'apellido' => $user->apellido,
                    'cedula' => $user->cedula ?? fake()->numerify('##########'),
                    'telefono' => $user->telefono ?? '0000000000',
                    'direccion' => $user->direccion,
                    'fecha_nacimiento' => '1990-01-01',
                ]);
            } catch (\Exception $e) {
                echo 'Error creating conductor for user ' . $user->id . ': ' . $e->getMessage() . PHP_EOL;
                throw $e;
            }
        }
        \Illuminate\Database\Eloquent\Model::reguard();
    }
}
