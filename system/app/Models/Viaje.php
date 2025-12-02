<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viaje extends Model
{
    protected $table = 'viajes';

    protected $fillable = [
        'conductor_id',
        'vehiculo_id',
        'cliente_id',
        'cliente_nombre',
        'cliente_telefono',
        'origen',
        'destino',
        'distancia_km',
        'duracion_minutos',
        'tarifa_aplicada_id',
        'valor_base',
        'recargos',
        'descuentos',
        'valor_total',
        'metodo_pago',
        'estado',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'observaciones',
        'calificacion',
        'comentario_cliente'
    ];

    protected $casts = [
        'fecha_hora_inicio' => 'datetime',
        'fecha_hora_fin' => 'datetime',
    ];

    public function conductor()
    {
        return $this->belongsTo(Conductor::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}
