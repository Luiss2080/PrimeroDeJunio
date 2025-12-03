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
        Schema::create('historial_reproducciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audio_id')->constrained('audios')->restrictOnDelete();
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->restrictOnDelete();
            $table->foreignId('viaje_id')->nullable()->constrained('viajes')->nullOnDelete();
            $table->timestamp('fecha_hora');
            $table->decimal('latitud', 10, 8)->nullable();
            $table->decimal('longitud', 11, 8)->nullable();
            $table->timestamps();

            $table->index('audio_id');
            $table->index('vehiculo_id');
            $table->index('fecha_hora');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_reproducciones');
    }
};
