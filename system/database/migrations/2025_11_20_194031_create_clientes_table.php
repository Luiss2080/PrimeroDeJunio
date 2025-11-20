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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellido', 100)->nullable();
            $table->string('telefono', 20);
            $table->string('email', 150)->nullable();
            $table->text('direccion_habitual')->nullable();
            $table->enum('tipo_cliente', ['particular', 'corporativo', 'frecuente'])->default('particular');
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->text('observaciones')->nullable();
            $table->decimal('descuento_porcentaje', 5, 2)->default(0.00);
            $table->timestamps();
            
            $table->index('telefono');
            $table->index('email');
            $table->index('tipo_cliente');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
