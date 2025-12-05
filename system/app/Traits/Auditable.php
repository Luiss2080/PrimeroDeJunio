<?php

namespace App\Traits;

use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait Auditable
{
    /**
     * Boot the trait
     */
    protected static function bootAuditable()
    {
        static::creating(function ($model) {
            $model->auditCreating();
        });

        static::created(function ($model) {
            $model->logActivity('crear', null, $model->getAuditableAttributes());
        });

        static::updating(function ($model) {
            $model->auditUpdating();
        });

        static::updated(function ($model) {
            $original = $model->getOriginal();
            $changes = $model->getChanges();
            
            if (!empty($changes)) {
                // Remover campos que no queremos auditar
                unset($changes['updated_at']);
                
                if (!empty($changes)) {
                    $model->logActivity('actualizar', 
                        array_intersect_key($original, $changes), 
                        array_intersect_key($model->getAttributes(), $changes),
                        array_keys($changes)
                    );
                }
            }
        });

        static::deleted(function ($model) {
            $model->logActivity('eliminar', $model->getAuditableAttributes(), null);
        });
    }

    /**
     * Maneja la auditoría al crear
     */
    protected function auditCreating()
    {
        if (Auth::check()) {
            $this->creado_por = Auth::id();
        }
    }

    /**
     * Maneja la auditoría al actualizar
     */
    protected function auditUpdating()
    {
        if (Auth::check()) {
            $this->actualizado_por = Auth::id();
        }
    }

    /**
     * Registra la actividad en los logs
     */
    protected function logActivity($action, $before = null, $after = null, $changedFields = null)
    {
        try {
            $user = Auth::user();
            
            Log::create([
                'usuario_id' => $user ? $user->id : null,
                'usuario_nombre' => $user ? $user->nombre_completo : 'Sistema',
                'usuario_email' => $user ? $user->email : null,
                'tipo_accion' => $action,
                'accion_detalle' => $this->getActionDescription($action),
                'nivel' => 'info',
                'tabla_afectada' => $this->getTable(),
                'registro_id' => $this->getKey(),
                'registro_descripcion' => $this->getAuditDescription(),
                'datos_anteriores' => $before ? json_encode($before) : null,
                'datos_nuevos' => $after ? json_encode($after) : null,
                'campos_modificados' => $changedFields ? json_encode($changedFields) : null,
                'ip_address' => Request::ip(),
                'user_agent' => Request::header('User-Agent'),
                'session_id' => session()->getId(),
                'modulo' => $this->getModuleName(),
                'metodo_http' => Request::method(),
                'url' => Request::fullUrl(),
                'parametros_request' => json_encode(Request::except(['password', '_token', '_method'])),
            ]);
        } catch (\Exception $e) {
            // Log silencioso - no fallar la operación principal si falla el audit
            \Log::error('Error en auditoría: ' . $e->getMessage());
        }
    }

    /**
     * Obtiene una descripción de la acción
     */
    protected function getActionDescription($action)
    {
        $descriptions = [
            'crear' => 'Registro creado',
            'actualizar' => 'Registro actualizado', 
            'eliminar' => 'Registro eliminado',
        ];

        $modelName = class_basename($this);
        $baseDescription = $descriptions[$action] ?? 'Acción realizada';
        
        return "{$baseDescription} en {$modelName}";
    }

    /**
     * Obtiene una descripción del registro para auditoría
     */
    protected function getAuditDescription()
    {
        $model = class_basename($this);
        
        // Intentar diferentes campos para la descripción
        $descriptionFields = ['nombre', 'titulo', 'descripcion', 'email', 'placa', 'codigo'];
        
        foreach ($descriptionFields as $field) {
            if (isset($this->attributes[$field])) {
                return "{$model} #{$this->getKey()}: {$this->attributes[$field]}";
            }
        }

        // Si es un modelo con nombre y apellido
        if (isset($this->attributes['nombre']) && isset($this->attributes['apellido'])) {
            return "{$model} #{$this->getKey()}: {$this->attributes['nombre']} {$this->attributes['apellido']}";
        }

        return "{$model} #{$this->getKey()}";
    }

    /**
     * Obtiene el nombre del módulo
     */
    protected function getModuleName()
    {
        $model = class_basename($this);
        
        $modules = [
            'User' => 'usuarios',
            'Cliente' => 'clientes',
            'Conductor' => 'conductores',
            'Vehiculo' => 'vehiculos',
            'Viaje' => 'viajes',
            'Role' => 'roles',
            'Tarifa' => 'tarifas',
            'Configuracion' => 'configuraciones',
            'Mantenimiento' => 'mantenimientos',
            'GastoOperativo' => 'gastos',
            'Documento' => 'documentos',
            'ReporteIncidente' => 'incidentes',
            'Turno' => 'turnos',
            'PagoConductor' => 'pagos',
        ];

        return $modules[$model] ?? strtolower($model);
    }

    /**
     * Obtiene los atributos auditables (excluyendo campos sensibles)
     */
    protected function getAuditableAttributes()
    {
        $attributes = $this->getAttributes();
        
        // Campos a excluir de la auditoría
        $excluded = [
            'password', 'remember_token', 'token_recuperacion', 
            'created_at', 'updated_at', 'deleted_at'
        ];

        return array_diff_key($attributes, array_flip($excluded));
    }

    /**
     * Relación con el usuario que creó el registro
     */
    public function creador()
    {
        return $this->belongsTo(\App\Models\User::class, 'creado_por');
    }

    /**
     * Relación con el usuario que actualizó el registro
     */
    public function actualizador()
    {
        return $this->belongsTo(\App\Models\User::class, 'actualizado_por');
    }

    /**
     * Obtiene el historial de logs para este registro
     */
    public function logs()
    {
        return Log::where('tabla_afectada', $this->getTable())
                  ->where('registro_id', $this->getKey())
                  ->orderBy('created_at', 'desc');
    }

    /**
     * Registra un log personalizado
     */
    public function logCustomActivity($action, $description = null, $level = 'info', $additionalData = [])
    {
        $user = Auth::user();
        
        $logData = array_merge([
            'usuario_id' => $user ? $user->id : null,
            'usuario_nombre' => $user ? $user->nombre_completo : 'Sistema',
            'usuario_email' => $user ? $user->email : null,
            'tipo_accion' => 'sistema',
            'accion_detalle' => $description ?? $action,
            'nivel' => $level,
            'tabla_afectada' => $this->getTable(),
            'registro_id' => $this->getKey(),
            'registro_descripcion' => $this->getAuditDescription(),
            'ip_address' => Request::ip(),
            'user_agent' => Request::header('User-Agent'),
            'session_id' => session()->getId(),
            'modulo' => $this->getModuleName(),
            'metodo_http' => Request::method(),
            'url' => Request::fullUrl(),
        ], $additionalData);

        return Log::create($logData);
    }
}