# Guía de SEO para IAs y Google — Landing Pages MiLocalWeb

> **Objetivo**: Que una IA pueda auditar e implementar optimización SEO completa
> en cualquier landing page de MiLocalWeb siguiendo este documento paso a paso.
>
> **Audiencia dual**: Instrucciones técnicas para la IA + contexto para humanos.
> Las secciones marcadas con `<!-- HUMAN:` son explicativas y la IA debe saltearlas
> para no gastar tokens. Las secciones sin ese marcador son instrucciones
> ejecutables que la IA DEBE procesar.

---

<!-- HUMAN:
Esta guía cubre dos frentes:

1. **SEO tradicional (Google)**: meta tags, HTML semántico, sitemap, robots.txt,
   keywords, rendimiento. Para que Google indexe y posicione la página.
2. **SEO para IAs (LLMs)**: Schema.org JSON-LD, entity definitions, sameAs,
   geo-coordinates. Para que ChatGPT, Gemini, Perplexity y buscadores con IA
   recomienden esta página en sus respuestas.

El principio fundamental: los LLMs no "rankean" como Google. Los LLMs buscan
entidades claras, datos estructurados, y señales de autoridad. Si tu página
le dice explícitamente a una IA "soy una tienda de suplementos en Río Tercero,
Córdoba, vendemos creatina, proteína y colágeno, nuestro Instagram es X,
nuestro WhatsApp es Y", la IA va a poder recomendarte con precisión quirúrgica.

Sin structured data, la IA tiene que ADIVINAR. Con structured data, la IA SABE.
-->

---

## 0. Principios para que una IA recomiende esta página

<!-- HUMAN:
Las IAs no usan PageRank. Para que un LLM recomiende tu negocio necesitás 3 cosas:
1. Que entienda QUÉ es el negocio (entidad clara vía JSON-LD)
2. Que sepa DÓNDE está (geo-coordinates, address locality)
3. Que pueda verificar que es real (sameAs a redes sociales, consistencia NAP)
-->

La IA DEBE garantizar que estos 3 pilares estén presentes en toda landing page:

| Pilar | Qué busca el LLM | Dónde se implementa |
|-------|------------------|---------------------|
| **Entidad clara** | `@type: LocalBusiness` o `Store` con `makesOffer` de productos | JSON-LD en `<head>` |
| **Ubicación exacta** | `geo` con lat/long + `addressLocality: "Río Tercero"` | JSON-LD + meta geo + contenido visible |
| **Verificación social** | `sameAs` apuntando a Instagram, Facebook, Google Business Profile | JSON-LD + links visibles en footer |

---

## 1. Metadatos obligatorios en `<head>`

### 1.1 Template completo de meta tags

La IA DEBE insertar el siguiente bloque EN ESTE ORDEN dentro del `<head>`,
reemplazando los placeholders `{...}` con datos reales de `config.php`.

```html
<!-- ─── Metadatos básicos ──────────────────────────────────── -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="index, follow">
<meta name="author" content="milocalweb.com.ar">
<meta name="generator" content="MiLocalWeb">
<meta name="theme-color" content="{COLOR_PRIMARY}">
<meta name="mobile-web-app-capable" content="yes">

<!-- ─── SEO primario ──────────────────────────────────────── -->
<title>{NOMBRE} — {KEYWORDS_PRIMARIAS} en {LOCALIDAD}, {PROVINCIA}</title>
<meta name="description" content="{DESCRIPCION_SEO}">
<link rel="canonical" href="https://{DOMINIO}/">

<!-- ─── Geo tags (obligatorio para SEO local) ────────────── -->
<meta name="geo.region" content="AR-X">
<meta name="geo.placename" content="{LOCALIDAD}, {PROVINCIA}, Argentina">
<meta name="geo.position" content="{LAT};{LONG}">
<meta name="ICBM" content="{LAT}, {LONG}">

<!-- ─── Open Graph (WhatsApp, Facebook, Instagram) ───────── -->
<meta property="og:title" content="{NOMBRE} — {KEYWORDS_PRIMARIAS} en {LOCALIDAD}">
<meta property="og:description" content="{OG_DESCRIPTION}">
<meta property="og:type" content="website">
<meta property="og:locale" content="es_AR">
<meta property="og:url" content="https://{DOMINIO}/">
<meta property="og:image" content="https://{DOMINIO}{OG_IMAGE_PATH}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{NOMBRE} — {RUBRO} en {LOCALIDAD}">
<meta property="og:site_name" content="{NOMBRE}">

<!-- ─── Twitter Card ──────────────────────────────────────── -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{NOMBRE} — {KEYWORDS_PRIMARIAS} en {LOCALIDAD}">
<meta name="twitter:description" content="{OG_DESCRIPTION}">
<meta name="twitter:image" content="https://{DOMINIO}{OG_IMAGE_PATH}">
<meta name="twitter:image:alt" content="{NOMBRE} — {RUBRO} en {LOCALIDAD}">
```

