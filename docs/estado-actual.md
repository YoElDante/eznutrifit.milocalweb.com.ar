# Estado actual — EZ Nutrifit

Landing page single-page de EZ Nutrifit, suplementos deportivos en Río Tercero, Córdoba. Stack: PHP plano sin framework, CSS modular con build propio y JavaScript vanilla. Auditoría de solo lectura del 2026-11-09: **NO LISTO**, con 56,5/79 ítems aplicables (71,5 %) y P1 abiertos.

> **Nota sobre referencias:** los números de línea son orientativos. La auditoría se hizo antes de la división de archivos y de los comentarios; si un archivo cambió, verificá por selector, meta tag o nombre de función.

## Actualización 2026-11-10 — fixes aplicados

- `nosotros.php` se incluyó en `index.php`; founder y 8 marcas quedaron visibles.
- JSON-LD con 15 Products (3 + 12 categorías), founder desde config y `inLanguage: es-AR`.
- Meta description sin `mb_strtolower`, WhatsApp del aside corregido, skip-link/foco y CSP/bloqueo de archivos internos.
- Detalle completo: [Resumen de fixes](../../../docs/resumen-fixes-2026-11-10.md).

> El veredicto y el puntaje de abajo son el corte de la auditoría 2026-11-09; no se recalcularon.

## Veredicto

| Campo | Valor |
|---|---|
| Estado | **NO LISTO** |
| Cumplimiento | 56,5/79 ítems aplicables (71,5 %) |
| Fecha | 2026-11-09 |
| Alcance | Auditoría de solo lectura + documentación. No se corrigió producto. |

- **Bloqueo principal (P1-01):** `includes/sections/nosotros.php` existe pero no se incluye en `index.php`. La sección obligatoria no se renderiza, y el founder y cinco marcas declaradas en JSON-LD quedan sin contraparte visible.
- **SEO:** la meta description usa `mb_strtolower`, `WebSite.inLanguage` es `es` en vez de `es-AR`, el JSON-LD omite cinco categorías y hardcodea el founder. **Nota:** `geo.region` `AR-X` es el código ISO correcto para Córdoba; la guía del template dice `AR-C` por error (`AR-C` corresponde a CABA).
- **Accesibilidad:** faltan skip-link y `:focus-visible` global; el footer usa `<h4>` y rompe la jerarquía pedida.
- **Funcionalidad/seguridad:** el WhatsApp de MiLocalWeb del aside usa `543513783473` (sin el `9`), la CSP no incluye `frame-ancestors` ni `media-src`, y la regla de `.htaccess` no bloquea `config.php`.
- **Fortalezas verificadas:** `php -l` limpio en 14/14 archivos; bundle CSS byte-idéntico al build; 20/20 imágenes con `alt` y dimensiones; JSON-LD sintácticamente válido; sin dependencias externas de JS/CSS.

## Ficha técnica

| Campo | Valor |
|---|---|
| Ruta | `C:\workspace\MiLocalWeb-WorkSpace\ProyectosWebs\landingpages.clientes\eznutrifit.milocalweb.com.ar` |
| Dominio previsto | `https://eznutrifit.milocalweb.com.ar` (`config.php:131`; canonical derivado de `HTTP_HOST` en `includes/header.php:25-26`) |
| Stack | PHP plano, CSS modular, JS vanilla |
| Entry point | `index.php` |
| Fuente de datos | `config.php` |
| Build CSS | `tools/build-css.php` |
| Build JS | No tiene; 4 scripts vanilla con `defer` |
| Git | Rama `main`; último commit `c62c00a`; working tree con cambios de la sesión documental, sin commits |

## Cumplimiento de especificaciones

> Base: `landingpages.clientes/template/docs/checklist-verificacion.md` y `guia-seo-implementacion.md`.
> `PASS` = cumple; `PARCIAL` = cumple con observaciones; `FAIL` = no cumple; `N/A` = no aplica.
> Las referencias de línea corresponden al estado actual del repositorio; la auditoría original se hizo antes del split de CSS.
>
> Resultado: 52 PASS, 9 PARCIAL, 18 FAIL y 4 N/A. Puntaje: 52 + (9 × 0,5) = **56,5 sobre 79 aplicables (71,5 %)**.
>
> **Corrección posterior:** SEO-03 se había marcado FAIL porque la guía del template indicaba `AR-C` para Córdoba. Verificado ISO 3166-2:AR, `AR-X` es el código correcto de Córdoba (`AR-C` es CABA). Si se recalcula solo ese ítem: 53 PASS, 9 PARCIAL, 17 FAIL = **57,5/79 (72,8 %)**. No se re-auditó el resto.

