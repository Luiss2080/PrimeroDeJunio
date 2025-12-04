<!-- Desktop Table View -->
<div class="table-container desktop-view">
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 40px;">
                    <input type="checkbox" class="custom-checkbox" id="selectAll">
                </th>
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
                    <span class="sortable-header" data-sort="rating">
                        Desempeño
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
                <th>Teléfono</th>
                <th>
                    <span class="sortable-header" data-sort="estado">
                        Estado
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
                    <input type="checkbox" class="row-checkbox" value="{{ $conductor->id }}">
                </td>
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
                    <div class="rating-cell">
                        <div class="star-rating">
                            <span class="star-icon">★</span>
                            <span class="rating-value">{{ number_format($conductor->rating, 1) }}</span>
                        </div>
                        <span class="secondary-text">{{ number_format($conductor->total_viajes) }} viajes</span>
                    </div>
                </td>
                <td>
                    <span class="payment-badge status-{{ $conductor->estado_pago }}">
                        {{ ucfirst(str_replace('_', ' ', $conductor->estado_pago)) }}
                    </span>
                </td>
                <td>
                    <span class="contact-text">{{ $conductor->telefono }}</span>
                </td>
                <td>
                    <span class="status-badge status-{{ $conductor->estado }}">
                        <span class="status-dot"></span>
                        {{ ucfirst($conductor->estado) }}
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
                <td colspan="9" class="text-center py-5">
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
                    <span class="star-icon">★</span> {{ number_format($conductor->rating, 1) }} <span class="text-muted">({{ number_format($conductor->total_viajes) }} viajes)</span>
                </div>
            </div>
            <div class="card-row">
                <span class="card-label">Pago</span>
                <span class="payment-badge status-{{ $conductor->estado_pago }}">
                    {{ ucfirst(str_replace('_', ' ', $conductor->estado_pago)) }}
                </span>
            </div>
            <div class="card-row">
                <span class="card-label">Teléfono</span>
                <span class="card-value">{{ $conductor->telefono }}</span>
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