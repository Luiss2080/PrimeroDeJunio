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
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->cascadeOnDelete();
            $table->enum('tipo_mantenimiento', ['preventivo', 'correctivo', 'revision', 'emergencia']);
            $table->text('descripcion');
            $table->integer('kilometraje_actual')->nullable();
            $table->decimal('costo', 10, 2)->default(0.00);
            $table->string('taller_nombre', 100)->nullable();
            $table->string('taller_telefono', 20)->nullable();
            $table->date('fecha_programada')->nullable();
            $table->date('fecha_realizada')->nullable();
            $table->enum('estado', ['programado', 'en_proceso', 'completado', 'cancelado'])->default('programado');
            $table->text('observaciones')->nullable();
            $table->integer('proximo_mantenimiento_km')->nullable();
            $table->date('proximo_mantenimiento_fecha')->nullable();
            $table->timestamps();

            $table->index('vehiculo_id');
            $table->index('fecha_programada');
            $table->index('estado');
            $table->index('tipo_mantenimiento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};
