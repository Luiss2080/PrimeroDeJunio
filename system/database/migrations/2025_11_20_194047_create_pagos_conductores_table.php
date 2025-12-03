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
        Schema::create('pagos_conductores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conductor_id')->constrained('conductores')->cascadeOnDelete();
            $table->date('fecha_pago');
            $table->decimal('monto', 10, 2);
            $table->enum('tipo', ['tarifa_diaria', 'multa', 'abono_deuda', 'otro'])->default('tarifa_diaria');
            $table->enum('metodo_pago', ['efectivo', 'transferencia', 'descuento_viajes', 'saldo_favor'])->default('efectivo');
            $table->foreignId('registrado_por')->constrained('users')->restrictOnDelete();
            $table->text('observaciones')->nullable();
            $table->enum('estado', ['pendiente', 'pagado', 'exonerado', 'rechazado'])->default('pendiente');
            $table->string('comprobante_ruta')->nullable();
            $table->timestamps();

            $table->index(['conductor_id', 'fecha_pago']);
            $table->index(['fecha_pago', 'estado']);
            $table->index('tipo');
            $table->index('registrado_por');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos_conductores');
    }
};
