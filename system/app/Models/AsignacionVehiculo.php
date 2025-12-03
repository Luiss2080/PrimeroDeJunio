<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignacionVehiculo extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    protected $table = 'asignaciones_vehiculo';

    protected $fillable = [
        'conductor_id',
        'vehiculo_id',
        'fecha_inicio',
        'fecha_fin',
        'turno',
        'hora_inicio',
        'hora_fin',
        'dias_semana',
        'estado',
        'observaciones'
    ];

    public function conductor()
    {
        return $this->belongsTo(Conductor::class, 'conductor_id');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }
}
