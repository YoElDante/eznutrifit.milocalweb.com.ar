# Resumen Lighthouse — Análisis de Tiempo (Timespan) Móvil
**Sitio:** https://eznutrifit.milocalweb.com.ar/
**Fecha del análisis:** 07/08/2026
**Modo:** `timespan` — mobile, throttling DevTools
**Duración de la sesión capturada:** ~19.9 s

> ℹ️ **Qué es este informe:** a diferencia de los dos anteriores (que miden la *carga inicial* de la página), este es un informe de tipo **timespan**: mide lo que pasa durante ~20 segundos de **interacción real** con la página ya cargada (scroll, exploración de secciones, etc.). Por eso no incluye categorías de Accesibilidad/SEO ni métricas como LCP/FCP — se enfoca en qué tan fluida es la experiencia una vez que el usuario ya está navegando, y cuánto peso extra se sigue descargando mientras lo hace.

---

## 1. Puntajes generales

| Categoría | Puntaje | Estado |
|---|---|---|
| **Performance** (durante la interacción) | 100 / 100 | 🟢 Excelente |
| **Best Practices** | 42 / 100 | 🔴 Requiere atención |

*(Accessibility y SEO no aplican en modo timespan.)*

### 1.1 Métricas de interacción
| Métrica | Valor | Puntaje |
|---|---|---|
| Total Blocking Time (TBT) | 0 ms | 1.00 |
| Cumulative Layout Shift (CLS) | 0 | 1.00 |
| Interaction to Next Paint (INP) | 90 ms | 0.99 |

**La experiencia de scroll/interacción en sí es fluida** — no hay bloqueos ni saltos de layout una vez que la página está cargada. El problema de este informe no es "se traba", sino **cuánto peso extra se sigue bajando en segundo plano**, principalmente por los mapas de Google embebidos y un video pesado.

---

## 2. Hallazgo principal: peso de red durante la sesión

| Recurso | Cantidad | Peso |
|---|---|---|
| **Total** | 142 solicitudes | **3.67 MB** |
| Contenido multimedia (video) | 1 archivo | 1.63 MB |
| Imágenes | 50 | 1.53 MB |
| Scripts | 56 | 439 KB |
| **Recursos de terceros** | **135 solicitudes** | **2.05 MB** |

**El 56% del peso total (2.05 MB de 3.67 MB) corresponde a recursos de terceros** — y casi todo ese tráfico de terceros es **Google Maps** (los 4 mapas embebidos cargan sus propios tiles, JS y fuentes cada vez que entran en el viewport).

### 2.1 El archivo más pesado de toda la sesión: un video de 1.6 MB
```
https://eznutrifit.milocalweb.com.ar/assets/vid/reels/suplementos-pilares-escenciales.mp4 → 1,625,722 bytes (~1.6 MB)
```
Es, por lejos, el recurso individual más pesado detectado en todo el análisis (más pesado que las 50 imágenes juntas de varias secciones).

**Recomendación:**
- Comprimir el video (bitrate más bajo, resolución acorde al tamaño real de reproducción, formato moderno como WebM/AV1).
- Si no es autoplay, cargarlo bajo demanda (mostrar un `poster` estático y cargar el `<video>`/`src` solo cuando el usuario haga clic en play), en vez de precargarlo con la página.

### 2.2 Los 4 mapas de Google Maps embebidos generan la mayor parte del tráfico de terceros
Se detectan decenas de tiles de mapa (`google.com/maps/vt?...`) y los scripts de la API de Places/Maps (`maps.googleapis.com`, `maps.gstatic.com`), varios de ellos de más de 70–140 KB cada uno.

Esto explica tres audits relacionados:
- **`cache-insight`** (score 0): ahorro estimado de **855 KiB** por mal aprovechamiento de caché — casi la totalidad son tiles/recursos de Google Maps.
- **`image-delivery-insight`** (score 0): ahorro estimado de **811 KiB** — de nuevo, mayormente tiles de mapas, no imágenes propias del sitio.
- **`font-display-insight`** (score 0): 390 ms de ahorro potencial en la fuente Roboto (`fonts.gstatic.com/s/roboto/...`) — esta fuente la carga el widget de Google Maps, no el sitio.

