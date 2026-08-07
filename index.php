<?php
/**
 * Landing Page — Template para clientes de MiLocalWeb.
 *
 * Single page larga con secciones de Hero, Productos, Ubicación,
 * Quiénes Somos y Footer con badge publicitario.
 *
 * Para personalizar, editá config.php con los datos del cliente.
 *
 * @package MiLocalWeb\Clientes
 */

require_once __DIR__ . '/config.php';
$cliente = require __DIR__ . '/config.php';

// ─── Rutas a assets ──────────────────────────────────────────────
$esLocal = (php_sapi_name() === 'cli-server')
    || in_array($_SERVER['SERVER_NAME'] ?? '', ['localhost', '127.0.0.1'], true);

$base    = $esLocal ? '' : 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost');
$assets  = $base . '/assets';
$css     = $assets . '/css/';
$js      = $assets . '/js/';
$img     = $assets . '/img/';
$svg     = __DIR__ . '/assets/img/svg/';

// Cache busting para múltiples archivos CSS/JS divididos por componente
$cssFiles = [
    'base.css',
    'navbar.css',
    'hero.css',
    'sections.css',
    'aside.css',
    'clientes.css',
    'footer.css',
    'responsive.css',
];

$jsFiles = [
    'back-to-top.js',
    'navbar.js',
    'smooth-scroll.js',
    'reels.js',
];

$cssVersions = [];
foreach ($cssFiles as $file) {
    $path = __DIR__ . '/assets/css/' . $file;
    $cssVersions[$file] = is_file($path) ? '?v=' . filemtime($path) : '';
}

$jsVersions = [];
foreach ($jsFiles as $file) {
    $path = __DIR__ . '/assets/js/' . $file;
    $jsVersions[$file] = is_file($path) ? '?v=' . filemtime($path) : '';
}

require_once __DIR__ . '/includes/header.php';
?>

<?php require_once __DIR__ . '/includes/sections/hero.php'; ?>
<?php require_once __DIR__ . '/includes/sections/estrella.php'; ?>
<?php require_once __DIR__ . '/includes/sections/productos.php'; ?>
<?php require_once __DIR__ . '/includes/sections/aside.php'; ?>
<?php require_once __DIR__ . '/includes/sections/ubicacion.php'; ?>
<?php require_once __DIR__ . '/includes/sections/reels.php'; ?>
<?php require_once __DIR__ . '/includes/sections/clientes.php'; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
