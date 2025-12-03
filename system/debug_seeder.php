<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$seeders = [
    Database\Seeders\RolesSeeder::class,
    Database\Seeders\UsuariosSeeder::class,
    Database\Seeders\ConductoresSeeder::class,
    Database\Seeders\VehiculosSeeder::class,
    Database\Seeders\ClientesSeeder::class,
    Database\Seeders\TarifasSeeder::class,
    Database\Seeders\AsignacionesVehiculoSeeder::class,
    Database\Seeders\ViajesSeeder::class,
    Database\Seeders\MantenimientosSeeder::class,
    Database\Seeders\DocumentosSeeder::class,
    Database\Seeders\GastosOperativosSeeder::class,
    Database\Seeders\PagosConductoresSeeder::class,
    Database\Seeders\TurnosSeeder::class,
    Database\Seeders\ReportesIncidentesSeeder::class,
];

foreach ($seeders as $seeder) {
    try {
        echo "Running $seeder...\n";
        (new $seeder)->run();
        echo "Success!\n";
    } catch (\Exception $e) {
        echo "Error in $seeder: " . $e->getMessage() . "\n";
        exit(1);
    }
}
