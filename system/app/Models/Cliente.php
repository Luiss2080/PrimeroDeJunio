<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\View\Composers\SidebarComposer;

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

    /**
     * Boot method para limpiar cache cuando se actualiza un cliente
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function () {
            SidebarComposer::clearCache();
        });

        static::updated(function () {
            SidebarComposer::clearCache();
        });

        static::deleted(function () {
            SidebarComposer::clearCache();
        });
    }
}