### Datos y configuración

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| CFG-01 | `config.php` sin placeholders ni lorem ipsum | PASS | `config.php:15-20`; no hay lorem ipsum. |
| CFG-02 | `nombre`, `slogan`, `rubro`, `whatsapp` correctos | PASS | `config.php:15-18`. |
| CFG-03 | `whatsapp` sin espacios/guiones, con país; mensaje personalizado | PASS | `config.php:18,20`; `includes/header.php:12-15`. |
| CFG-04 | `founder_name` y `founder_title` en config, no hardcodeados | FAIL | `includes/header.php:158-162` hardcodea `Emiliano Zebalos` y `Dueño`; no existen esas claves en `config.php`. |
| CFG-05 | `hero_descripcion` con productos + marcas + ubicación | PASS | `config.php:25`. |
| CFG-06 | `nosotros_texto` con keywords y marcas | PASS | `config.php:159`; contenido correcto, no se renderiza (SECT-07). |
| CFG-07 | `colors[]` completo | PASS | `config.php:33-45`; incluye primary, hover, accent, accent-hover, text, muted, bg, bg-alt, card-bg y hero bg. |
| CFG-08 | `tipografia` con fallback `system-ui` | PASS | `config.php:46`. |
| CFG-09 | `seo_keywords_primarias`, `seo_localidad`, `seo_provincia`, `seo_zona_influencia` | PASS | `config.php:136-139`. |
| CFG-10 | `seo_categorias` y `seo_marcas` completos | PASS | `config.php:144` (12 categorías) y `config.php:155` (8 marcas). |
| CFG-11 | `seo_categorias_imagenes` mapea cada categoría o fallback | FAIL | `config.php:145-154`: faltan Pre-entreno, Vitaminas, Carnitina, Glutamina y Óxido nítrico; el propio archivo lo admite en `config.php:153`. |
| CFG-12 | `seo_lat`, `seo_long` y `seo_og_image` existente 1200x630 | PASS | `config.php:140,142-143`; `og-image-1200x630.webp` verificada en 1200x630. |

### Assets

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| AST-01 | Nombres de assets en minúsculas, sin espacios, con prefijos | PARCIAL | `assets/img/milocalweb/iconos/Milocalweb.logo.ico` usa mayúsculas y no tiene referencias en el código; el resto cumple. |
| AST-02 | Sin `.txt` en `assets/`; formato WebP prioritario | PASS | 0 archivos `.txt` en `assets/`; imágenes WebP, favicon `.ico` y textura `.jpg` permitidos. |
| AST-03 | Logo transparente, OG 1200x630, favicon, hero, productos, terceros, videos + posters | PASS | `config.php:27,50-51,55-71,140`; 24/24 assets locales existen; `assets/vid/reels/*.mp4` + posters `.webp`. |
| AST-04 | Fotos de galería "Nosotros" en `identidad/` | FAIL | `config.php:163-172` usa `assets/img/cliente/impacto/`, no `identidad/`. |

### CSS y build

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| CSS-01 | `styles.css` más reciente que fuentes y build ejecutado | PASS | `assets/css/styles.css` regenerado el 2026-11-09 21:46; posterior a las fuentes; hash coincide con el build. |
| CSS-02 | `styles.css` no editado a mano | PASS | SHA-256 `79E66D6C8C77DCE2142A7F09770DAF4BAB8719F1E143DAD8228C274449BDDB0A`, idéntico al build desde las 13 fuentes (29.183 bytes). |
| CSS-03 | Critical CSS inline en `header.php` | PASS | `includes/header.php:286-289`. |
| CSS-04 | `fonts.css` y `styles.css` async con `preload + onload` | PASS | `includes/header.php:283-284` y `292-293`. |
| CSS-05 | Colores vía variables `--color-*`, mínimo hardcodeo | PARCIAL | Variables en `assets/css/base.css:8-19` y `critical.css:6-16`; hay hardcodeos en `hero.css:37,56,101`, `sections/02-estrella.css:9` y `footer.css:9,155`. |
| CSS-06 | Variables derivadas `--color-primary-glow`, `--color-section-dark` | FAIL | `grep` en `assets/css/` sin resultados. |

