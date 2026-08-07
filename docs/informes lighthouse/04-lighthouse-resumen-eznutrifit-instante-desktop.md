# Resumen Lighthouse — Análisis de Instante (Snapshot) Ordenador / Escritorio
**Sitio:** https://eznutrifit.milocalweb.com.ar/
**Fecha del análisis:** 07/08/2026
**Modo:** `snapshot` — desktop

> ℹ️ Igual que el snapshot móvil: analiza el DOM en un instante congelado, sin medir carga ni red.

---

## 1. Puntajes generales

| Categoría | Puntaje | Estado |
|---|---|---|
| Performance | 0 / 100 * | ⚠️ Ver nota — no es un 0 real, ver informe snapshot móvil |
| **Accessibility** | 91 / 100 | 🟡 Idéntico al snapshot móvil |
| **Best Practices** | 100 / 100 | 🟢 Excelente |
| **SEO** | 100 / 100 | 🟢 Excelente |

**Este informe es prácticamente idéntico al snapshot móvil** — mismos hallazgos, mismos elementos exactos, misma cantidad. Es esperable: los problemas de accesibilidad y de imágenes sin dimensiones son estructurales (están en el HTML/CSS), no dependen del viewport.

---

## 2. Accesibilidad (91/100) — mismos 6+4+1 elementos que en todos los demás informes

### 2.1 Contraste de color insuficiente — 6 elementos
| Elemento | Texto |
|---|---|
| `p.estrella-bajada` | "GANADOR DE PESO + CREATINA" |
| `span.aside-slogan` | "MÁS VISIBILIDAD, MÁS CLIENTES" |
| `p.footer-slogan` | "Estamos con vos y para vos!" |
| `h4` footer-social | "SEGUINOS" |
| `h4` footer-actions | "CONTACTO" |
| `a` footer-badge-cta | "Pedí la tuya sin cargo" |

### 2.2 `<iframe>` sin `title` — 4 elementos
Los 4 mapas de Google Maps embebidos en `div.ubicacion-mapa`.

### 2.3 Orden de encabezados incorrecto — 1 elemento
`<h4>` "SUPLEMENTOS ESENCIALES" en `div.reels-grid > div.reel-card`.

---

## 3. Best Practices (100/100) y SEO (100/100) ✅
Sin observaciones — igual que en el snapshot móvil.

---

## 4. `unsized-images` — 10 elementos confirmados (quinta y sexta vez)
Exactamente los mismos 10 elementos de siempre, con sus nombres accesibles:

| Imagen | Selector |
|---|---|
| Combo Explosivo EZ Nutrifit — Mutantmass + Creatina | `img.estrella-img` |
| ⚠️ MiLocalWeb.com.ar — Páginas web (logo aside) | `img.aside-logo-img` (**ancho 0**) |
| ⚠️ MiLocalWeb.com.ar — Páginas web (logo footer) | `img.mlw-logo-img` (**ancho 0**) |
| Somaginci Gym | `img.ubicacion-logo` |
| FREE BOX Gimnasio | `img.ubicacion-logo` |
| Gimancio Henko | `img.ubicacion-logo` |
| Logo EZ Nutrifit (navbar) | `img.brand-logo` |
| Logo EZ Nutrifit (hero) | `img.hero-logo` |
| EZ Nutrifit (footer) | `img.footer-logo` |
| Origen Run & Bike | `img.ubicacion-logo` |

Con este informe ya son **6 corridas distintas** (navegación ×2, timespan ×2, snapshot ×2) que confirman exactamente el mismo problema — es el hallazgo más consistente de todo el análisis.

---

## 5. Conclusión general — cierre del análisis completo (6 informes)

No hay hallazgos nuevos en este último informe. A modo de cierre, esto es lo que se repite de forma consistente en **todas** las corridas y por lo tanto son las prioridades más sólidas para corregir:

| Problema | Confirmado en |
|---|---|
| **10 imágenes sin `width`/`height`**, 2 de ellas rotas (ancho 0) | Los 6 informes |
| Contraste de color insuficiente (5-6 elementos) | Navegación ×2, Snapshot ×2 |
| 4 `<iframe>` de Google Maps sin `title` | Navegación ×2, Snapshot ×2 |
| Heading `<h4>` fuera de orden | Navegación ×2, Snapshot ×2 |
| Issue de Content Security Policy | Navegación ×2, Timespan ×2 |
| Video(s) muy pesados sin lazy-load (hasta 6.68 MB en desktop) | Timespan ×2 |
| 4 mapas de Google Maps generan 2 MB+ y 25 cookies de terceros | Timespan ×2 |
| Fondo de hero no priorizado para LCP | Navegación ×2 |
| CSS que bloquea el render (Google Fonts + 8 archivos) | Navegación ×2 |

**Recomendación de orden de trabajo para la IA/desarrollador:**
1. Video(s) pesados y mapas de Google Maps (mayor peso de red — timespan).
2. Imágenes sin dimensiones + las 2 rotas (afecta CLS y layout en todos los modos).
3. Fondo del hero / LCP + CSS bloqueante (carga inicial).
4. Accesibilidad: contraste, `title` en iframes, orden de headings.
5. Cabecera CSP.
