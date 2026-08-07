<?php
/**
 * Configuración del cliente — Landing Page.
 *
 * Este archivo es la ÚNICA fuente de datos del sitio. Completalo con los
 * datos del negocio y la landing se genera automáticamente.
 *
 * @package MiLocalWeb\Clientes
 */

return [

    // ─── Datos básicos ───────────────────────────────────────────────

    'nombre'    => 'EZ Nutrifit',
    'slogan'    => 'Estamos con vos y para vos!',
    'rubro'     => 'Suplementos Dietarios — Nutrición — Indumentaria Deportiva',
    'whatsapp'  => '5493571597376',
    'email'     => '',
    'whatsapp_mensaje' => 'Hola! Vi tu web y quisiera más info',

    // ─── Hero Section ────────────────────────────────────────────────

    'hero_layout'     => 'split',
    'hero_descripcion' => 'Creatina, proteína, colágeno, pre-entrenos, aminoácidos y quemadores de grasa en Río Tercero. Marcas líderes como Star Nutrition, ENA y Gentech. Envíos a todo Córdoba.',
    'hero_boton'       => 'Escribinos por WhatsApp',
    'hero_img'         => '/assets/img/cliente/identidad/hero-fondo-gris-575x800.webp',

    // ─── Identidad Visual: High-Contrast Neon ────────────────────────

    'colors' => [
        'color-primary'       => '#8DC63F',
        'color-primary-hover' => '#A8D95A',
        'color-accent'        => '#EB2D2D',
        'color-accent-hover'  => '#FF5555',
        'color-text'          => '#FFFFFF',
        'color-muted'         => '#A0A0A0',
        'color-bg'            => '#0D0D0D',
        'color-bg-alt'        => 'rgba(255, 255, 255, 0.03)',
        'color-card-bg'       => '#1A1A1A',
        'color-hero-bg-start' => '#000000',
        'color-hero-bg-end'   => '#0D1A00',
    ],
    'tipografia' => '"Montserrat", system-ui, -apple-system, "Segoe UI", Roboto, sans-serif',

    // ─── Rutas de imágenes ───────────────────────────────────────────

    'logo_img'  => '/assets/img/cliente/logos/logo-300x300-transp.webp',
    'favicon'   => '/assets/img/cliente/iconos/favicon.ico',

    // ─── Productos Destacados ────────────────────────────────────────

    'productos' => [
        [
            'nombre'      => 'Colágeno',
            'descripcion' => 'Da fuerza a los huesos, flexibilidad a las articulaciones y suaviza la piel. Reduce arrugas, celulitis y previene la caída del cabello.',
            'imagen'      => 'cliente/productos/prod-colageno.webp',
        ],
        [
            'nombre'      => 'Electrolytes Blend',
            'descripcion' => 'Hidratación y recuperación en cápsulas prácticas. 6 minerales y vitaminas. Sin azúcar, sin calorías. El futuro de la hidratación eficiente.',
            'imagen'      => 'cliente/productos/prod-electrolytes.webp',
        ],
        [
            'nombre'      => 'Combo Star Volumen + Recuperación',
            'descripcion' => 'Mutantmass 1.5kg + Creatina 300gr micronizada. Ganador de peso con 23g de proteínas por toma. Mejorá tu rendimiento y recuperación.',
            'imagen'      => 'cliente/productos/prod-combo-star.webp',
        ],
    ],

    // ─── Ubicación (dos puntos de venta) ─────────────────────────────

    'ubicaciones' => [
        [
            'nombre'      => 'FREE BOX Gimnasio',
            'logo'        => '/assets/img/terceros/logo-freebox-450x253.webp',
            'direccion'   => "Santiago del Estero 1402, esq. San Martín\nX5850\nRío Tercero\nCórdoba, Argentina",
            'gmaps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1500!2d-64.13625413423543!3d-32.16930097848404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95cd6fcc6bfb9423%3A0x89cf8d0071c5f8c7!2sFREE%20BOX!5e0!3m2!1ses!2sus!4v1785889933968!5m2!1ses!2sus" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>',
            'gmaps_link'  => 'https://www.google.com/maps?q=-32.1692529,-64.136046',
        ],
        [
            'nombre'      => 'Origen Run & Bike',
            'logo'        => '/assets/img/terceros/logo-origen-300x295.webp',
            'direccion'   => "Ejército de los Andes 129\nX5850\nRío Tercero\nCórdoba, Argentina",
            'gmaps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1500!2d-64.11809079406581!3d-32.18382680384672!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95cd6f33c8d75d99%3A0xea6f9f9ecb87cfe0!2sorigen%20run%20%26%20bike!5e0!3m2!1ses!2sar!4v1785889830560!5m2!1ses!2sar" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>',
            'gmaps_link'  => 'https://www.google.com/maps?q=-32.1839922,-64.1175126',
        ],
        [
            'nombre'      => 'Gimancio Henko',
            'logo'        => '/assets/img/terceros/logo-henko-300x399.webp',
            'direccion'   => "Mitre 38\nX5850\nRío Tercero\nCórdoba, Argentina",
            'gmaps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1500!2d-64.12243999485902!3d-32.1719297340486!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95cd6f006cba0403%3A0x3390974ffa4d7f3e!2sHENKO!5e0!3m2!1ses!2sar!4v1786062325916!5m2!1ses!2sar" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>',
            'gmaps_link'  => 'https://www.google.com/maps?q=-32.1719297,-64.1224399',
        ],
        [
            'nombre'      => 'Somaginci Gym',
            'logo'        => '/assets/img/terceros/logo-somaginci-600x271.webp',
            'direccion'   => "Felipe Varela y San Miguel\nX5850\nRío Tercero\nCórdoba, Argentina",
            'gmaps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1500!2d-64.12360022656418!3d-32.17335382856924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95cd6f37e58c84e7%3A0xffa8877dbad74edb!2sFelipe%20Varela%20%26%20San%20Miguel%2C%20X5850%20R%C3%ADo%20Tercero%2C%20C%C3%B3rdoba!5e0!3m2!1ses!2sar!4v1786063108188!5m2!1ses!2sar" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>',
            'gmaps_link'  => 'https://www.google.com/maps?q=-32.1733538,-64.1236002',
        ],
    ],

    // Compatibilidad con template original
    'direccion'    => "Santiago del Estero 1402, Río Tercero\nEjército de los Andes 129, Río Tercero",
    'gmaps_embed'  => '<iframe src="https://www.google.com/maps/embed?pb=!4v1785879348364!6m8!1m7!1sv5Sfl4H3iFsCMXMQg82OKQ!2m2!1d-32.16911750119117!2d-64.1359509106605!3f207.79!4f-0.37000000000000455!5f0.7820865974627469" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>',
    'gmaps_link'   => 'https://maps.app.goo.gl/Y1kUc9P4mNK7mtMh9',
    'mostrar_estrellas' => false,
    'estrellas'    => 0,
    'total_resenas'=> 0,
    'horario'      => '',

    // ─── Redes Sociales ──────────────────────────────────────────────

    'redes' => [
        'instagram' => 'https://www.instagram.com/ez.nutrifit/',
        'facebook'  => 'https://www.facebook.com/suplementosEZ',
        'tiktok'    => '',
        'web'       => 'https://eznutrifit.milocalweb.com.ar',
    ],

    // ─── Datos para SEO ───────────────────────────────────────────

    'seo_keywords_primarias' => 'Suplementos Deportivos',
    'seo_zona_influencia' => 'Interior de Córdoba, Valle de Calamuchita, Villa General Belgrano, Embalse, Santa Rosa de Calamuchita, Almafuerte, Tancacha',
    'seo_localidad' => 'Río Tercero',
    'seo_provincia' => 'Córdoba',
    'seo_og_image' => '/assets/img/cliente/logos/og-image-1200x630.webp',
    'og_descripcion' => 'Suplementos deportivos en Río Tercero. Creatina, proteína, colágeno y más. ¡Escribinos por WhatsApp!',
    'seo_lat' => '-32.1692529',
    'seo_long' => '-64.136046',
    'seo_categorias' => ['Proteína', 'Creatina', 'Colágeno', 'Pre-entreno', 'Aminoácidos', 'BCAA', 'Vitaminas', 'Quemadores de grasa', 'Carnitina', 'Glutamina', 'Óxido nítrico', 'Ganadores de peso'],
    'seo_categorias_imagenes' => [
        'Proteína'            => '/assets/vid/reels/suplementos-pilares-escenciales.webp',
        'Creatina'            => '/assets/img/cliente/productos/prod-combo-star.webp',
        'Colágeno'            => '/assets/img/cliente/productos/prod-colageno.webp',
        'Aminoácidos'         => '/assets/vid/reels/incluir-aminoacidos-bcaa.webp',
        'BCAA'                => '/assets/vid/reels/incluir-aminoacidos-bcaa.webp',
        'Ganadores de peso'   => '/assets/img/cliente/impacto/estrella-mutantmass-creatina.webp',
        'Quemadores de grasa' => '/assets/img/cliente/impacto/complemento-thermofuelmax.webp',
        // Faltan fotos para: Pre-entreno, Vitaminas, Carnitina, Glutamina, Óxido nítrico
    ],
    'seo_marcas' => ['Star Nutrition', 'ENA', 'Gentech', 'Xtrength', 'Nutrilab', 'HTN', 'Mervick', 'Ultra Tech'],

    // ─── Quiénes Somos ───────────────────────────────────────────────

    'nosotros_texto' => 'Pasión por la suplementación deportiva en Río Tercero. BCAA (Aminoácidos Ramificados), carnitina, glutamina, óxido nítrico y ganadores de peso. Distribuimos Xtrength, Nutrilab, HTN, Mervick, Ultra Tech y más. Envíos a todo el interior de Córdoba.',

    // ─── Galería Nosotros ────────────────────────────────────────────

    'nosotros_galeria' => [
        [
            'imagen' => '/assets/img/cliente/impacto/complemento-betaalanine-creatine.webp',
            'alt'    => 'EZ Nutrifit — Suplementos deportivos',
        ],
        [
            'imagen' => '/assets/img/cliente/impacto/complemento-betaalanine.webp',
            'alt'    => 'EZ Nutrifit — Productos en Río Tercero',
        ],
    ],

    // ─── Aside Publicitario ──────────────────────────────────────────

    'aside_visible'  => true,

    // ─── Otros Clientes ──────────────────────────────────────────────

    'mostrar_clientes'   => false,
    'clientes_encabezado' => 'Otros negocios que confían en MiLocalWeb',
    'clientes' => [
        [
            'nombre' => 'FREE BOX',
            'logo'   => '/assets/img/terceros/logo-freebox-450x253.webp',
            'url'    => 'https://maps.app.goo.gl/Y1kUc9P4mNK7mtMh9',
            'ancho'  => 120,
            'alto'   => 60,
        ],
        [
            'nombre' => 'Origen',
            'logo'   => '/assets/img/terceros/logo-origen-300x295.webp',
            'url'    => 'https://maps.app.goo.gl/Y1kUc9P4mNK7mtMh9',
            'ancho'  => 120,
            'alto'   => 60,
        ],
    ],

];
