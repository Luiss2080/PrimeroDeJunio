<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'año',
        'color',
        'numero_motor',
        'numero_chasis',
        'propietario',
        'estado'
    ];
}
