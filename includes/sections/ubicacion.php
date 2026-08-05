<?php
/**
 * Sección de Ubicación — "Donde nos podés encontrar".
 *
 * Muestra dos puntos de venta con mapa embebido de Google Maps,
 * dirección, logo del negocio anfitrión y botón "Llevame allí".
 *
 * @package MiLocalWeb\Clientes
 */

$ubicaciones = $cliente['ubicaciones'] ?? [];
if (empty($ubicaciones)) {
    $ubicaciones = [[
        'nombre'      => '',
        'direccion'   => $cliente['direccion'] ?? '',
        'gmaps_embed' => $cliente['gmaps_embed'] ?? '',
        'gmaps_link'  => $cliente['gmaps_link'] ?? '',
    ]];
}
?>
<section id="ubicacion" class="section section-ubicacion" aria-label="Ubicación">
    <div class="section-container">
        <h2 class="section-title">Donde nos podés encontrar</h2>

        <?php foreach ($ubicaciones as $i => $ubi): ?>
        <div class="ubicacion-block" style="<?= $i > 0 ? 'margin-top:3rem;' : '' ?>">
            <div class="ubicacion-grid">
                <!-- Info a la izquierda -->
                <div class="ubicacion-info">
                    <div class="ubicacion-header">
                        <?php if (!empty($ubi['logo'])): ?>
                        <img src="<?= htmlspecialchars($ubi['logo']) ?>" alt="<?= htmlspecialchars($ubi['nombre']) ?>" class="ubicacion-logo">
                        <?php endif; ?>
                        <?php if (!empty($ubi['nombre'])): ?>
                        <h3 class="ubicacion-punto"><?= htmlspecialchars($ubi['nombre']) ?></h3>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($ubi['direccion'])): ?>
                    <div class="ubicacion-direccion">
                        <span style="color: var(--color-primary); flex-shrink: 0;"><?php include $svg . 'pin.svg'; ?></span>
                        <div>
                            <h3>Dirección</h3>
                            <p><?= nl2br(htmlspecialchars($ubi['direccion'])) ?></p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($ubi['gmaps_link'])): ?>
                    <a href="<?= htmlspecialchars($ubi['gmaps_link']) ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="btn-maps">
                        <?php include $svg . 'pin.svg'; ?>
                        Llevame allí
                    </a>
                    <?php endif; ?>
                </div>

                <!-- Mapa a la derecha -->
                <div class="ubicacion-mapa">
                    <?= $ubi['gmaps_embed'] ?? '' ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
