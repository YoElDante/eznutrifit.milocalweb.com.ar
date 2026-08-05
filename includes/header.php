<?php
/**
 * Cabecera de la landing page del cliente.
 *
 * Incluye metadatos, Open Graph, favicon, inyección de colores
 * del cliente y la barra de navegación sticky.
 *
 * @package MiLocalWeb\Clientes
 */

// Helpers para WhatsApp
$wa_number = preg_replace('/[^0-9]/', '', $cliente['whatsapp']);
$wa_link   = 'https://wa.me/' . $wa_number;
$wa_msg    = urlencode($cliente['whatsapp_mensaje'] ?? 'Hola! Vi tu web y quisiera más info');
$wa_full   = $wa_link . '?text=' . $wa_msg;

$cs = $cliente['colors'] ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($cliente['nombre']) ?> — <?= htmlspecialchars($cliente['slogan']) ?>">
    <meta name="robots" content="index, follow">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($cliente['nombre']) ?> — <?= htmlspecialchars($cliente['slogan']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($cliente['hero_descripcion'] ?? '') ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="es_AR">

    <title><?= htmlspecialchars($cliente['nombre']) ?> — <?= htmlspecialchars($cliente['slogan']) ?></title>

    <!-- Favicon -->
    <?php $fav = $cliente['favicon'] ?? $img . 'iconos/favicon.ico'; ?>
    <link rel="icon" type="image/x-icon" href="<?= $fav ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= $fav ?>">

    <!-- Google Fonts: Bebas Neue para headings -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= $css ?>styles.css<?= CSS_VERSION ?>">

    <!-- Colores del cliente -->
    <?php if (!empty($cs)): ?>
    <style>
        :root {
            <?php foreach ($cs as $var => $val): ?>
            --<?= $var ?>: <?= $val ?>;
            <?php endforeach; ?>
        }
    </style>
    <?php endif; ?>

    <!-- Tipografía -->
    <?php if (!empty($cliente['tipografia'])): ?>
    <style>
        body { font-family: <?= $cliente['tipografia'] ?>; }
    </style>
    <?php endif; ?>
</head>
<body>
    <header class="site-header">
        <nav class="navbar" role="navigation" aria-label="Navegación principal">
            <?php $logo_src = $cliente['logo_img'] ?? $img . 'logo.png'; ?>
            <div class="navbar-brand">
                <a href="#" class="brand-link">
                    <img src="<?= $logo_src ?>"
                         alt="<?= htmlspecialchars($cliente['nombre']) ?>"
                         class="brand-logo"
                         loading="eager">
                    <span class="brand-name"><?= htmlspecialchars($cliente['nombre']) ?></span>
                </a>
            </div>
            <button class="navbar-toggle" aria-label="Abrir menú" aria-expanded="false">
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
            </button>
            <ul class="navbar-menu">
                <li><a href="#inicio">Inicio</a></li>
                <li><a href="#estrella">Ofertas</a></li>
                <li><a href="#productos">Productos</a></li>
                <li><a href="#ubicacion">Encontranos</a></li>
                <li><a href="#nosotros">Conocenos en Acción</a></li>
                <li>                <a href="<?= $wa_full ?>" target="_blank" rel="noopener noreferrer" class="nav-cta">
                    Contactanos
                    <?php include $svg . 'whatsapp.svg'; ?>
                </a></li>
            </ul>
        </nav>
        <div class="navbar-overlay" aria-hidden="true"></div>
    </header>
    <main class="site-main">
