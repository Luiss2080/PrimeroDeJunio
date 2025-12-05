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
            
            // Información personal básica
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('email', 150)->unique();
            $table->string('password');
            $table->string('telefono', 50)->nullable();
            $table->string('telefono_emergencia', 50)->nullable();
            $table->text('direccion')->nullable();
            $table->string('ciudad', 100)->nullable();
            $table->string('departamento', 100)->nullable();
            $table->string('codigo_postal', 20)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('genero', ['masculino', 'femenino', 'otro', 'prefiero_no_decir'])->nullable();
            $table->string('cedula', 20)->nullable()->unique();
            $table->string('avatar')->nullable();
            
            // Información laboral
            $table->unsignedBigInteger('rol_id')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->string('numero_empleado', 50)->nullable()->unique();
            $table->decimal('salario_base', 10, 2)->nullable();
            $table->string('turno_preferido', 50)->nullable(); // matutino, vespertino, nocturno, flexible
            $table->boolean('disponible_fines_semana')->default(true);
            $table->text('notas_empleado')->nullable();
            
            // Estado y seguridad
            $table->enum('estado', ['activo', 'inactivo', 'suspendido', 'pendiente', 'vacaciones'])->default('activo');
            $table->timestamp('ultimo_acceso')->nullable();
            $table->string('last_login_ip', 45)->nullable();
            $table->integer('intentos_login_fallidos')->default(0);
            $table->timestamp('bloqueado_hasta')->nullable();
            $table->string('token_recuperacion')->nullable();
            $table->timestamp('token_expiracion')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('password_changed_at')->nullable();
            $table->boolean('requiere_cambio_password')->default(false);
            
            // Configuraciones de usuario
            $table->string('tema_preferido', 20)->default('light'); // light, dark, auto
            $table->string('idioma', 10)->default('es'); // es, en, etc.
            $table->json('preferencias_notificaciones')->nullable();
            $table->boolean('recibir_emails_promocionales')->default(true);
            $table->string('zona_horaria', 50)->default('America/Bogota');
            
            // Auditoría y tracking
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->unsignedBigInteger('actualizado_por')->nullable();
            $table->timestamp('fecha_baja')->nullable();
            $table->text('motivo_baja')->nullable();
            
            $table->rememberToken();
            $table->timestamps();
            
            // Índices para optimizar consultas
            $table->index('email');
            $table->index('rol_id');
            $table->index('estado');
            $table->index('cedula');
            $table->index('numero_empleado');
            $table->index(['estado', 'rol_id']);
            $table->index('fecha_ingreso');
            $table->index('ultimo_acceso');
            
            // Claves foráneas adicionales
            $table->foreign('creado_por')->references('id')->on('users')->nullOnDelete();
            $table->foreign('actualizado_por')->references('id')->on('users')->nullOnDelete();
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