### JavaScript

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| JS-01 | 4 archivos JS con `defer` en footer | PASS | `includes/footer.php:120-122`; 4 archivos. |
| JS-02 | Cache busting con `filemtime()` en cada script | PASS | `index.php:57-65`; `includes/footer.php:121`. |
| JS-03 | Sin dependencias externas (jQuery, frameworks, CDNs) | PASS | `assets/js/*.js` vanilla; `header.php` y `footer.php` no cargan CDNs. |
| JS-04 | Navbar mobile, smooth scroll, back to top y reels funcionales | PASS | `assets/js/navbar.js:27-38`, `smooth-scroll.js:10-28`, `back-to-top.js:16-26`, `reels.js:29-47` (revisión estática). |

### SEO (checklist)

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| SEO-01 | Title `{nombre} — {keywords} en {localidad}` | PASS | `includes/header.php:30,238`; render: `EZ Nutrifit — Suplementos Deportivos en Río Tercero`. |
| SEO-02 | Meta description sin `mb_strtolower`, con nombres reales | FAIL | `includes/header.php:29,31,239`; render: `colágeno, electrolytes blend, combo star volumen + recuperación…`. |
| SEO-03 | Geo tags: region ISO correcto, placename, position, ICBM | PASS | `includes/header.php:243` usa `AR-X`, código ISO correcto para Córdoba; placename/position/ICBM correctos en `244-246`. La guía del template indica `AR-C` por error (`AR-C` es CABA). |
| SEO-04 | Open Graph completo: title, description, type, locale, image 1200x630, alt, site_name | PASS | `includes/header.php:249-258`; imagen 1200x630 verificada. |
| SEO-05 | Twitter Card `summary_large_image` completa | PASS | `includes/header.php:261-265`. |
| SEO-06 | Canonical correcta y `lang="es"` | PASS | `includes/header.php:25-26,37,226,240`; canonical derivado de `HTTP_HOST` (en local `127.0.0.1`; en producción el host canónico). |
| SEO-07 | JSON-LD `Store` con campos requeridos | PASS | `includes/header.php:120-223,278-280`; render: 1 Store. |
| SEO-08 | JSON-LD `Product` para cada producto y cada categoría, sin saltar | FAIL | `includes/header.php:81-84` hace `continue` si falta imagen; render: 10 Products vs. 15 esperados (3 productos + 12 categorías). |
| SEO-09 | `Offer` vinculados con `@id` y `BreadcrumbList` | PASS | `includes/header.php:44-72,100-108,164-182`; render: 10 Offers + 1 BreadcrumbList. |
| SEO-10 | Marcas como `Organization` | PASS | `includes/header.php:211-220`; render: 8 Organizations. |
| SEO-11 | Founder desde `config.php` | FAIL | `includes/header.php:158-162` hardcodeado. |
| SEO-12 | `WebSite.inLanguage` = `es-AR` | FAIL | `includes/header.php:190` usa `es`. |
| SEO-13 | `robots.txt` permite indexación, bloquea internos y declara sitemap | PASS | `robots.txt:4-15`. |
| SEO-14 | `sitemap.xml` con imágenes, coordenadas y `lastmod` | PARCIAL | `sitemap.xml:7` lastmod fijo `2026-08-07`; `10-12` declara `geo:format=georss` sin latitud/longitud; 6 imágenes en `13-36`, faltan categorías y OG. |
| SEO-15 | `.htaccess` con HTTPS forzado, CSP y cache headers | PARCIAL | `.htaccess:33-36` HTTPS y bloqueo parcial; `13-27` cache; `9` CSP sin `frame-ancestors` ni `media-src`. |
| SEO-16 | Alt text en todas las imágenes con formato `{NOMBRE} en {LOCALIDAD}` | PARCIAL | 20/20 imágenes con `alt`; formato inconsistente en `productos.php:35`, `estrella.php:28` y `ubicacion.php:104,148`. |
| SEO-17 | JSON-LD sintácticamente válido | PASS | `json_decode` OK: 1 bloque, 31 nodos (1 Store, 1 BreadcrumbList, 1 WebSite, 8 Organization, 10 Product, 10 Offer). |
| SEO-18 | Consistencia JSON-LD ↔ contenido visible | FAIL | Founder solo en JSON-LD; 5 marcas (`Xtrength`, `Nutrilab`, `HTN`, `Mervick`, `Ultra Tech`) solo en `config.php:159`, que no se renderiza porque falta `nosotros.php`. |

