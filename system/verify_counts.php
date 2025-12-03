<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tables = [
    'users' => \App\Models\User::class,
    'conductores' => \App\Models\Conductor::class,
    'vehiculos' => \App\Models\Vehiculo::class,
    'clientes' => \App\Models\Cliente::class,
    'tarifas' => \App\Models\Tarifa::class,
    'viajes' => \App\Models\Viaje::class,
    'asignaciones_vehiculo' => \App\Models\AsignacionVehiculo::class,
    'mantenimientos' => \App\Models\Mantenimiento::class,
    'pagos_conductores' => \App\Models\PagoConductor::class,
    'turnos' => \App\Models\Turno::class,
    'reportes_incidentes' => \App\Models\ReporteIncidente::class,
    'documentos' => \App\Models\Documento::class,
    'gastos_operativos' => \App\Models\GastoOperativo::class,
];

foreach ($tables as $table => $model) {
    try {
        $count = $model::count();
        echo "Table '$table': $count records\n";
    } catch (\Exception $e) {
        echo "Table '$table': Error - " . $e->getMessage() . "\n";
    }
}
