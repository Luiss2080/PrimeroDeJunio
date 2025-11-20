<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pagos_tarifa_diaria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conductor_id')->constrained('conductores')->cascadeOnDelete();
            $table->date('fecha_pago');
            $table->decimal('monto_tarifa', 10, 2);
            $table->enum('metodo_pago', ['efectivo', 'transferencia', 'descuento_viajes'])->default('efectivo');
            $table->foreignId('registrado_por')->constrained('users')->restrictOnDelete();
            $table->text('observaciones')->nullable();
            $table->enum('estado', ['pendiente', 'pagado', 'exonerado'])->default('pendiente');
            $table->datetime('fecha_registro')->default(now());
            $table->datetime('fecha_actualizacion')->default(now());
            $table->timestamps();

            $table->unique(['conductor_id', 'fecha_pago'], 'unique_conductor_fecha');
            $table->index(['conductor_id', 'fecha_pago']);
            $table->index(['fecha_pago', 'estado']);
            $table->index('registrado_por');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos_tarifa_diaria');
    }
};
