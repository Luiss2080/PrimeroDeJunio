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
        Schema::create('tarifas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->decimal('tarifa_base', 10, 2);
            $table->decimal('tarifa_por_km', 10, 2);
            $table->decimal('tarifa_por_minuto', 10, 2)->default(0.00);
            $table->decimal('tarifa_minima', 10, 2);
            $table->decimal('tarifa_maxima', 10, 2)->nullable();
            $table->decimal('recargo_nocturno', 5, 2)->default(0.00);
            $table->decimal('recargo_festivo', 5, 2)->default(0.00);
            $table->decimal('recargo_lluvia', 5, 2)->default(0.00);
            $table->time('hora_inicio_nocturno')->default('18:00:00');
            $table->time('hora_fin_nocturno')->default('06:00:00');
            $table->enum('estado', ['activa', 'inactiva'])->default('activa');
            $table->date('fecha_vigencia_inicio')->default(now()->toDateString());
            $table->date('fecha_vigencia_fin')->nullable();
            $table->timestamps();
            
            $table->index('estado');
            $table->index(['fecha_vigencia_inicio', 'fecha_vigencia_fin']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifas');
    }
};
