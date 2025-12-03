<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure roles exist
        if (Role::count() == 0) {
            $this->call(RolesSeeder::class);
        }

        // Create Admin User
        User::factory()->create([
            'nombre' => 'Admin',
            'apellido' => 'Sistema',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'rol_id' => Role::where('nombre', 'administrador')->first()->id,
        ]);

        // Create additional users
        User::factory()->count(10)->create([
            'rol_id' => Role::inRandomOrder()->first()->id,
        ]);
    }
}
