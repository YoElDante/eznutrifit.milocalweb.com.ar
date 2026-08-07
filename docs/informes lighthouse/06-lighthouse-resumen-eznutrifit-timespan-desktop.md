# Resumen Lighthouse — Análisis de Tiempo (Timespan) Ordenador / Escritorio
**Sitio:** https://eznutrifit.milocalweb.com.ar/
**Fecha del análisis:** 07/08/2026
**Modo:** `timespan` — desktop, throttling DevTools
**Duración de la sesión capturada:** ~18.9 s

> ℹ️ Igual que en el informe timespan móvil: esto mide ~19 s de **interacción real** (scroll por la página ya cargada), no la carga inicial. Ver el resumen de navegación desktop para FCP/LCP/CLS de la carga.

---

## 1. Puntajes generales

| Categoría | Puntaje | Estado |
|---|---|---|
| **Performance** (durante la interacción) | 100 / 100 | 🟢 Excelente |
| **Best Practices** | 42 / 100 | 🔴 Requiere atención |

### 1.1 Métricas de interacción
| Métrica | Valor | Puntaje |
|---|---|---|
| Total Blocking Time (TBT) | 0 ms | 1.00 |
| Cumulative Layout Shift (CLS) | 0 | 1.00 |
| Interaction to Next Paint (INP) | 40 ms | 1.00 |

**Igual que en móvil: la interacción en sí es perfecta.** El problema real de este informe es, otra vez, cuánto peso de red se sigue descargando mientras el usuario navega — y en desktop es **mucho más grave** que en móvil.

---

## 2. Hallazgo principal: peso de red durante la sesión — 8.44 MB (!)

| Recurso | Cantidad | Peso |
|---|---|---|
| **Total** | 153 solicitudes | **8.44 MB** |
| Contenido multimedia (videos) | **3 archivos** | **6.68 MB** |
| Imágenes | 45 | 1.36 MB |
| Scripts | 56 | 280 KB |
| Fuentes | 3 | 89 KB |
| **Recursos de terceros** | 146 solicitudes | 1.76 MB |

**Casi el doble de peso que en la sesión móvil equivalente (3.67 MB).** El salto se explica casi por completo por los videos.

### 2.1 Se cargan 3 videos, no 1 — 6.68 MB en total
En la sesión móvil solo se detectó 1 video (1.6 MB, porque el usuario probablemente no llegó a scrollear tan lejos o el layout mobile difiere). En desktop se cargan **los 3 videos de la sección "reels"**:

| Video | Peso |
|---|---|
| `incluir-aminoacidos-bcaa.mp4` | 2.53 MB |
| `beneficios-creatina-beta-alanine.mp4` | 2.42 MB |
| `suplementos-pilares-escenciales.mp4` | 1.73 MB |
| **Total** | **6.68 MB** |

Esto es, de lejos, **el hallazgo más importante de todo el análisis de Lighthouse** (en los 5 informes revisados hasta ahora): un usuario de escritorio que scrollea la página descarga casi 6.7 MB solo en video.

**Recomendación (alta prioridad):**
- Comprimir los 3 videos (bitrate, resolución, formato moderno — WebM/AV1 en vez de MP4 sin optimizar).
- No precargarlos: usar `preload="none"` con un `poster` (miniatura estática) y reproducir solo al hacer clic o al entrar realmente en el viewport con un observer, en vez de cargarlos automáticamente al hacer scroll cerca.
- Evaluar si los 3 reels necesitan estar en la página principal o si conviene enlazarlos a Instagram/YouTube y embeber solo el thumbnail.

### 2.2 Google Maps sigue siendo el segundo gran consumidor
Igual que en móvil: tiles de `google.com/maps/vt`, scripts de `maps.googleapis.com` (Places, util.js) y fuente Roboto de Maps aparecen entre los recursos más pesados (values de 40–140 KB cada uno). Esto se traduce en:
- **`cache-insight`** (score 0): 825 KiB de ahorro potencial por caché — mismo problema que en móvil.
- **`font-display-insight`** (score 0): 180 ms de ahorro — ahora aparecen 3 fuentes (Roboto + Google Sans Text, ambas de la UI de Maps).
- **`third-party-cookies`** (score 0): **25 cookies** de terceros, todas `__Secure-OSID` de los 4 mapas embebidos — idéntico a móvil.

