<?php
/**
 * Sección de Productos Destacados.
 *
 * Muestra hasta 3 productos con foto, nombre, descripción breve y un botón
 * individual de WhatsApp para consultar por cada uno.
 *
 * @package MiLocalWeb\Clientes
 */

$wa_number   = preg_replace('/[^0-9]/', '', $cliente['whatsapp']);
$wa_link     = 'https://wa.me/' . $wa_number;
$productos   = $cliente['productos'] ?? [];

if (empty($productos)) {
    return;
}
?>
<section id="productos" class="section section-productos" aria-label="Productos destacados">
    <div class="section-container">
        <h2 class="section-title">Productos Destacados</h2>
        <p class="section-subtitle">Conocé lo mejor que tenemos para ofrecerte</p>

        <div class="productos-grid">
            <?php foreach ($productos as $i => $p): ?>
            <?php
                $prod_msg = urlencode('Hola! Vi ' . htmlspecialchars_decode($p['nombre'] ?? '') . ' en tu web y quisiera más información');
                $prod_wa  = $wa_link . '?text=' . $prod_msg;
                $img_file = $p['imagen'] ?? ('producto-' . ($i + 1) . '.jpg');
            ?>
            <article class="producto-card">
                <div class="producto-img-wrapper">
                    <img src="<?= $img . $img_file ?>"
                         alt="<?= htmlspecialchars($p['nombre'] ?? 'Producto ' . ($i + 1)) ?>"
                         class="producto-img"
                         loading="lazy">
                </div>
                <div class="producto-body">
                    <h3 class="producto-nombre"><?= htmlspecialchars($p['nombre'] ?? 'Producto ' . ($i + 1)) ?></h3>
                    <p class="producto-desc"><?= htmlspecialchars($p['descripcion'] ?? '') ?></p>
                    <a href="<?= $prod_wa ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="btn-producto">
                        <?php include $svg . 'whatsapp.svg'; ?>
                        Consultame por este producto
                    </a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
