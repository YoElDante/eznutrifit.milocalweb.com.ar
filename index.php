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

$cliente = require __DIR__ . '/config.php';
require_once __DIR__ . '/includes/secrets.php';

// ─── Rutas a assets ──────────────────────────────────────────────
$esLocal = (php_sapi_name() === 'cli-server')
    || in_array($_SERVER['SERVER_NAME'] ?? '', ['localhost', '127.0.0.1'], true);

$base    = $esLocal ? '' : 'https://' . ($_SERVER['HTTP_HOST'] ?? 'localhost');
$assets  = $base . '/assets';
$css     = $assets . '/css/';
$js      = $assets . '/js/';
$img     = $assets . '/img/';
$svg     = __DIR__ . '/assets/img/svg/';

// Archivos CSS fuente (modulares). Se combinan en build time con:
//   php tools/build-css.php
// El resultado es assets/css/styles.css, que se carga de forma asíncrona.
// El CSS crítico (navbar + hero + variables) va inline en header.php.
$cssSourceFiles = [
    'base.css',
    'navbar.css',
    'hero.css',
    'sections/01-shared.css',
    'sections/02-estrella.css',
    'sections/03-reels.css',
    'sections/04-productos.css',
    'sections/05-ubicacion.css',
    'sections/06-nosotros.css',
    'aside.css',
    'clientes.css',
    'footer.css',
    'responsive.css',
];

// Orden de carga de los scripts. Se imprimen con defer al final del body
// (includes/footer.php), por lo que respetan este orden sin bloquear el render.
$jsFiles = [
    'back-to-top.js',
    'navbar.js',
    'smooth-scroll.js',
    'reels.js',
];

// Cache busting para styles.css (filemtime del bundle generado).
$stylesPath = __DIR__ . '/assets/css/styles.css';
$stylesVersion = is_file($stylesPath) ? filemtime($stylesPath) : time();

$jsVersions = [];
foreach ($jsFiles as $file) {
    $path = __DIR__ . '/assets/js/' . $file;
    $jsVersions[$file] = is_file($path) ? '?v=' . filemtime($path) : '';
}

// Las secciones se renderizan en el orden visual de la landing.
// header.php abre <main>; footer.php lo cierra y carga los scripts.
require_once __DIR__ . '/includes/header.php';
?>

<?php require_once __DIR__ . '/includes/sections/hero.php'; ?>
<?php require_once __DIR__ . '/includes/sections/estrella.php'; ?>
<?php require_once __DIR__ . '/includes/sections/productos.php'; ?>
<?php require_once __DIR__ . '/includes/sections/aside.php'; ?>
<?php require_once __DIR__ . '/includes/sections/ubicacion.php'; ?>
<?php require_once __DIR__ . '/includes/sections/reels.php'; ?>
<?php require_once __DIR__ . '/includes/sections/nosotros.php'; ?>
<?php require_once __DIR__ . '/includes/sections/clientes.php'; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
