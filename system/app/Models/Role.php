<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Auditable;

class Role extends Model
{
    use HasFactory, Auditable;

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'color',
        'icono',
        'permisos',
        'configuracion_dashboard',
        'modulos_acceso',
        'nivel_jerarquia',
        'es_super_admin',
        'puede_crear_usuarios',
        'puede_ver_reportes',
        'max_usuarios',
        'limite_transacciones',
        'horarios_acceso',
        'dias_acceso',
        'estado',
        'fecha_vigencia_desde',
        'fecha_vigencia_hasta',
        'creado_por',
        'actualizado_por',
        'motivo_cambio',
        'es_sistema',
    ];

    protected $casts = [
        'permisos' => 'array',
        'configuracion_dashboard' => 'array',
        'modulos_acceso' => 'array',
        'es_super_admin' => 'boolean',
        'puede_crear_usuarios' => 'boolean',
        'puede_ver_reportes' => 'boolean',
        'horarios_acceso' => 'array',
        'dias_acceso' => 'array',
        'fecha_vigencia_desde' => 'date',
        'fecha_vigencia_hasta' => 'date',
        'es_sistema' => 'boolean',
        'limite_transacciones' => 'decimal:2',
    ];

    /**
     * Relaciones
     */
    public function usuarios()
    {
        return $this->hasMany(User::class, 'rol_id');
    }

    /**
     * Scopes
     */
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    public function scopeVigentes($query)
    {
        $now = now()->toDateString();
        return $query->where(function($q) use ($now) {
            $q->whereNull('fecha_vigencia_desde')
              ->orWhere('fecha_vigencia_desde', '<=', $now);
        })->where(function($q) use ($now) {
            $q->whereNull('fecha_vigencia_hasta')
              ->orWhere('fecha_vigencia_hasta', '>=', $now);
        });
    }

    public function scopePorNivelJerarquia($query, $nivel)
    {
        return $query->where('nivel_jerarquia', '>=', $nivel);
    }

    public function scopeSuperAdmins($query)
    {
        return $query->where('es_super_admin', true);
    }

    public function scopeEditables($query)
    {
        return $query->where('es_sistema', false);
    }

    /**
     * Métodos de estado
     */
    public function esActivo()
    {
        return $this->estado === 'activo';
    }

    public function esVigente()
    {
        $now = now()->toDateString();
        $vigenciaDesde = !$this->fecha_vigencia_desde || $this->fecha_vigencia_desde <= $now;
        $vigenciaHasta = !$this->fecha_vigencia_hasta || $this->fecha_vigencia_hasta >= $now;
        
        return $vigenciaDesde && $vigenciaHasta;
    }

    public function puedeCrearUsuarios()
    {
        return $this->puede_crear_usuarios || $this->es_super_admin;
    }

    public function tienePermiso($permiso)
    {
        if ($this->es_super_admin) {
            return true;
        }

        if (!$this->permisos) {
            return false;
        }

        return in_array($permiso, $this->permisos);
    }

    public function tieneAccesoModulo($modulo)
    {
        if ($this->es_super_admin) {
            return true;
        }

        if (!$this->modulos_acceso) {
            return false;
        }

        return in_array($modulo, $this->modulos_acceso);
    }

    /**
     * Accessors
     */
    public function getColorHexAttribute()
    {
        return $this->color ?: '#6B7280';
    }

    public function getCantidadUsuariosAttribute()
    {
        return $this->usuarios()->count();
    }

    public function getPuedeAgregarUsuariosAttribute()
    {
        if (!$this->max_usuarios) {
            return true;
        }

        return $this->cantidad_usuarios < $this->max_usuarios;
    }
}
