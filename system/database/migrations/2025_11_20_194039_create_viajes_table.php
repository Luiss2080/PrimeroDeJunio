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
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conductor_id')->constrained('conductores')->restrictOnDelete();
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->restrictOnDelete();
            $table->foreignId('cliente_id')->nullable()->constrained('clientes')->nullOnDelete();
            $table->string('cliente_nombre', 100)->nullable();
            $table->string('cliente_telefono', 20)->nullable();
            $table->text('origen');
            $table->text('destino');
            $table->decimal('distancia_km', 8, 2)->nullable();
            $table->integer('duracion_minutos')->nullable();
            $table->integer('tiempo_espera_minutos')->default(0);
            $table->decimal('costo_tiempo_espera', 10, 2)->default(0.00);
            $table->foreignId('tarifa_aplicada_id')->nullable()->constrained('tarifas')->nullOnDelete();
            $table->decimal('valor_base', 10, 2);
            $table->decimal('recargos', 10, 2)->default(0.00);
            $table->decimal('descuentos', 10, 2)->default(0.00);
            $table->decimal('valor_total', 10, 2);
            $table->enum('metodo_pago', ['efectivo', 'tarjeta', 'transferencia', 'credito'])->default('efectivo');
            $table->enum('estado', ['pendiente', 'en_curso', 'completado', 'cancelado'])->default('pendiente');
            $table->timestamp('fecha_hora_inicio');
            $table->timestamp('fecha_hora_fin')->nullable();
            $table->text('observaciones')->nullable();
            $table->tinyInteger('calificacion')->nullable()->check('calificacion >= 1 AND calificacion <= 5');
            $table->text('comentario_cliente')->nullable();
            $table->timestamps();

            $table->index('conductor_id');
            $table->index('vehiculo_id');
            $table->index('cliente_id');
            $table->index('fecha_hora_inicio');
            $table->index('estado');
            $table->index(['fecha_hora_inicio', 'valor_total']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viajes');
    }
};
