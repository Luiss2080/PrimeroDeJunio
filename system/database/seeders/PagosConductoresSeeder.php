<?php

namespace Database\Seeders;

use App\Models\PagoConductor;
use App\Models\Conductor;
use Illuminate\Database\Seeder;

class PagosConductoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Conductor::count() == 0) {
            return;
        }

        PagoConductor::factory()
            ->count(40)
            ->recycle(Conductor::all())
            ->create();
    }
}
