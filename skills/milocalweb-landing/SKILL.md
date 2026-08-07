---
name: milocalweb-landing
description: "Trigger: landing page, config.php, assets, imágenes, relevamiento, ficha-cliente, template MiLocalWeb. Convenciones técnicas y flujo de implementación para landing pages."
license: Apache-2.0
metadata:
  author: "milocalweb"
  version: "1.0"
---

## Activation Contract

Load when: editing `config.php`, manipulating assets in `assets/img/` or `assets/vid/`, processing `docs/guia-relevamiento.md`, generating `docs/ficha-cliente.md`, or implementing landing page sections.

Do NOT load for: SEO questions, business model questions, general architecture overview (those are in AGENTS.md).

## Hard Rules

- `config.php` is the single source of truth for all client data.
- NEVER use spaces, uppercase, or special characters in asset filenames.
- NEVER leave `.txt` files in asset directories after implementation.
- ALWAYS rename assets to the convention below BEFORE updating code references.
- ALWAYS use `htmlspecialchars()` on all client data output.

## Asset Naming Convention

Format: `{prefijo}-{descriptor}-{dimension-opcional}.ext`
Rules: lowercase only, hyphens as separators, no spaces or underscores.

### Prefixes

| Prefix | Usage | Example |
|--------|-------|---------|
| `logo-` | Business logos | `logo-300x300-transp.webp` |
| `hero-` | Hero section main image | `hero-fondo-gris-575x800.webp` |
| `prod-` | Featured products | `prod-colageno.webp` |
| `estrella-` | Star product main image | `estrella-mutantmass-creatina.webp` |
| `complemento-` | Complementary products | `complemento-betaalanine.webp` |
| `identidad-` | Brand identity images | `identidad-indumentaria-800x800.webp` |
| `icono-` | Icons (except `favicon.ico`) | `icono-transparente.ico` |
| `textura-` | Background textures | `textura-fondo.jpg` |

### Third-party logos

Format: `logo-{business-name}-{width}x{height}.webp`
Examples: `logo-freebox-450x253.webp`, `logo-origen-300x295.webp`

### Videos

Same rules, stored in `assets/vid/reels/`:
- `suplementos-pilares-escenciales.mp4` + `.webp` poster

### Folder structure

```
assets/img/cliente/    → logos/, identidad/, productos/, impacto/, iconos/
assets/img/terceros/   → Third-party logos (flat, no subfolders)
assets/img/milocalweb/ → MiLocalWeb template assets (do not modify)
assets/vid/reels/      → Videos + posters
```

## Processing a New Client

When `docs/guia-relevamiento.md` is complete:

1. Read `docs/guia-relevamiento.md` — raw client data
2. Read `docs/informe_estilo_{cliente}.md` — visual identity (if exists)
3. Rename all images/videos to convention (minúsculas, guiones, prefijos)
4. Delete all `.txt` files from asset directories
5. Generate `docs/ficha-cliente.md` — canonical business document
6. Fill `config.php` using the field mapping below
7. If client has star product: edit `includes/sections/estrella.php`
8. If client has reels: edit `includes/sections/reels.php`
9. Mark `{cliente}.cliente.md` as ARCHIVED
10. Run the implementation checklist

## Config.php Field Mapping

> Source: `docs/guia-relevamiento.md` → target: `config.php`

| Guía section | config.php key | Notes |
|-------------|----------------|-------|
| Datos básicos | `nombre`, `slogan`, `rubro`, `whatsapp`, `email`, `whatsapp_mensaje` | |
| Identidad visual | `colors[]`, `tipografia` | IA derives hover variants (+15% lightness) |
| Hero | `hero_layout`, `hero_img`, `hero_descripcion`, `hero_boton` | |
| Productos | `productos[]` → `nombre`, `descripcion`, `imagen` | Max 3 |
| Ubicaciones | `ubicaciones[]` → `nombre`, `logo`, `direccion`, `gmaps_embed`, `gmaps_link` | |
| Reputación | `mostrar_estrellas`, `estrellas`, `total_resenas`, `horario` | |
| Redes | `redes['instagram','facebook','tiktok','web']` | Empty if no URL |
| Nosotros | `nosotros_texto`, `nosotros_galeria[]` | |
| Extras | `aside_visible`, `mostrar_clientes`, `clientes[]` | |
| Logo/Favicon | `logo_img`, `favicon` | |

