<!-- Desktop Table View -->
<div class="table-container desktop-view">
    <table class="data-table">
        <thead>
            <tr>
                <th>
                    <span class="sortable-header" data-sort="placa">
                        Placa
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="sortable-header" data-sort="marca">
                        Vehículo
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="sortable-header" data-sort="ano">
                        Año
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th>Propietario</th>
                <th>
                    <span class="sortable-header" data-sort="estado">
                        Estado
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th class="text-right">Acciones</th>
            </tr>
        </thead>
        <tbody id="vehiculosTableBody">
            @forelse($vehiculos as $vehiculo)
            <tr class="vehiculo-row" data-id="{{ $vehiculo->id }}">
                <td>
                    <div class="info-cell">
                        <span class="primary-text">{{ $vehiculo->placa }}</span>
                        <span class="secondary-text">ID: #{{ str_pad($vehiculo->id, 3, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </td>
                <td>
                    <div class="vehicle-info-cell">
                        <span class="vehicle-desc">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</span>
                        <span class="secondary-text">{{ $vehiculo->color }}</span>
                    </div>
                </td>
                <td>
                    <span class="text-muted">{{ $vehiculo->ano }}</span>
                </td>
                <td>
                    <div class="driver-info">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($vehiculo->propietario_nombre) }}&background=00ff66&color=000" alt="Avatar" class="driver-avatar">
                        <div>
                            <span class="driver-name">{{ $vehiculo->propietario_nombre }}</span>
                            <span class="secondary-text">{{ $vehiculo->propietario_telefono }}</span>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="status-badge status-{{ $vehiculo->estado }}">
                        <span class="status-dot"></span>
                        {{ ucfirst($vehiculo->estado) }}
                    </span>
                </td>
                <td>
                    <div class="action-buttons justify-end">
                        <a href="{{ route('vehiculos.show', $vehiculo->id) }}" class="btn-icon btn-view" title="Ver Perfil">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                        <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="btn-icon btn-edit" title="Editar">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </a>
                        <button class="btn-icon btn-delete" title="Eliminar" data-delete-url="{{ route('vehiculos.destroy', $vehiculo->id) }}" data-vehiculo-name="{{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->placa }})">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-5">
                    <div class="empty-state-container">
                        <div class="empty-icon-wrapper">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                        <h3 class="empty-title">No se encontraron vehículos</h3>
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
    @forelse($vehiculos as $vehiculo)
    <div class="driver-card vehiculo-card" data-id="{{ $vehiculo->id }}">
        <div class="card-header">
            <div class="driver-main-info">
                <div class="vehicle-icon-wrapper">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 16H9m10 0h3v-3.15M5 16H2v-3.15M7 16h10M5 16v-3.15a3 3 0 0 1 .45-1.55l2.65-4.4a3 3 0 0 1 2.55-1.45h2.7a3 3 0 0 1 2.55 1.45l2.65 4.4a3 3 0 0 1 .45 1.55v3.15M16 8h-8"/></svg>
                </div>
                <div>
                    <h3 class="card-name">{{ $vehiculo->placa }}</h3>
                    <span class="card-id">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</span>
                </div>
            </div>
            <div class="card-actions-direct">
                <a href="{{ route('vehiculos.show', $vehiculo->id) }}" class="btn-icon-sm btn-view">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </a>
                <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="btn-icon-sm btn-edit">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </a>
                <button class="btn-icon-sm btn-delete" data-delete-url="{{ route('vehiculos.destroy', $vehiculo->id) }}" data-vehiculo-name="{{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->placa }})">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                </button>
            </div>
        </div>
        
        <div class="card-body">
            <div class="card-row">
                <span class="card-label">Estado</span>
                <span class="status-badge status-{{ $vehiculo->estado }} sm">
                    <span class="status-dot"></span>
                    {{ ucfirst($vehiculo->estado) }}
                </span>
            </div>
            <div class="card-row">
                <span class="card-label">Año</span>
                <span class="card-value">{{ $vehiculo->ano }}</span>
            </div>
            <div class="card-row">
                <span class="card-label">Propietario</span>
                <span class="card-value">{{ $vehiculo->propietario_nombre }}</span>
            </div>
            <div class="card-row">
                <span class="card-label">Color</span>
                <span class="card-value">{{ $vehiculo->color }}</span>
            </div>
        </div>
    </div>
    @empty
    <div class="empty-state-mobile">
        <div class="empty-icon-wrapper">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </div>
        <p>No se encontraron vehículos</p>
    </div>
    @endforelse
</div>

<div class="pagination-container">
    {{ $vehiculos->appends(request()->except('page'))->links('pages.vehiculos') }}
</div>

<script>
// Manejar botones de eliminación con data attributes
document.addEventListener('click', function(e) {
    if (e.target.closest('.btn-delete')) {
        const button = e.target.closest('.btn-delete');
        const deleteUrl = button.getAttribute('data-delete-url');
        const vehiculoName = button.getAttribute('data-vehiculo-name');
        
        if (typeof openDeleteModal === 'function') {
            openDeleteModal(deleteUrl, vehiculoName);
        } else {
            // Fallback si no existe la función global
            if (confirm(`¿Estás seguro de que deseas eliminar a ${vehiculoName}?`)) {
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
                        alert('Error al eliminar el vehículo');
                    }
                });
            }
        }
    }
});
</script>
