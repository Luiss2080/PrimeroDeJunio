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
            
            // Relación con usuario
            $table->foreignId('usuario_id')->nullable()->constrained('users')->nullOnDelete();
            
            // Información personal
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('cedula', 20)->unique();
            $table->string('telefono', 50);
            $table->string('telefono_secundario', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('direccion')->nullable();
            $table->string('ciudad', 100)->nullable();
            $table->string('departamento', 100)->nullable();
            $table->date('fecha_nacimiento');
            $table->enum('genero', ['masculino', 'femenino', 'otro'])->nullable();
            $table->enum('estado_civil', ['soltero', 'casado', 'union_libre', 'divorciado', 'viudo'])->nullable();
            $table->string('grupo_sanguineo', 5)->nullable();
            $table->string('foto', 500)->nullable();
            
            // Información de contacto de emergencia
            $table->string('contacto_emergencia_nombre', 100)->nullable();
            $table->string('contacto_emergencia_telefono', 20)->nullable();
            $table->string('contacto_emergencia_relacion', 50)->nullable();
            $table->text('contacto_emergencia_direccion')->nullable();
            
            // Información laboral y experiencia
            $table->date('fecha_ingreso')->default(now()->toDateString());
            $table->date('fecha_baja')->nullable();
            $table->text('motivo_baja')->nullable();

            $table->decimal('salario_base', 10, 2)->nullable();
            $table->decimal('comision_porcentaje', 5, 2)->default(0); // Porcentaje de comisión
            $table->json('horarios_disponibles')->nullable(); // Horarios de disponibilidad
            $table->boolean('disponible_fines_semana')->default(true);
            $table->boolean('disponible_feriados')->default(false);
            
            // Documentación y verificaciones
            $table->boolean('antecedentes_penales')->default(false);
            $table->date('antecedentes_verificados_at')->nullable();
            $table->date('licencia_vencimiento')->nullable();
            $table->string('licencia_categoria', 10)->nullable(); // A1, A2, B1, B2, etc.
            $table->date('examen_medico_vencimiento')->nullable();
            $table->json('documentos_verificados')->nullable(); // Lista de documentos verificados
            $table->text('observaciones_verificacion')->nullable();
            
            // Estadísticas y rendimiento
            $table->decimal('rating', 3, 1)->default(5.0);
            $table->integer('total_viajes')->default(0);
            $table->integer('viajes_completados')->default(0);
            $table->integer('viajes_cancelados')->default(0);
            $table->decimal('total_ingresos', 15, 2)->default(0);
            $table->decimal('kilometraje_total', 12, 2)->default(0);
            $table->integer('asistencia_porcentaje')->default(100);
            $table->integer('puntualidad_porcentaje')->default(100);
            $table->date('ultima_evaluacion')->nullable();
            
            // Estado financiero y pagos
            $table->enum('estado_pago', ['al_dia', 'mora', 'pendiente', 'suspendido_pago'])->default('al_dia');
            $table->decimal('saldo_pendiente', 15, 2)->default(0);
            $table->date('ultimo_pago')->nullable();
            $table->decimal('ultimo_monto_pago', 10, 2)->nullable();
            $table->string('metodo_pago_preferido', 50)->nullable();
            $table->string('numero_cuenta_bancaria', 50)->nullable();
            $table->string('banco', 100)->nullable();
            
            // Estados y control
            $table->enum('estado', ['activo', 'inactivo', 'suspendido', 'vacaciones', 'licencia_medica', 'evaluacion'])->default('activo');

            $table->text('motivo_estado')->nullable();
            
            // Configuraciones personales
            $table->json('preferencias_viajes')->nullable(); // Tipos de viaje preferidos
            $table->boolean('acepta_viajes_nocturnos')->default(true);
            $table->boolean('acepta_viajes_largos')->default(true);
            $table->decimal('radio_operacion_km', 8, 2)->default(50); // Radio de operación en km
            
            // Auditoría
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->unsignedBigInteger('actualizado_por')->nullable();
            $table->text('observaciones')->nullable();
            $table->json('historial_cambios')->nullable(); // Log de cambios importantes
            
            $table->timestamps();

            // Índices optimizados
            $table->index('cedula');
            $table->index('estado');

            $table->index('usuario_id');
            $table->index('estado_pago');

            $table->index('fecha_ingreso');
            $table->index('rating');
            $table->index('licencia_vencimiento');
            $table->index('examen_medico_vencimiento');
            $table->index(['ciudad', 'estado']);
            $table->index('total_viajes');
            
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
        Schema::dropIfExists('conductores');
    }
};
