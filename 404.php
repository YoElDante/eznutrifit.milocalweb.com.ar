<?php
/**
 * Página 404 — ErrorDocument de .htaccess.
 *
 * Página mínima de "no encontrada": reutiliza el bundle de estilos y las
 * variables de marca de config.php, con robots noindex para no indexar.
 *
 * @package MiLocalWeb\Clientes
 */

http_response_code(404);
$cliente = require __DIR__ . '/config.php';
$wa_number = preg_replace('/[^0-9]/', '', (string) ($cliente['whatsapp'] ?? ''));
$stylesPath = __DIR__ . '/assets/css/styles.css';
$stylesVersion = is_file($stylesPath) ? '?v=' . filemtime($stylesPath) : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, follow">
    <title>Página no encontrada — <?= htmlspecialchars($cliente['nombre'] ?? '') ?></title>
    <link rel="icon" type="image/x-icon" href="<?= htmlspecialchars($cliente['favicon'] ?? '/assets/img/cliente/iconos/favicon.ico') ?>">
    <link rel="stylesheet" href="/assets/css/styles.css<?= $stylesVersion ?>">
    <style>
        /* Estilos mínimos de la página 404, sobre las variables del bundle. */
        .error-404 {
            min-height: 70vh;
            display: grid;
            place-content: center;
            justify-items: center;
            text-align: center;
            gap: 1rem;
            padding: 3rem 1.5rem;
        }
        .error-404 .error-code {
            font-family: var(--font-heading);
            font-size: 4rem;
            line-height: 1;
            color: var(--color-primary);
            margin: 0;
        }
        .error-404 h1 {
            font-family: var(--font-heading);
            font-size: 1.6rem;
            font-weight: 400;
            color: var(--color-text);
            margin: 0;
        }
        .error-404 p {
            color: var(--color-muted);
            max-width: 32ch;
        }
        .error-404 .error-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
        }
    </style>
</head>
<body>
    <main class="error-404">
        <p class="error-code">404</p>
        <h1>Página no encontrada</h1>
        <p>La página que buscás no existe o fue movida.</p>
        <div class="error-actions">
            <a href="/" class="btn-hero">Volver al inicio</a>
            <a href="https://wa.me/<?= htmlspecialchars($wa_number) ?>" target="_blank" rel="noopener noreferrer" class="btn-hero">Escribinos por WhatsApp</a>
        </div>
    </main>
</body>
</html>
