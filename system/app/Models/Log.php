<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'usuario_nombre',
        'usuario_email',
        'tipo_accion',
        'accion_detalle',
        'nivel',
        'tabla_afectada',
        'registro_id',
        'registro_descripcion',
        'datos_anteriores',
        'datos_nuevos',
        'campos_modificados',
        'ip_address',
        'user_agent',
        'session_id',
        'request_id',
        'modulo',
        'metodo_http',
        'url',
        'parametros_request',
        'duracion_ms',
        'requiere_atencion',
        'revisado_at',
        'revisado_por',
        'notas_revision',
    ];

    protected $casts = [
        'datos_anteriores' => 'array',
        'datos_nuevos' => 'array',
        'campos_modificados' => 'array',
        'parametros_request' => 'array',
        'revisado_at' => 'datetime',
        'requiere_atencion' => 'boolean',
        'duracion_ms' => 'integer',
    ];

    /**
     * Relación con el usuario que realizó la acción
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    /**
     * Usuario que revisó el log
     */
    public function revisor()
    {
        return $this->belongsTo(User::class, 'revisado_por');
    }

    /**
     * Scopes para filtrar logs
     */
    public function scopePorUsuario($query, $usuarioId)
    {
        return $query->where('usuario_id', $usuarioId);
    }

    public function scopePorTabla($query, $tabla)
    {
        return $query->where('tabla_afectada', $tabla);
    }

    public function scopePorRegistro($query, $tabla, $registroId)
    {
        return $query->where('tabla_afectada', $tabla)
                    ->where('registro_id', $registroId);
    }

    public function scopePorTipoAccion($query, $tipoAccion)
    {
        return $query->where('tipo_accion', $tipoAccion);
    }

    public function scopePorModulo($query, $modulo)
    {
        return $query->where('modulo', $modulo);
    }

    public function scopePorNivel($query, $nivel)
    {
        return $query->where('nivel', $nivel);
    }

    public function scopeRequierenAtencion($query)
    {
        return $query->where('requiere_atencion', true);
    }

    public function scopeHoy($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeUltimaSemana($query)
    {
        return $query->where('created_at', '>=', now()->subWeek());
    }

    public function scopeUltimoMes($query)
    {
        return $query->where('created_at', '>=', now()->subMonth());
    }

    /**
     * Obtiene los cambios en formato legible
     */
    public function getCambiosLegiblesAttribute()
    {
        if (!$this->campos_modificados) {
            return null;
        }

        $cambios = [];
        foreach ($this->campos_modificados as $campo) {
            $valorAnterior = $this->datos_anteriores[$campo] ?? 'N/A';
            $valorNuevo = $this->datos_nuevos[$campo] ?? 'N/A';
            
            $cambios[] = [
                'campo' => $this->traducirNombreCampo($campo),
                'anterior' => $valorAnterior,
                'nuevo' => $valorNuevo,
            ];
        }

        return $cambios;
    }

    /**
     * Traduce nombres de campos técnicos a legibles
     */
    private function traducirNombreCampo($campo)
    {
        $traducciones = [
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'email' => 'Correo Electrónico',
            'telefono' => 'Teléfono',
            'estado' => 'Estado',
            'direccion' => 'Dirección',
            'fecha_nacimiento' => 'Fecha de Nacimiento',
            'placa' => 'Placa',
            'marca' => 'Marca',
            'modelo' => 'Modelo',
            'color' => 'Color',
            'valor_total' => 'Valor Total',
            'origen' => 'Origen',
            'destino' => 'Destino',
            'conductor_id' => 'Conductor',
            'vehiculo_id' => 'Vehículo',
            'cliente_id' => 'Cliente',
            'salario_base' => 'Salario Base',
            'rol_id' => 'Rol',
            'cedula' => 'Cédula',
            'descripcion' => 'Descripción',
            'permisos' => 'Permisos',
        ];

        return $traducciones[$campo] ?? ucfirst(str_replace('_', ' ', $campo));
    }

    /**
     * Obtiene el color del nivel para UI
     */
    public function getColorNivelAttribute()
    {
        $colores = [
            'info' => 'blue',
            'warning' => 'yellow',
            'error' => 'red',
            'critical' => 'red',
        ];

        return $colores[$this->nivel] ?? 'gray';
    }

    /**
     * Obtiene el icono del tipo de acción
     */
    public function getIconoAccionAttribute()
    {
        $iconos = [
            'crear' => 'plus-circle',
            'actualizar' => 'pencil',
            'eliminar' => 'trash',
            'login' => 'login',
            'logout' => 'logout',
            'login_fallido' => 'x-circle',
            'cambio_password' => 'key',
            'recuperar_password' => 'mail',
            'asignar_vehiculo' => 'truck',
            'crear_viaje' => 'map-pin',
            'finalizar_viaje' => 'check-circle',
            'pago_realizado' => 'credit-card',
            'mantenimiento_programado' => 'tool',
            'exportar_datos' => 'download',
            'sistema' => 'cpu',
            'configuracion' => 'settings',
            'backup' => 'hard-drive',
        ];

        return $iconos[$this->tipo_accion] ?? 'activity';
    }

    /**
     * Marca el log como revisado
     */
    public function marcarComoRevisado($notas = null)
    {
        $this->update([
            'revisado_at' => now(),
            'revisado_por' => auth()->id(),
            'notas_revision' => $notas,
            'requiere_atencion' => false,
        ]);
    }

    /**
     * Estadísticas de logs
     */
    public static function estadisticasHoy()
    {
        return [
            'total' => static::hoy()->count(),
            'errores' => static::hoy()->where('nivel', 'error')->count(),
            'warnings' => static::hoy()->where('nivel', 'warning')->count(),
            'crear' => static::hoy()->where('tipo_accion', 'crear')->count(),
            'actualizar' => static::hoy()->where('tipo_accion', 'actualizar')->count(),
            'eliminar' => static::hoy()->where('tipo_accion', 'eliminar')->count(),
            'requieren_atencion' => static::hoy()->requierenAtencion()->count(),
        ];
    }

    /**
     * Logs más activos por tabla
     */
    public static function tablasMasActivas($limite = 10)
    {
        return static::selectRaw('tabla_afectada, COUNT(*) as total')
                    ->whereNotNull('tabla_afectada')
                    ->where('created_at', '>=', now()->subDays(7))
                    ->groupBy('tabla_afectada')
                    ->orderByDesc('total')
                    ->limit($limite)
                    ->get();
    }

    /**
     * Usuarios más activos
     */
    public static function usuariosMasActivos($limite = 10)
    {
        return static::selectRaw('usuario_id, usuario_nombre, COUNT(*) as total')
                    ->whereNotNull('usuario_id')
                    ->where('created_at', '>=', now()->subDays(7))
                    ->groupBy('usuario_id', 'usuario_nombre')
                    ->orderByDesc('total')
                    ->limit($limite)
                    ->get();
    }
}