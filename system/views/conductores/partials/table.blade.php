<!-- Desktop Table View -->
<div class="table-container desktop-view">
    <table class="data-table">
        <thead>
            <tr>
                <th>
                    <span class="sortable-header" data-sort="nombre">
                        Conductor 
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th>ID / CI</th>
                <th>
                    <span class="sortable-header" data-sort="chaleco_id">
                        Chaleco
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="sortable-header" data-sort="rating">
                        Desempeño
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="sortable-header" data-sort="experiencia_anos">
                        Experiencia
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="sortable-header" data-sort="estado_pago">
                        Estado Pago
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th>Contacto</th>
                <th>
                    <span class="sortable-header" data-sort="estado">
                        Estado
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="sortable-header" data-sort="estado_operativo">
                        Operativo
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th>Vehículo</th>
                <th class="text-right">Acciones</th>
            </tr>
        </thead>
        <tbody id="conductoresTableBody">
            @forelse($conductores as $conductor)
            <tr class="conductor-row" data-id="{{ $conductor->id }}">
                <td>
                    <div class="driver-info">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($conductor->nombre . ' ' . $conductor->apellido) }}&background=00ff66&color=000" alt="Avatar" class="driver-avatar">
                        <div>
                            <span class="driver-name">{{ $conductor->nombre }} {{ $conductor->apellido }}</span>
                            <span class="driver-role">Conductor</span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="info-cell">
                        <span class="primary-text">{{ $conductor->cedula }}</span>
                        <span class="secondary-text">ID: #{{ str_pad($conductor->id, 3, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </td>
                <td>
                    <div class="chaleco-cell">
                        @if($conductor->chaleco)
                            <span class="chaleco-badge chaleco-asignado">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path>
                                    <line x1="16" y1="8" x2="2" y2="22"></line>
                                    <line x1="17.5" y1="15" x2="9" y2="15"></line>
                                </svg>
                                {{ $conductor->chaleco->cod_chaleco }}
                            </span>
                            <span class="secondary-text">
                                Asignado {{ $conductor->fecha_asignacion_chaleco && $conductor->fecha_asignacion_chaleco instanceof \Carbon\Carbon ? $conductor->fecha_asignacion_chaleco->diffForHumans() : 'recientemente' }}
                            </span>
                        @else
                            <span class="chaleco-badge chaleco-sin-asignar">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                </svg>
                                Sin asignar
                            </span>
                        @endif
                    </div>
                </td>
                <td>
                    <div class="rating-cell">
                        <div class="star-rating">
                            <span class="star-icon">★</span>
                            <span class="rating-value">{{ number_format($conductor->rating, 1) }}</span>
                        </div>
                        <span class="secondary-text">
                            {{ number_format($conductor->total_viajes) }} viajes 
                            @if($conductor->viajes_completados > 0)
                                • {{ round(($conductor->viajes_completados / $conductor->total_viajes) * 100) }}% éxito
                            @endif
                        </span>
                    </div>
                </td>
                <td>
                    <div class="experience-cell">
                        <span class="experience-years">{{ $conductor->experiencia_anos }} años</span>
                        <span class="secondary-text">
                            @if($conductor->experiencia_anos == 0)
                                Nuevo conductor
                            @elseif($conductor->experiencia_anos <= 2)
                                Principiante
                            @elseif($conductor->experiencia_anos <= 5)
                                Experimentado
                            @else
                                Experto
                            @endif
                        </span>
                    </div>
                </td>
                <td>
                    <div class="payment-status-cell">
                        <span class="payment-badge status-{{ $conductor->estado_pago }}">
                            {{ ucfirst(str_replace('_', ' ', $conductor->estado_pago)) }}
                        </span>
                        @if($conductor->saldo_pendiente > 0)
                            <span class="secondary-text">Saldo: ${{ number_format($conductor->saldo_pendiente, 0) }}</span>
                        @endif
                    </div>
                </td>
                <td>
                    <div class="contact-cell">
                        <span class="contact-text">{{ $conductor->telefono }}</span>
                        @if($conductor->telefono_secundario)
                            <span class="secondary-text">{{ $conductor->telefono_secundario }}</span>
                        @endif
                    </div>
                </td>
                <td>
                    <span class="status-badge status-{{ $conductor->estado }}">
                        <span class="status-dot"></span>
                        {{ ucfirst($conductor->estado) }}
                    </span>
                </td>
                <td>
                    <span class="operational-badge status-{{ $conductor->estado_operativo }}">
                        <span class="operational-dot"></span>
                        {{ ucfirst(str_replace('_', ' ', $conductor->estado_operativo)) }}
                    </span>
                </td>
                <td>
                    @if($conductor->asignaciones->where('estado', 'activa')->first())
                        @php $vehiculo = $conductor->asignaciones->where('estado', 'activa')->first()->vehiculo; @endphp
                        <div class="vehicle-info-cell">
                            <span class="vehicle-plate">{{ $vehiculo->placa }}</span>
                            <span class="vehicle-desc">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</span>
                        </div>
                    @else
                        <span class="no-vehicle">Sin asignar</span>
                    @endif
                </td>
                <td>
                    <div class="action-buttons justify-end">
                        <a href="{{ route('conductores.show', $conductor->id) }}" class="btn-icon btn-view" title="Ver Perfil">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                        <a href="{{ route('conductores.edit', $conductor->id) }}" class="btn-icon btn-edit" title="Editar">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </a>
                        <button class="btn-icon btn-delete" title="Eliminar" data-delete-url="{{ route('conductores.destroy', $conductor->id) }}" data-conductor-name="{{ $conductor->nombre }} {{ $conductor->apellido }}">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center py-5">
                    <div class="empty-state-container">
                        <div class="empty-icon-wrapper">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                        <h3 class="empty-title">No se encontraron conductores</h3>
                        <p class="empty-desc">Intenta ajustar los filtros o términos de búsqueda.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="pagination-container">
    {{ $conductores->appends(request()->except('page'))->links('pages.conductores') }}
