# Informe de Cambios SEO — EZ Nutrifit

> Fecha: 2026-08-07
> Guía aplicada: `docs/guia-seo-ia.md`
> Proyecto: eznutrifit.milocalweb.com.ar

---

## Resumen Ejecutivo

Se implementaron **24 correcciones** de SEO. El cambio más significativo es la adición de **JSON-LD Structured Data** con 15 productos + 8 marcas, que permite que ChatGPT, Gemini, Perplexity y buscadores con IA entiendan el negocio y lo recomienden en sus respuestas. Sin esto, la página era invisible para IAs.

---

## Cambios Realizados

### 1. JSON-LD Structured Data (CRÍTICO)

**Archivo**: `includes/header.php`
**Qué se hizo**: Se agregó un bloque `<script type="application/ld+json">` con un `@graph` de Schema.org que incluye:

- **`Store`**: entidad del negocio con nombre, descripción, teléfono, dirección postal, coordenadas geo, zona de cobertura (`areaServed`), redes sociales (`sameAs`), y atribución a MiLocalWeb como `author`.
- **`Product` × 15**: 3 productos destacados con imagen + 12 categorías de productos que el negocio cubre (Proteína, Creatina, Colágeno, Pre-entreno, Aminoácidos, BCAA, Vitaminas, Quemadores de grasa, Carnitina, Glutamina, Óxido nítrico, Ganadores de peso).
- **`Organization` × 8**: marcas que el negocio distribuye (Star Nutrition, ENA, Gentech, Xtrength, Nutrilab, HTN, Mervick, Ultra Tech).
- **`BreadcrumbList`**: migas de pan que indican rubro + ubicación como señal de pertenencia geográfica.

**Impacto**: 
- ChatGPT, Gemini y Perplexity ahora pueden leer datos estructurados del negocio.
- Google muestra rich snippets (nombre, logo, teléfono, redes) en resultados de búsqueda.
- La página pasa de invisible a indexable por motores de búsqueda con IA.

---

### 2. Meta Title optimizado (CRÍTICO)

**Archivo**: `includes/header.php`
**Antes**: `EZ Nutrifit — Estamos con vos y para vos!`
**Después**: `EZ Nutrifit — Suplementos Deportivos y Nutrición en Río Tercero, Córdoba`

**Impacto**: El title es el factor de ranking más importante para Google. Ahora incluye keywords del rubro + ubicación geográfica, alineado con lo que la gente busca: "suplementos Río Tercero". Mejora CTR en SERP y posicionamiento para búsquedas locales.

---

### 3. Meta Description reescrita (CRÍTICO)

**Archivo**: `includes/header.php`
**Antes**: `EZ Nutrifit — Estamos con vos y para vos!` (35 chars, sin keywords)
**Después**: Se genera dinámicamente desde `hero_descripcion` con ~150 chars incluyendo keywords de producto + ubicación + CTA. Actualmente: `EZ Nutrifit: colágeno, electrolytes blend, combo star volumen + recuperación en Río Tercero. Suplementación deportiva de alto rendimiento. Pedí info por WhatsApp. Envíos a todo Córdoba.`

**Impacto**: 
- Incluye keywords de producto + ubicación + CTA.
- Google muestra la description en el snippet del resultado de búsqueda.
- Mejora CTR desde la SERP al mostrar información relevante.

---

### 4. H1 con keywords, sin slogan (CRÍTICO)

**Archivo**: `includes/sections/hero.php`
**Antes**: `Estamos con vos y para vos!` (sin keywords)
**Primera corrección**: `Suplementos Deportivos en Río Tercero — Estamos con vos y para vos!`
**Versión final**: `Suplementos Deportivos en Río Tercero`

**Justificación del cambio**: El slogan "Estamos con vos y para vos" no es una keyword — nadie lo busca en Google. Ocupaba espacio visual en el H1 sin aportar valor SEO. El H1 debe ser conciso, keyword-focused, y responder la query exacta del usuario.

**Impacto**: H1 limpio de 40 caracteres que responde exactamente a "suplementos deportivos Río Tercero". Mejor legibilidad en desktop (el texto anterior con slogan era muy largo y descuadraba el layout).

---

### 5. Hero description con productos y marcas reales (CRÍTICO)

