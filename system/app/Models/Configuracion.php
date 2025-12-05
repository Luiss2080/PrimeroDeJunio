<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Configuracion extends Model
{
    use Auditable;
    
    protected $table = 'configuraciones';
    
    protected $fillable = [
        'clave',
        'valor',
        'valor_anterior',
        'descripcion',
        'tipo',
        'categoria',
        'es_publica',
        'es_editable',
        'validacion_reglas',
        'actualizado_por',
    ];

    protected $casts = [
        'es_publica' => 'boolean',
        'es_editable' => 'boolean',
        'validacion_reglas' => 'array',
    ];

    // Scopes
    public function scopePublicas($query)
    {
        return $query->where('es_publica', true);
    }

    public function scopeEditables($query)
    {
        return $query->where('es_editable', true);
    }

    public function scopePorCategoria($query, $categoria)
    {
        return $query->where('categoria', $categoria);
    }

    // Relaciones
    public function actualizadoPor()
    {
        return $this->belongsTo(User::class, 'actualizado_por');
    }
}
