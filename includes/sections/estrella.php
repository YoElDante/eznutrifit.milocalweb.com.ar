<?php
/**
 * Sección Producto Estrella — Combo Explosivo.
 *
 * Showcase dedicado al producto principal con imagen grande,
 * descripción detallada, beneficios y CTA a WhatsApp.
 *
 * NOTA: el contenido está hardcodeado a propósito (no se lee de config.php).
 * Si cambia el combo, editar este archivo y revisar
 * assets/css/sections/02-estrella.css.
 *
 * @package MiLocalWeb\Clientes
 */

// Mensaje propio del combo: no usa el whatsapp_mensaje genérico de config.php.
$wa_number = preg_replace('/[^0-9]/', '', $cliente['whatsapp']);
$wa_link   = 'https://wa.me/' . $wa_number;
$wa_msg    = urlencode('Hola! Quiero info sobre el Combo Explosivo de EZ Nutrifit');
$wa_full   = $wa_link . '?text=' . $wa_msg;
?>
<section id="estrella" class="section section-estrella" aria-label="Producto estrella">
    <div class="section-container">

        <div class="estrella-grid">
            <!-- Imagen principal -->
            <div class="estrella-imagen">
                <img src="<?= $img ?>cliente/impacto/estrella-mutantmass-creatina.webp"
                     alt="EZ Nutrifit — Combo Explosivo Mutantmass + Creatina en Río Tercero, Córdoba"
                     class="estrella-img"
                     loading="lazy"
                     decoding="async"
                     width="600" height="600">
            </div>

            <!-- Contenido -->
            <div class="estrella-contenido">
                <h2 class="estrella-titulo">Combo Explosivo</h2>
                <p class="estrella-bajada">Ganador de peso + Creatina</p>

                <p class="estrella-descripcion">
                    El combo definitivo de <strong>Star Nutrition</strong>: <strong>Mutantmass 1.5kg</strong> 
                    con 23g de proteínas y 59g de carbohidratos por toma, más <strong>Creatina 300gr</strong> 
                    monohidrato micronizada. Potenciado con óxido nítrico, bajo en azúcar y libre de gluten.
                </p>

                <div class="estrella-nutri">
                    <div class="nutri-item">
                        <span class="nutri-valor">23g</span>
                        <span class="nutri-label">Proteínas</span>
                    </div>
                    <div class="nutri-item">
                        <span class="nutri-valor">59g</span>
                        <span class="nutri-label">Carbohidratos</span>
                    </div>
                    <div class="nutri-item">
                        <span class="nutri-valor">382</span>
                        <span class="nutri-label">Kcal / Toma</span>
                    </div>
                </div>

                <ul class="estrella-beneficios">
                    <li>Aumento de fuerza y resistencia</li>
                    <li>Promueve el crecimiento muscular</li>
                    <li>Incrementa el rendimiento deportivo</li>
                    <li>Retrasa la aparición de la fatiga</li>
                    <li>Mejora la recuperación post-entrenamiento</li>
                </ul>

                <div class="estrella-cta">
                    <a href="<?= $wa_full ?>"
                       target="_blank" rel="noopener noreferrer"
                       class="btn-hero">
                        <?php include $svg . 'whatsapp.svg'; ?>
                        Quiero este combo
                    </a>
                </div>
            </div>
        </div>

        <!-- Imágenes secundarias con overlay descriptivo -->
        <?php /* El overlay se revela por hover y por focus-within (accesible con teclado). */ ?>
        <h3 class="estrella-subtitulo">Sumalos a tu Combo</h3>
        <div class="estrella-secundarias">
            <div class="secundaria-card" tabindex="0">
                <div class="secundaria-img-wrap">
                     <img src="<?= $img ?>cliente/impacto/complemento-thermofuelmax.webp"
                          alt="EZ Nutrifit — Thermo Fuel Max, quemador de grasa, en Río Tercero, Córdoba"
                          class="secundaria-img"
                          loading="lazy"
                          decoding="async"
                          width="600" height="600">
                    <div class="secundaria-overlay">
                        <h4>Thermo Fuel Max</h4>
                        <p>Quemador de grasa con 6 extractos naturales. Inhibidor del apetito y activador del metabolismo. 120 cápsulas, libre de cafeína.</p>
                    </div>
                </div>
                <span>Thermo Fuel Max</span>
            </div>

            <div class="secundaria-card" tabindex="0">
                <div class="secundaria-img-wrap">
                     <img src="<?= $img ?>cliente/impacto/complemento-betaalanine-creatine.webp"
                          alt="EZ Nutrifit — Creatina + Beta Alanina en Río Tercero, Córdoba"
                          class="secundaria-img"
                          loading="lazy"
                          decoding="async"
                          width="600" height="600">
                    <div class="secundaria-overlay">
                        <h4>Creatina + Beta Alanina</h4>
                        <p>Juntos potencian la fuerza, resistencia y crecimiento muscular. Retrasan la fatiga y maximizan el rendimiento en cada entrenamiento.</p>
                    </div>
                </div>
                <span>Creatina + Beta Alanina</span>
            </div>

            <div class="secundaria-card" tabindex="0">
                <div class="secundaria-img-wrap">
                     <img src="<?= $img ?>cliente/impacto/complemento-betaalanine.webp"
                          alt="EZ Nutrifit — Beta Alanina 300gr en Río Tercero, Córdoba"
                          class="secundaria-img"
                          loading="lazy"
                          decoding="async"
                          width="600" height="600">
                    <div class="secundaria-overlay">
                        <h4>Beta Alanina</h4>
                        <p>Aminoácido que reduce la fatiga muscular durante el ejercicio intenso. Aumenta carnosina, fuerza y potencia. 300gr — 150 servicios. Libre de gluten.</p>
                    </div>
                </div>
                <span>Beta Alanina</span>
            </div>
        </div>

    </div>
</section>
