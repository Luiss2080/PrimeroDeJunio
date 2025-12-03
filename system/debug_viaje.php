<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Creating dependencies...\n";
    $conductores = \App\Models\Conductor::factory()->count(5)->create();
    $vehiculos = \App\Models\Vehiculo::factory()->count(5)->create();
    $clientes = \App\Models\Cliente::factory()->count(5)->create();
    $tarifas = \App\Models\Tarifa::factory()->count(5)->create();

    echo "Attempting Viaje Factory create (50 times)...\n";
    \App\Models\Viaje::factory()
        ->count(50)
        ->recycle($conductores)
        ->recycle($vehiculos)
        ->recycle($clientes)
        ->recycle($tarifas)
        ->create();
    echo "Viajes created successfully.\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
