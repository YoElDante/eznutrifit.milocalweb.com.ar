<?php
/**
 * Pie de página de la landing page del cliente.
 *
 * Incluye logo del cliente, enlaces a redes sociales, botón volver arriba,
 * badge publicitario de MiLocalWeb y el botón flotante de WhatsApp.
 *
 * @package MiLocalWeb\Clientes
 */

$wa_number = preg_replace('/[^0-9]/', '', $cliente['whatsapp']);
$wa_link   = 'https://wa.me/' . $wa_number;
$wa_msg    = urlencode($cliente['whatsapp_mensaje'] ?? 'Hola! Vi tu web y quisiera más info');
$wa_full   = $wa_link . '?text=' . $wa_msg;
$logo_src  = $cliente['logo_img'] ?? $img . 'logo.png';
?>
    </main>

    <footer class="site-footer" role="contentinfo">
        <div class="footer-content">
            <div class="footer-brand">
                <img src="<?= $logo_src ?>"
                     alt="<?= htmlspecialchars($cliente['nombre']) ?>"
                     class="footer-logo"
                     loading="lazy">
                <p class="footer-slogan"><?= htmlspecialchars($cliente['slogan']) ?></p>
            </div>

            <div class="footer-social">
                <h4>Seguinos</h4>
                <div class="social-links">
                    <?php if (!empty($cliente['redes']['instagram'])): ?>
                    <a href="<?= htmlspecialchars($cliente['redes']['instagram']) ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="social-link" aria-label="Instagram">
                        <?php include $svg . 'instagram-filled.svg'; ?>
                    </a>
                    <?php endif; ?>
                    <?php if (!empty($cliente['redes']['facebook'])): ?>
                    <a href="<?= htmlspecialchars($cliente['redes']['facebook']) ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="social-link" aria-label="Facebook">
                        <?php include $svg . 'facebook.svg'; ?>
                    </a>
                    <?php endif; ?>
                    <?php if (!empty($cliente['redes']['tiktok'])): ?>
                    <a href="<?= htmlspecialchars($cliente['redes']['tiktok']) ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="social-link" aria-label="TikTok">
                        <?php include $svg . 'tiktok.svg'; ?>
                    </a>
                    <?php endif; ?>
                    <?php if (!empty($cliente['redes']['web'])): ?>
                    <a href="<?= htmlspecialchars($cliente['redes']['web']) ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="social-link" aria-label="Sitio Web">
                        <?php include $svg . 'globe.svg'; ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="footer-actions">
                <h4>Contacto</h4>
                <a href="<?= $wa_full ?>" target="_blank" rel="noopener noreferrer" class="footer-wa-link">
                    <?php include $svg . 'whatsapp.svg'; ?>
                    Escribinos por WhatsApp
                </a>
            </div>
        </div>

        <!-- Badge MiLocalWeb -->
        <div class="footer-badge">
            <a href="https://milocalweb.com.ar#contacto" target="_blank" rel="noopener" class="footer-mlw-logo" title="MiLocalWeb.com.ar — Páginas web para negocios locales">
                <img src="<?= $img ?>milocalweb/logos/logo%20principal%20690x300%20transp.webp"
                     alt="MiLocalWeb.com.ar"
                     class="mlw-logo-img"
                     loading="lazy">
            </a>
            <div class="footer-badge-text">
                <p>
                    Hecho con <?php include $svg . 'heart.svg'; ?>
                    por
                    <a href="https://milocalweb.com.ar#contacto" target="_blank" rel="noopener" class="mlw-link">
                        <strong>MiLocalWeb.com.ar</strong>
                    </a>
                </p>
                <p class="footer-badge-cta">
                    ¿Te gustó esta web?
                    <a href="https://wa.me/5493513783473?text=Hola!%20Quiero%20una%20web%20como%20la%20de%20<?= urlencode($cliente['nombre']) ?>%20para%20mi%20negocio"
                       target="_blank" rel="noopener noreferrer">
                        Pedí la tuya sin cargo
                        <?php include $svg . 'whatsapp.svg'; ?>
                    </a>
                </p>
            </div>
        </div>

        <!-- Botón volver arriba -->
        <button class="back-to-top" aria-label="Volver arriba" title="Volver arriba">
            <?php include $svg . 'chevron-up.svg'; ?>
        </button>
    </footer>

    <!-- Botón flotante de WhatsApp -->
    <a href="<?= $wa_full ?>"
       target="_blank"
       rel="noopener noreferrer"
       class="whatsapp-float"
       aria-label="Chatear por WhatsApp">
        <?php include $svg . 'whatsapp.svg'; ?>
    </a>

    <script src="<?= $js ?>main.js<?= JS_VERSION ?>"></script>
</body>
</html>
