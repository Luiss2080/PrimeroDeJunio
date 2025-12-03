<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $table = 'tarifas';
    protected $fillable = [
        'nombre',
        'descripcion',
        'costo_base',
        'costo_km',
        'costo_minuto',
        'costo_minima',
        'recargo_nocturno',
        'recargo_festivo',
        'estado'
    ];
}
