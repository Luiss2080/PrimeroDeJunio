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
        Schema::create('asignaciones_vehiculo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conductor_id')->constrained('conductores')->cascadeOnDelete();
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->cascadeOnDelete();
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->enum('turno', ['manana', 'tarde', 'noche', 'completo'])->default('completo');
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fin')->nullable();
            $table->string('dias_semana', 20)->default('L,M,X,J,V,S,D');
            $table->enum('estado', ['activa', 'terminada', 'suspendida'])->default('activa');
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->index('conductor_id');
            $table->index('vehiculo_id');
            $table->index('fecha_inicio');
            $table->index('estado');
            $table->unique(['conductor_id', 'vehiculo_id', 'estado'], 'uk_conductor_vehiculo_activa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaciones_vehiculo');
    }
};