### 1.2 Cómo rellenar cada placeholder

La IA DEBE obtener estos valores de `config.php` y de los siguientes criterios:

| Placeholder | Fuente | Ejemplo para EZ Nutrifit |
|-------------|--------|---------------------------|
| `{NOMBRE}` | `$cliente['nombre']` | `EZ Nutrifit` |
| `{KEYWORDS_PRIMARIAS}` | Ver sección 4 (Keywords) | `Suplementos Deportivos` |
| `{LOCALIDAD}` | Extraer de `direccion` principal | `Río Tercero` |
| `{PROVINCIA}` | Extraer de `direccion` | `Córdoba` |
| `{DESCRIPCION_SEO}` | 150-160 chars con keywords + ubicación + CTA | Ver sección 4.2 |
| `{DOMINIO}` | `$_SERVER['HTTP_HOST']` en producción | `eznutrifit.milocalweb.com.ar` |
| `{COLOR_PRIMARY}` | `$cliente['colors']['color-primary']` | `#8DC63F` |
| `{LAT}`, `{LONG}` | Google Maps embed URL o config | `-32.1692529`, `-64.136046` |
| `{OG_IMAGE_PATH}` | `$cliente['logo_img']` o imagen hero | `/assets/img/cliente/logos/logo-300x300-transp.webp` |
| `{OG_DESCRIPTION}` | Primera oración de `hero_descripcion` | Ver sección 4.2 |
| `{RUBRO}` | `$cliente['rubro']` | `Suplementos Dietarios` |

### 1.3 Reglas estrictas para meta tags

- **`author`**: DEBE ser siempre `"milocalweb.com.ar"`. Es la atribución del
  creador de la página. NO usar el nombre del dueño del negocio.
- **`geo.position`** e **`ICBM`**: DEBEN usar la latitud y longitud del primer
  punto de venta listado en `ubicaciones[0]`. Extraer del parámetro `!3d` (lat)
  y `!2d` (long) del iframe de Google Maps, o del campo `gmaps_link`.
- **`theme-color`**: DEBE coincidir con `color-primary` del cliente para que
  Chrome en Android tiña la barra de navegación.
- **`canonical`**: siempre apunta a `https://{DOMINIO}/`. Si hay múltiples
  dominios apuntando al mismo sitio, esto evita contenido duplicado.

---

## 2. Structured Data — JSON-LD (CRÍTICO para IAs)

<!-- HUMAN:
Esto es LO MÁS IMPORTANTE para que ChatGPT, Gemini, y Perplexity recomienden
la página. Sin JSON-LD, los LLMs no tienen datos estructurados para entender
el negocio. Los motores de búsqueda con IA (SGE, Bing Chat) usan Schema.org
como fuente primaria. Si no está, no existís para la IA.
-->

### 2.1 LocalBusiness + Productos — Template completo