### Secciones

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| SECT-01 | Hero renderiza layout elegido y H1 = keywords + localidad, sin slogan | PASS | `config.php:24` (`split`); `hero.php:25-55`; H1 en `hero.php:38`. |
| SECT-02 | Productos 1-3 con nombre, descripción, imagen y CTA WhatsApp | PASS | `includes/sections/productos.php:19-55`; 3 tarjetas. |
| SECT-03 | Producto estrella hardcodeado correctamente | PASS | `includes/sections/estrella.php:21-134`. |
| SECT-04 | Ubicación 1-4 puntos con mapa, dirección y logo | PASS | `includes/sections/ubicacion.php:92-176`; `config.php:77-114` (4 puntos). |
| SECT-05 | Google Maps iframes con `title` y zoom `!1d1500` | PARCIAL | No hay iframes en el render: se usan Static Maps (`ubicacion.php:141-155`). El fallback iframe inyecta `title` (`159-166`) y los embeds usan `!1d1500` (`config.php:84,93,102,111`). |
| SECT-06 | Reels con videos y lazy loading | PASS | `includes/sections/reels.php:35-75`; `preload="none"` en `46`. |
| SECT-07 | `nosotros.php` incluido en `index.php` | FAIL | `index.php:72-78` incluye 7 secciones; no incluye `includes/sections/nosotros.php` (el archivo existe: `nosotros.php:25`). |
| SECT-08 | Aside publicitario presente y discreto | PASS | `includes/sections/aside.php:22-45`; `config.php:176`; renderizado entre productos y ubicación. |
| SECT-09 | Sección clientes según `mostrar_clientes` | PASS | `config.php:180` = `false`; `includes/sections/clientes.php:12-20` retorna; no se renderiza. |
| SECT-10 | Footer MiLocalWeb + WhatsApp float | PASS | `includes/footer.php:21-118`; `#25D366` en `footer.css:176`; float en `footer.php:111-118`. |

### Documentación

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| DOC-01 | `AGENTS.md` y skill `milocalweb-landing` presentes | PASS | `AGENTS.md` en raíz; `skills/milocalweb-landing/SKILL.md`. |
| DOC-02 | `README.md` presente | FAIL | No existe en la raíz. El `docs/README.md` creado en esta sesión es un índice de documentación y no cumple este requisito. |
| DOC-03 | `ficha-cliente.md`, `informe_estilo_*`, `guia-relevamiento.md`, `{cliente}.cliente.md` | PARCIAL | `docs/ficha-cliente.md`, `docs/informe_estilo_eznutrifit.md` y `docs/guia-relevamiento.md` presentes; falta `docs/eznutrifit.cliente.md`. |

### Accesibilidad

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| ACC-01 | Skip-link al contenido principal | FAIL | `includes/header.php:313-314` pasa de `<body>` a `<header>` sin skip-link; `grep` sin resultados. |
| ACC-02 | `:focus-visible` global | FAIL | `grep -rn "focus-visible" assets/css/` sin resultados. |
| ACC-03 | Roles ARIA navigation/contentinfo y `aria-label` en secciones | PASS | `includes/header.php:315`; `includes/footer.php:21`; secciones con `aria-label` (`hero.php:25`, `productos.php:19`, etc.). |
| ACC-04 | `aria-expanded` en menú y `aria-hidden` en overlays | PASS | `includes/header.php:328`; `navbar.js:20-30`; render: 1 `aria-expanded` y 3 `aria-hidden="true"`. |
| ACC-05 | Imágenes con `width`/`height` | PASS | Render: 20/20 imágenes con dimensiones. |
| ACC-06 | Sin `h4` en footer; jerarquía h1→h2→h3 | FAIL | `includes/footer.php:34,68` usa `<h4>`; render: h4=5 (3 en estrella `93,109,125` y 2 en footer). |
| ACC-07 | Contraste WCAG AA | N/A | No medido en esta auditoría; los reportes Lighthouse históricos no se re-ejecutaron. |