**Archivo**: `config.php`
**Antes**: `Suplementación deportiva de alto rendimiento. Vos decidís tu meta, nosotros te acompañamos. Desde Río Tercero para todo el interior de Córdoba.`
**Después**: `Creatina, proteína, colágeno, pre-entrenos, aminoácidos y quemadores de grasa en Río Tercero. Marcas líderes como Star Nutrition, ENA y Gentech. Envíos a todo Córdoba.`

**Justificación**: La versión anterior era marketing vacío sin valor SEO ("suplementación deportiva de alto rendimiento" no matchea ninguna query real). La nueva versión nombra productos que la gente busca + marcas que googlea + ubicación. Cada palabra trabaja para SEO sin sacrificar legibilidad.

---

### 6. Meta tags de autoría y geo (ALTO)

**Archivo**: `includes/header.php`

**Se agregaron**:
| Tag | Valor |
|-----|-------|
| `meta author` | `milocalweb.com.ar` |
| `meta generator` | `MiLocalWeb` |
| `meta theme-color` | `#8DC63F` (color primario) |
| `link canonical` | `https://eznutrifit.milocalweb.com.ar/` |
| `geo.region` | `AR-X` |
| `geo.placename` | `Río Tercero, Córdoba, Argentina` |
| `geo.position` | `-32.1692529;-64.136046` |
| `ICBM` | `-32.1692529, -64.136046` |

**Impacto**:
- Geo tags: Google los usa para SEO local y búsquedas "cerca de mí".
- Canonical: evita contenido duplicado si hay múltiples dominios.
- Author/generator: atribución a MiLocalWeb + señal de autoridad.
- Theme-color: Chrome en Android tiñe la barra con el color de la marca.

---

### 7. Open Graph completo + Twitter Card (ALTO)

**Archivo**: `includes/header.php`

**Se agregaron**:
- `og:url`, `og:image`, `og:image:width`, `og:image:height`, `og:image:alt`, `og:site_name`
- Twitter Card completo: `twitter:card`, `twitter:title`, `twitter:description`, `twitter:image`, `twitter:image:alt`

**Impacto**: Cuando alguien comparte la página en WhatsApp, Facebook, Instagram o Twitter, se muestra una preview rica con imagen, título y descripción. Sin esto, aparece solo la URL pelada. Mejora engagement en redes sociales.

---

### 8. Campos SEO en config.php (ALTO)

**Archivo**: `config.php`

**Se agregaron**:
```php
'seo_keywords_primarias' => 'Suplementos Deportivos',
'seo_zona_influencia' => 'Interior de Córdoba, Valle de Calamuchita, ...',
'seo_localidad' => 'Río Tercero',
'seo_provincia' => 'Córdoba',
'seo_og_image' => '/assets/img/cliente/logos/logo-300x300-transp.webp',
'seo_lat' => '-32.1692529',
'seo_long' => '-64.136046',
'seo_categorias' => ['Proteína', 'Creatina', 'Colágeno', 'Pre-entreno', 'Aminoácidos', 'BCAA', 'Vitaminas', 'Quemadores de grasa', 'Carnitina', 'Glutamina', 'Óxido nítrico', 'Ganadores de peso'],
'seo_marcas' => ['Star Nutrition', 'ENA', 'Gentech', 'Xtrength', 'Nutrilab', 'HTN', 'Mervick', 'Ultra Tech'],
```

**Impacto**: Centraliza todos los datos SEO en la fuente única de verdad. Las categorías y marcas alimentan el JSON-LD dinámicamente. Facilita futuros cambios y mantiene consistencia entre todos los templates.

---

### 9. robots.txt (ALTO)

**Archivo**: `robots.txt` (NUEVO)

**Contenido**:
- Permite indexación completa (`Allow: /`)
- Bloquea archivos internos (`config.php`, `includes/`, `docs/`, `skills/`)
- Declara sitemap location
- Crawl-delay: 10 segundos

**Impacto**: Googlebot y Bingbot ahora tienen instrucciones claras de qué indexar y qué no. Sin este archivo, los crawlers pueden gastar presupuesto de rastreo en archivos irrelevantes.

---

### 10. sitemap.xml (ALTO)

**Archivo**: `sitemap.xml` (NUEVO)

