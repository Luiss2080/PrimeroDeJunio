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
        Schema::create('conductores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('cedula', 20)->unique();
            $table->string('telefono', 20);
            $table->text('direccion')->nullable();
            $table->date('fecha_nacimiento');
            $table->string('licencia_numero', 50)->unique();
            $table->string('licencia_categoria', 10);
            $table->date('licencia_vigencia');
            $table->integer('experiencia_anos')->default(0);
            $table->string('foto')->nullable();
            $table->enum('estado', ['activo', 'inactivo', 'suspendido'])->default('activo');
            $table->date('fecha_ingreso')->default(now()->toDateString());
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->index('cedula');
            $table->index('licencia_numero');
            $table->index('estado');
            $table->index('usuario_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conductores');
    }
};
