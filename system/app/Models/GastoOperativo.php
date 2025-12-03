<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastoOperativo extends Model
{
    use HasFactory;

    protected $table = 'gastos_operativos';
    protected $fillable = [
        'vehiculo_id',
        'tipo_gasto',
        'monto',
        'fecha',
        'descripcion',
        'registrado_por',
        'comprobante_ruta'
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function registradoPor()
    {
        return $this->belongsTo(User::class, 'registrado_por');
    }
}
