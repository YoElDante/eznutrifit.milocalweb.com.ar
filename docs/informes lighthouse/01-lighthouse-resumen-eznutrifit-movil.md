# Resumen Lighthouse — Navegación Móvil
**Sitio:** https://eznutrifit.milocalweb.com.ar/
**Fecha del análisis:** 07/08/2026
**Dispositivo:** Emulación móvil (Moto G Power)

> ⚠️ Nota: el propio informe advierte que **extensiones de Chrome afectaron negativamente la carga** ("Chrome extensions negatively affected this page's load performance"). Varios hallazgos de JS sin minificar / JS no usado corresponden a extensiones del navegador (MetaMask, Ruffle, ad-blockers, etc.), no al código del sitio. Ya fueron filtrados de este resumen — solo se listan problemas reales del sitio.

---

## 1. Puntajes generales

| Categoría | Puntaje | Estado |
|---|---|---|
| **Performance** | 66 / 100 | 🟠 Necesita mejoras |
| **Accessibility** | 91 / 100 | 🟡 Buena, con detalles a corregir |
| **Best Practices** | 77 / 100 | 🟠 Necesita mejoras |
| **SEO** | 100 / 100 | 🟢 Excelente |

---

## 2. Core Web Vitals / Métricas de carga

| Métrica | Valor | Puntaje | Diagnóstico |
|---|---|---|---|
| First Contentful Paint (FCP) | 2.1 s | 0.80 | Aceptable |
| **Largest Contentful Paint (LCP)** | **3.8 s** | 0.55 | 🔴 Problema principal |
| **Total Blocking Time (TBT)** | **760 ms** | 0.39 | 🔴 Problema principal |
| Cumulative Layout Shift (CLS) | 0.061 | 0.97 | Muy bueno |
| Speed Index | 4.0 s | 0.80 | Aceptable |
| Time to Interactive (TTI) | 3.8 s | 0.89 | Bueno |

**Los dos factores que más penalizan el puntaje de Performance son el LCP (3.8s) y el TBT (760ms).**

---

## 3. Problemas de Performance (detalle)

### 3.1 LCP no se descubre a tiempo (`lcp-discovery-insight`)
El elemento LCP es el fondo del hero (`section#inicio > div.hero-split-bg`), aplicado como `background-image` en CSS inline:
```html
<div class="hero-split-bg" style="background-image: url('/assets/img/cliente/identidad/hero-fondo-gris-575x8...');" aria-hidden="true">
```
- No tiene `fetchpriority="high"`.
- Al ser una imagen de fondo por CSS (no `<img>`), el navegador no puede precargarla hasta que descubre el CSS/HTML completo.

**Recomendación:** convertir esa imagen de fondo crítica en un `<img>` con `fetchpriority="high"` (o agregar un `<link rel="preload" as="image">` en el `<head>` apuntando a esa imagen).

### 3.2 Requests que bloquean el render (`render-blocking-insight`)
9 recursos bloquean el pintado inicial, entre ellos:
- Google Fonts (`fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat...`) — 1204 bytes, **retraso estimado de 1038 ms**
- `navbar.css`, `base.css`, `clientes.css`, `aside.css`, `sections.css` (retraso 150ms), `hero.css`, `responsive.css`, `footer.css`

**Recomendación:**
- Usar `<link rel="preconnect">` + `font-display: swap` para Google Fonts (ya se detecta como candidato de preconnect: `fonts.gstatic.com`, ahorro estimado ~530 ms).
- Combinar/(critical CSS inline) los múltiples archivos CSS pequeños, o cargar los no críticos con `media="print" onload="this.media='all'"` / `rel=preload`.

### 3.3 Cadena de dependencias de red
La cadena más larga arranca en el documento principal y pasa por Google Fonts. Reducir eslabones y priorizar el CSS/JS crítico ayudaría a bajar el LCP.

### 3.4 Imágenes sin `width`/`height` explícitos (`unsized-images`) — 10 elementos
Causan layout shift. Elementos afectados:
- `img.estrella-img` (producto destacado)
- Logos de ubicaciones: `logo-somaginci-600x271.webp`, `logo-freebox-450x253.webp`, `logo-henko-300x399.webp`, `logo-origen-300x295.webp`
- `img.brand-logo` (navbar), `img.hero-logo`, `img.footer-logo` — mismo logo `logo-300x300-transp.webp` usado 3 veces
- ⚠️ **2 imágenes con `width: 0` en el momento de medir** (posible carga rota o diferida sin dimensiones):
  - `aside.publicidad-aside > a.aside-logo > img.aside-logo-img`
  - `footer.site-footer > a.footer-mlw-logo > img.mlw-logo-img`

**Recomendación:** agregar atributos `width`/`height` (o `aspect-ratio` en CSS) a todas las `<img>`, y revisar por qué las dos imágenes marcadas quedan con ancho 0 (posible `src` roto, lazy-load mal configurado, o contenedor colapsado).

### 3.5 Entrega de imágenes mejorable (`image-delivery-insight`)
Ahorro estimado: **152 KiB**. Afecta 8 imágenes, principalmente:
- `secundaria-img` (productos secundarios) x2
- Logos de `ubicacion-logo` (gimnasios asociados) x4
- `estrella-img` (producto destacado)
- El fondo del hero (`hero-split-bg`)