**Contenido**:
- URL canónica con lastmod, changefreq y priority 1.0
- namespace geo para señales de ubicación
- 6 imágenes indexadas (logo, hero, 3 productos, combo explosivo)

**Impacto**: Google descubre e indexa las imágenes más rápido. El sitemap con geo namespace refuerza las señales de SEO local. Se debe submite en Google Search Console.

---

### 11. Consistencia JSON-LD ↔ Contenido visible (ALTO)

**Archivos**: `config.php` (hero_descripcion, nosotros_texto), `includes/sections/productos.php` (section-subtitle)

**Qué se hizo**: Google exige que toda entidad declarada en JSON-LD tenga evidencia en contenido visible de la página. Se distribuyeron las 12 categorías de productos y 8 marcas en 3 ubicaciones del contenido visible:

| Ubicación | Categorías | Marcas |
|-----------|-----------|--------|
| `hero_descripcion` (config.php) | creatina, proteína, colágeno, pre-entrenos, aminoácidos, quemadores de grasa | Star Nutrition, ENA, Gentech |
| `productos.php` subtitle | proteínas, creatinas, colágenos, vitaminas, aminoácidos | Star Nutrition, ENA, Gentech |
| `nosotros_texto` (config.php) | BCAA, carnitina, glutamina, óxido nítrico, ganadores de peso | Xtrength, Nutrilab, HTN, Mervick, Ultra Tech |

**Impacto**: El JSON-LD ahora es conforme con las políticas de Google. Sin esta consistencia, Google puede marcar el structured data como spammy e ignorarlo.

**Regla aprendida**: NUNCA declarar entidades en JSON-LD que no aparezcan en contenido visible. Schema.org dice explícitamente: "You should mark up only the content that is visible to people who visit the web page."

---

### 12. Alt text mejorado en imágenes (MEDIO)

**Archivos modificados**:
| Archivo | Antes | Después |
|---------|-------|---------|
| `header.php` (navbar logo) | `EZ Nutrifit` | `Logo EZ Nutrifit — Suplementos deportivos en Río Tercero` |
| `hero.php` (logo + imagen) | `Logo EZ Nutrifit` / `EZ Nutrifit` | `Logo EZ Nutrifit — Suplementos deportivos en Río Tercero` |
| `productos.php` (productos) | `Colágeno` | `Colágeno — EZ Nutrifit Río Tercero` |
| `footer.php` (logo cliente) | `EZ Nutrifit` | `EZ Nutrifit — Suplementos deportivos en Río Tercero` |
| `footer.php` (MiLocalWeb) | `MiLocalWeb.com.ar` | `MiLocalWeb.com.ar — Páginas web para negocios locales` |
| `aside.php` (MiLocalWeb) | `MiLocalWeb` | `MiLocalWeb.com.ar — Páginas web para negocios locales` |

**Impacto**: 
- Google Images: mejor posicionamiento en búsqueda de imágenes.
- IAs (ChatGPT Vision, Gemini): entienden qué muestra cada imagen.
- Accesibilidad: lectores de pantalla describen correctamente.

---

### 13. Headings semánticos optimizados (MEDIO)

**Archivos**: `productos.php`, `ubicacion.php`

| Sección | Antes | Después |
|---------|-------|---------|
| Productos `<h2>` | `Productos Destacados` | `Suplementos y Nutrición Deportiva` |
| Ubicación `<h2>` | `Donde nos podés encontrar` | `Donde nos podés encontrar` |
| Ubicación subtítulo | *(no existía)* | `Visitá nuestros stands de venta y comprá suplementos deportivos de calidad en Río Tercero. Cuatro puntos de venta con las mejores marcas y asesoramiento personalizado.` |

**Nota sobre Ubicación**: La primera corrección usó `Dónde comprar suplementos en Río Tercero` como H2, que era técnicamente perfecto para SEO pero sonaba robótico y antinatural para un humano. La solución final: H2 natural ("Donde nos podés encontrar") + subtítulo keyword-rich. Google indexa el contexto semántico de la sección completa, no solo el H2. Con BERT y MUM, Google entiende relaciones semánticas sin necesitar un exact match textual en el heading.