**Recomendación:** este es el punto de mayor impacto de todo el informe de timespan. Opciones, de más a menos agresiva:
1. Reemplazar los 4 iframes de Google Maps por una **imagen estática del mapa** (Static Maps API) con un enlace "Ver en Google Maps" que abra el mapa interactivo real solo si el usuario lo pide.
2. Si se necesitan interactivos, cargarlos con **lazy-loading real** (por ejemplo, cargar el `src` del iframe solo cuando el bloque de ubicación entra en el viewport, con `loading="lazy"` ya presente pero además retrasando la inyección del `src` hasta que sea visible).
3. Como mínimo, limitar a 1–2 mapas visibles por defecto y el resto detrás de un acordeón/tab, para no cargar los 4 en la misma sesión de scroll.

---

## 3. Best Practices (42/100) — por qué baja tanto en este informe

### 3.1 Cookies de terceros (`third-party-cookies`) — 25 cookies detectadas
Las 25 cookies son todas `__Secure-OSID` provenientes de los iframes de `google.com/maps/embed`. Es consecuencia directa de tener 4 mapas embebidos activos.

### 3.2 Problemas registrados en el panel Issues (`inspector-issues`) — 2 issues
1. **Cookie** — asociado a las cookies de terceros de Google Maps.
2. **Content Security Policy** — el mismo issue de CSP que ya aparecía en los informes de navegación (móvil y desktop); se confirma que es un problema recurrente y real del sitio, no puntual.

### 3.3 APIs obsoletas (`deprecations`)
Mismo hallazgo que en los otros informes: 1 advertencia sobre la Shared Storage API, originada por una extensión del navegador (no es código del sitio).

**Recomendación:** resolver los mapas embebidos (sección 2.2) resuelve automáticamente el problema de cookies de terceros. El issue de CSP conviene tratarlo aparte, a nivel de cabecera del servidor.

---

## 4. Otros hallazgos técnicos

### 4.1 Trabajo del hilo principal durante la interacción — 7.3 s (score 0.5)
| Categoría | Duración |
|---|---|
| Other | 4.48 s |
| Rendering (pintado/composición) | 1.45 s |
| Script Evaluation | 1.09 s |
| Style & Layout | 0.31 s |

El bloque "Other" domina — coherente con la carga y renderizado continuo de los tiles de mapa mientras el usuario navega por esa sección.

### 4.2 Imágenes sin `width`/`height` (`unsized-images`) — 10 elementos, score 0.5
Mismos elementos ya identificados en los informes de navegación (logos, imagen de producto destacado, y las 2 imágenes con ancho 0 — `aside-logo-img` y `mlw-logo-img`). Se confirma una tercera vez en un informe distinto.

### 4.3 Animaciones no compuestas (`non-composited-animations`) — 2 elementos
Dos `article.producto-card` (tarjetas de producto en la sección de productos) usan una animación sobre `border-top-color`, una propiedad CSS que el navegador no puede animar de forma compuesta (fuera del hilo principal), lo que obliga a repintar en el hilo principal cada vez que se anima.

**Recomendación:** reemplazar la animación de `border-top-color` por una animación de `transform`, `opacity`, o un `box-shadow`/`outline` con `will-change`, que sí se pueden componer eficientemente.

### 4.4 Tamaño del DOM — 320 elementos totales
Dentro de rangos saludables, sin problema.

---

## 5. Lista priorizada de acciones (para pasar a la IA / al desarrollador)

**Alto impacto:**
1. **Optimizar o diferir el video de 1.6 MB** (`suplementos-pilares-escenciales.mp4`): comprimir, o cargar bajo demanda con poster estático en vez de precargarlo.
2. **Reducir el costo de los 4 mapas de Google Maps embebidos** (2 MB / 135 requests de terceros, 855 KiB de mala caché, 811 KiB de tiles pesados): usar mapa estático + link, o lazy-load real del `src` del iframe recién al hacer scroll cerca.
3. Como consecuencia directa del punto anterior, se elimina el problema de **25 cookies de terceros** y mejora fuerte el puntaje de Best Practices.

**Medio impacto:**
4. Reemplazar la animación de `border-top-color` en las tarjetas de producto por una propiedad animable de forma compuesta (`transform`/`opacity`).
5. Resolver el issue de **Content Security Policy** (recurrente en los 3 informes) a nivel de cabecera del servidor.

**Ya identificado en informes anteriores (reforzado acá):**
6. Agregar `width`/`height` a las 10 imágenes sin dimensiones explícitas, y revisar las 2 imágenes rotas (`aside-logo-img`, `mlw-logo-img`).

*(El aviso de API obsoleta sigue correspondiendo a una extensión del navegador, no al sitio.)*
