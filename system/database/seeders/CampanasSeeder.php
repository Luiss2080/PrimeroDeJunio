<?php

namespace Database\Seeders;

use App\Models\Campana;
use App\Models\Cliente;
use Illuminate\Database\Seeder;

class CampanasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Cliente::count() == 0) {
            return;
        }

        Campana::factory()
            ->count(10)
            ->recycle(Cliente::all())
            ->create();
    }
}
