/* PRIMERO DE JUNIO - FOOTER JAVASCRIPT DEL SISTEMA */
/* Funcionalidades para el footer del sistema basado en el sitio web */

class FooterSystem {
    constructor() {
        this.footer = null;
        this.socialLinks = [];
        this.quickActions = [];
        this.statsElements = [];
        this.observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        this.init();
    }

    init() {
        this.setupElements();
        this.setupSocialLinks();
        this.setupQuickActions();
        this.setupIntersectionObserver();
        this.initializeAnimations();
        this.loadStats();
        this.setupFloatingEffects();
    }

    setupElements() {
        this.footer = document.querySelector('.footer');
        this.socialLinks = document.querySelectorAll('.social-link');
        this.quickActions = document.querySelectorAll('.quick-action');
        this.statsElements = document.querySelectorAll('.stat-value');
    }

    // ===== ENLACES SOCIALES =====
    setupSocialLinks() {
        this.socialLinks.forEach(link => {
            const originalIcon = link.innerHTML;
            
            link.addEventListener('mouseenter', () => {
                this.animateSocialLink(link, true);
            });

            link.addEventListener('mouseleave', () => {
                this.animateSocialLink(link, false);
            });

            link.addEventListener('click', (e) => {
                e.preventDefault();
                this.handleSocialClick(link);
            });
        });
    }

    animateSocialLink(link, isEntering) {
        const icon = link.querySelector('i');
        
        if (isEntering) {
            // Animación de entrada
            gsap.to(link, {
                y: -3,
                scale: 1.05,
                boxShadow: '0 8px 25px rgba(0, 255, 102, 0.3)',
                duration: 0.3,
                ease: "back.out(1.7)"
            });

            if (icon) {
                gsap.to(icon, {
                    scale: 1.1,
                    rotation: 10,
                    color: '#ffffff',
                    duration: 0.3,
                    ease: "power2.out"
                });
            }

            // Efecto de onda
            this.createRippleEffect(link);
        } else {
            // Animación de salida
            gsap.to(link, {
                y: 0,
                scale: 1,
                boxShadow: '0 0 0 rgba(0, 255, 102, 0)',
                duration: 0.3,
                ease: "power2.out"
            });

            if (icon) {
                gsap.to(icon, {
                    scale: 1,
                    rotation: 0,
                    color: '',
                    duration: 0.3,
                    ease: "power2.out"
                });
            }
        }
    }

    createRippleEffect(element) {
        const ripple = document.createElement('div');
        ripple.className = 'social-ripple';
        ripple.style.cssText = `
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(0, 255, 102, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
            z-index: 0;
        `;
        
        element.style.position = 'relative';
        element.appendChild(ripple);
        
        gsap.to(ripple, {
            width: 60,
            height: 60,
            opacity: 0,
            duration: 0.6,
            ease: "power2.out",
            onComplete: () => {
                ripple.remove();
            }
        });
    }

    handleSocialClick(link) {
        const href = link.getAttribute('href');
        const platform = this.getSocialPlatform(link);
        
        // Animación de click
        gsap.to(link, {
            scale: 0.95,
            duration: 0.1,
            yoyo: true,
            repeat: 1,
            ease: "power2.inOut"
        });

        // Efecto de partículas
        this.createClickParticles(link);

        setTimeout(() => {
            if (href && href !== '#') {
                window.open(href, '_blank', 'noopener,noreferrer');
            }
        }, 200);
    }

    getSocialPlatform(link) {
        const href = link.getAttribute('href') || '';
        const icon = link.querySelector('i')?.className || '';
        
        if (href.includes('facebook') || icon.includes('facebook')) return 'Facebook';
        if (href.includes('twitter') || icon.includes('twitter')) return 'Twitter';
        if (href.includes('instagram') || icon.includes('instagram')) return 'Instagram';
        if (href.includes('youtube') || icon.includes('youtube')) return 'YouTube';
        if (href.includes('linkedin') || icon.includes('linkedin')) return 'LinkedIn';
        if (href.includes('whatsapp') || icon.includes('whatsapp')) return 'WhatsApp';
        
        return 'Red Social';
    }

