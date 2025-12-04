<!-- Desktop Table View -->
<div class="table-container desktop-view">
    <table class="data-table">
        <thead>
            <tr>
                <th>
                    <span class="sortable-header" data-sort="nombre">
                        Usuario 
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>
                    <span class="sortable-header" data-sort="rol_id">
                        Rol
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="sortable-header" data-sort="estado">
                        Estado
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="sortable-header" data-sort="created_at">
                        Fecha Registro
                        <svg class="sort-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </span>
                </th>
                <th class="text-right">Acciones</th>
            </tr>
        </thead>
        <tbody id="usuariosTableBody">
            @forelse($usuarios as $usuario)
            <tr class="usuario-row" data-id="{{ $usuario->id }}">
                <td>
                    <div class="user-info">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($usuario->nombre . ' ' . $usuario->apellido) }}&background=random&color=fff" alt="Avatar" class="user-avatar">
                        <div>
                            <span class="user-name">{{ $usuario->nombre }} {{ $usuario->apellido }}</span>
                            <!-- <span class="user-role">{{ $usuario->rol_id }}</span> -->
                        </div>
                    </div>
                </td>
                <td>
                    <span class="secondary-text">{{ $usuario->email }}</span>
                </td>
                <td>
                    <span class="contact-text">{{ $usuario->telefono ?? 'N/A' }}</span>
                </td>
                <td>
                    <span class="role-badge role-{{ strtolower($usuario->rol_id ?? 'usuario') }}">
                        {{ ucfirst($usuario->rol_id ?? 'Usuario') }}
                    </span>
                </td>
                <td>
                    <span class="status-badge status-{{ $usuario->estado }}">
                        <span class="status-dot"></span>
                        {{ ucfirst($usuario->estado) }}
                    </span>
                </td>
                <td>
                    <span class="secondary-text">{{ $usuario->created_at->format('d/m/Y') }}</span>
                </td>
                <td>
                    <div class="action-buttons justify-end">
                        <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn-icon btn-view" title="Ver Perfil">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn-icon btn-edit" title="Editar">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        </a>
                        <button class="btn-icon btn-delete" title="Eliminar" data-delete-url="{{ route('usuarios.destroy', $usuario->id) }}" data-user-name="{{ $usuario->nombre }} {{ $usuario->apellido }}">
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
                        <h3 class="empty-title">No se encontraron usuarios</h3>
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
    @forelse($usuarios as $usuario)
    <div class="user-card usuario-card" data-id="{{ $usuario->id }}">
        <div class="card-header">
            <div class="user-main-info">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($usuario->nombre . ' ' . $usuario->apellido) }}&background=random&color=fff" alt="Avatar" class="card-avatar">
                <div>
                    <h3 class="card-name">{{ $usuario->nombre }} {{ $usuario->apellido }}</h3>
                    <span class="card-role">{{ ucfirst($usuario->rol_id ?? 'Usuario') }}</span>
                </div>
            </div>
            <div class="card-actions-direct">
                <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn-icon-sm btn-view">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </a>
                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn-icon-sm btn-edit">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </a>
                <button class="btn-icon-sm btn-delete" data-delete-url="{{ route('usuarios.destroy', $usuario->id) }}" data-user-name="{{ $usuario->nombre }} {{ $usuario->apellido }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                </button>
            </div>
        </div>
        
        <div class="card-body">
            <div class="card-row">
                <span class="card-label">Estado</span>
                <span class="status-badge status-{{ $usuario->estado }} sm">
                    <span class="status-dot"></span>
                    {{ ucfirst($usuario->estado) }}
                </span>
            </div>
            <div class="card-row">
                <span class="card-label">Email</span>
                <span class="card-value">{{ $usuario->email }}</span>
            </div>
            <div class="card-row">
                <span class="card-label">Teléfono</span>
                <span class="card-value">{{ $usuario->telefono ?? 'N/A' }}</span>
            </div>
            <div class="card-row">
                <span class="card-label">Registro</span>
                <span class="card-value">{{ $usuario->created_at->format('d/m/Y') }}</span>
            </div>
        </div>
    </div>
    @empty
    <div class="empty-state-mobile">
        <div class="empty-icon-wrapper">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        </div>
        <p>No se encontraron usuarios</p>
    </div>
    @endforelse
</div>

<div class="pagination-container">
    <div class="pagination-info">
        Mostrando {{ $usuarios->firstItem() ?? 0 }} a {{ $usuarios->lastItem() ?? 0 }} de {{ $usuarios->total() }} usuarios
    </div>
    <div class="pagination-links">
        {{ $usuarios->appends(request()->except('page'))->links() }}
    </div>
</div>

<script>
// Manejar botones de eliminación con data attributes
document.addEventListener('click', function(e) {
    if (e.target.closest('.btn-delete')) {
        const button = e.target.closest('.btn-delete');
        const deleteUrl = button.getAttribute('data-delete-url');
        const userName = button.getAttribute('data-user-name');
        
        if (typeof openDeleteModal === 'function') {
            openDeleteModal(deleteUrl, userName);
        } else {
            // Fallback si no existe la función global
            if (confirm(`¿Estás seguro de que deseas eliminar a ${userName}?`)) {
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
                        alert('Error al eliminar el usuario');
                    }
                });
            }
        }
    }
});
</script>
