<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Chaleco extends Model
{
    protected $fillable = [
        'cod_chaleco',
        'estado',
        'descripcion',
        'fecha_adquisicion',
        'costo'
    ];

    protected $casts = [
        'fecha_adquisicion' => 'date',
        'costo' => 'decimal:2'
    ];

    // Relación con conductor actual (uno a uno)
    public function conductorActual(): HasOne
    {
        return $this->hasOne(Conductor::class, 'chaleco_id');
    }

    // Verificar si el chaleco está disponible
    public function isDisponible(): bool
    {
        return $this->estado === 'disponible';
    }

    // Verificar si el chaleco está asignado
    public function isAsignado(): bool
    {
        return $this->estado === 'asignado';
    }

    // Generar el próximo código de chaleco
    public static function generarProximoCodigo(): string
    {
        $ultimo = self::orderBy('cod_chaleco', 'desc')->first();
        
        if (!$ultimo) {
            return '0001';
        }

        $numero = (int) $ultimo->cod_chaleco;
        $siguiente = $numero + 1;
        
        return str_pad($siguiente, 4, '0', STR_PAD_LEFT);
    }

    // Asignar chaleco a conductor
    public function asignarAConductor(Conductor $conductor): bool
    {
        if (!$this->isDisponible()) {
            return false;
        }

        // Liberar cualquier chaleco previo del conductor
        if ($conductor->chaleco_id) {
            $chalecoAnterior = self::find($conductor->chaleco_id);
            if ($chalecoAnterior) {
                $chalecoAnterior->update(['estado' => 'disponible']);
            }
        }

        // Asignar nuevo chaleco
        $this->update(['estado' => 'asignado']);
        $conductor->update([
            'chaleco_id' => $this->id,
            'fecha_asignacion_chaleco' => now()
        ]);

        return true;
    }

    // Liberar chaleco (hacer disponible)
    public function liberar(): bool
    {
        if ($this->conductorActual) {
            $this->conductorActual->update([
                'chaleco_id' => null,
                'fecha_asignacion_chaleco' => null
            ]);
        }

        return $this->update(['estado' => 'disponible']);
    }

    // Scopes
    public function scopeDisponibles($query)
    {
        return $query->where('estado', 'disponible');
    }

    public function scopeAsignados($query)
    {
        return $query->where('estado', 'asignado');
    }
}
