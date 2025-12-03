<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    echo "Attempting User Factory create...\n";
    $user = \App\Models\User::factory()->create();
    echo "User created: " . $user->id . "\n";

    echo "Attempting Factory create...\n";
    \App\Models\Conductor::factory()->create([
        'usuario_id' => $user->id,
        'cedula' => '1234567892', // Unique
        'fecha_nacimiento' => '1990-01-01',
    ]);
    echo "Success!\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
