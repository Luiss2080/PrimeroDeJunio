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
            
            // Información básica del vehículo
            $table->string('placa', 10)->unique();
            $table->string('marca', 50);
            $table->string('modelo', 50);
            $table->string('linea', 100)->nullable(); // Línea específica del modelo
            $table->string('color', 30);
            $table->string('color_secundario', 30)->nullable();
            $table->integer('ano');
            $table->integer('cilindraje');
            $table->enum('tipo_combustible', ['Gasolina', 'Gas', 'Diesel', 'Electrico', 'Hibrido', 'GNV'])->default('Gasolina');
            $table->enum('transmision', ['manual', 'automatica', 'semi_automatica'])->default('manual');
            $table->integer('capacidad_pasajeros')->default(4);
            $table->decimal('capacidad_tanque_litros', 6, 2)->nullable();
            $table->decimal('rendimiento_km_galon', 6, 2)->nullable();
            
            // Identificación del vehículo
            $table->string('numero_motor', 50)->unique()->nullable();
            $table->string('numero_chasis', 50)->unique()->nullable();
            $table->string('numero_serie', 50)->nullable();
            $table->string('tarjeta_propiedad', 50)->nullable();
            
            // Información del propietario
            $table->string('propietario_nombre', 100);
            $table->string('propietario_cedula', 20);
            $table->string('propietario_telefono', 50)->nullable();
            $table->string('propietario_email', 100)->nullable();
            $table->text('propietario_direccion')->nullable();
            $table->string('propietario_ciudad', 100)->nullable();
            
            // Información comercial
            $table->decimal('valor_comercial', 15, 2)->nullable();
            $table->decimal('valor_asegurado', 15, 2)->nullable();
            $table->string('aseguradora', 100)->nullable();
            $table->string('poliza_numero', 100)->nullable();
            $table->date('poliza_vencimiento')->nullable();
            
            // Documentación vehicular
            $table->date('soat_vencimiento')->nullable();
            $table->string('soat_numero', 50)->nullable();
            $table->date('tecnomecanica_vencimiento')->nullable();
            $table->string('tecnomecanica_numero', 50)->nullable();
            $table->date('revision_gases_vencimiento')->nullable();
            $table->json('documentos_vehiculo')->nullable(); // Lista de documentos del vehículo
            
            // Control operativo
            $table->integer('kilometraje_actual')->default(0);
            $table->date('ultimo_mantenimiento')->nullable();
            $table->integer('kilometraje_ultimo_mantenimiento')->nullable();
            $table->date('proximo_mantenimiento')->nullable();
            $table->integer('kilometraje_proximo_mantenimiento')->nullable();
            $table->decimal('costo_mantenimiento_total', 15, 2)->default(0);
            
            // Estadísticas operativas
            $table->integer('total_viajes')->default(0);
            $table->decimal('total_kilometros_recorridos', 12, 2)->default(0);
            $table->decimal('total_ingresos_generados', 15, 2)->default(0);
            $table->decimal('total_gastos_operativos', 15, 2)->default(0);
            $table->decimal('promedio_consumo_combustible', 8, 2)->nullable();
            $table->date('ultima_utilizacion')->nullable();
            
            // Estados y disponibilidad
            $table->enum('estado', [
                'activo', 'mantenimiento', 'inactivo', 'vendido', 
                'siniestrado', 'decomisado', 'documentos_vencidos'
            ])->default('activo');
            $table->enum('estado_operativo', [
                'disponible', 'en_servicio', 'mantenimiento', 'fuera_servicio', 
                'revision_tecnica', 'limpieza'
            ])->default('disponible');
            $table->timestamp('ultimo_cambio_estado')->nullable();
            $table->text('motivo_estado')->nullable();
            
            // Características y equipamiento
            $table->boolean('tiene_aire_acondicionado')->default(false);
            $table->boolean('tiene_gps')->default(false);
            $table->boolean('tiene_camara_seguridad')->default(false);
            $table->boolean('tiene_wifi')->default(false);
            $table->boolean('tiene_cargador_usb')->default(false);
            $table->boolean('es_blindado')->default(false);
            $table->json('equipamiento_adicional')->nullable(); // Lista de equipamiento extra
            
            // Ubicación y asignación
            $table->string('ubicacion_actual', 200)->nullable();
            $table->decimal('latitud', 10, 8)->nullable();
            $table->decimal('longitud', 11, 8)->nullable();
            $table->timestamp('ultima_ubicacion_actualizada')->nullable();
            $table->string('parqueadero_asignado', 100)->nullable();
            
            // Costos y tarifas
            $table->decimal('tarifa_km', 8, 2)->nullable(); // Tarifa por kilómetro
            $table->decimal('tarifa_hora', 8, 2)->nullable(); // Tarifa por hora
            $table->decimal('tarifa_minima', 8, 2)->nullable(); // Tarifa mínima
            $table->decimal('porcentaje_comision_conductor', 5, 2)->default(70); // % para el conductor
            
            // Auditoría y control
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->unsignedBigInteger('actualizado_por')->nullable();
            $table->date('fecha_adquisicion')->nullable();
            $table->date('fecha_baja')->nullable();
            $table->text('motivo_baja')->nullable();
            $table->text('observaciones')->nullable();
            $table->json('historial_propietarios')->nullable(); // Historial de propietarios
            $table->json('historial_incidentes')->nullable(); // Incidentes reportados
            
            $table->timestamps();

            // Índices optimizados
            $table->index('placa');
            $table->index('propietario_cedula');
            $table->index('estado');
            $table->index('estado_operativo');
            $table->index(['marca', 'modelo']);
            $table->index('soat_vencimiento');
            $table->index('tecnomecanica_vencimiento');
            $table->index('poliza_vencimiento');
            $table->index('proximo_mantenimiento');
            $table->index('kilometraje_actual');
            $table->index(['estado', 'estado_operativo']);
            $table->index('ultima_utilizacion');
            $table->index('ano');
            $table->index('capacidad_pasajeros');
            $table->index(['latitud', 'longitud']);
            
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
        Schema::dropIfExists('vehiculos');
    }
};
