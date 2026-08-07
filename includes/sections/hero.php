<?php
/**
 * Sección Hero de la landing page.
 *
 * Soportes 4 layouts vía $cliente['hero_layout']:
 *   - img-right (default): imagen a la derecha, texto/logo a la izquierda
 *   - img-left: imagen a la izquierda, texto/logo a la derecha
 *   - stacked: imagen arriba ocupando todo el ancho, texto abajo centrado
 *   - split: imagen a la izquierda con gradiente de oscurecimiento, texto a la derecha
 *
 * @package MiLocalWeb\Clientes
 */

$layout      = $cliente['hero_layout'] ?? 'img-right';
$hero_class  = 'hero hero--' . $layout;
$hero_img    = $cliente['hero_img'] ?? $img . 'hero.jpg';
$logo_src    = $cliente['logo_img'] ?? $img . 'logo.png';
$wa_number   = preg_replace('/[^0-9]/', '', $cliente['whatsapp']);
$wa_link     = 'https://wa.me/' . $wa_number;
$wa_msg      = urlencode($cliente['whatsapp_mensaje'] ?? 'Hola! Vi tu web y quisiera más info');
$wa_full     = $wa_link . '?text=' . $wa_msg;
?>
<section id="inicio" class="<?= $hero_class ?>" aria-label="Presentación">

    <?php if ($layout === 'split'): ?>
        <!-- Layout SPLIT: imagen izquierda → gradiente → texto derecha -->
        <div class="hero-split-bg" style="background-image: url('<?= $hero_img ?>')" aria-hidden="true"></div>
        <div class="hero-split-overlay" aria-hidden="true"></div>
        <div class="hero-container">
            <div class="hero-content hero-content--right">
                <img src="<?= $logo_src ?>"
                     alt="Logo <?= htmlspecialchars($cliente['nombre']) ?> — Suplementos deportivos en Río Tercero"
                     class="hero-logo"
                     width="300" height="300">
                <h1 class="hero-title"><?= htmlspecialchars(($cliente['seo_keywords_primarias'] ?? 'Suplementos Deportivos') . ' en ' . ($cliente['seo_localidad'] ?? 'Río Tercero')) ?></h1>
                <?php if (!empty($cliente['hero_descripcion'])): ?>
                <p class="hero-subtitle"><?= nl2br(htmlspecialchars($cliente['hero_descripcion'])) ?></p>
                <?php endif; ?>
                <div class="hero-actions">
                    <a href="<?= $wa_full ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="btn-hero">
                        <?php include $svg . 'whatsapp.svg'; ?>
                        <?= htmlspecialchars($cliente['hero_boton'] ?? 'Escribinos por WhatsApp') ?>
                    </a>
                    <a href="<?= htmlspecialchars($cliente['redes']['instagram'] ?? '#') ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="btn-hero btn-hero--instagram">
                        <?php include $svg . 'instagram-stroke.svg'; ?>
                        Conocenos en Instagram
                    </a>
                </div>
            </div>
        </div>

    <?php elseif ($layout === 'stacked'): ?>
        <!-- Layout STACKED: imagen arriba, texto abajo centrado -->
        <div class="hero-effects" aria-hidden="true"></div>
        <div class="hero-container">
            <div class="hero-image-wrapper">
                <img src="<?= $hero_img ?>"
                     alt="<?= htmlspecialchars($cliente['nombre']) ?> — Suplementos deportivos en Río Tercero"
                     class="hero-image"
                     loading="eager"
                     fetchpriority="high"
                     width="575" height="800">
            </div>
            <div class="hero-content hero-content--centered">
                <img src="<?= $logo_src ?>"
                     alt="Logo <?= htmlspecialchars($cliente['nombre']) ?> — Suplementos deportivos en Río Tercero"
                     class="hero-logo"
                     width="300" height="300">
                <h1 class="hero-title"><?= htmlspecialchars(($cliente['seo_keywords_primarias'] ?? 'Suplementos Deportivos') . ' en ' . ($cliente['seo_localidad'] ?? 'Río Tercero')) ?></h1>
                <?php if (!empty($cliente['hero_descripcion'])): ?>
                <p class="hero-subtitle"><?= nl2br(htmlspecialchars($cliente['hero_descripcion'])) ?></p>
                <?php endif; ?>
                <div class="hero-actions">
                    <a href="<?= $wa_full ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="btn-hero">
                        <?php include $svg . 'whatsapp.svg'; ?>
                        <?= htmlspecialchars($cliente['hero_boton'] ?? 'Escribinos por WhatsApp') ?>
                    </a>
                </div>
            </div>
        </div>

    <?php else: ?>
        <!-- Layout IMG-RIGHT o IMG-LEFT: dos columnas, imagen a un lado -->
        <div class="hero-effects" aria-hidden="true"></div>
        <div class="hero-container">
            <div class="hero-content">
                <img src="<?= $logo_src ?>"
                     alt="Logo <?= htmlspecialchars($cliente['nombre']) ?> — Suplementos deportivos en Río Tercero"
                     class="hero-logo"
                     width="300" height="300">
                <h1 class="hero-title"><?= htmlspecialchars(($cliente['seo_keywords_primarias'] ?? 'Suplementos Deportivos') . ' en ' . ($cliente['seo_localidad'] ?? 'Río Tercero')) ?></h1>
                <?php if (!empty($cliente['hero_descripcion'])): ?>
                <p class="hero-subtitle"><?= nl2br(htmlspecialchars($cliente['hero_descripcion'])) ?></p>
                <?php endif; ?>
                <div class="hero-actions">
                    <a href="<?= $wa_full ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="btn-hero">
                        <?php include $svg . 'whatsapp.svg'; ?>
                        <?= htmlspecialchars($cliente['hero_boton'] ?? 'Escribinos por WhatsApp') ?>
                    </a>
                </div>
            </div>
            <div class="hero-image-wrapper">
                <img src="<?= $hero_img ?>"
                     alt="<?= htmlspecialchars($cliente['nombre']) ?> — Suplementos deportivos en Río Tercero"
                     class="hero-image"
                     loading="eager"
                     fetchpriority="high"
                     width="575" height="800">
            </div>
        </div>
    <?php endif; ?>

</section>
