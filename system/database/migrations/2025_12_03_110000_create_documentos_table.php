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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->morphs('documentable'); // documentable_id, documentable_type
            $table->string('tipo_documento', 50); // Licencia, SOAT, Tecnomecanica, etc.
            $table->string('numero', 100)->nullable();
            $table->date('fecha_expedicion')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('archivo_ruta')->nullable();
            $table->enum('estado', ['vigente', 'vencido', 'por_vencer'])->default('vigente');
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->index(['documentable_type', 'documentable_id']);
            $table->index('tipo_documento');
            $table->index('fecha_vencimiento');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
