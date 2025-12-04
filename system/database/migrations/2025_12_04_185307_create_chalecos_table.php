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
        Schema::create('chalecos', function (Blueprint $table) {
            $table->id();
            $table->string('cod_chaleco', 10)->unique()->comment('Código del chaleco (ej: 0001, 0002)');
            $table->enum('estado', ['disponible', 'asignado', 'mantenimiento', 'perdido'])->default('disponible');
            $table->text('descripcion')->nullable()->comment('Descripción del chaleco, color, talla, etc.');
            $table->date('fecha_adquisicion')->nullable()->comment('Fecha de adquisición del chaleco');
            $table->decimal('costo', 10, 2)->nullable()->comment('Costo del chaleco');
            $table->timestamps();
            
            // Índices
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chalecos');
    }
};
