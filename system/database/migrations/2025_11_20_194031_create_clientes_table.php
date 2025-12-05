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
            
            // Información personal básica
            $table->string('nombre', 100);
            $table->string('apellido', 100)->nullable();
            $table->string('segundo_nombre', 100)->nullable();
            $table->string('cedula', 20)->nullable()->unique();
            $table->enum('tipo_documento', ['CC', 'CE', 'PA', 'TI', 'NIT'])->default('CC');
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('genero', ['masculino', 'femenino', 'otro', 'prefiero_no_decir'])->nullable();
            
            // Información de contacto
            $table->string('telefono', 20);
            $table->string('telefono_secundario', 20)->nullable();
            $table->string('telefono_oficina', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('email_secundario', 150)->nullable();
            
            // Direcciones
            $table->text('direccion_habitual')->nullable();
            $table->text('direccion_oficina')->nullable();
            $table->string('ciudad_residencia', 100)->nullable();
            $table->string('departamento_residencia', 100)->nullable();
            $table->string('codigo_postal', 20)->nullable();
            $table->json('direcciones_frecuentes')->nullable(); // Lista de direcciones frecuentes con nombres
            
            // Información comercial y clasificación
            $table->enum('tipo_cliente', [
                'particular', 'corporativo', 'frecuente', 'vip', 
                'empresa', 'gobierno', 'turista', 'estudiante'
            ])->default('particular');
            $table->string('empresa', 150)->nullable();
            $table->string('cargo', 100)->nullable();
            $table->string('nit_empresa', 20)->nullable();
            $table->date('fecha_registro');
            $table->string('referido_por', 100)->nullable(); // Cómo conoció el servicio
            
            // Configuraciones financieras
            $table->decimal('descuento_porcentaje', 5, 2)->default(0.00);
            $table->decimal('limite_credito', 15, 2)->default(0); // Para clientes corporativos
            $table->decimal('saldo_pendiente', 15, 2)->default(0);
            $table->enum('forma_pago_preferida', ['efectivo', 'tarjeta', 'transferencia', 'credito'])->default('efectivo');
            $table->boolean('requiere_factura')->default(false);
            $table->string('razon_social_factura', 200)->nullable();
            $table->string('nit_factura', 20)->nullable();
            
            // Estadísticas y comportamiento
            $table->integer('total_viajes')->default(0);
            $table->integer('viajes_completados')->default(0);
            $table->integer('viajes_cancelados')->default(0);
            $table->decimal('total_gastado', 15, 2)->default(0);
            $table->decimal('promedio_gasto_viaje', 10, 2)->default(0);
            $table->decimal('calificacion_promedio', 3, 1)->nullable(); // Calificación que da a conductores
            $table->date('ultimo_viaje')->nullable();
            $table->integer('frecuencia_uso_mensual')->default(0); // Viajes por mes promedio
            
            // Preferencias y configuraciones
            $table->json('preferencias_viaje')->nullable(); // Tipo de música, temperatura, etc.
            $table->string('conductor_preferido', 200)->nullable(); // Lista de conductores preferidos
            $table->boolean('acepta_compartir_viaje')->default(false);
            $table->boolean('requiere_silla_bebe')->default(false);
            $table->boolean('requiere_acceso_discapacitados')->default(false);
            $table->json('horarios_habituales')->nullable(); // Horarios frecuentes de viaje
            
            // Marketing y comunicación
            $table->boolean('acepta_promociones_email')->default(true);
            $table->boolean('acepta_promociones_sms')->default(true);
            $table->boolean('acepta_encuestas')->default(true);
            $table->string('canal_comunicacion_preferido', 50)->default('telefono'); // telefono, email, whatsapp
            $table->json('intereses')->nullable(); // Intereses del cliente para marketing
            
            // Estado y seguridad
            $table->enum('estado', [
                'activo', 'inactivo', 'suspendido', 'bloqueado', 
                'moroso', 'vip', 'evaluacion'
            ])->default('activo');
            $table->enum('nivel_confianza', ['alto', 'medio', 'bajo', 'nuevo'])->default('nuevo');
            $table->text('motivo_estado')->nullable();
            $table->timestamp('ultimo_cambio_estado')->nullable();
            $table->boolean('cliente_problematico')->default(false);
            $table->text('notas_comportamiento')->nullable();
            
            // Contacto de emergencia
            $table->string('contacto_emergencia_nombre', 100)->nullable();
            $table->string('contacto_emergencia_telefono', 20)->nullable();
            $table->string('contacto_emergencia_relacion', 50)->nullable();
            
            // Auditoría
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->unsignedBigInteger('actualizado_por')->nullable();
            $table->text('observaciones')->nullable();
            $table->json('historial_incidentes')->nullable(); // Historial de incidentes con el cliente
            $table->date('ultima_verificacion_datos')->nullable();
            
            $table->timestamps();

            // Índices optimizados
            $table->index('telefono');
            $table->index('email');
            $table->index('cedula');
            $table->index('tipo_cliente');
            $table->index('estado');
            $table->index('nivel_confianza');
            $table->index('fecha_registro');
            $table->index('ultimo_viaje');
            $table->index(['estado', 'tipo_cliente']);
            $table->index('total_viajes');
            $table->index('empresa');
            $table->index('nit_empresa');
            $table->index(['ciudad_residencia', 'estado']);
            $table->index('cliente_problematico');
            
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
        Schema::dropIfExists('clientes');
    }
};