**Recomendación:** servir en formato WebP/AVIF ya optimizado y en el tamaño real de despliegue (muchos logos se muestran a 44–127px de ancho pero probablemente se sirven en resoluciones mayores), y usar `srcset`/`sizes` para servir tamaños según el viewport.

### 3.6 Tiempo de ejecución de JS en el hilo principal
- Trabajo total en `https://eznutrifit.milocalweb.com.ar/`: **~4.6 s** (scripting: 1.2s, parseo/compilación: 1s)
- Desglose del hilo principal: Other 2.1s, Script Evaluation 1.9s, Style & Layout 1.3s, Script Parsing/Compile 1.0s, Parse HTML/CSS 0.26s

**Recomendación:** revisar scripts propios del sitio (no extensiones) — diferir JS no crítico con `defer`/`async`, dividir en chunks más chicos, y evitar trabajo pesado de layout/estilo durante la carga inicial.

---

## 4. Accesibilidad (Accessibility: 91/100)

### 4.1 Contraste de color insuficiente (`color-contrast`) — 6 elementos
| Elemento | Texto | Contraste actual |
|---|---|---|
| `p.estrella-bajada` | "GANADOR DE PESO + CREATINA" | 4.33 (insuficiente) |
| `span.aside-slogan` | "MÁS VISIBILIDAD, MÁS CLIENTES" | 3.99 |
| `p.footer-slogan` | "Estamos con vos y para vos!" | 4.42 (color #757575) |
| `h4` footer "SEGUINOS" | — | 3.39 (color #636363 sobre fondo #050505) |
| `h4` footer "CONTACTO" | — | 3.39 |
| (6to elemento adicional del mismo tipo) | — | — |

**Recomendación:** oscurecer los grises claros (`#757575`, `#636363`) o aclarar el fondo para alcanzar al menos 4.5:1 en texto normal (WCAG AA).

### 4.2 `<iframe>` sin `title` (`frame-title`) — 4 elementos
Los 4 mapas de Google Maps embebidos (`ubicacion-mapa > iframe`) no tienen atributo `title`.

**Recomendación:** agregar `title="Mapa de ubicación de [nombre del gimnasio]"` a cada iframe.

### 4.3 Orden de encabezados incorrecto (`heading-order`) — 1 elemento
El `<h4>` "SUPLEMENTOS ESENCIALES" dentro de `div.reels-grid > div.reel-card > div.reel-info` rompe la jerarquía secuencial de headings.

**Recomendación:** revisar la jerarquía h1→h2→h3→h4 de toda la página y ajustar ese encabezado al nivel que corresponda (probablemente h3, dependiendo del h anterior en esa sección).

---

## 5. Best Practices (77/100)

### 5.1 APIs obsoletas (`deprecations`)
1 advertencia detectada, pero **originada por una extensión de Chrome** (Shared Storage API), no por el código del sitio. No requiere acción en el sitio.

### 5.2 Problemas en el panel "Issues" de DevTools (`inspector-issues`)
Se detectó 1 issue de tipo **Content Security Policy (CSP)**.

**Recomendación:** abrir el sitio en DevTools → pestaña *Issues* para ver el detalle exacto de la política CSP que se está violando (probablemente relacionada con los `<iframe>` de Google Maps o fuentes externas de Google Fonts) y ajustar la cabecera `Content-Security-Policy` para permitir esos orígenes explícitamente.

---

## 6. SEO — 100/100 ✅
Sin observaciones. El sitio cumple todos los checks de SEO de Lighthouse en esta corrida.

---

## 7. Lista priorizada de acciones (para pasar a la IA / al desarrollador)

**Alto impacto (Performance):**
1. Precargar/priorizar la imagen de fondo del hero (`fetchpriority="high"` o `<link rel="preload">`).
2. Agregar `rel="preconnect"` a `fonts.gstatic.com` y `fonts.googleapis.com`.
3. Reducir/combinar los 8 archivos CSS que bloquean el render; inline del CSS crítico above-the-fold.
4. Agregar `width` y `height` (o `aspect-ratio`) a las 10 imágenes sin dimensiones explícitas.
5. Investigar y corregir las 2 imágenes con ancho 0 (`aside-logo-img`, `mlw-logo-img`) — posible carga rota.
6. Optimizar/redimensionar las imágenes listadas en "image-delivery-insight" (ahorro estimado 152 KiB): servir en el tamaño real mostrado y con `srcset`.
7. Revisar y diferir scripts propios pesados para bajar el Total Blocking Time (760 ms).

**Medio impacto (Accesibilidad):**
8. Corregir contraste de color en 6 elementos (grises `#757575`/`#636363` sobre fondos oscuros/claros).
9. Agregar `title` a los 4 `<iframe>` de Google Maps.
10. Corregir el orden jerárquico del `<h4>` "SUPLEMENTOS ESENCIALES".

**Bajo impacto (Best Practices):**
11. Revisar la cabecera `Content-Security-Policy` para resolver el issue reportado en DevTools.

*(El hallazgo de "Shared Storage API deprecada" y los reportes de JS sin minificar/no usado provienen de extensiones del navegador del usuario que corrió el test, no del código del sitio — no requieren acción.)*
