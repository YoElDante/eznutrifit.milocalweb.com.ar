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

## Implementation Checklist

Before considering a landing page complete, verify:

- [ ] `config.php` complete with no placeholders
- [ ] All images in `assets/img/` follow naming convention
- [ ] No `.txt` files in asset directories
- [ ] `AGENTS.md` present in project root
- [ ] `docs/ficha-cliente.md` complete and up to date
- [ ] Footer MiLocalWeb visible and functional
- [ ] Aside publicitario present
- [ ] WhatsApp float functional
- [ ] Meta tags correct (title, description, OG)
- [ ] `.htaccess` with HTTPS forced and cache
- [ ] Responsive on mobile
- [ ] No PHP errors (display_errors off in production)
