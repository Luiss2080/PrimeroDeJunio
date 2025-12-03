<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    protected $table = 'clientes';
    protected $fillable = [
        'nombre',
        'apellidos',
        'telefono',
        'email',
        'direccion',
        'cedula',
        'estado'
    ];
}
