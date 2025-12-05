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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            
            // Información del usuario y contexto
            $table->foreignId('usuario_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('usuario_nombre', 150)->nullable(); // Snapshot del nombre por si se borra el usuario
            $table->string('usuario_email', 150)->nullable(); // Snapshot del email
            
            // Información de la acción
            $table->enum('tipo_accion', [
                'crear', 'actualizar', 'eliminar', 'login', 'logout', 
                'login_fallido', 'cambio_password', 'recuperar_password',
                'asignar_vehiculo', 'crear_viaje', 'finalizar_viaje',
                'pago_realizado', 'mantenimiento_programado', 'exportar_datos',
                'sistema', 'configuracion', 'backup'
            ]);
            $table->string('accion_detalle', 200); // Descripción más detallada
            $table->enum('nivel', ['info', 'warning', 'error', 'critical'])->default('info');
            
            // Información del recurso afectado
            $table->string('tabla_afectada', 50)->nullable();
            $table->unsignedBigInteger('registro_id')->nullable(); // Cambio a unsignedBigInteger para consistencia
            $table->string('registro_descripcion', 200)->nullable(); // Descripción del registro (ej: "Viaje #123 - Juan Pérez")
            
            // Datos del cambio
            $table->json('datos_anteriores')->nullable();
            $table->json('datos_nuevos')->nullable();
            $table->json('campos_modificados')->nullable(); // Solo los campos que cambiaron
            
            // Información técnica
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('session_id', 100)->nullable();
            $table->string('request_id', 50)->nullable(); // Para rastrear requests específicos
            
            // Información adicional
            $table->string('modulo', 50)->nullable(); // ej: 'conductores', 'viajes', 'vehiculos'
            $table->string('metodo_http', 10)->nullable(); // GET, POST, PUT, DELETE
            $table->string('url', 500)->nullable();
            $table->json('parametros_request')->nullable();
            $table->integer('duracion_ms')->nullable(); // Duración de la operación en millisegundos
            
            // Auditoría y seguimiento
            $table->boolean('requiere_atencion')->default(false); // Para marcar logs que requieren revisión
            $table->timestamp('revisado_at')->nullable();
            $table->unsignedBigInteger('revisado_por')->nullable();
            $table->text('notas_revision')->nullable();
            
            $table->timestamps();

            // Índices optimizados
            $table->index('usuario_id');
            $table->index('tipo_accion');
            $table->index('tabla_afectada');
            $table->index('registro_id');
            $table->index('nivel');
            $table->index('created_at');
            $table->index('modulo');
            $table->index('ip_address');
            $table->index(['tabla_afectada', 'registro_id']);
            $table->index(['usuario_id', 'created_at']);
            $table->index(['tipo_accion', 'created_at']);
            $table->index('requiere_atencion');

            // Clave foránea adicional
            $table->foreign('revisado_por')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