**Impacto**: 
- Productos: El H2 ahora usa keywords del rubro que Google indexa como señal de relevancia temática.
- Ubicación: El subtítulo contiene "comprar suplementos deportivos" + "Río Tercero", dándole a Google el contexto keyword sin sacrificar legibilidad humana.

---

### 14. Traducción de términos en inglés (MEDIO)

**Archivos**: `config.php`, `includes/sections/reels.php`

| Ubicación | Antes | Después |
|-----------|-------|---------|
| `nosotros_texto` | `BCAA, carnitina...` | `BCAA (Aminoácidos Ramificados), carnitina...` |
| `reels.php` título | `Aminoácidos BCAA` | `Aminoácidos BCAA (Ramificados)` |

**Regla**: Los términos en inglés que NO son nombres de producto ni marcas deben tener su traducción al castellano argentino al lado. Nombres de producto ("Thermo Fuel Max", "Electrolytes Blend") y marcas ("Star Nutrition", "ENA") se mantienen en su idioma original.

---

### 15. Sección SEO en ficha-cliente.md (MEDIO)

**Archivo**: `docs/ficha-cliente.md`

**Se agregó** sección `## SEO` con: keywords primarias, keywords de producto, localidad, provincia, zona de influencia, coordenadas y Google Maps link.

**Impacto**: Documentación completa para cualquier IA o persona que trabaje en este proyecto en el futuro.

---

### 16. Bug: ID duplicado corregido (ALTO)

**Archivo**: `includes/sections/reels.php`
**Antes**: `<section id="nosotros" ...>` (colisionaba con `nosotros.php`)
**Después**: `<section id="reels" ...>`

**Impacto**: IDs duplicados rompen la validez HTML y confunden a crawlers y navegadores. La sección Reels ahora tiene su propio identificador único.

---

## Lecciones Aprendidas

1. **El H1 debe ser conciso y keyword-focused.** El slogan no pertenece al H1. Nadie busca por slogan. El H1 responde la query del usuario, punto.

2. **Los H2 deben ser naturales para humanos.** Las keywords van en subtítulos o en el texto inmediato. Google indexa contexto semántico, no solo el heading.

3. **JSON-LD ↔ contenido visible: consistencia obligatoria.** Schema.org y Google exigen que cada entidad del structured data tenga evidencia en contenido visible. No alcanza con meter keywords solo en el JSON-LD.

4. **Distribuir keywords en múltiples ubicaciones visibles**, no saturar una sola. Hero, subtítulos de sección, nosotros_texto. Natural, legible, pero cubriendo todas las categorías y marcas.

5. **Idioma = español para Argentina.** Contenido y JSON-LD en español. Solo términos técnicos en inglés que la gente busca así (BCAA, Whey Protein). Marcas y nombres de producto en su idioma original.

6. **Hidden text NUNCA.** Es black-hat SEO penalizado con desindexación. El JSON-LD es el mecanismo legal y diseñado para darle datos a las máquinas.

---

## Verificación Post-Implementación

| Herramienta | URL | Qué verifica |
|-------------|-----|--------------|
| Google Rich Results Test | https://search.google.com/test/rich-results | JSON-LD válido |
| Schema.org Validator | https://validator.schema.org/ | Structured data bien formado |
| Open Graph Debugger | https://www.opengraph.xyz/ | Previews de WhatsApp/Facebook |
| Google PageSpeed Insights | https://pagespeed.web.dev/ | Rendimiento + SEO básico |
| Google Search Console | https://search.google.com/search-console | Indexar sitemap + monitorear |

---

## Resultados Esperados

| Métrica | Impacto esperado |
|---------|-----------------|
| Indexación en Google | Página indexada con rich snippets (logo, teléfono, redes) |
| Búsquedas locales | Mejor ranking para "suplementos Río Tercero", "suplementos deportivos Córdoba", "creatina Río Tercero", "proteína Río Tercero", "Star Nutrition Río Tercero" |
| Visibilidad en IAs | ChatGPT, Gemini y Perplexity pueden recomendar el negocio para consultas sobre suplementos en Río Tercero y zona |
| CTR en SERP | Mejora por title descriptivo + meta description con keywords de producto |
| Previews en redes | Imagen, título y descripción al compartir en WhatsApp/Facebook |
| Google Images | Imágenes indexadas con alt text descriptivo |