**Recomendación:** la misma que en el informe móvil — reemplazar los mapas interactivos por una imagen estática + link, o diferir la carga del `src` del iframe hasta que el bloque sea realmente visible.

---

## 3. Best Practices (42/100)

Mismos 3 problemas que en móvil:
1. **`third-party-cookies`** (score 0) — 25 cookies de Google Maps.
2. **`inspector-issues`** (score 0) — 2 issues: **Cookie** (de Maps) + **Content Security Policy** (recurrente en los 4 informes anteriores).
3. **`deprecations`** (score 0) — 1 advertencia de Shared Storage API, originada por una extensión del navegador, no por el sitio.

---

## 4. Otros hallazgos técnicos

### 4.1 Trabajo del hilo principal — 2.9 s (score 0.5)
Mucho menor que en móvil (7.3 s), como es esperable en desktop:
| Categoría | Duración |
|---|---|
| Other | 1.93 s |
| Rendering | 0.57 s |
| Style & Layout | 0.23 s |
| Script Evaluation | 0.21 s |

### 4.2 Animaciones no compuestas (`non-composited-animations`) — 3 elementos (antes 2 en móvil)
En desktop aparece un elemento adicional respecto a móvil:

| Elemento | Propiedades no animables encontradas |
|---|---|
| `a.footer-wa-link` (botón de WhatsApp del footer) | `background-color` |
| `article.producto-card` (#1) | `border-left/right/top-color` |
| `article.producto-card` (#2) | `border-bottom/left/right/top-color`, **`box-shadow`** |

**Recomendación:** reemplazar las animaciones de color de borde y de `background-color`/`box-shadow` por transiciones de `transform`, `opacity`, o usar `filter`/`outline` con GPU-friendly properties, para que el navegador pueda componerlas fuera del hilo principal.

### 4.3 Tamaño del DOM — 320 elementos totales
Igual que en móvil, dentro de rangos saludables.

---

## 5. Lista priorizada de acciones (para pasar a la IA / al desarrollador)

**Alto impacto (el más importante de todos los informes):**
1. **Comprimir y diferir la carga de los 3 videos de "reels"** (6.68 MB en total). Usar `preload="none"` + poster + carga bajo demanda, y comprimir a un bitrate/formato razonable.
2. **Reducir el costo de los 4 mapas de Google Maps embebidos** (825 KiB de mala caché, 25 cookies de terceros, fuentes extra de Maps) — reemplazar por mapa estático + link, o lazy-load real del `src`.

**Medio impacto:**
3. Resolver el issue de **Content Security Policy**, recurrente en los 4 informes anteriores — a nivel de cabecera del servidor.
4. Ajustar las 3 animaciones no compuestas (`footer-wa-link`, 2× `producto-card`) para usar propiedades animables de forma eficiente (`transform`/`opacity` en vez de colores de borde/sombra/fondo).

**Ya identificado en informes anteriores (reforzado acá):**
5. Agregar `width`/`height` a las imágenes sin dimensiones, y revisar las 2 imágenes rotas (`aside-logo-img`, `mlw-logo-img`).

*(El aviso de API obsoleta sigue correspondiendo a una extensión del navegador, no al sitio.)*

---

## 6. Comparación rápida móvil vs. desktop (timespan)

| Métrica | Móvil | Desktop |
|---|---|---|
| Peso total de la sesión | 3.67 MB | **8.44 MB** |
| Videos cargados | 1 (1.6 MB) | **3 (6.68 MB)** |
| Peso de terceros | 2.05 MB | 1.76 MB |
| Ahorro estimado por caché | 855 KiB | 825 KiB |
| Cookies de terceros | 25 | 25 |
| Trabajo en hilo principal | 7.3 s | 2.9 s |
| Animaciones no compuestas | 2 | 3 |

**El problema de los videos es mucho más severo en desktop** — probablemente porque el layout desktop muestra los 3 reels en simultáneo/visible durante el scroll, mientras que en móvil el usuario alcanzó a ver (o el layout solo cargó) 1 solo video en los mismos ~19 segundos.
