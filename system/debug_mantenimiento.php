<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Creating dependencies...\n";
    $vehiculo = \App\Models\Vehiculo::factory()->create();

    echo "Attempting Mantenimiento Factory create...\n";
    $mantenimiento = \App\Models\Mantenimiento::factory()
        ->recycle($vehiculo)
        ->create();
    echo "Mantenimiento created: " . $mantenimiento->id . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