    createClickParticles(element) {
        const rect = element.getBoundingClientRect();
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;

        for (let i = 0; i < 8; i++) {
            const particle = document.createElement('div');
            particle.className = 'click-particle';
            particle.style.cssText = `
                position: fixed;
                top: ${centerY}px;
                left: ${centerX}px;
                width: 4px;
                height: 4px;
                background: var(--primary-green);
                border-radius: 50%;
                pointer-events: none;
                z-index: 1000;
            `;
            
            document.body.appendChild(particle);
            
            const angle = (i / 8) * Math.PI * 2;
            const distance = 50;
            const endX = Math.cos(angle) * distance;
            const endY = Math.sin(angle) * distance;
            
            gsap.to(particle, {
                x: endX,
                y: endY,
                opacity: 0,
                scale: 0,
                duration: 0.6,
                ease: "power2.out",
                onComplete: () => {
                    particle.remove();
                }
            });
        }
    }

    // ===== ACCIONES RÁPIDAS =====
    setupQuickActions() {
        this.quickActions.forEach(action => {
            action.addEventListener('mouseenter', () => {
                this.animateQuickAction(action, true);
            });

            action.addEventListener('mouseleave', () => {
                this.animateQuickAction(action, false);
            });

            action.addEventListener('click', (e) => {
                this.handleQuickActionClick(action, e);
            });
        });
    }

    animateQuickAction(action, isEntering) {
        const icon = action.querySelector('i');
        const text = action.querySelector('span');
        
        if (isEntering) {
            gsap.to(action, {
                y: -3,
                scale: 1.02,
                boxShadow: '0 8px 25px rgba(0, 255, 102, 0.2)',
                duration: 0.3,
                ease: "power2.out"
            });

            if (icon) {
                gsap.to(icon, {
                    scale: 1.1,
                    rotation: 5,
                    color: '#ffffff',
                    duration: 0.3,
                    ease: "back.out(1.7)"
                });
            }

            if (text) {
                gsap.to(text, {
                    color: '#ffffff',
                    duration: 0.3,
                    ease: "power2.out"
                });
            }

            // Efecto de brillo
            this.createShineEffect(action);
        } else {
            gsap.to(action, {
                y: 0,
                scale: 1,
                boxShadow: '0 0 0 rgba(0, 255, 102, 0)',
                duration: 0.3,
                ease: "power2.out"
            });

            if (icon) {
                gsap.to(icon, {
                    scale: 1,
                    rotation: 0,
                    color: '',
                    duration: 0.3,
                    ease: "power2.out"
                });
            }

            if (text) {
                gsap.to(text, {
                    color: '',
                    duration: 0.3,
                    ease: "power2.out"
                });
            }
        }
    }

    createShineEffect(element) {
        const shine = document.createElement('div');
        shine.className = 'action-shine';
        shine.style.cssText = `
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            pointer-events: none;
            z-index: 1;
        `;
        
        element.style.position = 'relative';
        element.style.overflow = 'hidden';
        element.appendChild(shine);
        
        gsap.to(shine, {
            left: '100%',
            duration: 0.6,
            ease: "power2.out",
            onComplete: () => {
                shine.remove();
            }
        });
    }

    handleQuickActionClick(action, event) {
        event.preventDefault();
        
        // Animación de click
        gsap.to(action, {
            scale: 0.97,
            duration: 0.1,
            yoyo: true,
            repeat: 1,
            ease: "power2.inOut"
        });

        // Efecto de impulso
        this.createPulseEffect(action);

        const href = action.getAttribute('href');
        const actionType = this.getActionType(action);

        setTimeout(() => {
            this.executeQuickAction(href, actionType);
        }, 200);
    }

    getActionType(action) {
        const icon = action.querySelector('i')?.className || '';
        const text = action.querySelector('span')?.textContent?.toLowerCase() || '';
        
        if (icon.includes('plus') || text.includes('nuevo')) return 'create';
        if (icon.includes('chart') || text.includes('reporte')) return 'report';
        if (icon.includes('cog') || text.includes('config')) return 'config';
        if (icon.includes('help') || text.includes('ayuda')) return 'help';
        
        return 'navigate';
    }

