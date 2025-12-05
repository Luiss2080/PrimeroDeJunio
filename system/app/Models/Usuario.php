<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\View\Composers\SidebarComposer;

class Usuario extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $table = 'usuarios';

    /**
     * Boot method para limpiar cache cuando se actualiza un usuario
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
