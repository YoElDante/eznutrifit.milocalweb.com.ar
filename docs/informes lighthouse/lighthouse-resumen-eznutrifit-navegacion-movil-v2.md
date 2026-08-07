# Resumen Lighthouse — Navegación Móvil (Re-análisis tras cambios)
**Sitio:** https://eznutrifit.milocalweb.com.ar/
**Comparado contra:** primer informe de navegación móvil

---

## 1. Puntajes: antes vs. después

| Categoría | Antes | Después | Cambio |
|---|---|---|---|
| **Performance** | 66 | **83** | 🟢 +17 |
| **Accessibility** | 91 | **96** | 🟢 +5 |
| **Best Practices** | 77 | 77 | ⏸️ Sin cambios |
| **SEO** | 100 | 100 | ⏸️ Sin cambios |

**Mejora sólida en Performance y Accesibilidad.** Best Practices se mantiene igual porque los 2 problemas que lo bajaban (CSP y una advertencia de API obsoleta) siguen presentes.

---

## 2. Core Web Vitals: antes vs. después

| Métrica | Antes | Después | Cambio |
|---|---|---|---|
| First Contentful Paint | 2.1 s | 2.3 s | 🔴 Empeoró levemente |
| **Largest Contentful Paint** | 3.8 s | **2.3 s** | 🟢 **-1.5 s** |
| Total Blocking Time | 760 ms | 430 ms | 🟢 -330 ms |
| Cumulative Layout Shift | 0.061 | 0.061 | ⏸️ Sin cambios |
| Speed Index | 4.0 s | 3.2 s | 🟢 -0.8 s |
| Time to Interactive | 3.8 s | 3.1 s | 🟢 -0.7 s |

**El LCP bajó de "pobre" a "necesita mejora" (2.3s)** — se confirma que el fix del `fetchpriority="high"` en el fondo del hero funcionó:
```
lcp-discovery-insight ahora muestra:
✅ fetchpriority=high applied: true
✅ La solicitud es visible en el documento inicial: true
✅ carga en diferido no aplicada: true
```
El TBT también bajó bastante (760ms → 430ms), aunque sigue siendo el principal responsable de que Performance no sea más alto (score 0.64).

---

## 3. Lo que se solucionó por completo ✅

| Problema (informe original) | Estado ahora |
|---|---|
| 10 imágenes sin `width`/`height` (`unsized-images`) | ✅ **Resuelto** — ya no aparece en el informe |
| 4 `<iframe>` de Google Maps sin `title` (`frame-title`) | ✅ **Resuelto** |
| `<h4>` "SUPLEMENTOS ESENCIALES" fuera de orden (`heading-order`) | ✅ **Resuelto** |
| LCP no priorizado (fondo del hero) | ✅ **Resuelto** — `fetchpriority="high"` aplicado |
| 5 de 6 elementos con contraste insuficiente | ✅ **Resueltos** |

Muy buen avance — se cerraron 4 de los ~6 focos de problemas identificados originalmente, y el 5to (contraste) quedó casi resuelto.

---

## 4. Lo que sigue pendiente

### 4.1 Contraste de color — 1 elemento restante (antes 6)
Solo queda:
```
p.footer-badge-cta > a → "Pedí la tuya sin cargo"
```
(el botón/link de WhatsApp del footer, dentro de `div.footer-badge`). El resto del contraste ya se corrigió.

### 4.2 CSS que bloquea el render — reducido, pero no eliminado
Antes bloqueaban 9 recursos; ahora **solo `fonts.css`** (504 bytes) sigue marcado como bloqueante. Los demás CSS (navbar, base, clientes, aside, sections, hero, responsive, footer) ya no aparecen en la lista — probablemente se combinaron, se movieron a `media` no bloqueante, o se inlinearon.

**Recomendación restante:** cargar `fonts.css` de forma no bloqueante (`media="print" onload="this.media='all'"` o `<link rel="preload" as="style">`).

### 4.3 Entrega de imágenes — ahorro bajó de 152 KiB a 81 KiB
Mejoró bastante, pero siguen 3 imágenes con margen de optimización: `secundaria-img`, `estrella-img`, y el fondo del hero (`hero-split-bg`). Revisar si conviene comprimir más o servir tamaños más ajustados al viewport real.

### 4.4 Trabajo en el hilo principal — sigue siendo el mayor freno de Performance
- `bootup-time`: 4.1 s de ejecución de JS en `https://eznutrifit.milocalweb.com.ar/` (similar al informe original, ~4.6s)
- `mainthread-work-breakdown`: score 0 — 5.7 s de trabajo total
- `max-potential-fid`: 300 ms (score 0.36) — sigue siendo bajo

Esto es lo que explica que, aunque LCP mejoró mucho, el score de Performance no llegue más alto: **el TBT y el trabajo del hilo principal siguen siendo el cuello de botella**.

**Recomendación:** revisar qué script(s) propio(s) del sitio se ejecutan en la carga inicial (no son de extensiones — confirmado, `unminified-javascript`/`unused-javascript` ya no listan nada del sitio) y diferir/dividir ese trabajo con `defer`, `async`, o cargando funcionalidad no crítica después del primer render.

### 4.5 Best Practices — sin cambios (77/100)
Los mismos 2 problemas de siempre:
- `deprecations` — advertencia de extensión del navegador (no requiere acción)
- `inspector-issues` — issue de **Content Security Policy**, todavía sin resolver

---

## 5. Lista priorizada de próximos pasos

1. **Reducir el trabajo del hilo principal / JS de la carga inicial** (5.7s) — es ahora el principal freno del Performance score.
2. Cargar `fonts.css` de forma no bloqueante.
3. Corregir el contraste del link "Pedí la tuya sin cargo" en el footer (último elemento de accesibilidad pendiente).
4. Resolver el issue de **Content Security Policy**.
5. Terminar de optimizar las 3 imágenes que aún tienen margen de ahorro (81 KiB).

**En resumen: los cambios anteriores funcionaron muy bien** (Performance +17, Accessibility +5, LCP -1.5s). Lo que queda es más específico: el trabajo de JS en el hilo principal y la cabecera CSP.
