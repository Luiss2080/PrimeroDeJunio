<!-- Desktop Table View -->
<div class="table-container desktop-view">
    <table class="data-table">
        <thead>
            <tr>
                <th>
                    <span class="sortable-header" data-sort="fecha_hora_inicio">
                        Fecha/Hora
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="sortable-header" data-sort="cliente_nombre">
                        Cliente
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th>Conductor</th>
                <th>Ruta</th>
                <th>
                    <span class="sortable-header" data-sort="estado">
                        Estado
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="sortable-header" data-sort="valor_total">
                        Monto
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th class="text-right">Acciones</th>
            </tr>
        </thead>
        <tbody id="viajesTableBody">
            @forelse($viajes as $viaje)
            <tr class="viaje-row" data-id="{{ $viaje->id }}">
                <td>
                    <div class="info-cell">
                        <span class="primary-text">{{ $viaje->fecha_hora_inicio ? $viaje->fecha_hora_inicio->format('d/m/Y') : 'N/A' }}</span>
                        <span class="secondary-text">{{ $viaje->fecha_hora_inicio ? $viaje->fecha_hora_inicio->format('H:i') : 'N/A' }}</span>
                    </div>
                </td>
                <td>
                    <div class="info-cell">
                        <span class="primary-text">{{ $viaje->cliente_nombre }}</span>
                        <span class="secondary-text">{{ $viaje->cliente_telefono }}</span>
                    </div>
                </td>
                <td>
                    @if($viaje->conductor)
                        <div class="driver-info-mini">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($viaje->conductor->nombre . ' ' . $viaje->conductor->apellido) }}&background=00ff66&color=000&size=32" alt="Avatar" class="driver-avatar-mini">
                            <div class="driver-details">
                                <span class="driver-name">{{ $viaje->conductor->nombre }} {{ $viaje->conductor->apellido }}</span>
                                @if($viaje->vehiculo)
                                    <span class="vehicle-plate">{{ $viaje->vehiculo->placa }}</span>
                                @endif
                            </div>
                        </div>
                    @else
                        <span class="text-muted">Sin asignar</span>
                    @endif
                </td>
                <td>
                    <div class="route-info">
                        <div class="route-point">
                            <span class="point-dot origin"></span>
                            <span class="point-text" title="{{ $viaje->origen }}">{{ Str::limit($viaje->origen, 20) }}</span>
                        </div>
                        <div class="route-line"></div>
                        <div class="route-point">
                            <span class="point-dot destination"></span>
                            <span class="point-text" title="{{ $viaje->destino }}">{{ Str::limit($viaje->destino, 20) }}</span>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="status-badge status-{{ $viaje->estado }}">
                        <span class="status-dot"></span>
                        {{ ucfirst($viaje->estado) }}
                    </span>
                </td>
                <td>
                    <div class="amount-cell">
                        <span class="amount-value">Bs. {{ number_format($viaje->valor_total, 2) }}</span>
                        <span class="payment-method">{{ ucfirst($viaje->metodo_pago) }}</span>
                    </div>
                </td>
                <td>
                    <div class="action-buttons justify-end">
                        <a href="{{ route('viajes.show', $viaje->id) }}" class="btn-icon btn-view" title="Ver Detalles">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                        <a href="{{ route('viajes.edit', $viaje->id) }}" class="btn-icon btn-edit" title="Editar">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </a>
                        <button class="btn-icon btn-delete" title="Eliminar" onclick="openDeleteModal('{{ route('viajes.destroy', $viaje->id) }}', 'Viaje #{{ $viaje->id }}')">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-5">
                    <div class="empty-state-container">
                        <div class="empty-icon-wrapper">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                        <h3 class="empty-title">No se encontraron viajes</h3>
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
    @forelse($viajes as $viaje)
    <div class="driver-card viaje-card" data-id="{{ $viaje->id }}">
        <div class="card-header">
            <div class="driver-main-info">
                <div class="date-badge">
                    <span class="day">{{ $viaje->fecha_hora_inicio ? $viaje->fecha_hora_inicio->format('d') : '--' }}</span>
                    <span class="month">{{ $viaje->fecha_hora_inicio ? $viaje->fecha_hora_inicio->format('M') : '--' }}</span>
                </div>
                <div>
                    <h3 class="card-name">{{ $viaje->cliente_nombre }}</h3>
                    <span class="card-id">#VJ-{{ str_pad($viaje->id, 4, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
            <div class="card-actions-direct">
                <a href="{{ route('viajes.show', $viaje->id) }}" class="btn-icon-sm btn-view">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </a>
                <a href="{{ route('viajes.edit', $viaje->id) }}" class="btn-icon-sm btn-edit">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="card-row">
                <span class="card-label">Estado</span>
                <span class="status-badge status-{{ $viaje->estado }} sm">
                    <span class="status-dot"></span>
                    {{ ucfirst($viaje->estado) }}
                </span>
            </div>
            <div class="card-row">
                <span class="card-label">Ruta</span>
                <div class="route-mini">
                    <span class="route-text">{{ Str::limit($viaje->origen, 15) }} → {{ Str::limit($viaje->destino, 15) }}</span>
                </div>
            </div>
            <div class="card-row">
                <span class="card-label">Conductor</span>
                @if($viaje->conductor)
                    <span class="card-value">{{ $viaje->conductor->nombre }} {{ $viaje->conductor->apellido }}</span>
                @else
                    <span class="card-value text-muted">Sin asignar</span>
                @endif
            </div>
            <div class="card-row">
                <span class="card-label">Monto</span>
                <span class="amount-value-sm">Bs. {{ number_format($viaje->valor_total, 2) }}</span>
            </div>
        </div>
    </div>
    @empty
    <div class="empty-state-mobile">
        <div class="empty-icon-wrapper">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </div>
        <p>No se encontraron viajes</p>
    </div>
    @endforelse
</div>

<div class="pagination-container">
    {{ $viajes->appends(request()->except('page'))->links('vendor.pagination.custom') }}
</div>
