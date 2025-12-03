<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoConductor extends Model
{
    use HasFactory;

    protected $table = 'pagos_conductores';
    protected $fillable = [
        'conductor_id',
        'fecha_pago',
        'monto',
        'tipo',
        'metodo_pago',
        'registrado_por',
        'observaciones',
        'estado',
        'comprobante_ruta'
    ];

    public function conductor()
    {
        return $this->belongsTo(Conductor::class);
    }

    public function registradoPor()
    {
        return $this->belongsTo(User::class, 'registrado_por');
    }
}
