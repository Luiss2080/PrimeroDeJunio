<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Creating dependencies...\n";
    $conductor = \App\Models\Conductor::factory()->create();

    echo "Attempting Documento Factory create...\n";
    $documento = \App\Models\Documento::factory()->create([
        'documentable_id' => $conductor->id,
        'documentable_type' => \App\Models\Conductor::class,
    ]);
    echo "Documento created: " . $documento->id . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
