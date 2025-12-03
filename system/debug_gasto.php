<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Creating dependencies...\n";
    $vehiculo = \App\Models\Vehiculo::factory()->create();

    echo "Attempting GastoOperativo Factory create...\n";
    $gasto = \App\Models\GastoOperativo::factory()
        ->recycle($vehiculo)
        ->create();
    echo "Gasto created: " . $gasto->id . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
