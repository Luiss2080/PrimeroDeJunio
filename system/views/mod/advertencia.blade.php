<!-- Warning Modal -->
<div class="modal-overlay" id="warningModal">
    <div class="modal-container warning-theme">
        <div class="modal-header">
            <div class="modal-icon-wrapper warning-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    <line x1="12" y1="9" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
            </div>
            <h3 class="modal-title" id="warningTitle">No se puede eliminar</h3>
        </div>
        
        <div class="modal-body">
            <p id="warningMessage">Este registro no se puede eliminar porque tiene datos asociados (como viajes o turnos) que dependen de él.</p>
            <p class="text-sm text-muted mt-2">Para eliminar este registro, primero debes eliminar o desvincular los datos asociados.</p>
        </div>
        
        <div class="modal-actions">
            <button type="button" class="btn-modal btn-modal-warning" id="closeWarningBtn">Entendido</button>
        </div>
    </div>
</div>
