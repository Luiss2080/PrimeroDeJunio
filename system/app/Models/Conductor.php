<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\View\Composers\SidebarComposer;

class Conductor extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $table = 'conductores';
    protected $fillable = [
        'chaleco_id',
        'fecha_asignacion_chaleco',
        'usuario_id',
        'nombre',
        'apellido',
        'cedula',
        'telefono',
        'email',
        'direccion',
        'fecha_nacimiento',
        'grupo_sanguineo',
        'contacto_emergencia_nombre',
        'contacto_emergencia_telefono',
        'antecedentes_penales',
        'experiencia_anos',
        'foto',
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
        'antecedentes_verificados_at' => 'datetime'
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
            'ingresos_generados' => $viajesDelMes->sum('valor_total'),
            'calificacion_promedio' => $viajesDelMes->avg('calificacion') ?? 0,
            'distancia_total' => $viajesDelMes->sum('distancia_km') ?? 0
        ];
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
     * Relación con Chaleco
     */
    public function chaleco()
    {
        return $this->belongsTo(Chaleco::class, 'chaleco_id');
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
