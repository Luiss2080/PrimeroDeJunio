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
        Schema::create('configuraciones', function (Blueprint $table) {
            $table->id();
            $table->string('clave', 100)->unique();
            $table->text('valor')->nullable();
            $table->text('valor_anterior')->nullable();
            $table->text('descripcion')->nullable();
            $table->enum('tipo', ['string', 'number', 'boolean', 'json', 'file'])->default('string');
            $table->enum('categoria', [
                'empresa', 'tarifas', 'notificaciones', 'pagos', 
                'sistema', 'seguridad', 'reportes', 'app'
            ])->default('sistema');
            $table->boolean('es_publica')->default(false); // Si se puede mostrar en APIs públicas
            $table->boolean('es_editable')->default(true);
            $table->text('validacion_reglas')->nullable(); // Reglas de validación JSON
            $table->unsignedBigInteger('actualizado_por')->nullable();
            $table->timestamps();

            $table->index('clave');
            $table->index('categoria');
            $table->index('es_publica');
            $table->index('es_editable');
            
            $table->foreign('actualizado_por')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuraciones');
    }
};
