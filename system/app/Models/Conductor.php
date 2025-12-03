<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $table = 'conductores';
    protected $fillable = [
        'usuario_id',
        'nombre',
        'apellido',
        'cedula',
        'telefono',
        'email',
        'direccion',
        'fecha_nacimiento',
        'grupo_sanguineo',
        'contacto_emergencia_nombre',
        'contacto_emergencia_telefono',
        'antecedentes_penales',
        'experiencia_anos',
        'foto',
        'estado',
        'estado_pago',
        'rating',
        'total_viajes',
        'asistencia_porcentaje',
        'antecedentes_verificados_at',
        'fecha_ingreso',
        'observaciones'
    ];

    /**
     * Relación con Asignaciones de Vehículo
     */
    public function asignaciones()
    {
        return $this->hasMany(AsignacionVehiculo::class, 'conductor_id');
    }

    /**
     * Obtener el vehículo asignado actualmente (activo)
     */
    public function vehiculoActual()
    {
        return $this->hasOneThrough(
            Vehiculo::class,
            AsignacionVehiculo::class,
            'conductor_id', // Foreign key on asignaciones_vehiculo table...
            'id', // Foreign key on vehiculos table...
            'id', // Local key on conductores table...
            'vehiculo_id' // Local key on asignaciones_vehiculo table...
        )->where('asignaciones_vehiculo.estado', 'activa');
    }

    /**
     * Relación con Viajes
     */
    public function viajes()
    {
        return $this->hasMany(Viaje::class, 'conductor_id');
    }
}
