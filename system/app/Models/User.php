<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\View\Composers\SidebarComposer;
use App\Traits\Auditable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        // Información personal básica
        'nombre',
        'apellido', 
        'email',
        'password',
        'telefono',
        'telefono_emergencia',
        'direccion',
        'ciudad',
        'departamento',
        'codigo_postal',
        'fecha_nacimiento',
        'genero',
        'cedula',
        'avatar',
        
        // Información laboral
        'rol_id',
        'fecha_ingreso',
        'numero_empleado',
        'salario_base',
        'turno_preferido',
        'disponible_fines_semana',
        'notas_empleado',
        
        // Estado y seguridad
        'estado',
        'ultimo_acceso',
        'last_login_ip',
        'intentos_login_fallidos',
        'bloqueado_hasta',
        'token_recuperacion',
        'token_expiracion',
        'email_verified_at',
        'password_changed_at',
        'requiere_cambio_password',
        
        // Configuraciones de usuario
        'tema_preferido',
        'idioma',
        'preferencias_notificaciones',
        'recibir_emails_promocionales',
        'zona_horaria',
        
        // Auditoría
        'creado_por',
        'actualizado_por',
        'fecha_baja',
        'motivo_baja',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'token_recuperacion',
        'salario_base', // Información sensible
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'fecha_nacimiento' => 'date',
            'fecha_ingreso' => 'date',
            'ultimo_acceso' => 'datetime',
            'bloqueado_hasta' => 'datetime',
            'token_expiracion' => 'datetime',
            'password_changed_at' => 'datetime',
            'fecha_baja' => 'datetime',
            'salario_base' => 'decimal:2',
            'disponible_fines_semana' => 'boolean',
            'requiere_cambio_password' => 'boolean',
            'recibir_emails_promocionales' => 'boolean',
            'preferencias_notificaciones' => 'array',
            'intentos_login_fallidos' => 'integer',
        ];
    }
    /**
     * Relación con el rol del usuario
     */
    public function rol()
    {
        return $this->belongsTo(Role::class, 'rol_id');
    }

    /**
     * Usuario que creó este registro
     */
    public function creador()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }

    /**
     * Usuario que actualizó este registro por última vez
     */
    public function actualizador()
    {
        return $this->belongsTo(User::class, 'actualizado_por');
    }

    /**
     * Usuarios creados por este usuario
     */
    public function usuariosCreados()
    {
        return $this->hasMany(User::class, 'creado_por');
    }

    /**
     * Obtiene el nombre completo del usuario
     */
    public function getNombreCompletoAttribute()
    {
        return trim($this->nombre . ' ' . $this->apellido);
    }

    /**
     * Obtiene la edad del usuario
     */
    public function getEdadAttribute()
    {
        if (!$this->fecha_nacimiento) {
            return null;
        }
        return $this->fecha_nacimiento->diffInYears(now());
    }

    /**
     * Verifica si el usuario está activo
     */
    public function isActivo()
    {
        return $this->estado === 'activo';
    }

    /**
     * Verifica si el usuario está bloqueado
     */
    public function isBloqueado()
    {
        return $this->bloqueado_hasta && $this->bloqueado_hasta->isFuture();
    }

    /**
     * Obtiene los años de servicio
     */
    public function getAnosServicioAttribute()
    {
        if (!$this->fecha_ingreso) {
            return null;
        }
        return $this->fecha_ingreso->diffInYears(now());
    }

    /**
     * Obtiene la dirección completa
     */
    public function getDireccionCompletaAttribute()
    {
        $direccion = $this->direccion;
        if ($this->ciudad) {
            $direccion .= ', ' . $this->ciudad;
        }
        if ($this->departamento) {
            $direccion .= ', ' . $this->departamento;
        }
        return $direccion;
    }

    /**
     * Scopes
     */
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    public function scopePorRol($query, $rolNombre)
    {
        return $query->whereHas('rol', function ($q) use ($rolNombre) {
            $q->where('nombre', $rolNombre);
        });
    }

    public function scopeDisponiblesFinesDeSemana($query)
    {
        return $query->where('disponible_fines_semana', true);
    }

    public function scopeConTelefono($query)
    {
        return $query->whereNotNull('telefono');
    }

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