### Performance

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| PERF-01 | Preload del hero con `fetchpriority="high"` | PASS | `includes/header.php:273-275`. |
| PERF-02 | `loading="lazy"` en imágenes no críticas | PASS | `productos.php:37`, `estrella.php:30,89,105,121`, `nosotros.php:40`, `ubicacion.php:104,151`, `footer.php:27,82`, `aside.php:28`. |
| PERF-03 | `decoding="async"` en no críticas y `auto` en LCP | PARCIAL | Mayoría cumple; Static Maps en `ubicacion.php:147-151` no tiene `decoding`; el hero `split` usa background CSS (`hero.php:29`), sin `<img>` LCP. |
| PERF-04 | Fuentes auto-hosteadas woff2 con `font-display: swap` | PASS | `assets/fonts/fonts.css:8-108`; 4 woff2 en `assets/fonts/`. |
| PERF-05 | Sin Google Fonts ni CDNs externos | PASS | `includes/header.php` solo carga assets locales; no hay `<script src="http...">`. |
| PERF-06 | LCP/TBT/CLS y Lighthouse móvil | N/A | No se ejecutó Lighthouse. Reportes históricos en `docs/informes lighthouse/` (07/08/2026), anteriores al cambio a Static Maps. |

### Funcionalidad

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| FUN-01 | WhatsApp del cliente funcional con mensaje default | PASS | `config.php:18,20`; `header.php:12-15`; `https://wa.me/5493571597376?text=...`. Entrega real no verificable. |
| FUN-02 | WhatsApp de MiLocalWeb en footer y aside | FAIL | `includes/footer.php:96` = `5493513783473`; `includes/sections/aside.php:18` = `543513783473` (sin el `9`). |
| FUN-03 | Links de redes sociales y Google Maps | PASS | `config.php:127-132`; `ubicacion.php:122-127`; URLs válidas. Alcance externo no verificable. |
| FUN-04 | Sin errores PHP, enlaces ni imágenes rotas | PASS | `php -l` 14/14 OK; render sin warnings; 24/24 assets locales OK; 5/5 anchors OK; Static Map externo 200. |

### Mobile

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| MOB-01 | Viewport `width=device-width, initial-scale=1.0` | PASS | `includes/header.php:230`. |
| MOB-02 | Menú hamburguesa, hero/productos/mapas/videos responsive | PASS | `navbar.js:27-38`; `responsive.css:10-324`; revisión estática. |
| MOB-03 | Touch targets ≥44x44 | FAIL | `assets/css/navbar.css:91-92` (36x36); `assets/css/footer.css:65-66` (42x42). |
| MOB-04 | Sin scroll horizontal | N/A | Requiere navegador; `base.css:71,81` usa `overflow-x:hidden` (puede ocultar el problema, no probarlo). |

### Seguridad

| ID | Requisito | Estado | Evidencia |
|---|---|---|---|
| SEC-01 | `secrets.php` en `.gitignore` y no versionado | PASS | `.gitignore:14`; `git ls-files includes/secrets.php` vacío. |
| SEC-02 | CSP con `frame-ancestors` y `media-src` | FAIL | `.htaccess:9` no los incluye; `X-Frame-Options` en `.htaccess:7` mitiga parcialmente. |
| SEC-03 | `display_errors = Off` en producción | N/A | No hay configuración PHP en el repo; depende del hosting. |
| SEC-04 | `htmlspecialchars()` en todo output y `rel="noopener noreferrer"` | PARCIAL | Sin escapar: `header.php:268-269` (`$fav`), `hero.php:29` (`$hero_img` en style) y `footer.php:16,24` (`$logo_src`). 3 links externos usan solo `rel="noopener"`: `footer.php:78,90` y `aside.php:24`. |
| SEC-05 | Sin información sensible en comentarios HTML | PASS | Los comentarios del render son etiquetas de sección; no hay claves ni datos privados. |

## SEO implementado

