<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $table = 'turnos';
    protected $fillable = [
        'conductor_id',
        'vehiculo_id',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'km_inicial',
        'km_final',
        'total_recaudado',
        'estado',
        'observaciones_inicio',
        'observaciones_fin'
    ];

    public function conductor()
    {
        return $this->belongsTo(Conductor::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}