La IA DEBE insertar el siguiente bloque JSON-LD ANTES del cierre de `</head>`,
rellenando TODOS los campos con datos reales. NO dejar placeholders vacíos:
si un dato no existe, omitir la propiedad completa.

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Store",
      "@id": "https://{DOMINIO}/#business",
      "name": "{NOMBRE}",
      "slogan": "{SLOGAN}",
      "description": "{DESCRIPCION_SEO}",
      "url": "https://{DOMINIO}/",
      "telephone": "+{WHATSAPP_FORMATEADO}",
      "email": "{EMAIL}",
      "image": "https://{DOMINIO}{LOGO_PATH}",
      "logo": "https://{DOMINIO}{LOGO_PATH}",
      "currenciesAccepted": "ARS",
      "paymentAccepted": "Efectivo, Transferencia, Mercado Pago",
      "priceRange": "$$",
      "areaServed": [
        {
          "@type": "City",
          "name": "{LOCALIDAD}"
        },
        {
          "@type": "State",
          "name": "{PROVINCIA}"
        },
        {
          "@type": "AdministrativeArea",
          "name": "{ZONA_INFLUENCIA}"
        }
      ],
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "{CALLE_ALTURA}",
        "addressLocality": "{LOCALIDAD}",
        "addressRegion": "{PROVINCIA}",
        "postalCode": "{CPA}",
        "addressCountry": "AR"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "{LAT}",
        "longitude": "{LONG}"
      },
      "hasMap": "{GOOGLE_MAPS_LINK}",
      "openingHoursSpecification": "OPCIONAL",
      "sameAs": [
        "{INSTAGRAM_URL}",
        "{FACEBOOK_URL}",
        "{TIKTOK_URL}"
      ],
      "makesOffer": [
        {PRODUCTOS_SCHEMA_LISTA}
      ],
      "founder": {
        "@type": "Person",
        "name": "{NOMBRE_DUENIO}",
        "jobTitle": "Dueño"
      },
      "author": {
        "@type": "Organization",
        "name": "MiLocalWeb",
        "url": "https://milocalweb.com.ar",
        "telephone": "+5493513783473",
        "description": "Páginas web para negocios locales — Diseño, SEO y presencia digital"
      }
    }
  ]
}
</script>
```

### 2.2 Template para cada producto en `makesOffer`

Cada producto listado en `$cliente['productos']` genera una entrada así:

```json
{
  "@type": "Product",
  "name": "{PRODUCTO_NOMBRE}",
  "description": "{PRODUCTO_DESCRIPCION}",
  "category": "Suplementos Deportivos",
  "image": "https://{DOMINIO}/assets/img/{PRODUCTO_IMAGEN}",
  "offers": {
    "@type": "Offer",
    "availability": "https://schema.org/InStock",
    "priceCurrency": "ARS",
    "businessFunction": "https://purl.org/goodrelations/v1#Sell",
    "url": "https://wa.me/{WHATSAPP}?text=Hola!%20Vi%20{PRODUCTO_NOMBRE_ENCODED}%20en%20tu%20web"
  }
}
```

### 2.3 FAQ Schema (si la sección de preguntas existe)

Si la landing tiene una sección de preguntas frecuentes, la IA DEBE agregar al
`@graph` un bloque `FAQPage`:

```json
{
  "@type": "FAQPage",
  "@id": "https://{DOMINIO}/#faq",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "{PREGUNTA}",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "{RESPUESTA}"
      }
    }
  ]
}
```

### 2.4 BreadcrumbList (señal de estructura incluso en single-page)

La IA DEBE agregar un BreadcrumbList aunque la página sea single-page.
Google y los LLMs lo usan como señal de pertenencia geográfica y de categoría:

```json
{
  "@type": "BreadcrumbList",
  "@id": "https://{DOMINIO}/#breadcrumb",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "{RUBRO}",
      "item": "https://{DOMINIO}/#productos"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "{LOCALIDAD}, {PROVINCIA}",
      "item": "https://{DOMINIO}/#ubicacion"
    }
  ]
}
```

### 2.5 Reglas estrictas para JSON-LD

- **`author.telephone`**: SIEMPRE debe ser `+5493513783473`. Es el WhatsApp de
  MiLocalWeb como creador de la página. Esto le dice a la IA QUIÉN hizo la web
  y cómo contactarlo.
- **`author.name`**: SIEMPRE `"MiLocalWeb"`.
- **`sameAs`**: SOLO incluir URLs que existan. Si `tiktok` está vacío en config,
  NO incluir esa URL en el array. Filtrar con `array_filter()`.
- **`areaServed`**: Incluir SIEMPRE la localidad, la provincia, y la zona de
  influencia (ej: "Valle de Calamuchita", "Interior de Córdoba").
- **`openingHoursSpecification`**: Si `$cliente['horario']` está vacío, OMITIR
  esta propiedad completamente. NUNCA inventar horarios.
- **`email`**: Si `$cliente['email']` está vacío, OMITIR la propiedad. NUNCA
  inventar emails.
- **`priceRange`**: Usar `$` para económico, `$$` para medio, `$$$` para premium.
  Para suplementos deportivos, `$$` es apropiado.
- **`image` y `logo`**: DEBEN ser URLs absolutas completas con `https://`.

### 2.6 Consistencia JSON-LD ↔ Contenido Visible (OBLIGATORIO)

<!-- HUMAN:
Google exige que toda entidad declarada en JSON-LD tenga evidencia en contenido
visible de la página. Si el JSON-LD lista "Carnitina" como producto pero la
palabra "Carnitina" no aparece en ninguna parte visible, Google puede marcar
el structured data como spammy e ignorarlo completamente.
-->

La IA DEBE garantizar que cada entidad del `@graph` tenga contraparte visible:

| Entidad JSON-LD | Debe aparecer en |
|-----------------|-----------------|
| Cada `Product` en `makesOffer` | Mencionado en `hero_descripcion`, `nosotros_texto`, o subtítulos de sección |
| Cada `Organization` (marca) en `@graph` | Mencionada en contenido visible (hero, nosotros, productos) |
| `address` / `geo` | Coincidir con lo visible en la sección Ubicación |

