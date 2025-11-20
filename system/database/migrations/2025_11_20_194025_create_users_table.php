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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('email', 150)->unique();
            $table->string('password');
            $table->string('telefono', 20)->nullable();
            $table->text('direccion')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('avatar')->nullable();
            $table->foreignId('rol_id')->constrained('roles')->restrictOnDelete();
            $table->enum('estado', ['activo', 'inactivo', 'pendiente'])->default('activo');
            $table->timestamp('ultimo_acceso')->nullable();
            $table->string('token_recuperacion')->nullable();
            $table->timestamp('token_expiracion')->nullable();
            $table->timestamp('email_verified_at')->nullable(); // Para Laravel
            $table->rememberToken(); // Para Laravel
            $table->timestamps();
            
            $table->index('email');
            $table->index('rol_id');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
