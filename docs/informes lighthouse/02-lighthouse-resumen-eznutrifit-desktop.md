# Resumen Lighthouse — Navegación Ordenador / Escritorio
**Sitio:** https://eznutrifit.milocalweb.com.ar/
**Fecha del análisis:** 07/08/2026
**Dispositivo:** Emulación desktop (pantalla grande)

> ⚠️ Igual que en la corrida móvil, hay ruido de **extensiones de Chrome** en algunos audits de JavaScript (JS sin minificar / no usado). Ya está filtrado — solo se listan hallazgos reales del sitio.

---

## 1. Puntajes generales

| Categoría | Puntaje | Estado |
|---|---|---|
| **Performance** | 86 / 100 | 🟢 Bueno |
| **Accessibility** | 91 / 100 | 🟡 Buena, con detalles a corregir |
| **Best Practices** | 77 / 100 | 🟠 Necesita mejoras |
| **SEO** | 100 / 100 | 🟢 Excelente |

**Comparado con la versión móvil (Performance 66), en desktop el rendimiento mejora bastante** (86) — esperable, porque la simulación desktop no aplica el throttling de CPU/red 4G que sí se usa en móvil. Accessibility, Best Practices y SEO dan exactamente igual en ambas corridas.

---

## 2. Core Web Vitals / Métricas de carga

| Métrica | Valor | Puntaje | Diagnóstico |
|---|---|---|---|
| First Contentful Paint (FCP) | 1.1 s | 0.79 | Bueno |
| Largest Contentful Paint (LCP) | 1.9 s | 0.67 | 🟠 A mejorar |
| Total Blocking Time (TBT) | 30 ms | 1.00 | Excelente |
| Cumulative Layout Shift (CLS) | 0.018 | 1.00 | Excelente |
| Speed Index | 1.9 s | 0.68 | 🟠 A mejorar |
| Time to Interactive (TTI) | 1.9 s | 0.97 | Excelente |
| **Max Potential FID** | **280 ms** | 0.41 | 🔴 A revisar |

**En desktop el cuello de botella ya no es el bloqueo del hilo principal (TBT/CLS están perfectos), sino el LCP y el Speed Index — ambos ligados a la carga de imágenes y al descubrimiento tardío del elemento LCP.**

---

## 3. Problemas de Performance (detalle)

### 3.1 Desglose del LCP (`lcp-breakdown-insight`)
El elemento LCP sigue siendo el fondo del hero (`section#inicio > div.hero-split-bg`, ahora medido en 955×673px en desktop). Desglose de los 1.9s:

| Subparte | Duración |
|---|---|
| Time to First Byte (TTFB) | 577 ms |
| Retraso de carga de recursos | 742 ms |
| Duración de carga del recurso | *(resto)* |

El **retraso de carga de recursos (742 ms)** es el tramo más grande y evitable: el navegador tarda en darse cuenta de que necesita esa imagen porque está en un `background-image` inline, no en un `<img>` descubrible tempranamente.

### 3.2 LCP no priorizado (`lcp-discovery-insight`)
Mismo diagnóstico que en móvil:
- `fetchpriority="high"` → **no aplicado**
- La solicitud sí es visible en el documento inicial, y no usa `loading="lazy"` (correcto), pero falta la prioridad alta.

**Recomendación:** convertir el fondo del hero en `<img fetchpriority="high">` o agregar `<link rel="preload" as="image" href="...">` en el `<head>`.

### 3.3 Requests que bloquean el render (`render-blocking-insight`)
Ahorro estimado esta vez es menor: **30 ms** (en desktop las conexiones son más rápidas). Los mismos 9 archivos CSS que en móvil: `responsive.css`, `aside.css`, `footer.css`, `sections.css` (223ms de impacto), `clientes.css`, `base.css`, `navbar.css`, `hero.css`, y el CSS de Google Fonts.

**Recomendación:** igual que en móvil — combinar/inline del CSS crítico y diferir el resto.

### 3.4 Cadena de dependencias de red
Misma cadena crítica: documento → Google Fonts. `fonts.gstatic.com` sigue siendo candidato de `preconnect`.

### 3.5 Entrega de imágenes mejorable (`image-delivery-insight`)
Ahorro estimado: **261 KiB** (más que en móvil, porque en desktop se muestran imágenes más grandes: p. ej. `estrella-img` a 428×428px vs 379×379px en móvil). Afecta 9 imágenes: productos secundarios, logos de gimnasios asociados, el producto destacado y el fondo del hero.

**Recomendación:** servir tamaños responsivos con `srcset`/`sizes` según el viewport (desktop necesita variantes más grandes que las de móvil, pero comprimidas correctamente).

### 3.6 Imágenes sin `width`/`height` explícitos (`unsized-images`) — 10 elementos
Mismo problema que en móvil, con las medidas correspondientes a desktop:

