<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $table = 'documentos';
    protected $fillable = [
        'documentable_id',
        'documentable_type',
        'tipo_documento',
        'numero',
        'fecha_expedicion',
        'fecha_vencimiento',
        'archivo_ruta',
        'estado',
        'observaciones'
    ];

    public function documentable()
    {
        return $this->morphTo();
    }
}