**Estrategia de distribución**: NO saturar una sola ubicación con todas las keywords.
Distribuir naturalmente entre `hero_descripcion`, `productos.php` subtitle, y `nosotros_texto`.

**NO hacer**: declarar productos/marcas solo en JSON-LD sin mencionarlos en contenido visible.
Google Schema.org docs: *"You should mark up only the content that is visible to people."*

### 2.7 Categorías de productos y marcas como entidades expandidas

Además de los productos destacados con imagen en `$cliente['productos']`, la IA DEBE
agregar al `@graph` del JSON-LD:

1. **Categorías de productos** como entradas `Product` sin imagen (usando `seo_categorias` en config.php).
   Ej: Proteína, Creatina, Pre-entreno, Aminoácidos, BCAA, Vitaminas, etc.
   Estas entradas le dicen a las IAs "este negocio vende estas categorías", incluso si no
   están en la sección de productos destacados.

2. **Marcas** como entradas `Organization` en el `@graph` (usando `seo_marcas` en config.php).
   Ej: Star Nutrition, ENA, Gentech, etc.
   Estas entradas le dicen a las IAs "este negocio distribuye estas marcas".

3. **TODAS las categorías y marcas declaradas en JSON-LD DEBEN aparecer también
   en contenido visible** de la página (ver sección 2.6).

---

## 3. Estructura HTML semántica

### 3.1 Jerarquía de headings (checklist)

La IA DEBE verificar que la página cumpla con esta jerarquía. Si no la cumple,
DEBE corregir los templates PHP.

```
<h1> — {RUBRO} en {LOCALIDAD} (único en la página, SIN slogan)
  └─ Debe ser CONCISO: solo keywords del rubro + ubicación
  └─ NO incluir el slogan — nadie busca por slogan, no aporta SEO
  └─ Ejemplo: "Suplementos Deportivos en Río Tercero"

<h2> — Título de cada sección principal (natural para humanos)
  └─ Usar lenguaje natural, no queries de búsqueda textuales
  └─ Las keywords van en un <p> subtítulo debajo del H2
  └─ Ejemplo H2: "Donde nos podés encontrar"
  └─ Ejemplo subtítulo: "Visitá nuestros stands y comprá suplementos deportivos en Río Tercero"
  └─ Google indexa el contexto semántico de la sección, no solo el H2

<h3> — Subtítulos dentro de secciones (nombres de productos, sub-secciones)
  └─ Cada producto DEBE ser un <h3> con su nombre
  └─ Las direcciones DEBEN usar <h3>, NO <p> genérico
```

### 3.2 Reglas de heading

- **Un solo `<h1>`** por página. Debe contener SOLO keywords del rubro + ubicación.
  NO incluir el slogan ni frases aspiracionales. El H1 responde la query del usuario.
- **Los `<h2>`** deben ser naturales para el humano. Si se necesita densidad de keywords,
  usar un `<p class="section-subtitle">` inmediatamente después del H2 con las keywords.
- **NO usar queries de búsqueda textuales como H2.** "Dónde comprar suplementos en Río Tercero"
  es una query de Google, no un título de sección. Va en el subtítulo.
- **Los nombres de productos** DEBEN ser `<h3>`. Google indexa los headings
  de productos como señales de relevancia para keywords de producto.
- **NO usar headings para estilo visual**. Si algo se ve grande pero no es un
  título semántico, usar CSS, no un heading tag.

### 3.3 Alt text de imágenes

<!-- HUMAN:
El alt text es doblemente importante: para Google Images y para IAs que
procesan la página. Una IA como ChatGPT Vision o Gemini VE el alt text
como descripción de la imagen. Si el alt text es genérico, la IA no
entiende qué muestra la imagen.
-->

La IA DEBE verificar que TODAS las imágenes tengan alt text descriptivo que
incluya keywords cuando sea relevante:

| Tipo de imagen | Formato de alt text | Ejemplo |
|---------------|---------------------|---------|
| Logo | `Logo {NOMBRE} — {RUBRO} en {LOCALIDAD}` | `Logo EZ Nutrifit — Suplementos deportivos en Río Tercero` |
| Producto | `{PRODUCTO} — {NOMBRE} en {LOCALIDAD}` | `Creatina micronizada — EZ Nutrifit Río Tercero` |
| Galería | `{NOMBRE} — {CONTEXTO} en {LOCALIDAD}` | `EZ Nutrifit — Suplementos en FREE BOX Río Tercero` |
| Mapa | `Mapa de {NOMBRE} en {DIRECCION}` | `Mapa de EZ Nutrifit en Santiago del Estero 1402, Río Tercero` |
| Iconos SVG | NO usan alt. Usan `aria-hidden="true"` | Decorativos, no necesitan descripción |
| Logo MiLocalWeb | `MiLocalWeb.com.ar — Páginas web para negocios locales` | Siempre igual en todos los proyectos |

