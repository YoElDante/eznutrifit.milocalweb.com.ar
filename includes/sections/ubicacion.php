<?php
/**
 * Sección de Ubicación — "Donde nos podés encontrar".
 *
 * Muestra los puntos de venta con imagen estática de Google Maps,
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

/**
 * Devuelve los atributos width/height de un logo local.
 *
 * Evita saltos de layout (CLS) cuando la imagen no declara dimensiones.
 * Solo mide archivos dentro del proyecto; si no puede, retorna cadena vacía.
 *
 * @param string $logoUrl Ruta pública del logo (ej. /assets/img/...).
 * @return string Atributos HTML listos para insertar, o ''.
 */
function ubicacion_logo_dims($logoUrl) {
    $path = __DIR__ . '/../../' . ltrim($logoUrl, '/');
    if (is_file($path) && function_exists('getimagesize')) {
        $info = getimagesize($path);
        if ($info) {
            return ' width="' . $info[0] . '" height="' . $info[1] . '"';
        }
    }
    return '';
}

/**
 * Obtiene las coordenadas de una ubicación.
 *
 * Prioriza los campos lat/lng de config.php y, como fallback, intenta
 * extraerlas del parámetro `q` de un link de Google Maps.
 *
 * @param array $ubi Datos de una ubicación de config.php.
 * @return array{0: ?string, 1: ?string} Par [lat, lng] o [null, null].
 */
function ubicacion_coords($ubi) {
    if (!empty($ubi['lat']) && !empty($ubi['lng'])) {
        return [$ubi['lat'], $ubi['lng']];
    }
    if (!empty($ubi['gmaps_link']) && preg_match('/[?&]q=(-?\d+\.\d+),(-?\d+\.\d+)/', $ubi['gmaps_link'], $matches)) {
        return [$matches[1], $matches[2]];
    }
    return [null, null];
}

/**
 * Construye la URL de Google Static Maps para una ubicación.
 *
 * Retorna cadena vacía si no hay API key configurada en secrets.php,
 * para que la sección use el iframe embebido como fallback.
 *
 * @param string|float $lat Latitud.
 * @param string|float $lng Longitud.
 * @param int $ancho Ancho en px (máx. 640 en el plan gratuito).
 * @param int $alto Alto en px.
 * @param int $zoom Nivel de zoom (16 = escala de calle).
 * @return string URL del mapa estático, o '' si falta la API key.
 */
function ubicacion_static_map_url($lat, $lng, $ancho = 640, $alto = 350, $zoom = 16) {
    $apiKey = defined('GOOGLE_MAPS_API_KEY') ? GOOGLE_MAPS_API_KEY : '';
    $placeholder = 'TU_GOOGLE_MAPS_API_KEY_AQUI';
    if ($apiKey === '' || $apiKey === $placeholder) {
        return '';
    }
    $size = (int) $ancho . 'x' . (int) $alto;
    return sprintf(
        'https://maps.googleapis.com/maps/api/staticmap?center=%s,%s&zoom=%d&size=%s&markers=color:red%%7C%s,%s&key=%s',
        $lat,
        $lng,
        (int) $zoom,
        $size,
        $lat,
        $lng,
        urlencode($apiKey)
    );
}
?>
<section id="ubicacion" class="section section-ubicacion" aria-label="Ubicación">
    <div class="section-container">
        <h2 class="section-title">Donde nos podés encontrar</h2>
        <p class="section-subtitle">Visitá nuestros stands de venta y comprá suplementos deportivos de calidad en Río Tercero. Cuatro puntos de venta con las mejores marcas y asesoramiento personalizado.</p>

        <?php foreach ($ubicaciones as $i => $ubi): ?>
        <div class="ubicacion-block" style="<?= $i > 0 ? 'margin-top:3rem;' : '' ?>">
            <div class="ubicacion-grid">
                <!-- Info a la izquierda -->
                <div class="ubicacion-info">
                    <div class="ubicacion-header">
                        <?php if (!empty($ubi['logo'])): ?>
                        <img src="<?= htmlspecialchars($ubi['logo']) ?>" alt="<?= htmlspecialchars($ubi['nombre']) ?>" class="ubicacion-logo"<?= ubicacion_logo_dims($ubi['logo']) ?> loading="lazy" decoding="async">
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
                    <?php
                        // Estrategia de mapa: Static Maps si hay API key; si no, iframe embed.
                        list($lat, $lng) = ubicacion_coords($ubi);
                        $staticMapUrl = ($lat && $lng) ? ubicacion_static_map_url($lat, $lng) : '';
                        $mapAlt = !empty($ubi['nombre'])
                            ? 'Mapa de ubicación de ' . htmlspecialchars($ubi['nombre']) . ' en Río Tercero, Córdoba'
                            : 'Mapa de ubicación';

                        if ($staticMapUrl !== '' && !empty($ubi['gmaps_link'])):
                    ?>
                        <a href="<?= htmlspecialchars($ubi['gmaps_link']) ?>"
                           target="_blank" rel="noopener noreferrer"
                           class="ubicacion-mapa-link"
                           aria-label="Ver <?= htmlspecialchars($ubi['nombre']) ?> en Google Maps">
                            <img src="<?= htmlspecialchars($staticMapUrl) ?>"
                                 alt="<?= $mapAlt ?>"
                                 class="ubicacion-mapa-img"
                                 width="640" height="350"
                                 loading="lazy">
                            <?php if (!empty($ubi['nombre'])): ?>
                            <span class="ubicacion-mapa-label"><?= htmlspecialchars($ubi['nombre']) ?></span>
                            <?php endif; ?>
                        </a>
                    <?php elseif (!empty($ubi['gmaps_embed'])): ?>
                        <div class="ubicacion-mapa-fallback">
                            <?php
                                $iframeTitle = !empty($ubi['nombre'])
                                    ? 'Mapa de ubicación de ' . htmlspecialchars($ubi['nombre'])
                                    : 'Mapa de ubicación';
                                $embed = $ubi['gmaps_embed'];
                                // Accesibilidad: Google a veces devuelve el iframe sin title.
                                if (preg_match('/<iframe\b/i', $embed) && !preg_match('/<iframe\b[^>]*\btitle=/i', $embed)) {
                                    $embed = preg_replace('/<iframe/i', '<iframe title="' . $iframeTitle . '"', $embed, 1);
                                }
                                echo $embed;
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