| Elemento | Estado | Valor encontrado | Evidencia |
|---|---|---|---|
| Title | PASS | `EZ Nutrifit — Suplementos Deportivos en Río Tercero` | `includes/header.php:30,238`; render. |
| Meta description | FAIL | `EZ Nutrifit: colágeno, electrolytes blend, combo star volumen + recuperación en Río Tercero. Suplementos deportivos. Pedí info por WhatsApp.` — nombres de producto en minúscula por `mb_strtolower` | `includes/header.php:29,31,239`; render. |
| Canonical | PASS | `https://{HTTP_HOST}/`; en local `https://127.0.0.1:8102/`; en producción `https://eznutrifit.milocalweb.com.ar/` | `includes/header.php:25-26,37,240`. |
| Robots meta | PASS | `index, follow` | `includes/header.php:231`. |
| `lang` | PASS | `es` | `includes/header.php:226`. |
| `geo.region` | PASS | `AR-X` — código ISO correcto para Córdoba; la guía del template dice `AR-C` por error (CABA) | `includes/header.php:243`; ISO 3166-2:AR |
| `geo.placename`, `geo.position`, `ICBM` | PASS | `Río Tercero, Córdoba, Argentina`; `-32.1692529;-64.136046`; `-32.1692529, -64.136046` | `includes/header.php:244-246`. |
| Open Graph | PASS | title, description, type=website, locale=es_AR, url, image 1200x630, width, height, alt, site_name | `includes/header.php:249-258`. |
| Twitter Card | PASS | `summary_large_image`, title, description, image, image:alt | `includes/header.php:261-265`. |
| JSON-LD (sintaxis y tipos) | PASS | Store ×1, BreadcrumbList ×1, WebSite ×1, Organization ×8, Product ×10, Offer ×10; 31 nodos | `includes/header.php:120-223,278-280`; render parseado. |
| JSON-LD (contenido) | FAIL | `inLanguage` = `es`; founder hardcodeado; 10 Products en vez de 15 (omite Pre-entreno, Vitaminas, Carnitina, Glutamina y Óxido nítrico) | `includes/header.php:81-84,158-162,190`. |
| H1/H2/H3 | PASS | h1=1 (`Suplementos Deportivos en Río Tercero`), h2=4, h3=15, h4=5 | Render DOM; el h4 del footer se objeta en ACC-06. |
| Alt text | PARCIAL | 20/20 con alt; formato variable (`Producto — EZ Nutrifit Río Tercero`, `Combo Explosivo EZ Nutrifit — …`, nombre del punto de venta) | `productos.php:35`, `estrella.php:28`, `ubicacion.php:104,148`. |
| `robots.txt` | PASS | `User-agent: *`, `Allow: /`, sitemap, disallow config/includes/docs/skills, crawl-delay 10 | `robots.txt:4-15`. |
| `sitemap.xml` | PARCIAL | XML válido, 1 URL, 6 imágenes, `lastmod` fijo `2026-08-07`; declara `geo:format=georss` sin latitud/longitud | `sitemap.xml:7,10-12,13-36`. |
| `.htaccess` | PARCIAL | HTTPS forzado, bloqueo de `includes/` (no de `config.php`), cache CSS/JS/fuentes/imágenes/HTML; CSP sin `frame-ancestors` ni `media-src` | `.htaccess:9,13-27,33-36`; ver P1-11. |
| Enlaces internos | PASS | 5 anchors (`#inicio`, `#estrella`, `#productos`, `#ubicacion`, `#reels`), 0 rotos | DOM; `index.php:72-78`; `header.php:334-338`. |
| Imagen OG | PASS | `assets/img/cliente/logos/og-image-1200x630.webp`, 1200x630, 45.888 bytes | `config.php:140`; `getimagesize`. |
| Favicon | PASS | `assets/img/cliente/iconos/favicon.ico` | `config.php:51`; `header.php:268-269`; archivo existe. |
| `hreflang` | N/A | Sitio monolingüe (`lang="es"`); no aplica. | — |

## Deuda y riesgos

> **No corregido en esta sesión.** El alcance fue documental. **No se identificaron hallazgos P0 en el alcance auditado.** Ordenado por impacto.

### P1 — incumplimientos de especificación

