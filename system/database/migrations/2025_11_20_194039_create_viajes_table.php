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
        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            
            // Relaciones principales
            $table->foreignId('conductor_id')->constrained('conductores')->restrictOnDelete();
            $table->foreignId('vehiculo_id')->constrained('vehiculos')->restrictOnDelete();
            $table->foreignId('cliente_id')->nullable()->constrained('clientes')->nullOnDelete();
            $table->foreignId('tarifa_aplicada_id')->constrained('tarifas')->restrictOnDelete();
            
            // Información del cliente (backup si no está registrado)
            $table->string('cliente_nombre', 100)->nullable();
            $table->string('cliente_telefono', 50)->nullable();
            
            // Información geográfica esencial
            $table->text('origen');
            $table->decimal('origen_latitud', 10, 8)->nullable();
            $table->decimal('origen_longitud', 11, 8)->nullable();
            $table->text('destino');
            $table->decimal('destino_latitud', 10, 8)->nullable();
            $table->decimal('destino_longitud', 11, 8)->nullable();
            
            // Métricas del viaje (solo lo necesario)
            $table->decimal('distancia_km', 8, 2)->nullable();
            $table->integer('duracion_minutos')->nullable();
            $table->integer('tiempo_espera_minutos')->default(0);
            
            // Costos consolidados
            $table->decimal('valor_base', 10, 2);
            $table->decimal('recargos_total', 10, 2)->default(0.00);
            $table->decimal('descuentos_total', 10, 2)->default(0.00);
            $table->decimal('valor_total', 10, 2);
            $table->decimal('comision_conductor', 10, 2)->nullable();
            
            // Información de pago
            $table->enum('metodo_pago', [
                'efectivo', 'tarjeta_debito', 'tarjeta_credito', 
                'transferencia', 'credito'
            ])->default('efectivo');
            $table->enum('estado_pago', ['pendiente', 'pagado', 'anulado'])->default('pendiente');
            $table->timestamp('fecha_pago')->nullable();
            
            // Estados del viaje (simplificados)
            $table->enum('estado', [
                'pendiente', 'confirmado', 'en_curso', 'completado', 
                'cancelado', 'no_presentado'
            ])->default('pendiente');
            
            // Fechas esenciales
            $table->timestamp('fecha_solicitud');
            $table->timestamp('fecha_hora_inicio');
            $table->timestamp('fecha_hora_fin')->nullable();
            
            // Tipo de servicio
            $table->enum('tipo_servicio', [
                'urbano', 'intermunicipal', 'aeropuerto', 'especial'
            ])->default('urbano');
            $table->integer('numero_pasajeros')->default(1);
            
            // Calificaciones
            $table->tinyInteger('calificacion_cliente')->nullable();
            $table->text('comentario_cliente')->nullable();
            $table->tinyInteger('calificacion_conductor')->nullable();
            $table->text('comentario_conductor')->nullable();
            
            // Información técnica básica
            $table->string('codigo_reserva', 20)->unique()->nullable();
            $table->string('plataforma_origen', 50)->default('web');
            
            // Auditoría
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->text('motivo_cancelacion')->nullable();
            $table->text('observaciones')->nullable();
            
            $table->timestamps();

            // Índices optimizados
            $table->index('conductor_id');
            $table->index('vehiculo_id');
            $table->index('cliente_id');
            $table->index('tarifa_aplicada_id');
            $table->index('fecha_hora_inicio');
            $table->index('fecha_solicitud');
            $table->index('estado');
            $table->index('estado_pago');
            $table->index('tipo_servicio');
            $table->index('codigo_reserva');
            $table->index(['fecha_hora_inicio', 'valor_total']);
            $table->index(['estado', 'conductor_id']);
            
            // Clave foránea adicional
            $table->foreign('creado_por')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viajes');
    }
};
