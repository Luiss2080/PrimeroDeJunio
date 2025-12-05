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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            
            // Información básica del rol
            $table->string('nombre', 50)->unique();
            $table->string('slug', 50)->unique(); // Para URLs amigables
            $table->text('descripcion')->nullable();
            $table->string('color', 20)->default('#6B7280'); // Color para UI (hex)
            $table->string('icono', 50)->nullable(); // Icono para UI
            
            // Permisos y configuración
            $table->json('permisos')->nullable(); // Permisos específicos del rol
            $table->json('configuracion_dashboard')->nullable(); // Configuración personalizada del dashboard
            $table->json('modulos_acceso')->nullable(); // Módulos a los que tiene acceso
            $table->integer('nivel_jerarquia')->default(1); // Nivel jerárquico (1=más bajo, 10=más alto)
            $table->boolean('es_super_admin')->default(false); // Si tiene acceso total
            $table->boolean('puede_crear_usuarios')->default(false);
            $table->boolean('puede_ver_reportes')->default(false);
            
            // Limitaciones y configuraciones
            $table->integer('max_usuarios')->nullable(); // Máximo de usuarios con este rol
            $table->decimal('limite_transacciones', 15, 2)->nullable(); // Límite en transacciones monetarias
            $table->json('horarios_acceso')->nullable(); // Horarios permitidos para acceso
            $table->json('dias_acceso')->nullable(); // Días de la semana permitidos
            
            // Estado y auditoría
            $table->enum('estado', ['activo', 'inactivo', 'suspendido', 'deprecado'])->default('activo');
            $table->date('fecha_vigencia_desde')->nullable();
            $table->date('fecha_vigencia_hasta')->nullable();
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->unsignedBigInteger('actualizado_por')->nullable();
            $table->text('motivo_cambio')->nullable(); // Razón del último cambio
            $table->boolean('es_sistema')->default(false); // Si es un rol del sistema (no editable)
            
            $table->timestamps();

            // Índices optimizados
            $table->index('nombre');
            $table->index('slug');
            $table->index('estado');
            $table->index('nivel_jerarquia');
            $table->index('es_super_admin');
            $table->index(['estado', 'nivel_jerarquia']);
            $table->index('fecha_vigencia_desde');
            $table->index('fecha_vigencia_hasta');
            
            // Claves foráneas
            $table->foreign('creado_por')->references('id')->on('users')->nullOnDelete();
            $table->foreign('actualizado_por')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
