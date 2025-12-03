<?php

namespace Database\Seeders;

use App\Models\Audio;
use App\Models\Campana;
use Illuminate\Database\Seeder;

class AudiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Campana::count() == 0) {
            return;
        }

        Audio::factory()
            ->count(30)
            ->recycle(Campana::all())
            ->create();
    }
}
