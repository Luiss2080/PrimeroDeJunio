<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Creating dependencies...\n";
    $conductor = \App\Models\Conductor::factory()->create();
    $vehiculo = \App\Models\Vehiculo::factory()->create();

    echo "Attempting AsignacionVehiculo Factory create...\n";
    $asignacion = \App\Models\AsignacionVehiculo::factory()
        ->recycle($conductor)
        ->recycle($vehiculo)
        ->create();
    echo "Asignacion created: " . $asignacion->id . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
