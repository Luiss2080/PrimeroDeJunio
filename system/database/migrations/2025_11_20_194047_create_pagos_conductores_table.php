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
            $table->enum('tipo', [
                'tarifa_diaria', 'comision_viajes', 'bono_productividad', 
                'multa', 'descuento', 'abono_deuda', 'liquidacion'
            ])->default('tarifa_diaria');
            $table->enum('metodo_pago', [
                'efectivo', 'transferencia', 'consignacion', 
                'descuento_viajes', 'cheque'
            ])->default('efectivo');
            $table->foreignId('registrado_por')->constrained('users')->restrictOnDelete();
            $table->text('observaciones')->nullable();
            $table->enum('estado', ['pendiente', 'pagado', 'exonerado', 'rechazado'])->default('pendiente');
            $table->string('comprobante_ruta', 500)->nullable();
            $table->string('referencia_externa', 100)->nullable();
            $table->date('periodo_inicio')->nullable();
            $table->date('periodo_fin')->nullable();
            $table->integer('total_viajes_periodo')->nullable();
            $table->decimal('comision_total_periodo', 10, 2)->nullable();
            $table->unsignedBigInteger('actualizado_por')->nullable();
            $table->timestamps();

            $table->index(['conductor_id', 'fecha_pago']);
            $table->index(['fecha_pago', 'estado']);
            $table->index('tipo');
            $table->index('registrado_por');
            $table->index(['periodo_inicio', 'periodo_fin']);
            $table->index(['conductor_id', 'estado']);
            
            $table->foreign('actualizado_por')->references('id')->on('users')->nullOnDelete();
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
