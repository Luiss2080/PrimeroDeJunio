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
    Database\Seeders\PagosTarifaDiariaSeeder::class,
    Database\Seeders\TurnosSeeder::class,
    Database\Seeders\ReportesIncidentesSeeder::class,
    Database\Seeders\CampanasSeeder::class,
    Database\Seeders\AudiosSeeder::class,
    Database\Seeders\HistorialReproduccionesSeeder::class,
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