    createPulseEffect(element) {
        const pulse = document.createElement('div');
        pulse.className = 'action-pulse';
        pulse.style.cssText = `
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(0, 255, 102, 0.3) 0%, transparent 70%);
            border-radius: inherit;
            pointer-events: none;
            z-index: 1;
        `;
        
        element.appendChild(pulse);
        
        gsap.fromTo(pulse,
            { scale: 0, opacity: 1 },
            { 
                scale: 1.2, 
                opacity: 0, 
                duration: 0.6,
                ease: "power2.out",
                onComplete: () => {
                    pulse.remove();
                }
            }
        );
    }

    executeQuickAction(href, actionType) {
        if (href && href !== '#') {
            if (actionType === 'help') {
                window.open(href, '_blank');
            } else {
                window.location.href = href;
            }
        } else {
            // Acción por defecto basada en tipo
            switch (actionType) {
                case 'create':
                    console.log('Ejecutando acción de crear...');
                    break;
                case 'report':
                    console.log('Ejecutando acción de reporte...');
                    break;
                case 'config':
                    console.log('Ejecutando acción de configuración...');
                    break;
                case 'help':
                    console.log('Ejecutando acción de ayuda...');
                    break;
                default:
                    console.log('Ejecutando acción por defecto...');
            }
        }
    }

    // ===== ESTADÍSTICAS =====
    async loadStats() {
        try {
            const response = await fetch('/api/system/stats');
            const data = await response.json();
            
            if (data.success) {
                this.updateStats(data.stats);
            }
        } catch (error) {
            console.error('Error cargando estadísticas del footer:', error);
            // Datos por defecto
            this.updateStats({
                usuarios: 156,
                viajes: 1247,
                vehiculos: 89,
                ingresos: 25680
            });
        }
    }

    updateStats(stats) {
        const statsContainer = this.footer?.querySelector('.footer-stats');
        if (!statsContainer) return;

        const statsHTML = Object.entries(stats).map(([key, value]) => `
            <div class="stat-item">
                <div class="stat-value">${value}</div>
                <div class="stat-label">${this.getStatLabel(key)}</div>
            </div>
        `).join('');

        statsContainer.innerHTML = statsHTML;

        // Animar contadores cuando sean visibles
        this.setupStatsAnimation();
    }

    getStatLabel(key) {
        const labels = {
            usuarios: 'Usuarios',
            viajes: 'Viajes',
            vehiculos: 'Vehículos',
            ingresos: 'Ingresos',
            conductores: 'Conductores',
            clientes: 'Clientes'
        };
        
        return labels[key] || key.charAt(0).toUpperCase() + key.slice(1);
    }

    setupStatsAnimation() {
        const statItems = this.footer?.querySelectorAll('.footer-stats .stat-item');
        
        if (!statItems.length) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.animateStatCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, this.observerOptions);