| Imagen | Tamaño mostrado |
|---|---|
| `estrella-img` (producto destacado) | 428×428 |
| `logo-somaginci-600x271.webp` | 129×58 |
| `logo-freebox-450x253.webp` | 104×58 |
| `logo-henko-300x399.webp` | 52×58 |
| `logo-300x300-transp.webp` (navbar) | 42×42 |
| `logo-300x300-transp.webp` (hero-logo) | 200×200 |
| `logo-300x300-transp.webp` (footer-logo) | 120×120 |
| `logo-origen-300x295.webp` | 59×58 |
| ⚠️ `aside-logo-img` | **0×80** |
| ⚠️ `mlw-logo-img` | **0×44** |

Los dos mismos elementos rotos que en móvil (`aside-logo-img` y `mlw-logo-img`) también aparecen con **ancho 0 en desktop** — confirma que **no es un problema del viewport móvil**, sino algo estructural en esas dos imágenes (src roto, contenedor colapsado, o falta de estilos de ancho).

**Recomendación:** agregar `width`/`height` a las 10 imágenes y revisar específicamente esas 2 imágenes rotas — es la prioridad más clara detectada en ambos informes.

### 3.7 Latencia potencial máxima de la primera interacción (`max-potential-fid`) — 280 ms
Puntaje bajo (0.41) pese a que TBT es excelente. Indica que existe al menos una tarea larga en el hilo principal que podría demorar la respuesta a la primera interacción del usuario.

**Recomendación:** revisar con el *Performance panel* de DevTools qué script genera esa tarea larga puntual y dividirla en fragmentos más chicos (`code splitting` / `requestIdleCallback`).

---

## 4. Accesibilidad (Accessibility: 91/100) — idéntico a móvil

### 4.1 Contraste de color insuficiente (`color-contrast`) — 6 elementos
Los mismos 5 elementos de móvil, más uno adicional propio de la vista desktop:

| Elemento | Texto | Detalle |
|---|---|---|
| `p.estrella-bajada` | "GANADOR DE PESO + CREATINA" | Contraste insuficiente |
| `span.aside-slogan` | "MÁS VISIBILIDAD, MÁS CLIENTES" | Contraste insuficiente |
| `p.footer-slogan` | "Estamos con vos y para vos!" | Contraste insuficiente |
| `h4` footer "SEGUINOS" | — | Contraste insuficiente |
| `h4` footer "CONTACTO" | — | Contraste insuficiente |
| `a` botón WhatsApp (footer-badge-cta) | "Hola! Quiero una web como la..." | Contraste insuficiente |

### 4.2 `<iframe>` sin `title` — 4 mapas de Google Maps embebidos
Mismos 4 iframes de ubicaciones sin `title`.

### 4.3 Orden de encabezados incorrecto — mismo `<h4>` "SUPLEMENTOS ESENCIALES"

*(Recomendaciones: iguales a las del informe móvil — ver sección 4 de ese resumen.)*

---

## 5. Best Practices (77/100) — idéntico a móvil
- `deprecations`: 1 advertencia de API obsoleta, originada por una extensión del navegador (no del sitio).
- `inspector-issues`: 1 issue de **Content Security Policy** registrado en el panel Issues — mismo hallazgo que en móvil, confirma que es un problema real y no exclusivo del viewport.

---

## 6. SEO — 100/100 ✅
Sin observaciones, igual que en móvil.

---

## 7. Lista priorizada de acciones (para pasar a la IA / al desarrollador)

**Alto impacto (Performance):**
1. Convertir el fondo del hero en `<img fetchpriority="high">` o precargarlo con `<link rel="preload" as="image">` — confirmado como el mayor cuello de botella del LCP en ambos informes (742 ms de retraso de carga evitable).
2. Agregar `rel="preconnect"` a `fonts.gstatic.com` / `fonts.googleapis.com`.
3. Combinar/diferir los 9 archivos CSS que bloquean el render.
4. **Corregir las 2 imágenes con ancho 0** (`aside-logo-img`, `mlw-logo-img`) — se confirma en móvil Y desktop, es un bug real y no un artefacto del viewport.
5. Agregar `width`/`height` a las 10 imágenes sin dimensiones (usar valores distintos por breakpoint si el diseño es muy diferente entre mobile y desktop).
6. Servir imágenes con `srcset`/`sizes` para no entregar el mismo archivo pesado en mobile y desktop (ahorro estimado: 152 KiB en móvil, 261 KiB en desktop).
7. Investigar la tarea larga que eleva el Max Potential FID a 280 ms en desktop.

**Medio impacto (Accesibilidad):**
8. Corregir contraste en los 6 elementos listados (incluye ahora el botón/link de WhatsApp del footer).
9. Agregar `title` a los 4 `<iframe>` de Google Maps.
10. Corregir el orden jerárquico del `<h4>` "SUPLEMENTOS ESENCIALES".

**Bajo impacto (Best Practices):**
11. Revisar la cabecera `Content-Security-Policy` — mismo issue en ambos dispositivos, conviene resolverlo a nivel servidor/cabecera global.

*(El aviso de API obsoleta y los reportes de JS sin minificar/no usado corresponden a extensiones del navegador que corrió el test, no al código del sitio.)*
