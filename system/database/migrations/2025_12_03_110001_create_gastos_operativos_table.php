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
        Schema::create('gastos_operativos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->cascadeOnDelete();
            $table->enum('tipo_gasto', ['combustible', 'mantenimiento', 'lavado', 'peaje', 'impuesto', 'seguro', 'otro']);
            $table->decimal('monto', 10, 2);
            $table->date('fecha');
            $table->text('descripcion')->nullable();
            $table->foreignId('registrado_por')->constrained('users')->restrictOnDelete();
            $table->string('comprobante_ruta')->nullable();
            $table->timestamps();

            $table->index('vehiculo_id');
            $table->index('tipo_gasto');
            $table->index('fecha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gastos_operativos');
    }
};
