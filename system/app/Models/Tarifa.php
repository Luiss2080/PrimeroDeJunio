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
        'tarifa_base',
        'tarifa_por_km',
        'tarifa_por_minuto',
        'tarifa_minima',
        'recargo_nocturno',
        'recargo_festivo',
        'estado'
    ];
}
