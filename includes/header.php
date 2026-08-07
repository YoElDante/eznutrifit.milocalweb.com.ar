<?php
/**
 * Cabecera de la landing page del cliente.
 *
 * Incluye metadatos, Open Graph, favicon, inyección de colores
 * del cliente y la barra de navegación sticky.
 *
 * @package MiLocalWeb\Clientes
 */

// Helpers para WhatsApp
$wa_number = preg_replace('/[^0-9]/', '', $cliente['whatsapp']);
$wa_link   = 'https://wa.me/' . $wa_number;
$wa_msg    = urlencode($cliente['whatsapp_mensaje'] ?? 'Hola! Vi tu web y quisiera más info');
$wa_full   = $wa_link . '?text=' . $wa_msg;

$cs = $cliente['colors'] ?? [];

// ─── Variables SEO ──────────────────────────────────────────
$seo_localidad  = $cliente['seo_localidad'] ?? 'Río Tercero';
$seo_provincia  = $cliente['seo_provincia'] ?? 'Córdoba';
$seo_keywords   = $cliente['seo_keywords_primarias'] ?? 'Suplementos Deportivos';
$seo_lat        = $cliente['seo_lat'] ?? '-32.1692529';
$seo_long       = $cliente['seo_long'] ?? '-64.136046';
$seo_domain     = $_SERVER['HTTP_HOST'] ?? 'eznutrifit.milocalweb.com.ar';
$seo_base_url   = 'https://' . $seo_domain;
$seo_og_image_path = $cliente['seo_og_image'] ?? '/assets/img/cliente/logos/logo-300x300-transp.webp';

$productos_nombres = array_map(function ($p) { return mb_strtolower($p['nombre']); }, $cliente['productos']);
$seo_title       = htmlspecialchars($cliente['nombre']) . ' — ' . $seo_keywords . ' y Nutrición en ' . $seo_localidad . ', ' . htmlspecialchars($seo_provincia);
$seo_description = htmlspecialchars($cliente['nombre']) . ': ' . implode(', ', array_slice($productos_nombres, 0, 3)) . ' en ' . $seo_localidad . '. Suplementación deportiva de alto rendimiento. Pedí info por WhatsApp. Envíos a todo Córdoba.';
$seo_placename   = $seo_localidad . ', ' . htmlspecialchars($seo_provincia) . ', Argentina';
$og_title_meta   = htmlspecialchars($cliente['nombre']) . ' — ' . $seo_keywords . ' en ' . $seo_localidad;
$og_description  = htmlspecialchars($cliente['hero_descripcion'] ?? '');
$og_image_url    = $seo_base_url . $seo_og_image_path;
$og_image_alt    = htmlspecialchars($cliente['nombre']) . ' — ' . htmlspecialchars($cliente['rubro'] ?? 'Suplementos Deportivos') . ' en ' . $seo_localidad;
$canonical_url   = $seo_base_url;

// ─── JSON-LD Structured Data ────────────────────────────────
$ld_offers = [];
$ld_products = [];

$offerIndex = 0;
foreach ($cliente['productos'] as $p) {
    $productId  = $seo_base_url . '/#product-' . ($offerIndex + 1);
    $offerId    = $seo_base_url . '/#offer-' . ($offerIndex + 1);
    $offerIndex++;

    $ld_products[] = [
        '@type' => 'Product',
        '@id'   => $productId,
        'name' => $p['nombre'],
        'description' => $p['descripcion'],
        'category' => 'Suplementos Deportivos',
        'image' => $seo_base_url . '/assets/img/' . $p['imagen'],
        'offers' => ['@id' => $offerId],
    ];

    $ld_offers[] = [
        '@type' => 'Offer',
        '@id'   => $offerId,
        'price' => '0',
        'priceCurrency' => 'ARS',
        'availability' => 'https://schema.org/InStock',
        'url' => 'https://wa.me/' . $wa_number . '?text=' . urlencode('Hola! Vi ' . $p['nombre'] . ' en tu web y quisiera más información'),
        'itemOffered' => ['@id' => $productId],
    ];

    $ld_store_offers[] = ['@id' => $offerId];
}

