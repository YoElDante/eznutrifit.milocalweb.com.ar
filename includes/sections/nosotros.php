<?php
/**
 * Sección Quiénes Somos / Nosotros.
 *
 * Muestra fotos del local o equipo, un breve texto sobre el negocio,
 * enlaces a redes sociales y un CTA final a WhatsApp.
 *
 * @package MiLocalWeb\Clientes
 */

$wa_number   = preg_replace('/[^0-9]/', '', $cliente['whatsapp']);
$wa_link     = 'https://wa.me/' . $wa_number;
$wa_msg      = urlencode($cliente['whatsapp_mensaje'] ?? 'Hola! Vi tu web y quisiera más info');
$wa_full     = $wa_link . '?text=' . $wa_msg;
$redes_vivas = array_filter($cliente['redes'] ?? [], function ($url) {
    return !empty($url);
});
$galeria = $cliente['nosotros_galeria'] ?? [
    ['imagen' => $img . 'local-1.jpg', 'alt' => $cliente['nombre'] . ' — Nuestro local'],
    ['imagen' => $img . 'local-2.jpg', 'alt' => $cliente['nombre'] . ' — Nuestro equipo'],
];
?>
<section id="nosotros" class="section section-nosotros" aria-label="Quiénes somos">
    <div class="section-container">
        <h2 class="section-title">Quiénes Somos</h2>

        <?php if (!empty($cliente['nosotros_texto'])): ?>
        <p class="nosotros-texto"><?= nl2br(htmlspecialchars($cliente['nosotros_texto'])) ?></p>
        <?php endif; ?>

        <!-- Galería de fotos -->
        <div class="nosotros-gallery">
            <?php foreach ($galeria as $item): ?>
            <div class="gallery-item">
                <img src="<?= htmlspecialchars($item['imagen']) ?>"
                     alt="<?= htmlspecialchars($item['alt'] ?? $cliente['nombre']) ?>"
                     class="gallery-img"
                     loading="lazy">
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Redes sociales -->
        <?php if (!empty($redes_vivas)): ?>
        <div class="nosotros-redes">
            <h3>Seguinos en redes</h3>
            <div class="redes-grid">
                <?php if (!empty($cliente['redes']['instagram'])): ?>
                <a href="<?= htmlspecialchars($cliente['redes']['instagram']) ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="red-card">
                    <?php include $svg . 'instagram-filled.svg'; ?>
                    <span>Instagram</span>
                </a>
                <?php endif; ?>
                <?php if (!empty($cliente['redes']['facebook'])): ?>
                <a href="<?= htmlspecialchars($cliente['redes']['facebook']) ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="red-card">
                    <?php include $svg . 'facebook.svg'; ?>
                    <span>Facebook</span>
                </a>
                <?php endif; ?>
                <?php if (!empty($cliente['redes']['tiktok'])): ?>
                <a href="<?= htmlspecialchars($cliente['redes']['tiktok']) ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="red-card">
                    <?php include $svg . 'tiktok.svg'; ?>
                    <span>TikTok</span>
                </a>
                <?php endif; ?>
                <?php if (!empty($cliente['redes']['web'])): ?>
                <a href="<?= htmlspecialchars($cliente['redes']['web']) ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="red-card">
                    <?php include $svg . 'globe.svg'; ?>
                    <span>Sitio Web</span>
                </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- CTA final -->
        <div class="nosotros-cta">
            <p>¿Querés saber más? Escribinos y te respondemos al toque.</p>
            <a href="<?= $wa_full ?>"
               target="_blank" rel="noopener noreferrer"
               class="btn-hero">
                <?php include $svg . 'whatsapp.svg'; ?>
                Contactanos por WhatsApp
            </a>
        </div>
    </div>
</section>
