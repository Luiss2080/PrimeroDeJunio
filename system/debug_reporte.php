<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Creating dependencies...\n";
    $user = \App\Models\User::factory()->create();
    $vehiculo = \App\Models\Vehiculo::factory()->create();
    // Viaje requires dependencies too, but factory handles it now
    $viaje = \App\Models\Viaje::factory()->create();

    echo "Attempting ReporteIncidente Factory create...\n";
    $reporte = \App\Models\ReporteIncidente::factory()
        ->recycle($user)
        ->recycle($vehiculo)
        ->recycle($viaje)
        ->create();
    echo "Reporte created: " . $reporte->id . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