// Categorías de productos que el negocio cubre (consulta por WhatsApp)
$seo_categorias = $cliente['seo_categorias'] ?? [];
$seo_categorias_imagenes = $cliente['seo_categorias_imagenes'] ?? [];
foreach ($seo_categorias as $cat) {
    if (empty($seo_categorias_imagenes[$cat])) {
        continue;
    }

    $productId = $seo_base_url . '/#product-' . ($offerIndex + 1);
    $offerId   = $seo_base_url . '/#offer-' . ($offerIndex + 1);
    $offerIndex++;

    $ld_products[] = [
        '@type' => 'Product',
        '@id'   => $productId,
        'name' => $cat,
        'description' => $cat . ' — Consultá por WhatsApp en ' . $cliente['nombre'] . '. ' . $seo_localidad . ', Córdoba.',
        'category' => 'Suplementos Deportivos',
        'image' => $seo_base_url . $seo_categorias_imagenes[$cat],
        'offers' => ['@id' => $offerId],
    ];

    $ld_offers[] = [
        '@type' => 'Offer',
        '@id'   => $offerId,
        'price' => '0',
        'priceCurrency' => 'ARS',
        'availability' => 'https://schema.org/InStock',
        'url' => 'https://wa.me/' . $wa_number . '?text=' . urlencode('Hola! Quiero info sobre ' . $cat),
        'itemOffered' => ['@id' => $productId],
    ];

    $ld_store_offers[] = ['@id' => $offerId];
}

$ld_sameas = array_values(array_filter([
    $cliente['redes']['instagram'] ?? '',
    $cliente['redes']['facebook'] ?? '',
]));

$ld_json = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'Store',
            '@id' => $seo_base_url . '/#business',
            'name' => $cliente['nombre'],
            'slogan' => $cliente['slogan'] ?? '',
            'description' => strip_tags($seo_description),
            'url' => $seo_base_url . '/',
            'telephone' => '+' . $wa_number,
            'image' => $og_image_url,
            'logo' => $og_image_url,
            'currenciesAccepted' => 'ARS',
            'paymentAccepted' => 'Efectivo, Transferencia, Mercado Pago',
            'priceRange' => '$$',
            'areaServed' => [
                ['@type' => 'City', 'name' => $seo_localidad],
                ['@type' => 'State', 'name' => htmlspecialchars($seo_provincia)],
                ['@type' => 'AdministrativeArea', 'name' => $cliente['seo_zona_influencia'] ?? 'Interior de Córdoba'],
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Santiago del Estero 1402',
                'addressLocality' => $seo_localidad,
                'addressRegion' => htmlspecialchars($seo_provincia),
                'postalCode' => 'X5850',
                'addressCountry' => 'AR',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => $seo_lat,
                'longitude' => $seo_long,
            ],
            'hasMap' => $cliente['ubicaciones'][0]['gmaps_link'] ?? '',
            'sameAs' => $ld_sameas,
            'makesOffer' => $ld_store_offers,
            'founder' => [
                '@type' => 'Person',
                'name' => 'Emiliano Zebalos',
                'jobTitle' => 'Dueño',
            ],
        ],
        [
            '@type' => 'BreadcrumbList',
            '@id' => $seo_base_url . '/#breadcrumb',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => $seo_keywords . ' en ' . $seo_localidad,
                    'item' => $seo_base_url . '/#productos',
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => $seo_localidad . ', ' . htmlspecialchars($seo_provincia),
                    'item' => $seo_base_url . '/#ubicacion',
                ],
            ],
        ],
        [
            '@type' => 'WebSite',
            '@id' => $seo_base_url . '/#website',
            'url' => $seo_base_url . '/',
            'name' => htmlspecialchars($cliente['nombre']) . ' — ' . $seo_keywords . ' en ' . $seo_localidad,
            'description' => $seo_description,
            'inLanguage' => 'es',
            'author' => [
                '@type' => 'Organization',
                'name' => 'MiLocalWeb',
                'url' => 'https://milocalweb.com.ar',
                'telephone' => '+5493513783473',
                'description' => 'Páginas web para negocios locales — Diseño, SEO y presencia digital',
                'image' => $seo_base_url . '/assets/img/milocalweb/logos/logo-principal-690x300-transp.webp',
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => 'Angelo de Peredo 34',
                    'addressLocality' => 'Córdoba',
                    'addressRegion' => 'Córdoba',
                    'postalCode' => 'X5000BTB',
                    'addressCountry' => 'AR',
                ],
            ],
        ],
    ],
];

// Agregar marcas como entidades Organization al @graph
$seo_marcas = $cliente['seo_marcas'] ?? [];
foreach ($seo_marcas as $i => $marca) {
    $ld_json['@graph'][] = [
        '@type' => 'Organization',
        '@id' => $seo_base_url . '/#brand-' . ($i + 1),
        'name' => $marca,
        'description' => $marca . ' — Marca de suplementos deportivos disponible en ' . $cliente['nombre'] . ' en ' . $seo_localidad,
    ];
}

