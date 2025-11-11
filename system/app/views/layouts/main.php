<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : '' ?>Primero de Junio - Sistema</title>
    
    <!-- Meta tags adicionales -->
    <meta name="description" content="Sistema de gestión para la Asociación de Conductores Primero de Junio">
    <meta name="author" content="Nexorium">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/system/public/assets/images/favicon.ico">
    
    <!-- CSS Principal -->
    <link rel="stylesheet" href="/system/public/assets/css/main.css">
    <link rel="stylesheet" href="/system/public/assets/css/header.css">
    <link rel="stylesheet" href="/system/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/system/public/assets/css/footer.css">
    <link rel="stylesheet" href="/system/public/assets/css/components.css">
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- CSS adicional por página -->
    <?php if (isset($additionalCSS)): ?>
        <?php foreach ($additionalCSS as $css): ?>
            <link rel="stylesheet" href="<?= $css ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <!-- Header -->
    <?php include 'header.php'; ?>
    
    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>
    
    <!-- Contenido Principal -->
    <main class="main-content">
        <!-- Breadcrumb -->
        <?php if (isset($breadcrumb) && !empty($breadcrumb)): ?>
            <nav class="breadcrumb">
                <?php foreach ($breadcrumb as $index => $crumb): ?>
                    <?php if ($index < count($breadcrumb) - 1): ?>
                        <a href="<?= $crumb['url'] ?>"><?= $crumb['title'] ?></a>
                        <span>/</span>
                    <?php else: ?>
                        <span><?= $crumb['title'] ?></span>
                    <?php endif; ?>
                <?php endforeach; ?>
            </nav>
        <?php endif; ?>
        
        <!-- Header de página -->
        <?php if (isset($pageTitle) || isset($pageSubtitle)): ?>
            <header class="page-header">
                <?php if (isset($pageTitle)): ?>
                    <h1 class="page-title"><?= $pageTitle ?></h1>
                <?php endif; ?>
                <?php if (isset($pageSubtitle)): ?>
                    <p class="page-subtitle"><?= $pageSubtitle ?></p>
                <?php endif; ?>
            </header>
        <?php endif; ?>
        
        <!-- Contenido de la página -->
        <div class="page-content">
            <?= $content ?>
        </div>
    </main>
    
    <!-- Footer -->
    <?php include 'footer.php'; ?>
    
    <!-- JavaScript Principal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="/system/public/assets/js/main.js"></script>
    <script src="/system/public/assets/js/header.js"></script>
    <script src="/system/public/assets/js/sidebar.js"></script>
    <script src="/system/public/assets/js/footer.js"></script>
    <script src="/system/public/assets/js/components.js"></script>
    
    <!-- JavaScript adicional por página -->
    <?php if (isset($additionalJS)): ?>
        <?php foreach ($additionalJS as $js): ?>
            <script src="<?= $js ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- JavaScript inline -->
    <?php if (isset($inlineJS)): ?>
        <script>
            <?= $inlineJS ?>
        </script>
    <?php endif; ?>
</body>
</html>