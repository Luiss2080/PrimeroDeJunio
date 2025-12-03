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
        'tipo',
        'descripcion',
        'costo',
        'fecha_inicio',
        'fecha_fin',
        'taller',
        'factura_numero',
        'observaciones'
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}