// Agregar Products y Offers al @graph
$ld_json['@graph'] = array_merge($ld_json['@graph'], $ld_products, $ld_offers);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- ─── Metadatos básicos ──────────────────────────────────── -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="author" content="milocalweb.com.ar">
    <meta name="generator" content="MiLocalWeb">
    <meta name="theme-color" content="<?= htmlspecialchars($cliente['colors']['color-primary'] ?? '#8DC63F') ?>">
    <meta name="mobile-web-app-capable" content="yes">

    <!-- ─── SEO primario ──────────────────────────────────────── -->
    <title><?= $seo_title ?></title>
    <meta name="description" content="<?= $seo_description ?>">
    <link rel="canonical" href="<?= $canonical_url ?>/">

    <!-- ─── Geo tags (SEO local) ─────────────────────────────── -->
    <meta name="geo.region" content="AR-X">
    <meta name="geo.placename" content="<?= $seo_placename ?>">
    <meta name="geo.position" content="<?= $seo_lat ?>;<?= $seo_long ?>">
    <meta name="ICBM" content="<?= $seo_lat ?>, <?= $seo_long ?>">

    <!-- ─── Open Graph (WhatsApp, Facebook, Instagram) ───────── -->
    <meta property="og:title" content="<?= $og_title_meta ?>">
    <meta property="og:description" content="<?= $og_description ?>">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="es_AR">
    <meta property="og:url" content="<?= $canonical_url ?>/">
    <meta property="og:image" content="<?= $og_image_url ?>">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">
    <meta property="og:image:alt" content="<?= $og_image_alt ?>">
    <meta property="og:site_name" content="<?= htmlspecialchars($cliente['nombre']) ?>">

    <!-- ─── Twitter Card ──────────────────────────────────────── -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $og_title_meta ?>">
    <meta name="twitter:description" content="<?= $og_description ?>">
    <meta name="twitter:image" content="<?= $og_image_url ?>">
    <meta name="twitter:image:alt" content="<?= $og_image_alt ?>">

    <!-- Favicon -->
    <?php $fav = $cliente['favicon'] ?? $img . 'iconos/favicon.ico'; ?>
    <link rel="icon" type="image/x-icon" href="<?= $fav ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= $fav ?>">

    <!-- JSON-LD Structured Data for AI / Search Engines -->
    <script type="application/ld+json">
    <?= json_encode($ld_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>
    </script>

    <!-- Google Fonts: Bebas Neue para headings -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;600;700;800;900&display=swap" rel="stylesheet">

    <?php foreach ($cssFiles as $file): ?>
    <link rel="stylesheet" href="<?= $css . $file . $cssVersions[$file] ?>">
    <?php endforeach; ?>

    <!-- Colores del cliente -->
    <?php if (!empty($cs)): ?>
    <style>
        :root {
            <?php foreach ($cs as $var => $val): ?>
            --<?= $var ?>: <?= $val ?>;
            <?php endforeach; ?>
        }
    </style>
    <?php endif; ?>

    <!-- Tipografía -->
    <?php if (!empty($cliente['tipografia'])): ?>
    <style>
        body { font-family: <?= $cliente['tipografia'] ?>; }
    </style>
    <?php endif; ?>
</head>
<body>
    <header class="site-header">
        <nav class="navbar" role="navigation" aria-label="Navegación principal">
            <?php $logo_src = $cliente['logo_img'] ?? $img . 'logo.png'; ?>
            <div class="navbar-brand">
                <a href="#" class="brand-link">
                    <img src="<?= $logo_src ?>"
alt="Logo <?= htmlspecialchars($cliente['nombre']) ?> — Suplementos deportivos en <?= $seo_localidad ?>"
                          class="brand-logo"
                         loading="eager">
                    <span class="brand-name"><?= htmlspecialchars($cliente['nombre']) ?></span>
                </a>
            </div>
            <button class="navbar-toggle" aria-label="Abrir menú" aria-expanded="false">
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
                <span class="toggle-bar"></span>
            </button>
            <ul class="navbar-menu">
                <li><a href="#inicio">Inicio</a></li>
                <li><a href="#estrella">Ofertas</a></li>
                <li><a href="#productos">Productos</a></li>
                <li><a href="#ubicacion">Encontranos</a></li>
                <li><a href="#nosotros">Conocenos en Acción</a></li>
                <li>                <a href="<?= $wa_full ?>" target="_blank" rel="noopener noreferrer" class="nav-cta">
                    Contactanos
                    <?php include $svg . 'whatsapp.svg'; ?>
                </a></li>
            </ul>
        </nav>
        <div class="navbar-overlay" aria-hidden="true"></div>
    </header>
    <main class="site-main">
