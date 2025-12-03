<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteIncidente extends Model
{
    use HasFactory;

    protected $table = 'reportes_incidentes';
    protected $fillable = [
        'usuario_reporta_id',
        'viaje_id',
        'vehiculo_id',
        'tipo',
        'descripcion',
        'nivel_gravedad',
        'estado',
        'resolucion',
        'fecha_resolucion'
    ];

    public function usuarioReporta()
    {
        return $this->belongsTo(User::class, 'usuario_reporta_id');
    }

    public function viaje()
    {
        return $this->belongsTo(Viaje::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}
