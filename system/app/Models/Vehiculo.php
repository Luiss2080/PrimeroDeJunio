<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $table = 'vehiculos';
    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'color',
        'ano',
        'cilindraje',
        'tipo_combustible',
        'capacidad_pasajeros',
        'numero_motor',
        'numero_chasis',
        'propietario_nombre',
        'propietario_cedula',
        'propietario_telefono',
        'estado',
        'observaciones'
    ];

    /**
     * Relación con Viajes
     */
    public function viajes()
    {
        return $this->hasMany(Viaje::class, 'vehiculo_id');
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
}