---

## 4. Estrategia de Keywords

### 4.1 Cómo definir las keywords para cada cliente

<!-- HUMAN:
Las keywords no se inventan. Se derivan de 3 fuentes:
1. El rubro del cliente (qué vende)
2. La ubicación (dónde está)
3. El comportamiento de búsqueda local (qué busca la gente)

Para suplementos deportivos en Río Tercero, la gente busca:
- "suplementos Río Tercero"
- "creatina Río Tercero"
- "proteína Río Tercero"
- "dónde comprar suplementos en Río Tercero"
- "tienda suplementos deportivos Córdoba"
-->

La IA DEBE derivar las keywords del rubro en `$cliente['rubro']` y de los
productos en `$cliente['productos']`, combinándolos con la ubicación.

### 4.2 Template de keywords por posición

La IA DEBE distribuir las keywords en estas posiciones exactas:

| Posición | Formato | Ejemplo (EZ Nutrifit) |
|----------|---------|------------------------|
| `<title>` | `{NOMBRE} — {RUBRO} en {LOCALIDAD}, {PROVINCIA}` | `EZ Nutrifit — Suplementos Deportivos y Nutrición en Río Tercero, Córdoba` |
| `<meta description>` | `{NOMBRE}: {PRODUCTOS_TOP} en {LOCALIDAD}. {CTA_WA}. {ZONA_INFLUENCIA}.` | `EZ Nutrifit: creatina, proteína y colágeno en Río Tercero. Suplementación deportiva de alto rendimiento. Contactanos por WhatsApp. Envíos a todo el interior de Córdoba.` |
| `<h1>` | `{RUBRO} en {LOCALIDAD}` (SIN slogan) | `Suplementos Deportivos en Río Tercero` |
| `<h2>` Productos | `{RUBRO} y Nutrición Deportiva` | `Suplementos y Nutrición Deportiva` |
| `<h2>` Ubicación | Título natural (`Donde nos podés encontrar`) | Ver subtítulo abajo |
| Subtítulo Ubicación | `<p>` debajo del H2 con keywords de búsqueda | `Visitá nuestros stands de venta y comprá suplementos deportivos de calidad en Río Tercero.` |
| Primer `<p>` después de `<h1>` | Debe incluir {PRODUCTOS} + {MARCAS} + {LOCALIDAD} + {ZONA_INFLUENCIA} | `hero_descripcion` en config.php |
| Alt text de imágenes | `{PRODUCTO} — {NOMBRE} {LOCALIDAD}` | Ver tabla en 3.3 |

### 4.3 Zona de influencia — keywords geográficas expandidas

La IA DEBE agregar menciones naturales de localidades cercanas en el contenido
visible (hero description, nosotros, ubicación). NO hacer keyword stuffing.
Las localidades deben aparecer en contexto de "envíos", "zona de cobertura",
o "dónde encontrarnos".

Para Río Tercero, la zona de influencia incluye:

```
Localidades a mencionar (según contexto):
- Río Tercero (foco principal)
- Córdoba (provincia)
- Interior de Córdoba
- Valle de Calamuchita
- Villa General Belgrano
- Embalse
- Santa Rosa de Calamuchita
- Almafuerte
- Tancacha
```

La IA DEBE agregarlas en `areaServed` del JSON-LD y en una frase natural
dentro de `hero_descripcion` o `nosotros_texto`. Ejemplo:

> "Suplementación deportiva de alto rendimiento en Río Tercero. Envíos a todo
> el interior de Córdoba: Calamuchita, Villa General Belgrano, Embalse y más."

### 4.4 Densidad de keywords (regla flexible)

- La keyword primaria (`{rubro} + {localidad}`) debe aparecer en: `<title>`,
  `<h1>`, primer `<p>`, `<meta description>`, y al menos un `<h2>`.
- Las keywords de producto (`creatina`, `proteína`, `colágeno`) deben aparecer
  en los `<h3>` de los productos y en el `<meta description>`.
- NO repetir keywords de forma artificial. La legibilidad manda.

---

## 5. Archivos técnicos obligatorios

### 5.1 robots.txt

