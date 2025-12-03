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
}