| Prioridad | Problema | Impacto | Evidencia | Recomendación |
|---|---|---|---|---|
| P1-01 | `nosotros.php` no está incluido en `index.php` | Sección obligatoria ausente; founder y 5 marcas del JSON-LD sin contraparte visible; se pierde CTA y galería | `index.php:72-78`; `includes/sections/nosotros.php:25` | Agregar el `require_once` antes del footer y un link `#nosotros` en el navbar. |
| P1-02 | JSON-LD omite 5 categorías por falta de imagen | Se pierden keywords para Google/IA; incumple guía B.2 ("NO hacer continue") | `includes/header.php:81-84`; `config.php:145-154` | Quitar el `continue` y usar fallback (logo u OG) para las 5 categorías. |
| P1-03 | Founder hardcodeado en `header.php` | Rompe la fuente única de verdad; si cambia el dueño, el JSON-LD queda desactualizado | `includes/header.php:158-162`; no hay `founder_*` en `config.php` | Agregar `founder_name`/`founder_title` a `config.php` y consumirlos. |
| P1-04 | `WebSite.inLanguage` = `es` | Señal de idioma imprecisa; la guía exige `es-AR` | `includes/header.php:190` | Cambiar a `es-AR`. |
| P1-05 | Meta description generada con `mb_strtolower` | Degrada nombres propios de producto y incumple guía A.2 | `includes/header.php:29,31` | Respetar la capitalización original de `productos[].nombre`. |
| — | `geo.region` = `AR-X` | **No es un hallazgo:** `AR-X` es el código ISO correcto para Córdoba. La guía A.3 del template está equivocada al indicar `AR-C` (`AR-C` es CABA). | `includes/header.php:243`; ISO 3166-2:AR | Corregir la guía del template; no cambiar el HTML. |
| P1-07 | Falta skip-link | Usuarios de teclado/lectores de pantalla no pueden saltar la navegación | `includes/header.php:313-314`; `grep` sin resultados | Insertar `<a class="skip-link" href="#inicio">Saltar al contenido</a>` después de `<body>` y estilos de foco. |
| P1-08 | Falta `:focus-visible` global | Foco de teclado poco visible; incumple checklist de accesibilidad | `grep -rn "focus-visible" assets/css/` sin resultados | Agregar regla global en `base.css` con outline visible. |
| P1-09 | WhatsApp de MiLocalWeb del aside sin el `9` | El CTA de autopromoción puede abrir un número inválido | `includes/sections/aside.php:18` (`543513783473`) vs. `includes/footer.php:96` (`5493513783473`) | Unificar en `5493513783473` o centralizarlo en config. |
| P1-10 | CSP sin `frame-ancestors` ni `media-src` | Incumple checklist de seguridad; `X-Frame-Options` mitiga solo parcialmente | `.htaccess:9`; `.htaccess:7` | Agregar `frame-ancestors 'self'; media-src 'self';` y, opcionalmente, `object-src 'none'`. |
| P1-11 | La regla de bloqueo no cubre `config.php` | La guía E.3 exige bloquear `config.php`; el archivo queda accesible (ejecuta y devuelve vacío, pero sin defensa en profundidad) | `.htaccess:33` usa una regla que solo cubre `config/` e `includes/`; prueba: `config.php` → NO MATCH, `includes/secrets.php` → MATCH | Corregir el patrón para incluir `config.php`, `docs/`, `tools/`, `skills/` y `.git` (ver nota P1-11). |

> **P1-11 — regla sugerida:** `RewriteRule ^(config\.php|includes/|docs/|tools/|skills/|\.git) - [F,L,NC]`

### P2 — mejoras

