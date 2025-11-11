<footer class="footer">
    <div class="footer-content">
        <div class="footer-left">
            <p>&copy; <?= date('Y') ?> Asociación de Conductores "Primero de Junio". Todos los derechos reservados.</p>
        </div>
        
        <div class="footer-links">
            <a href="/system/ayuda">Ayuda</a>
            <a href="/system/soporte">Soporte</a>
            <a href="/system/politicas">Políticas</a>
            <a href="/" target="_blank">Sitio Web</a>
        </div>
        
        <div class="footer-right">
            <span>Versión 1.0.0</span>
            <span class="separator">•</span>
            <span>Desarrollado por <strong>Nexorium</strong></span>
        </div>
    </div>
</footer>

<style>
.separator {
    margin: 0 0.5rem;
    color: var(--gray-medium);
}

.footer-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.footer-left p {
    margin: 0;
    font-size: 0.85rem;
}

.footer-right {
    font-size: 0.85rem;
    display: flex;
    align-items: center;
}

@media (max-width: 768px) {
    .footer-content {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
    
    .footer-links {
        order: -1;
    }
    
    .footer-right .separator {
        display: none;
    }
    
    .footer-right {
        flex-direction: column;
        gap: 0.25rem;
    }
}
</style>