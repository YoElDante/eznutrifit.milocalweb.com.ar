<?php
/**
 * Sección Reels — Videos educativos.
 *
 * Muestra 3 videos locales con lazy loading real:
 * preload="none" = 0 KB hasta que el usuario toca play.
 *
 * @package MiLocalWeb\Clientes
 */

$reels = [
    [
        'src'    => '/assets/vid/reels/suplementos-pilares-escenciales.mp4',
        'poster' => '/assets/vid/reels/suplementos-pilares-escenciales.webp',
        'titulo' => 'Suplementos esenciales',
        'desc'   => 'Conocé los pilares de la suplementación deportiva y para qué sirve cada uno.',
    ],
    [
        'src'    => '/assets/vid/reels/incluir-aminoacidos-bcaa.mp4',
        'poster' => '/assets/vid/reels/incluir-aminoacidos-bcaa.webp',
        'titulo' => 'Aminoácidos BCAA (Ramificados)',
        'desc'   => 'Por qué incluir aminoácidos en tu rutina y cómo mejoran tu recuperación.',
    ],
    [
        'src'    => '/assets/vid/reels/beneficios-creatina-beta-alanine.mp4',
        'poster' => '/assets/vid/reels/beneficios-creatina-beta-alanine.webp',
        'titulo' => 'Creatina + Beta Alanina',
        'desc'   => 'Los beneficios de combinar estos dos suplementos para maximizar tu rendimiento.',
    ],
];
?>
<section id="reels" class="section section-reels" aria-label="Videos educativos">
    <div class="section-container">
        <h2 class="section-title">Conocenos en acción</h2>
        <p class="section-subtitle">Aprendé sobre suplementación, entrenamiento y nutrición deportiva. Informate con nosotros y llevá tu rendimiento al próximo nivel.</p>

        <div class="reels-grid">
            <?php foreach ($reels as $i => $reel): ?>
            <div class="reel-card">
                <div class="reel-wrapper">
                    <video src="<?= htmlspecialchars($reel['src']) ?>"
                           class="reel-video"
                           preload="none"
                           controls
                           playsinline
                           poster="<?= htmlspecialchars($reel['poster']) ?>"
                           title="<?= htmlspecialchars($reel['titulo']) ?> — Hacé clic para reproducir">
                    </video>
                    <button class="reel-play-btn"
                            aria-label="Reproducir: <?= htmlspecialchars($reel['titulo']) ?>"
                            title="Reproducir: <?= htmlspecialchars($reel['titulo']) ?>"
                            data-video="<?= $i ?>">
                    </button>
                </div>
                <div class="reel-info">
                    <h4><?= htmlspecialchars($reel['titulo']) ?></h4>
                    <p><?= htmlspecialchars($reel['desc']) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="reels-ig-link">
            <a href="<?= htmlspecialchars($cliente['redes']['instagram'] ?? '#') ?>"
               target="_blank" rel="noopener noreferrer"
               class="btn-hero btn-hero--instagram">
                <?php include $svg . 'instagram-stroke.svg'; ?>
                Seguinos en Instagram
            </a>
        </div>
    </div>
</section>