| Prioridad | Problema | Impacto | Evidencia | Recomendación |
|---|---|---|---|---|
| P2-01 | Sitemap con `lastmod` fijo, sin coordenadas y con 6 imágenes | Pierde señales de actualización/geo e imágenes de categorías/OG | `sitemap.xml:7,10-12,13-36` | Generar `sitemap.php` con `date('Y-m-d')`, coordenadas y todas las imágenes. |
| P2-02 | Formato de alt text inconsistente | Menor señal para Google Images y accesibilidad | `productos.php:35`, `estrella.php:28`, `ubicacion.php:104,148` | Unificar a `{NEGOCIO} — {descripción} en {LOCALIDAD}`. |
| P2-03 | `critical.css` duplica navbar, hero y breakpoints de `responsive.css` | Duplicación de mantenimiento; AGENTS prohíbe duplicar breakpoints | `critical.css:59-400` vs. `navbar.css`, `hero.css`, `responsive.css:10-324` | Extraer solo lo above-the-fold o generar el critical desde las fuentes. |
| P2-04 | Hardcodeos de color y ausencia de variables derivadas | Dificulta el theming por cliente; incumple AGENTS/checklist | `base.css:8-19`; `hero.css:37,56,101`; `sections/02-estrella.css:9`; `footer.css:9,155`; `grep` sin `--color-primary-glow`/`--color-section-dark` | Crear las variables derivadas y reemplazar literales. |
| P2-05 | `<h4>` en el footer | Rompe la jerarquía pedida (h1→h2→h3) | `includes/footer.php:34,68` | Cambiar a `<h3>` o `<p>` con clase. |
| P2-06 | Touch targets menores a 44x44 | Dificulta el uso en mobile | `navbar.css:91-92` (36x36); `footer.css:65-66` (42x42) | Llevar ambos a ≥44x44. |
| P2-07 | `README.md` raíz y `docs/eznutrifit.cliente.md` ausentes | Incumple checklist de documentación | Raíz sin `README.md`; `docs/` sin `eznutrifit.cliente.md` | Crear el README raíz y archivar el relevamiento. `docs/README.md` no reemplaza al README raíz. |
| P2-08 | Documentos internos y `tools/` servidos públicamente | Divulgación de datos del negocio; `build-css.php` ejecutable por HTTP | `curl /docs/ficha-cliente.md` → 200; `.htaccess:33` solo bloquea `config/` e `includes/`, no `config.php`, `docs/`, `tools/` ni `.git` | Bloquear `config.php`, `docs`, `tools`, `skills` y `.git` en `.htaccess` y/o mover docs fuera del docroot. |
| P2-09 | `Milocalweb.logo.ico` con mayúsculas y sin uso | Ruido y violación menor de convención | `assets/img/milocalweb/iconos/Milocalweb.logo.ico`; sin referencias en código | Renombrar a minúsculas o eliminar si no se usa (con confirmación). |
| P2-10 | Ubicación usa Static Maps en lugar de iframe | Desviación de AGENTS §4; el fallback iframe sí cumple `title` y `!1d1500` | `ubicacion.php:134-155`; `config.php:84,93,102,111`; `docs/plan-mejora-lighthouse-01.md` recomienda Static Maps | Documentar la excepción en AGENTS o restaurar el iframe si se exige al pie de la letra. |
| P2-11 | Limpieza de código: doble include de config, lista CSS muerta y variable sin inicializar | Ruido/mantenimiento; riesgo de drift | `index.php:13-14`; `index.php:32-46` (solo definición); `header.php:44-45,74` (`$ld_store_offers` sin inicializar) | Usar `$cliente = require` una vez; eliminar `$cssSourceFiles`; inicializar `$ld_store_offers = []`. |
| P2-12 | Canonical/OG derivados de `HTTP_HOST` sin escape; JSON-LD también usa el host como base | Riesgo de host-header injection/canonical poisoning; en local apunta a `127.0.0.1` | `header.php:25-26,240,253`; base usada en JSON-LD `header.php:126-182` | Fijar el dominio de producción en config y escapar la salida HTML. |
| P2-13 | Static Maps sin `decoding="async"` | Trabajo de decodificación innecesario en imágenes no críticas | `ubicacion.php:147-151` | Agregar `decoding="async"`. |
| P2-14 | Documentación desactualizada | Confunde al próximo mantenedor/IA | `docs/informe-cambios-seo.md:11,23,48` documenta 15 Products y una meta description anterior; `AR-X` sí es correcto para Córdoba; `docs/plan-mejora-lighthouse-01.md:113-119` describe iframes que ya no se usan | Actualizar el informe SEO y el plan Lighthouse al estado real. |
| P2-15 | Sin manejo de 404 | El servidor embebido devuelve 200 con la home para una ruta sin archivo; producción no verificable | `curl /ruta-inexistente-audit-xyz` → 200 con cuerpo idéntico a `/` | Agregar `ErrorDocument 404` y una página 404 mínima. |

## Checklist para considerarlo terminado

- [ ] Todos los P0 resueltos.
- [ ] Todos los P1 resueltos o aceptados por escrito.
- [ ] Checklist de `template/docs/checklist-verificacion.md` al 100 %.
- [ ] Sitemap subido a Search Console.
- [ ] Lighthouse móvil: Performance ≥ 85, Accesibilidad ≥ 95, SEO 100.
- [ ] Sin errores PHP ni enlaces/imágenes rotas.

> No se identificaron P0 en esta auditoría; el bloqueo actual es la lista P1. La documentación y el orden de esta sesión están completos; el producto sigue **NO LISTO**.

## Verificación reproducible

```bash
php -l index.php
php -l includes/header.php
php -S 127.0.0.1:8102 -t .
curl -s -o NUL -w "%{http_code}" http://127.0.0.1:8102/
```

> La auditoría ejecutó `php -l` sobre 14/14 archivos PHP y `curl` sobre las rutas de `mapa-sitio.md`. El servidor embebido no aplica `.htaccess`; los headers y bloqueos deben validarse en Apache.

## Documentos relacionados

- [Arquitectura](arquitectura.md)
- [Mapa del sitio](mapa-sitio.md)
- [Resumen de documentación](resumen-documentacion.md)
