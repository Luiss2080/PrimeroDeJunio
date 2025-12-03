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
        Schema::create('reportes_incidentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_reporta_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('viaje_id')->nullable()->constrained('viajes')->nullOnDelete();
            $table->foreignId('vehiculo_id')->nullable()->constrained('vehiculos')->nullOnDelete();
            $table->enum('tipo', ['accidente', 'falla_mecanica', 'queja_cliente', 'objeto_olvidado', 'otro']);
            $table->text('descripcion');
            $table->enum('nivel_gravedad', ['bajo', 'medio', 'alto', 'critico'])->default('bajo');
            $table->enum('estado', ['reportado', 'en_revision', 'resuelto', 'cerrado'])->default('reportado');
            $table->text('resolucion')->nullable();
            $table->timestamp('fecha_resolucion')->nullable();
            $table->timestamps();

            $table->index('usuario_reporta_id');
            $table->index('tipo');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes_incidentes');
    }
};
