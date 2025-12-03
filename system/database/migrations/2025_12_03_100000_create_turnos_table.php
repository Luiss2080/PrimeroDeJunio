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
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conductor_id')->constrained('conductores')->restrictOnDelete();
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->restrictOnDelete();
            $table->timestamp('fecha_hora_inicio');
            $table->timestamp('fecha_hora_fin')->nullable();
            $table->integer('km_inicial');
            $table->integer('km_final')->nullable();
            $table->decimal('total_recaudado', 10, 2)->default(0.00);
            $table->text('observaciones_inicio')->nullable();
            $table->text('observaciones_fin')->nullable();
            $table->enum('estado', ['abierto', 'cerrado'])->default('abierto');
            $table->timestamps();

            $table->index('conductor_id');
            $table->index('vehiculo_id');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turnos');
    }
};