**Hardcoded sections** (NOT in config.php — edit PHP directly):
- Star product → `includes/sections/estrella.php`
- Reels → `includes/sections/reels.php`

**Special rules**:
- Google Maps iframe: standardize zoom to `!1d1500`
- Google Maps link: prefer `https://www.google.com/maps?q=LAT,LNG`
- PENDING fields → `''` in config.php
- NO APLICA fields → `''` in config.php

## CSS Delivery Optimization (Performance 95+)

Every landing page MUST use Critical CSS inline + async bundle.

> **Golden rule:** CSS is ALWAYS written in source files. `assets/css/styles.css`
> is a **generated artifact** from the build and is **NEVER edited by hand** —
> any direct edit is lost the next time the script runs.

### Where each style goes

1. **Modular component styles** → `assets/css/*.css`
   (`base.css`, `navbar.css`, `hero.css`, `sections.css`, `aside.css`,
   `clientes.css`, `footer.css`, `responsive.css`). Source of truth for page sections.
2. **Above-the-fold critical styles** → `assets/css/critical.css`
   (`:root` variables, base reset, navbar incl. mobile hamburger, hero all layouts
   + critical breakpoints). Injected inline in `includes/header.php` inside a
   `<style>` tag, so changes appear on the next request — NO rebuild needed.
3. **Local fonts** → `assets/fonts/fonts.css` (self-hosted, async load).

### Regenerating the bundle (build)

- `tools/build-css.php` combines ONLY the modular files in `assets/css/*.css`
  (it does NOT include `critical.css` or `fonts.css`) into a single
  `assets/css/styles.css`, with conservative minification. Runs at build/deploy
  time, never at runtime.
- **After modifying ANY modular file in `assets/css/`**, you MUST run:
  ```bash
  php tools/build-css.php
  ```
- `assets/css/styles.css` is served asynchronously:
  ```html
  <link rel="preload" href="assets/css/styles.css?v=..." as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="assets/css/styles.css?v=..."></noscript>
  ```
- The cache-buster (`?v=`) is computed with `filemtime()` of the bundle, so
  regenerating the file invalidates the cache automatically.

### Post-change verification

- After any CSS change, confirm `assets/css/styles.css` is newer than the edited
  source file (or just always run the build).
- Review in the browser with a hard refresh (`Ctrl+Shift+R` / `Cmd+Shift+R`).
- If you only touched `critical.css` or `fonts.css`, no rebuild is needed, but a
  hard refresh still is.

### Fonts & images

- **Self-host fonts** in `assets/fonts/` instead of Google Fonts to avoid
  third-party requests and simplify CSP. Load async with `font-display: swap`.
- **Images**: add `width` and `height` to every `<img>`, use `loading="lazy"`
  for non-critical images, and add `decoding="async"` to offload image decode
  from the main thread. Keep `decoding="auto"` for LCP images.

**Anti-patterns to avoid:**
- ❌ Do NOT generate CSS bundles at runtime (no `bundle.php`).
- ❌ Do NOT edit `assets/css/styles.css` by hand — it is a build artifact.
- ❌ Do NOT load multiple render-blocking CSS files.
- ❌ Do NOT load Google Fonts synchronously from `fonts.googleapis.com`.

## Implementation Checklist

Before considering a landing page complete, verify:

- [ ] `config.php` complete with no placeholders
- [ ] All images in `assets/img/` follow naming convention
- [ ] No `.txt` files in asset directories
- [ ] `AGENTS.md` present in project root and up to date
- [ ] `docs/ficha-cliente.md` complete and up to date
- [ ] Footer MiLocalWeb visible and functional
- [ ] Aside publicitario present
- [ ] WhatsApp float functional
- [ ] Meta tags correct (title, description, OG)
- [ ] `.htaccess` with HTTPS forced, cache and CSP
- [ ] Every CSS edit happened in a source file (`assets/css/*.css`, `critical.css` or `fonts.css`) — never in `styles.css`
- [ ] `php tools/build-css.php` ran after any modular `assets/css/*.css` change, and `assets/css/styles.css` is newer than its sources
- [ ] `assets/css/critical.css` inline in `<head>` and `styles.css` loaded async
- [ ] Responsive on mobile
- [ ] No PHP errors (display_errors off in production)
