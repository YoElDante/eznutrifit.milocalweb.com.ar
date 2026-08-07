# Resumen Lighthouse — Análisis de Instante (Snapshot) Móvil
**Sitio:** https://eznutrifit.milocalweb.com.ar/
**Fecha del análisis:** 07/08/2026
**Modo:** `snapshot` — mobile (simulado)

> ℹ️ **Qué es este informe:** a diferencia de los de navegación (carga) y timespan (interacción), un **snapshot** analiza el DOM en un instante congelado de la página — no mide tiempos de carga ni de red. Por eso Performance casi no tiene peso acá (solo evalúa 1 cosa: imágenes sin dimensiones) y el resto se concentra en Accesibilidad, Best Practices y SEO estructurales.

---

## 1. Puntajes generales

| Categoría | Puntaje | Estado |
|---|---|---|
| Performance | 0 / 100 * | ⚠️ Ver nota |
| **Accessibility** | 91 / 100 | 🟡 Buena, con detalles a corregir |
| **Best Practices** | 100 / 100 | 🟢 Excelente |
| **SEO** | 100 / 100 | 🟢 Excelente |

**\* Nota sobre el 0 en Performance:** no es un 0 real de rendimiento. En modo snapshot, la categoría Performance solo incluye 1 audit (`unsized-images`, imágenes sin `width`/`height`) y ese audit tiene **peso 0** en el cálculo — es decir, no hay ningún audit que realmente puntúe la categoría en este modo, y Lighthouse muestra 0 por defecto al no tener componentes ponderados. **Ignorar este número** — el rendimiento real ya está cubierto por los informes de navegación (66 móvil / 86 desktop) y timespan.

---

## 2. Accesibilidad (91/100) — mismos 3 problemas que en los informes de navegación

Este snapshot **confirma exactamente los mismos hallazgos** que ya aparecían en los informes de navegación móvil y desktop — es una buena señal de consistencia (no depende del momento de carga, es estructural):

### 2.1 Contraste de color insuficiente — 6 elementos
Los mismos elementos: `p.estrella-bajada`, `span.aside-slogan`, `p.footer-slogan`, `h4` "SEGUINOS", `h4` "CONTACTO" y un sexto elemento del mismo tipo.

### 2.2 `<iframe>` sin `title` — 4 elementos
Los 4 mapas de Google Maps embebidos, sin cambios.

### 2.3 Orden de encabezados incorrecto — 1 elemento
El `<h4>` "SUPLEMENTOS ESENCIALES" sigue rompiendo la jerarquía.

*(Recomendaciones: las mismas ya detalladas en el informe de navegación móvil — corregir contraste a mínimo 4.5:1, agregar `title` a los iframes, y ajustar el nivel del heading.)*

---

## 3. Best Practices (100/100) ✅
En este modo se evalúan otros checks distintos a los de navegación (pegado en inputs bloqueado, doctype, librerías JS, relación de aspecto de imágenes, tamaño de imagen responsive) — **todos pasan**. No es contradictorio con el 77/100 de los informes de navegación: ahí el puntaje bajo venía de `deprecations` (extensión del navegador) e `inspector-issues` (CSP), que no forman parte de esta categoría en modo snapshot.

## 4. SEO (100/100) ✅
Sin observaciones, consistente con los otros informes.

---

## 5. Diagnóstico técnico único de este informe: `unsized-images` (10 elementos, score 0.5)
Confirma **por cuarta vez** (navegación móvil, navegación desktop, timespan móvil/desktop y ahora este snapshot) el mismo conjunto de 10 imágenes sin `width`/`height`, incluidas las 2 rotas con ancho 0 (`aside-logo-img`, `mlw-logo-img`).

---

## 6. Conclusión y lista de acciones

Este informe no aporta hallazgos nuevos — **confirma y refuerza** los ya identificados en los informes anteriores. Sirve principalmente para verificar que los problemas de accesibilidad y las imágenes sin dimensiones son consistentes y no dependen del estado de carga.

**Acciones (ya cubiertas por los informes anteriores, reforzadas acá):**
1. Corregir contraste de color en los 6 elementos listados.
2. Agregar `title` a los 4 `<iframe>` de Google Maps.
3. Corregir el orden jerárquico del `<h4>` "SUPLEMENTOS ESENCIALES".
4. Agregar `width`/`height` a las 10 imágenes sin dimensiones, y arreglar las 2 imágenes rotas.

*(No hay hallazgos nuevos de Performance o Best Practices en este informe — ver los resúmenes de navegación y timespan para esos puntos.)*
