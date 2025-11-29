<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    protected $table = 'conductores';
    protected $fillable = [
        'nombre',
        'apellidos',
        'cedula',
        'telefono',
        'email',
        'direccion',
        'fecha_nacimiento',
        'licencia_conducir',
        'fecha_vencimiento_licencia',
        'estado'
    ];
}