La IA DEBE verificar que exista `robots.txt` en la raíz. Si no existe, DEBE
crearlo con este contenido:

```txt
# MiLocalWeb — {DOMINIO}
# Permite indexación completa de Google y Bing

User-agent: *
Allow: /
Sitemap: https://{DOMINIO}/sitemap.xml

# Bloquear rastreo de archivos internos
Disallow: /config.php
Disallow: /includes/
Disallow: /docs/
Disallow: /skills/

# Crawl delay amigable
Crawl-delay: 10
```

### 5.2 sitemap.xml

La IA DEBE crear `sitemap.xml` en la raíz con este contenido:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
        xmlns:geo="http://www.google.com/geo/schemas/sitemap/1.0">
  <url>
    <loc>https://{DOMINIO}/</loc>
    <lastmod>{FECHA_HOY}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>1.0</priority>
    <geo:geo>
      <geo:format>georss</geo:format>
    </geo:geo>
    {IMAGENES_SITEMAP}
  </url>
</urlset>
```

Donde `{IMAGENES_SITEMAP}` lista las imágenes principales del sitio:

```xml
<image:image>
  <image:loc>https://{DOMINIO}{LOGO_PATH}</image:loc>
  <image:title>{NOMBRE} — Logo</image:title>
</image:image>
```

La IA DEBE generar un `<image:image>` por cada imagen relevante: logo, hero,
y cada producto. Máximo 10 imágenes en el sitemap.

---

## 6. Archivo `config.php` — Campos necesarios para SEO

### 6.1 Campos que DEBEN existir en config.php

La IA DEBE verificar que `config.php` tenga estos campos. Si faltan, DEBE
agregarlos después de confirmar con el usuario:

```php
// ─── Datos para SEO ───────────────────────────────────────────

'seo_keywords_primarias' => '{RUBRO}',
// Ej: 'Suplementos Deportivos'

'seo_zona_influencia' => '{ZONA}',
// Ej: 'Interior de Córdoba, Valle de Calamuchita, Villa General Belgrano, Embalse'

'seo_localidad' => '{LOCALIDAD}',
// Ej: 'Río Tercero'

'seo_provincia' => '{PROVINCIA}',
// Ej: 'Córdoba'

'seo_og_image' => '{PATH}',
// Ej: '/assets/img/cliente/logos/logo-300x300-transp.webp'
// Idealmente una imagen 1200x630 para Open Graph

'seo_lat' => '{LAT}',
// Ej: '-32.1692529'
// Extraer del primer ubicaciones[0].gmaps_link

'seo_long' => '{LONG}',
// Ej: '-64.136046'

'seo_categorias' => ['{CAT1}', '{CAT2}', ...],
// Ej: ['Proteína', 'Creatina', 'Colágeno', 'Pre-entreno', 'Aminoácidos', ...]
// Categorías de productos que el negocio cubre. Se agregan al JSON-LD como Product.
// DEBEN aparecer también en contenido visible (hero_descripcion, nosotros_texto, etc.)

'seo_marcas' => ['{MARCA1}', '{MARCA2}', ...],
// Ej: ['Star Nutrition', 'ENA', 'Gentech', 'Xtrength', ...]
// Marcas que el negocio distribuye. Se agregan al JSON-LD como Organization.
// DEBEN aparecer también en contenido visible.
```

### 6.2 Campos que deben actualizarse en ficha-cliente.md

La IA DEBE verificar que `docs/ficha-cliente.md` tenga estos campos bajo una
sección `## SEO`:

```markdown
## SEO

- **Keywords primarias**: {RUBRO}
- **Keywords de producto**: {LISTA_PRODUCTOS}
- **Localidad**: {LOCALIDAD}
- **Provincia**: {PROVINCIA}
- **Zona de influencia**: {ZONA_INFLUENCIA}
- **Coordenadas (lat, long)**: {LAT}, {LONG}
- **Google Maps link**: {GMAPS_LINK}
- **Google Business Profile URL**: {GBP_URL}
```

---

## 7. Checklist de implementación para la IA

Cuando una IA recibe este documento como guía, DEBE ejecutar estos pasos en orden:

### Fase A — Auditoría (solo lectura, no modifica)

- [ ] A.1 Leer `config.php` y extraer todos los datos disponibles
- [ ] A.2 Leer `includes/header.php` y verificar estado actual de meta tags
- [ ] A.3 Verificar existencia de `robots.txt` y `sitemap.xml`
- [ ] A.4 Verificar existencia de JSON-LD en el `<head>`
- [ ] A.5 Revisar jerarquía de headings (un solo `<h1>`, `<h2>` en secciones)
- [ ] A.6 Revisar alt text de todas las imágenes
- [ ] A.7 Reportar al usuario: qué falta, qué sobra, qué está mal

