<aside class="sidebar" id="sidebar">
    <nav class="sidebar-nav">
        <!-- Dashboard -->
        <div class="nav-section">
            <div class="nav-section-title">Principal</div>
            <a href="/system/dashboard" class="nav-item <?= (isset($currentPage) && $currentPage === 'dashboard') ? 'active' : '' ?>">
                <i class="fas fa-tachometer-alt"></i>
                Dashboard
            </a>
        </div>

        <!-- Gestión de Viajes -->
        <div class="nav-section">
            <div class="nav-section-title">Viajes</div>
            <a href="/system/viajes" class="nav-item <?= (isset($currentPage) && $currentPage === 'viajes') ? 'active' : '' ?>">
                <i class="fas fa-route"></i>
                Gestión de Viajes
            </a>
            <a href="/system/viajes/nuevo" class="nav-item <?= (isset($currentPage) && $currentPage === 'viajes-nuevo') ? 'active' : '' ?>">
                <i class="fas fa-plus-circle"></i>
                Nuevo Viaje
            </a>
            <a href="/system/tarifas" class="nav-item <?= (isset($currentPage) && $currentPage === 'tarifas') ? 'active' : '' ?>">
                <i class="fas fa-dollar-sign"></i>
                Tarifas
            </a>
        </div>

        <!-- Conductores -->
        <div class="nav-section">
            <div class="nav-section-title">Conductores</div>
            <a href="/system/conductores" class="nav-item <?= (isset($currentPage) && $currentPage === 'conductores') ? 'active' : '' ?>">
                <i class="fas fa-users"></i>
                Lista de Conductores
            </a>
            <a href="/system/conductores/nuevo" class="nav-item <?= (isset($currentPage) && $currentPage === 'conductores-nuevo') ? 'active' : '' ?>">
                <i class="fas fa-user-plus"></i>
                Registrar Conductor
            </a>
            <a href="/system/pagos-tarifa" class="nav-item <?= (isset($currentPage) && $currentPage === 'pagos-tarifa') ? 'active' : '' ?>">
                <i class="fas fa-credit-card"></i>
                Pagos Tarifa Diaria
            </a>
        </div>

        <!-- Vehículos -->
        <div class="nav-section">
            <div class="nav-section-title">Vehículos</div>
            <a href="/system/vehiculos" class="nav-item <?= (isset($currentPage) && $currentPage === 'vehiculos') ? 'active' : '' ?>">
                <i class="fas fa-motorcycle"></i>
                Lista de Vehículos
            </a>
            <a href="/system/vehiculos/nuevo" class="nav-item <?= (isset($currentPage) && $currentPage === 'vehiculos-nuevo') ? 'active' : '' ?>">
                <i class="fas fa-plus"></i>
                Registrar Vehículo
            </a>
            <a href="/system/asignaciones" class="nav-item <?= (isset($currentPage) && $currentPage === 'asignaciones') ? 'active' : '' ?>">
                <i class="fas fa-link"></i>
                Asignaciones
            </a>
            <a href="/system/mantenimientos" class="nav-item <?= (isset($currentPage) && $currentPage === 'mantenimientos') ? 'active' : '' ?>">
                <i class="fas fa-wrench"></i>
                Mantenimientos
            </a>
        </div>

        <!-- Clientes -->
        <div class="nav-section">
            <div class="nav-section-title">Clientes</div>
            <a href="/system/clientes" class="nav-item <?= (isset($currentPage) && $currentPage === 'clientes') ? 'active' : '' ?>">
                <i class="fas fa-address-book"></i>
                Lista de Clientes
            </a>
            <a href="/system/clientes/nuevo" class="nav-item <?= (isset($currentPage) && $currentPage === 'clientes-nuevo') ? 'active' : '' ?>">
                <i class="fas fa-user-plus"></i>
                Registrar Cliente
            </a>
        </div>

        <!-- Administración (Solo para admins) -->
        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
        <div class="nav-section">
            <div class="nav-section-title">Administración</div>
            <a href="/system/usuarios" class="nav-item <?= (isset($currentPage) && $currentPage === 'usuarios') ? 'active' : '' ?>">
                <i class="fas fa-users-cog"></i>
                Usuarios del Sistema
            </a>
            <a href="/system/roles" class="nav-item <?= (isset($currentPage) && $currentPage === 'roles') ? 'active' : '' ?>">
                <i class="fas fa-shield-alt"></i>
                Roles y Permisos
            </a>
            <a href="/system/configuracion" class="nav-item <?= (isset($currentPage) && $currentPage === 'configuracion') ? 'active' : '' ?>">
                <i class="fas fa-cog"></i>
                Configuración
            </a>
            <a href="/system/logs" class="nav-item <?= (isset($currentPage) && $currentPage === 'logs') ? 'active' : '' ?>">
                <i class="fas fa-file-alt"></i>
                Logs del Sistema
            </a>
        </div>
        <?php endif; ?>

        <!-- Reportes -->
        <div class="nav-section">
            <div class="nav-section-title">Reportes</div>
            <a href="/system/reportes/viajes" class="nav-item <?= (isset($currentPage) && $currentPage === 'reportes-viajes') ? 'active' : '' ?>">
                <i class="fas fa-chart-line"></i>
                Reporte de Viajes
            </a>
            <a href="/system/reportes/ingresos" class="nav-item <?= (isset($currentPage) && $currentPage === 'reportes-ingresos') ? 'active' : '' ?>">
                <i class="fas fa-chart-bar"></i>
                Reporte de Ingresos
            </a>
            <a href="/system/reportes/conductores" class="nav-item <?= (isset($currentPage) && $currentPage === 'reportes-conductores') ? 'active' : '' ?>">
                <i class="fas fa-users"></i>
                Reporte de Conductores
            </a>
        </div>

        <!-- Ayuda -->
        <div class="nav-section">
            <div class="nav-section-title">Ayuda</div>
            <a href="/system/ayuda" class="nav-item <?= (isset($currentPage) && $currentPage === 'ayuda') ? 'active' : '' ?>">
                <i class="fas fa-question-circle"></i>
                Centro de Ayuda
            </a>
            <a href="/system/soporte" class="nav-item <?= (isset($currentPage) && $currentPage === 'soporte') ? 'active' : '' ?>">
                <i class="fas fa-headset"></i>
                Soporte Técnico
            </a>
        </div>
    </nav>
</aside>

<!-- JavaScript para el sidebar -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const sidebar = document.getElementById('sidebar');
    
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
    }
    
    // Cerrar sidebar al hacer click fuera en móvil
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 1024 && 
            !sidebar.contains(e.target) && 
            !mobileMenuBtn.contains(e.target)) {
            sidebar.classList.remove('show');
        }
    });
});
</script>