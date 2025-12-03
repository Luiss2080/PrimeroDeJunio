<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $table = 'mantenimientos';
    protected $fillable = [
        'vehiculo_id',
        'tipo_mantenimiento',
        'descripcion',
        'kilometraje_actual',
        'costo',
        'taller_nombre',
        'taller_telefono',
        'fecha_programada',
        'fecha_realizada',
        'estado',
        'observaciones',
        'proximo_mantenimiento_km',
        'proximo_mantenimiento_fecha'
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}