        statItems.forEach(item => observer.observe(item));
    }

    animateStatCounter(statItem) {
        const valueElement = statItem.querySelector('.stat-value');
        if (!valueElement) return;

        const finalValue = parseInt(valueElement.textContent.replace(/[^0-9]/g, '')) || 0;
        const hasPrefix = valueElement.textContent.includes('$');
        
        valueElement.textContent = hasPrefix ? '$0' : '0';

        gsap.to({ value: 0 }, {
            value: finalValue,
            duration: 2,
            ease: "power2.out",
            onUpdate: function() {
                const currentValue = Math.round(this.targets()[0].value);
                const formattedValue = currentValue.toLocaleString();
                valueElement.textContent = hasPrefix ? `$${formattedValue}` : formattedValue;
            }
        });

        // Efecto de highlight durante la animación
        gsap.fromTo(valueElement,
            { color: 'var(--primary-green)', scale: 1 },
            { 
                color: '', 
                scale: 1.1,
                duration: 0.3,
                yoyo: true,
                repeat: 3,
                ease: "power2.inOut"
            }
        );
    }

    // ===== INTERSECTION OBSERVER =====
    setupIntersectionObserver() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    this.animateFooterElements();
                    observer.unobserve(entry.target);
                }
            });
        }, this.observerOptions);

        if (this.footer) {
            observer.observe(this.footer);
        }
    }

    animateFooterElements() {
        // Animar secciones del footer
        const sections = this.footer?.querySelectorAll('.footer-brand, .footer-nav, .footer-contact, .footer-actions');
        
        sections?.forEach((section, index) => {
            gsap.fromTo(section,
                { y: 50, opacity: 0 },
                {
                    y: 0,
                    opacity: 1,
                    duration: 0.6,
                    delay: index * 0.1,
                    ease: "power3.out"
                }
            );
        });

        // Animar enlaces del footer
        const footerLinks = this.footer?.querySelectorAll('.footer-link');
        footerLinks?.forEach((link, index) => {
            gsap.fromTo(link,
                { x: -20, opacity: 0 },
                {
                    x: 0,
                    opacity: 1,
                    duration: 0.4,
                    delay: 0.3 + (index * 0.05),
                    ease: "power2.out"
                }
            );
        });

        // Animar elementos de contacto
        const contactItems = this.footer?.querySelectorAll('.contact-item');
        contactItems?.forEach((item, index) => {
            gsap.fromTo(item,
                { scale: 0.9, opacity: 0 },
                {
                    scale: 1,
                    opacity: 1,
                    duration: 0.4,
                    delay: 0.4 + (index * 0.1),
                    ease: "back.out(1.7)"
                }
            );
        });
    }

    // ===== EFECTOS FLOTANTES =====
    setupFloatingEffects() {
        // Efecto de partículas de fondo
        this.createBackgroundParticles();
        
        // Efecto de ondas suaves
        this.createWaveEffect();
        
        // Efecto de brillo sutil
        this.createAmbientGlow();
    }

    createBackgroundParticles() {
        if (!this.footer) return;

        const particleCount = 20;
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'footer-particle';
            particle.style.cssText = `
                position: absolute;
                width: 2px;
                height: 2px;
                background: rgba(0, 255, 102, 0.2);
                border-radius: 50%;
                pointer-events: none;
                left: ${Math.random() * 100}%;
                top: ${Math.random() * 100}%;
            `;
            
            this.footer.appendChild(particle);
            
            // Animación flotante continua
            gsap.to(particle, {
                y: -20,
                x: Math.random() * 40 - 20,
                duration: 3 + Math.random() * 2,
                repeat: -1,
                yoyo: true,
                ease: "sine.inOut",
                delay: Math.random() * 2
            });
            
            // Efecto de parpadeo
            gsap.to(particle, {
                opacity: Math.random() * 0.5 + 0.2,
                duration: 2 + Math.random() * 3,
                repeat: -1,
                yoyo: true,
                ease: "power2.inOut",
                delay: Math.random() * 3
            });
        }
    }

    createWaveEffect() {
        const wave = document.createElement('div');
        wave.className = 'footer-wave';
        wave.style.cssText = `
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--primary-green), transparent);
            opacity: 0.3;
            z-index: 1;
        `;
        
        this.footer?.appendChild(wave);
        
        gsap.to(wave, {
            scaleX: 0,
            transformOrigin: 'center',
            duration: 3,
            repeat: -1,
            yoyo: true,
            ease: "sine.inOut"
        });
    }

    createAmbientGlow() {
        const glow = document.createElement('div');
        glow.className = 'footer-glow';
        glow.style.cssText = `
            position: absolute;
            top: -50px;
            left: 50%;
            width: 200px;
            height: 100px;
            background: radial-gradient(ellipse, rgba(0, 255, 102, 0.1) 0%, transparent 70%);
            transform: translateX(-50%);
            pointer-events: none;
            z-index: 0;
        `;
        
        this.footer?.appendChild(glow);
        
        gsap.to(glow, {
            opacity: 0.3,
            scale: 1.2,
            duration: 4,
            repeat: -1,
            yoyo: true,
            ease: "sine.inOut"
        });
    }

    // ===== INICIALIZAR ANIMACIONES =====
    initializeAnimations() {
        if (!this.footer) return;

        // Animación inicial del footer
        gsap.fromTo(this.footer,
            { y: 100, opacity: 0 },
            {
                y: 0,
                opacity: 1,
                duration: 0.8,
                ease: "power3.out",
                delay: 0.2
            }
        );
    }

    // ===== MÉTODOS PÚBLICOS =====
    updateFooterInfo(info) {
        // Actualizar información de la empresa
        const brandDescription = this.footer?.querySelector('.footer-description');
        if (brandDescription && info.description) {
            brandDescription.textContent = info.description;
        }

        // Actualizar información de contacto
        if (info.contact) {
            this.updateContactInfo(info.contact);
        }

        // Actualizar versión
        const versionElement = this.footer?.querySelector('.footer-version');
        if (versionElement && info.version) {
            versionElement.textContent = `v${info.version}`;
        }
    }

    updateContactInfo(contact) {
        const contactItems = this.footer?.querySelectorAll('.contact-item');
        
        contactItems?.forEach(item => {
            const label = item.querySelector('.contact-label')?.textContent.toLowerCase();
            const valueElement = item.querySelector('.contact-value');
            
            if (valueElement) {
                if (label?.includes('teléfono') && contact.phone) {
                    valueElement.textContent = contact.phone;
                } else if (label?.includes('email') && contact.email) {
                    valueElement.textContent = contact.email;
                } else if (label?.includes('dirección') && contact.address) {
                    valueElement.textContent = contact.address;
                }
            }
        });
    }

    showFooterMessage(message, type = 'info') {
        const messageEl = document.createElement('div');
        messageEl.className = `footer-message message-${type}`;
        messageEl.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : 'info'}-circle"></i>
            <span>${message}</span>
        `;

        this.footer?.appendChild(messageEl);

        gsap.fromTo(messageEl,
            { y: 50, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.4, ease: "power2.out" }
        );

        setTimeout(() => {
            gsap.to(messageEl, {
                y: 50,
                opacity: 0,
                duration: 0.3,
                ease: "power2.in",
                onComplete: () => messageEl.remove()
            });
        }, 3000);
    }

    setCompactMode(isCompact) {
        this.footer?.classList.toggle('compact', isCompact);
        
        if (isCompact) {
            // Ocultar secciones no esenciales
            const hideElements = this.footer?.querySelectorAll('.footer-top, .footer-social, .footer-actions');
            hideElements?.forEach(el => {
                gsap.to(el, {
                    opacity: 0,
                    height: 0,
                    duration: 0.3,
                    ease: "power2.in"
                });
            });
        } else {
            // Mostrar todas las secciones
            const showElements = this.footer?.querySelectorAll('.footer-top, .footer-social, .footer-actions');
            showElements?.forEach(el => {
                gsap.to(el, {
                    opacity: 1,
                    height: 'auto',
                    duration: 0.3,
                    ease: "power2.out"
                });
            });
        }
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    window.footerSystem = new FooterSystem();
});

// CSS adicional para efectos dinámicos
const footerStyles = `
.footer-particle {
    animation: float 3s ease-in-out infinite;
}

.social-ripple,
.action-shine,
.action-pulse {
    pointer-events: none !important;
}

.footer-message {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    background: var(--white);
    color: var(--dark);
    padding: 1rem 1.5rem;
    border-radius: 8px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    z-index: 1000;
    max-width: 300px;
}

.footer-message.message-success {
    border-left: 4px solid #22c55e;
}

.footer-message.message-error {
    border-left: 4px solid #dc2626;
}

.footer-message.message-info {
    border-left: 4px solid #3b82f6;
}

.footer-wave {
    animation: wave 3s linear infinite;
}

@keyframes wave {
    0% { transform: scaleX(0); }
    50% { transform: scaleX(1); }
    100% { transform: scaleX(0); }
}

.footer.compact .footer-top {
    display: none;
}

.footer.compact {
    padding: 1rem 0;
}

.click-particle {
    animation: particle-explode 0.6s ease-out forwards;
}

@keyframes particle-explode {
    to {
        transform: scale(0);
        opacity: 0;
    }
}
`;

const footerStyleElement = document.createElement('style');
footerStyleElement.textContent = footerStyles;
document.head.appendChild(footerStyleElement);