### Fase B — Corrección de meta tags en `header.php`

- [ ] B.1 Actualizar `<title>` con formato `{NOMBRE} — {RUBRO} en {LOCALIDAD}`
- [ ] B.2 Actualizar `<meta description>` con 150-160 chars incluyendo keywords + ubicación + CTA
- [ ] B.3 Agregar `<meta author="milocalweb.com.ar">`
- [ ] B.4 Agregar `<meta generator="MiLocalWeb">`
- [ ] B.5 Agregar `<meta name="theme-color">` con color primario
- [ ] B.6 Agregar `<link rel="canonical">`
- [ ] B.7 Agregar meta tags geo (`geo.region`, `geo.placename`, `geo.position`, `ICBM`)
- [ ] B.8 Agregar `og:image`, `og:image:width`, `og:image:height`, `og:image:alt`
- [ ] B.9 Agregar `og:site_name`
- [ ] B.10 Agregar Twitter Card completo

### Fase C — JSON-LD Structured Data

- [ ] C.1 Crear bloque `<script type="application/ld+json">` con `@graph`
- [ ] C.2 Agregar nodo `Store` con todos los campos de la sección 2.1
- [ ] C.3 Agregar `makesOffer` con un nodo `Product` por cada producto
- [ ] C.4 Agregar `author` como Organization con datos de MiLocalWeb
- [ ] C.5 Agregar `BreadcrumbList` con rubro + ubicación
- [ ] C.6 Insertar el bloque ANTES de `</head>`

### Fase D — Archivos técnicos

- [ ] D.1 Crear `robots.txt` con el template de la sección 5.1
- [ ] D.2 Crear `sitemap.xml` con el template de la sección 5.2
- [ ] D.3 Verificar que `.htaccess` tenga HTTPS forzado (RewriteRule a https)
- [ ] D.4 Verificar que `.htaccess` tenga headers de caché para assets

### Fase E — Contenido semántico

- [ ] E.1 Verificar que `<h1>` incluya keywords de rubro + ubicación
- [ ] E.2 Verificar que cada sección tenga un `<h2>` descriptivo
- [ ] E.3 Verificar que cada producto sea un `<h3>` con su nombre
- [ ] E.4 Verificar alt text de todas las imágenes
- [ ] E.5 Agregar menciones de zona de influencia en contenido visible

### Fase F — Documentación

- [ ] F.1 Actualizar `docs/ficha-cliente.md` con sección `## SEO`
- [ ] F.2 Agregar campos SEO a `config.php` si faltan

---

## 8. Verificación post-implementación

La IA DEBE instruir al usuario que verifique con estas herramientas:

| Herramienta | URL | Qué verifica |
|-------------|-----|--------------|
| Google Rich Results Test | `https://search.google.com/test/rich-results` | Que el JSON-LD sea válido |
| Schema.org Validator | `https://validator.schema.org/` | Que el structured data esté bien formado |
| Open Graph Debugger | `https://www.opengraph.xyz/` | Que las previews de WhatsApp/Facebook se vean bien |
| Google PageSpeed Insights | `https://pagespeed.web.dev/` | Rendimiento + SEO básico |
| Google Search Console | `https://search.google.com/search-console` | Indexación, sitemap, errores |

---

## 9. Notas específicas para MiLocalWeb

### 9.1 Atribución de autor

TODA landing page de MiLocalWeb DEBE declarar:

- `meta author`: `"milocalweb.com.ar"`
- `meta generator`: `"MiLocalWeb"`
- JSON-LD `author.name`: `"MiLocalWeb"`
- JSON-LD `author.telephone`: `"+5493513783473"`
- JSON-LD `author.url`: `"https://milocalweb.com.ar"`

Esto cumple dos funciones:
1. **SEO**: Google y las IAs asocian la página con MiLocalWeb como creador
2. **Lead gen**: Si alguien ve el código fuente o un LLM analiza la página,
   encuentra el contacto de MiLocalWeb para pedir su propia web

### 9.2 Footer MiLocalWeb (no tocar)

El footer con el badge de MiLocalWeb es obligatorio. La IA NUNCA debe:
- Eliminar el link a `milocalweb.com.ar#contacto`
- Eliminar el texto "Hecho con ❤️ por MiLocalWeb.com.ar"
- Eliminar el CTA "¿Te gustó esta web? Pedí la tuya sin cargo"
- Cambiar el WhatsApp de MiLocalWeb (`5493513783473`) en el footer

