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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('placa', 10)->unique();
            $table->string('marca', 50);
            $table->string('modelo', 50);
            $table->string('color', 30);
            $table->integer('ano');
            $table->integer('cilindraje');
            $table->enum('tipo_combustible', ['Gasolina', 'Gas', 'Diesel', 'Electrico', 'Hibrido'])->default('Gasolina');
            $table->integer('capacidad_pasajeros')->default(4);
            $table->string('numero_motor', 50)->unique()->nullable();
            $table->string('numero_chasis', 50)->unique()->nullable();
            $table->string('propietario_nombre', 100);
            $table->string('propietario_cedula', 20);
            $table->string('propietario_telefono', 50)->nullable();
            $table->enum('estado', ['activo', 'mantenimiento', 'inactivo', 'vendido'])->default('activo');
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->index('placa');
            $table->index('propietario_cedula');
            $table->index('estado');
            $table->index(['marca', 'modelo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
