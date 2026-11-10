# Resumen de documentación — EZ Nutrifit

Esta sesión dividió el CSS monolítico, actualizó el build y agregó comentarios documentales; además creó los cinco documentos de `docs/`. No se tocó lógica, contenido, datos, SEO ni diseño, y los P1/P2 de `estado-actual.md` siguen abiertos.

> **Documentación y orden: completos. Producto: NO LISTO.** La auditoría del 2026-11-09 mantiene el veredicto y los P1 abiertos.

## Fixes 2026-11-10

- `nosotros.php` incluido; founder y marcas visibles.
- JSON-LD con 15 Products, founder desde config y `es-AR`.
- Meta description sin `mb_strtolower`, WhatsApp del aside, skip-link/foco y CSP.
- Detalle completo: [Resumen de fixes](../../../docs/resumen-fixes-2026-11-10.md).

## Qué se hizo

| Acción | Archivos | Resultado |
|---|---|---|
| Dividir CSS | `assets/css/sections.css` → `assets/css/sections/01-shared.css`, `02-estrella.css`, `03-reels.css`, `04-productos.css`, `05-ubicacion.css`, `06-nosotros.css` | 684 líneas → 6 parciales; máximo 220 líneas después de comentarios. |
| Actualizar build | `tools/build-css.php` | Nuevo orden de 13 fuentes; bundle regenerado. |
| Actualizar entry point | `index.php` | Lista de fuentes CSS actualizada a los 6 parciales. |
| Comprimir comentarios | `assets/css/critical.css` | 406 → 400 líneas, sin dividir. |
| Documentar | 31 archivos: 12 PHP, 4 JS, 15 CSS | Comentarios documentales agregados en sitio. |
| Crear documentación | `docs/README.md`, `docs/estado-actual.md`, `docs/arquitectura.md`, `docs/mapa-sitio.md`, `docs/resumen-documentacion.md` | Índice, estado, arquitectura, mapa y este resumen. |
| Verificar | PHP, JS, HTML y navegador | Ver tabla siguiente. |

## Archivos divididos

| Antes | Líneas | Después | Máx. líneas |
|---|---|---|---|
| `assets/css/sections.css` | 684 | 6 parciales en `assets/css/sections/`: `01-shared.css` (40), `02-estrella.css` (220), `03-reels.css` (117), `04-productos.css` (95), `05-ubicacion.css` (141), `06-nosotros.css` (98) | 220 |
| `assets/css/critical.css` | 406 | `assets/css/critical.css` (sin dividir; comentarios comprimidos) | 400 |

> El orden de las 6 parciales preserva la cascada original: shared → estrella → reels → productos → ubicación → nosotros. `tools/build-css.php:23-39` es la fuente del orden.

## Verificación

| Prueba | Resultado |
|---|---|
| `php -l` | 12 archivos verificados, 0 errores. |
| HTML renderizado | Idéntico en `/` (ignorando comentarios CSS inline). |
| CSS normalizado | Bundle regenerado; SHA-256 idéntico al original: `79E66D6C8C77DCE2142A7F09770DAF4BAB8719F1E143DAD8228C274449BDDB0A` (29.183 bytes). |
| `node --check` | 4 archivos, 0 errores. |
| Smoke test navegador | Menú mobile y reels OK. |
| Archivos untracked | `assets/img/cliente/logos/og-image-1200x630.jpg` y `docs/rendimiento navegacion movil.txt` intactos. |
| Git | Cambios en working tree, sin commits ni `git add`. |

## Qué NO se tocó

- Lógica de negocio, contenido, datos de clientes, SEO y diseño.
- Se corrigieron `nosotros.php`, el JSON-LD (15 Products + founder + `es-AR`), la meta description, el WhatsApp del aside, skip-link/foco, CSP y el bloqueo de `config.php`/`docs`/`tools`/`skills`/`.git`. Quedan P2 de accesibilidad/performance y la re-auditoría. (`geo.region` `AR-X` es correcto para Córdoba; la guía del template se corrigió.)
- No se modificaron `docs/ficha-cliente.md`, `docs/informe_estilo_eznutrifit.md`, los informes Lighthouse ni el plan de mejora.
- No se creó el `README.md` de la raíz; el `docs/README.md` nuevo es solo el índice de esta carpeta y no cumple DOC-02.
- No se ejecutó Lighthouse ni se re-midieron Core Web Vitals.

## Cómo revertir

- Backup completo previo a los cambios: `C:\workspace\MiLocalWeb-WorkSpace\_backups\ProyectosWebs-20261109-203606\eznutrifit.milocalweb.com.ar` (verificado).
- Git: `git -C C:\workspace\MiLocalWeb-WorkSpace\ProyectosWebs\landingpages.clientes\eznutrifit.milocalweb.com.ar status` y `git -C ... diff`.
- No se hicieron commits. Para volver al estado auditado, restaurar desde el backup y, si se restauran fuentes CSS, correr `php tools/build-css.php`.

## Pendientes recomendados

Ver [estado-actual.md](estado-actual.md), sección "Deuda y riesgos". P1-01 a P1-11 ya se corrigieron el 2026-11-10 (nosotros, JSON-LD, founder, `es-AR`, meta description, skip-link/foco, WhatsApp del aside, CSP y bloqueo de archivos internos). Quedan P2 de accesibilidad/performance, el README raíz y una medición Lighthouse actual.