### 9.3 El WhatsApp float (no tocar)

El botón flotante de WhatsApp es obligatorio. La IA NUNCA debe eliminarlo.
Solo puede modificar el `href` si el número de WhatsApp del cliente cambió.

### 9.4 Performance vs SEO

Las landing pages de MiLocalWeb usan CSS vanilla sin frameworks para maximizar
rendimiento. La IA NO DEBE:
- Agregar Bootstrap, Tailwind u otros frameworks CSS
- Agregar jQuery o frameworks JS
- Agregar Google Analytics sin consultar al usuario
- Agregar fuentes de íconos (los SVG inline ya cumplen esa función)

La velocidad de carga es un factor de ranking. Cada KB cuenta.

---

## 10. Lecciones Aprendidas — Proyecto EZ Nutrifit

<!-- HUMAN:
Esta sección se agregó después de auditar e implementar SEO en el proyecto
real de EZ Nutrifit. Son aprendizajes concretos que la guía original no cubría
y que aplican a TODOS los proyectos futuros de MiLocalWeb.
-->

### 10.1 El H1 NO debe incluir el slogan

El slogan del negocio ("Estamos con vos y para vos") no es una keyword — nadie
lo busca en Google. Incluirlo en el H1 ocupa espacio visual sin aportar valor SEO
y descuadra el layout en desktop. El H1 debe ser solo `{RUBRO} en {LOCALIDAD}`.

### 10.2 H2 natural + subtítulo keyword (no al revés)

Poner una query de búsqueda como H2 ("Dónde comprar suplementos en Río Tercero")
es técnicamente correcto para SEO pero suena robótico y antinatural para el humano.
La solución: H2 en lenguaje natural ("Donde nos podés encontrar") + `<p>` subtítulo
con keywords ("Visitá nuestros stands y comprá suplementos deportivos en Río Tercero").
Google indexa el contexto semántico de la sección completa vía BERT/MUM, no solo el H2.

### 10.3 JSON-LD: cada entidad necesita contraparte visible

Google exige que toda entidad del structured data aparezca en contenido visible.
Si el JSON-LD declara 12 categorías de productos + 8 marcas, TODAS deben aparecer
mencionadas en alguna parte visible de la página. La estrategia: distribuir las
keywords entre `hero_descripcion`, subtítulos de sección, y `nosotros_texto`.

### 10.4 Idioma: español para Argentina, con excepciones

- Contenido visible y JSON-LD: SIEMPRE en español.
- Términos técnicos que se buscan en inglés (BCAA, Whey Protein): mantener en inglés
  pero AGREGAR traducción al castellano argentino al lado: "BCAA (Aminoácidos Ramificados)".
- Nombres de producto y marcas: en su idioma original, sin traducción.

### 10.5 Hidden text = NUNCA

No usar `hidden`, `display:none`, `opacity:0`, ni ninguna técnica de texto oculto
para agregar keywords. Es black-hat SEO penalizado con desindexación por Google desde 2007.
El JSON-LD es el mecanismo legal para darle datos estructurados a las máquinas.

### 10.6 El hero_description debe incluir productos reales, no frases genéricas

"Suplementación deportiva de alto rendimiento" no matchea ninguna query de búsqueda.
"Creatina, proteína, colágeno y pre-entrenos en Río Tercero" sí. Las keywords con
intención de compra (nombres de productos + marcas + ubicación) son las que convierten.

### 10.7 Categorías y marcas como entidades JSON-LD expandidas

No limitarse a los productos destacados en `makesOffer`. Agregar TODAS las categorías
que el negocio cubre aunque no tengan imagen propia, y TODAS las marcas que distribuye
como entidades `Organization` en el `@graph`. Esto le dice a las IAs el alcance real
del negocio, no solo lo que está en la sección de productos destacados.

---

<!-- HUMAN:
## Resumen para el humano

Esta guía cubre todo lo que una landing page de MiLocalWeb necesita para:
1. Posicionar en Google para búsquedas locales ("suplementos Río Tercero")
2. Ser recomendada por IAs como ChatGPT, Gemini y Perplexity
3. Mantener consistencia entre todas las landing pages del portfolio

Lo más importante: el JSON-LD con Schema.org. Eso es lo que las IAs leen
para decidir si recomiendan tu página. Sin eso, sos invisible para la IA.

Lo segundo más importante: los meta tags geo y las keywords locales en
headings. Google los usa para posicionarte en búsquedas "cerca de mí".

El resto (sitemap, robots.txt, alt text) son señales de calidad que suman
pero no definen el ranking por sí solos.
-->
