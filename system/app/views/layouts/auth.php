<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : '' ?>Primero de Junio</title>
    
    <!-- Meta tags -->
    <meta name="description" content="Sistema de autenticación - Asociación de Conductores Primero de Junio">
    <meta name="author" content="Nexorium">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/system/public/assets/images/favicon.ico">
    
    <!-- CSS Principal -->
    <link rel="stylesheet" href="/system/public/assets/css/main.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Estilos específicos para auth -->
    <style>
        body {
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Fondo animado */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 20%, rgba(0, 255, 102, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(34, 197, 94, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(0, 255, 102, 0.05) 0%, transparent 70%);
            animation: backgroundFloat 20s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes backgroundFloat {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.1) rotate(180deg); }
        }

        .auth-container {
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 255, 102, 0.2);
            border-radius: 20px;
            padding: 3rem;
            width: 100%;
            max-width: 450px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .auth-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient-primary);
            opacity: 0.8;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .auth-logo i {
            font-size: 3rem;
            color: var(--primary-green);
            filter: drop-shadow(0 0 10px rgba(0, 255, 102, 0.5));
        }

        .auth-logo-text {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .auth-logo-title {
            font-family: var(--font-headings);
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary-green);
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .auth-logo-subtitle {
            font-family: var(--font-primary);
            font-size: 0.9rem;
            color: var(--gray-light);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 0.25rem;
        }

        .auth-title {
            font-size: 1.5rem;
            color: var(--white);
            margin-bottom: 0.5rem;
            text-transform: none;
            letter-spacing: 0;
        }

        .auth-subtitle {
            color: var(--gray-light);
            font-size: 0.95rem;
            margin-bottom: 0;
        }

        .auth-form {
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--white);
            font-size: 0.9rem;
        }

        .form-input {
            width: 100%;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: var(--white);
            font-family: var(--font-primary);
            transition: var(--transition-fast);
            font-size: 0.95rem;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(0, 255, 102, 0.1);
            background: rgba(255, 255, 255, 0.08);
        }

        .form-input::placeholder {
            color: var(--gray-medium);
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-medium);
            transition: var(--transition-fast);
        }

        .input-group .form-input {
            padding-left: 3rem;
        }

        .input-group:focus-within .input-icon {
            color: var(--primary-green);
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray-medium);
            cursor: pointer;
            transition: var(--transition-fast);
            padding: 0.5rem;
        }

        .password-toggle:hover {
            color: var(--primary-green);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1.5rem 0;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .checkbox-group input[type="checkbox"] {
            accent-color: var(--primary-green);
        }

        .checkbox-group label {
            color: var(--gray-light);
            font-size: 0.9rem;
            cursor: pointer;
        }

        .forgot-password {
            color: var(--primary-green);
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition-fast);
        }

        .forgot-password:hover {
            color: var(--primary-green-dark);
            text-shadow: 0 0 8px rgba(0, 255, 102, 0.5);
        }

        .auth-button {
            width: 100%;
            padding: 1rem;
            background: var(--gradient-primary);
            border: none;
            border-radius: 12px;
            color: var(--white);
            font-family: var(--font-headings);
            font-size: 1rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: var(--transition-fast);
            box-shadow: var(--shadow-green);
            position: relative;
            overflow: hidden;
        }

        .auth-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
        }

        .auth-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-green-hover);
        }

        .auth-button:hover::before {
            left: 100%;
        }

        .auth-button:active {
            transform: translateY(0);
        }

        .auth-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .auth-footer {
            text-align: center;
            color: var(--gray-light);
            font-size: 0.9rem;
        }

        .auth-link {
            color: var(--primary-green);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition-fast);
        }

        .auth-link:hover {
            color: var(--primary-green-dark);
            text-shadow: 0 0 8px rgba(0, 255, 102, 0.5);
        }

        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            border-left: 4px solid;
            font-size: 0.9rem;
        }

        .alert-error {
            background: rgba(220, 38, 38, 0.1);
            border-color: #dc2626;
            color: #fca5a5;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border-color: #22c55e;
            color: #86efac;
        }

        .alert-info {
            background: rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
            color: #93c5fd;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .auth-container {
                padding: 2rem 1.5rem;
                margin: 1rem;
                border-radius: 16px;
            }

            .auth-logo {
                flex-direction: column;
                gap: 0.5rem;
            }

            .auth-logo i {
                font-size: 2.5rem;
            }

            .auth-logo-title {
                font-size: 1.5rem;
                text-align: center;
            }

            .form-options {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        /* Loading animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 3px solid var(--white);
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <?= $content ?>
    </div>

    <!-- JavaScript Principal -->
    <script src="/system/public/assets/js/main.js"></script>
    
    <!-- JavaScript específico para auth -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const passwordToggles = document.querySelectorAll('.password-toggle');
            passwordToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    const icon = this.querySelector('i');
                    
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });

            // Form submission with loading
            const authForms = document.querySelectorAll('.auth-form');
            authForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitBtn = this.querySelector('.auth-button');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<span class="loading"></span> Procesando...';
                    }
                });
            });

            // Auto-hide alerts
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }, 5000);
            });

            // Focus first input
            const firstInput = document.querySelector('.form-input');
            if (firstInput) {
                firstInput.focus();
            }
        });
    </script>

    <!-- JavaScript adicional -->
    <?php if (isset($additionalJS)): ?>
        <?php foreach ($additionalJS as $js): ?>
            <script src="<?= $js ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>