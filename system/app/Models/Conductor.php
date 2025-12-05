<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\View\Composers\SidebarComposer;
use App\Traits\Auditable;

class Conductor extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory, Auditable;

    protected $table = 'conductores';
    protected $fillable = [
        'chaleco_id',
        'fecha_asignacion_chaleco',
        'usuario_id',
        'nombre',
        'apellido',
        'cedula',
        'telefono',
        'telefono_secundario',
        'email',
        'direccion',
        'ciudad',
        'departamento',
        'fecha_nacimiento',
        'genero',
        'estado_civil',
        'grupo_sanguineo',
        'foto',
        'contacto_emergencia_nombre',
        'contacto_emergencia_telefono',
        'contacto_emergencia_relacion',
        'contacto_emergencia_direccion',
        'fecha_ingreso',
        'fecha_baja',
        'motivo_baja',
        'experiencia_anos',
        'salario_base',
        'comision_porcentaje',
        'horarios_disponibles',
        'disponible_fines_semana',
        'disponible_feriados',
        'antecedentes_penales',
        'antecedentes_verificados_at',
        'licencia_vencimiento',
        'licencia_categoria',
        'examen_medico_vencimiento',
        'documentos_verificados',
        'observaciones_verificacion',
        'rating',
        'total_viajes',
        'viajes_completados',
        'viajes_cancelados',
        'total_ingresos',
        'kilometraje_total',
        'asistencia_porcentaje',
        'puntualidad_porcentaje',
        'ultima_evaluacion',
        'estado_pago',
        'saldo_pendiente',
        'ultimo_pago',
        'ultimo_monto_pago',
        'metodo_pago_preferido',
        'numero_cuenta_bancaria',
        'banco',
        'estado',
        'estado_operativo',
        'ultimo_cambio_estado',
        'motivo_estado',
        'preferencias_viajes',
        'acepta_viajes_nocturnos',
        'acepta_viajes_largos',
        'radio_operacion_km',
        'creado_por',
        'actualizado_por',
        'observaciones',
        'historial_cambios',
        'estado',
        'estado_pago',
        'rating',
        'total_viajes',
        'asistencia_porcentaje',
        'antecedentes_verificados_at',
        'fecha_ingreso',
        'observaciones'
    ];

    protected $casts = [
        'fecha_asignacion_chaleco' => 'datetime',
        'fecha_nacimiento' => 'date',
        'fecha_ingreso' => 'date',
        'fecha_baja' => 'date',
        'antecedentes_verificados_at' => 'date',
        'licencia_vencimiento' => 'date',
        'examen_medico_vencimiento' => 'date',
        'ultima_evaluacion' => 'date',
        'ultimo_pago' => 'date',
        'ultimo_cambio_estado' => 'datetime',
        'salario_base' => 'decimal:2',
        'comision_porcentaje' => 'decimal:2',
        'rating' => 'decimal:1',
        'total_ingresos' => 'decimal:2',
        'kilometraje_total' => 'decimal:2',
        'saldo_pendiente' => 'decimal:2',
        'ultimo_monto_pago' => 'decimal:2',
        'radio_operacion_km' => 'decimal:2',
        'disponible_fines_semana' => 'boolean',
        'disponible_feriados' => 'boolean',
        'antecedentes_penales' => 'boolean',
        'acepta_viajes_nocturnos' => 'boolean',
        'acepta_viajes_largos' => 'boolean',
        'horarios_disponibles' => 'array',
        'documentos_verificados' => 'array',
        'preferencias_viajes' => 'array',
        'historial_cambios' => 'array',
    ];

    /**
     * Relación con Usuario
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Relación con Asignaciones de Vehículo
     */
    public function asignaciones()
    {
        return $this->hasMany(AsignacionVehiculo::class, 'conductor_id');
    }

    /**
     * Obtener el vehículo asignado actualmente (activo)
     */
    public function vehiculoActual()
    {
        return $this->hasOneThrough(
            Vehiculo::class,
            AsignacionVehiculo::class,
            'conductor_id', // Foreign key on asignaciones_vehiculo table...
            'id', // Foreign key on vehiculos table...
            'id', // Local key on conductores table...
            'vehiculo_id' // Local key on asignaciones_vehiculo table...
        )->where('asignaciones_vehiculo.estado', 'activa');
    }

    /**
     * Relación con Viajes
     */
    public function viajes()
    {
        return $this->hasMany(Viaje::class, 'conductor_id');
    }

    /**
     * Relación con Documentos (polimórfica)
     */
    public function documentos()
    {
        return $this->morphMany(Documento::class, 'documentable');
    }

    /**
     * Relación con Chaleco
     */
    public function chaleco()
    {
        return $this->belongsTo(Chaleco::class, 'chaleco_id');
    }

    /**
     * Relación con Pagos
     */
    public function pagos()
    {
        return $this->hasMany(PagoConductor::class, 'conductor_id');
    }

    /**
     * Scopes
     */
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    public function scopeDisponibles($query)
    {
        return $query->where('estado_operativo', 'disponible');
    }

    public function scopeConVehiculo($query)
    {
        return $query->whereHas('asignaciones', function($q) {
            $q->where('estado', 'activa');
        });
    }

    public function scopeConDocumentosVigentes($query)
    {
        return $query->where(function($q) {
            $q->where('licencia_vencimiento', '>', now())
              ->where('examen_medico_vencimiento', '>', now());
        });
    }

    public function scopeDisponiblesFinesDeSemana($query)
    {
        return $query->where('disponible_fines_semana', true);
    }

    /**
     * Accessors
     */
    public function getNombreCompletoAttribute()
    {
        return trim($this->nombre . ' ' . $this->apellido);
    }

    public function getEdadAttribute()
    {
        if (!$this->fecha_nacimiento) {
            return null;
        }
        return $this->fecha_nacimiento->diffInYears(now());
    }

    public function getAnosServicioAttribute()
    {
        if (!$this->fecha_ingreso) {
            return null;
        }
        return $this->fecha_ingreso->diffInYears(now());
    }

    /**
     * Métodos de estado
     */
    public function esActivo()
    {
        return $this->estado === 'activo';
    }

    public function estaDisponible()
    {
        return $this->estado_operativo === 'disponible' && $this->esActivo();
    }

    public function tieneDocumentosVigentes()
    {
        $licenciaVigente = !$this->licencia_vencimiento || $this->licencia_vencimiento > now();
        $examenVigente = !$this->examen_medico_vencimiento || $this->examen_medico_vencimiento > now();
        
        return $licenciaVigente && $examenVigente;
    }

    public function tieneVehiculoAsignado()
    {
        return $this->asignaciones()->where('estado', 'activa')->exists();
    }

    /**
     * Obtener estadísticas del mes actual
     */
    public function estadisticasDelMes()
    {
        $inicioMes = now()->startOfMonth();
        $finMes = now()->endOfMonth();
        
        $viajesDelMes = $this->viajes()
            ->whereBetween('fecha_hora_inicio', [$inicioMes, $finMes])
            ->where('estado', 'completado');
            
        return [
            'viajes_completados' => $viajesDelMes->count(),
            'ingresos_totales' => $viajesDelMes->sum('comision_conductor'),
            'kilometraje' => $viajesDelMes->sum('distancia_km'),
            'rating_promedio' => $viajesDelMes->avg('calificacion_cliente'),
        ];
    }

    /**
     * Cambiar estado operativo
     */
    public function cambiarEstadoOperativo($nuevoEstado, $motivo = null)
    {
        $this->update([
            'estado_operativo' => $nuevoEstado,
            'ultimo_cambio_estado' => now(),
            'motivo_estado' => $motivo,
        ]);

        $this->logCustomActivity(
            'cambio_estado_operativo',
            "Estado operativo cambiado a: {$nuevoEstado}" . ($motivo ? " - Motivo: {$motivo}" : ''),
            'info'
        );
    }

    /**
     * Actualizar estadísticas
     */
    public function actualizarEstadisticas()
    {
        $viajes = $this->viajes()->where('estado', 'completado');
        
        $this->update([
            'total_viajes' => $viajes->count(),
            'viajes_completados' => $viajes->count(),
            'total_ingresos' => $viajes->sum('comision_conductor'),
            'kilometraje_total' => $viajes->sum('distancia_km'),
            'rating' => $viajes->avg('calificacion_cliente') ?? 5.0,
        ]);
    }

    /**
     * Obtener estadísticas del mes anterior para comparación
     */
    public function estadisticasDelMesAnterior()
    {
        $inicioMesAnterior = now()->subMonth()->startOfMonth();
        $finMesAnterior = now()->subMonth()->endOfMonth();
        
        $viajesDelMesAnterior = $this->viajes()
            ->whereBetween('fecha_hora_inicio', [$inicioMesAnterior, $finMesAnterior])
            ->where('estado', 'completado');
            
        return [
            'viajes_completados' => $viajesDelMesAnterior->count(),
            'ingresos_generados' => $viajesDelMesAnterior->sum('valor_total'),
            'calificacion_promedio' => $viajesDelMesAnterior->avg('calificacion') ?? 0
        ];
    }

    /**
     * Obtener el código del chaleco asignado
     */
    public function getCodChaleco()
    {
        return $this->chaleco ? $this->chaleco->cod_chaleco : null;
    }

    /**
     * Verificar si tiene chaleco asignado
     */
    public function tieneChaleco()
    {
        return !is_null($this->chaleco_id);
    }

    /**
     * Calcular porcentaje de cambio entre dos valores
     */
    public function calcularCambio($valorActual, $valorAnterior)
    {
        if ($valorAnterior == 0) {
            return $valorActual > 0 ? 100 : 0;
        }
        return round((($valorActual - $valorAnterior) / $valorAnterior) * 100, 1);
    }

    /**
     * Obtener el documento de un tipo específico
     */
    public function getDocumento($tipo)
    {
        return $this->documentos()->where('tipo_documento', $tipo)->first();
    }

    /**
     * Boot method para limpiar cache cuando se actualiza un conductor
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function () {
            SidebarComposer::clearCache();
        });

        static::updated(function () {
            SidebarComposer::clearCache();
        });

        static::deleted(function () {
            SidebarComposer::clearCache();
        });
    }
}