</div>

<!-- Mobile Card View -->
<div class="mobile-cards-view">
    @forelse($conductores as $conductor)
    <div class="driver-card conductor-card" data-id="{{ $conductor->id }}">
        <div class="card-header">
            <div class="driver-main-info">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($conductor->nombre . ' ' . $conductor->apellido) }}&background=00ff66&color=000" alt="Avatar" class="card-avatar">
                <div>
                    <h3 class="card-name">{{ $conductor->nombre }} {{ $conductor->apellido }}</h3>
                    <span class="card-id">ID: #{{ str_pad($conductor->id, 3, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
            <div class="card-actions-direct">
                <a href="{{ route('conductores.show', $conductor->id) }}" class="btn-icon-sm btn-view">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </a>
                <a href="{{ route('conductores.edit', $conductor->id) }}" class="btn-icon-sm btn-edit">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </a>
                <button class="btn-icon-sm btn-delete" data-delete-url="{{ route('conductores.destroy', $conductor->id) }}" data-conductor-name="{{ $conductor->nombre }} {{ $conductor->apellido }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                </button>
            </div>
        </div>
        
        <div class="card-body">
            <div class="card-row">
                <span class="card-label">Estado</span>
                <span class="status-badge status-{{ $conductor->estado }} sm">
                    <span class="status-dot"></span>
                    {{ ucfirst($conductor->estado) }}
                </span>
            </div>
            <div class="card-row">
                <span class="card-label">Desempeño</span>
                <div class="rating-cell">
                    <span class="star-icon">★</span> {{ number_format($conductor->rating, 1) }} 
                    <span class="text-muted">
                        ({{ number_format($conductor->total_viajes) }} viajes
                        @if($conductor->viajes_completados > 0) 
                            • {{ round(($conductor->viajes_completados / $conductor->total_viajes) * 100) }}% éxito
                        @endif)
                    </span>
                </div>
            </div>
            <div class="card-row">
                <span class="card-label">Experiencia</span>
                <span class="card-value">{{ $conductor->experiencia_anos }} años</span>
            </div>
            <div class="card-row">
                <span class="card-label">Estado Operativo</span>
                <span class="operational-badge status-{{ $conductor->estado_operativo }}">
                    {{ ucfirst(str_replace('_', ' ', $conductor->estado_operativo)) }}
                </span>
            </div>
            <div class="card-row">
                <span class="card-label">Estado Pago</span>
                <div>
                    <span class="payment-badge status-{{ $conductor->estado_pago }}">
                        {{ ucfirst(str_replace('_', ' ', $conductor->estado_pago)) }}
                    </span>
                    @if($conductor->saldo_pendiente > 0)
                        <span class="text-muted d-block">Saldo: ${{ number_format($conductor->saldo_pendiente, 0) }}</span>
                    @endif
                </div>
            </div>
            <div class="card-row">
                <span class="card-label">Contacto</span>
                <div>
                    <span class="card-value">{{ $conductor->telefono }}</span>
                    @if($conductor->telefono_secundario)
                        <span class="text-muted d-block">{{ $conductor->telefono_secundario }}</span>
                    @endif
                </div>
            </div>
            <div class="card-row">
                <span class="card-label">Vehículo</span>
                @if($conductor->asignaciones->where('estado', 'activa')->first())
                    @php $vehiculo = $conductor->asignaciones->where('estado', 'activa')->first()->vehiculo; @endphp
                    <span class="card-value highlight">{{ $vehiculo->placa }}</span>
                @else
                    <span class="card-value text-muted">Sin asignar</span>
                @endif
            </div>
            <div class="card-row">
                <span class="card-label">Chaleco</span>
                @if($conductor->chaleco)
                    <span class="card-value chaleco-asignado">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path>
                            <line x1="16" y1="8" x2="2" y2="22"></line>
                            <line x1="17.5" y1="15" x2="9" y2="15"></line>
                        </svg>
                        {{ $conductor->chaleco->cod_chaleco }}
                    </span>
                @else
                    <span class="card-value text-muted">Sin asignar</span>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="empty-state-mobile">
        <div class="empty-icon-wrapper">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </div>
        <p>No se encontraron conductores</p>
    </div>
    @endforelse
</div>

<script>
// Manejar botones de eliminación con data attributes
document.addEventListener('click', function(e) {
    if (e.target.closest('.btn-delete')) {
        const button = e.target.closest('.btn-delete');
        const deleteUrl = button.getAttribute('data-delete-url');
        const conductorName = button.getAttribute('data-conductor-name');
        
        if (typeof openDeleteModal === 'function') {
            openDeleteModal(deleteUrl, conductorName);
        } else {
            // Fallback si no existe la función global
            if (confirm(`¿Estás seguro de que deseas eliminar a ${conductorName}?`)) {
                fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                }).then(response => {
                    if (response.ok) {
                        location.reload();
                    } else {
                        alert('Error al eliminar el conductor');
                    }
                });
            }
        }
    }
});
</script>