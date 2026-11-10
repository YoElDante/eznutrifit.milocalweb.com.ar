# Documentación — EZ Nutrifit

Landing page single-page de EZ Nutrifit (suplementos deportivos en Río Tercero, Córdoba); esta carpeta reúne el estado real, la arquitectura, el mapa de rutas y el registro de la documentación.

> **Estado del producto: NO LISTO.** La auditoría del 2026-11-09 detectó P1 abiertos (56,5/79, 71,5 %). Esta carpeta documenta el estado real; no certifica que el sitio esté terminado.

## Orden de lectura

1. [Estado actual](estado-actual.md) — veredicto, cumplimiento y SEO.
2. [Arquitectura](arquitectura.md) — archivos, flujos y diagramas.
3. [Mapa del sitio](mapa-sitio.md) — rutas, anclas y sitemap.
4. [Resumen de documentación](resumen-documentacion.md) — cambios de esta sesión.

## Documentos existentes

- [Ficha del cliente](ficha-cliente.md) — datos canónicos del negocio, identidad, productos, ubicaciones y SEO.
- [Informe de identidad visual](informe_estilo_eznutrifit.md) — paleta, tipografías y criterios visuales de la marca.
- [Guía de relevamiento](guia-relevamiento.md) — plantilla para completar datos del cliente en campo.
- [Guía de SEO para IA](guia-seo-ia.md) — reglas de metadatos, JSON-LD, headings y archivos técnicos.
- [Guía de Search Console](guia-search-console.md) — verificación del dominio y carga del sitemap.
- [Informe de cambios SEO (histórico)](informe-cambios-seo.md) — informe del 2026-08-07; desactualizado respecto del render actual (documenta 15 Products). `AR-X` sí es correcto para Córdoba.
- [Plan de mejora Lighthouse 01 (histórico)](plan-mejora-lighthouse-01.md) — plan del 2026-08-07; describe iframes que ya no se usan.
- Informes Lighthouse — seis informes del 2026-08-07 y un re-análisis posterior; son históricos y anteriores al cambio a Static Maps:
  - [01 — Navegación móvil](<informes lighthouse/01-lighthouse-resumen-eznutrifit-movil.md>)
  - [02 — Navegación escritorio](<informes lighthouse/02-lighthouse-resumen-eznutrifit-desktop.md>)
  - [03 — Snapshot móvil](<informes lighthouse/03-lighthouse-resumen-eznutrifit-instante-movil.md>)
  - [04 — Snapshot escritorio](<informes lighthouse/04-lighthouse-resumen-eznutrifit-instante-desktop.md>)
  - [05 — Timespan móvil](<informes lighthouse/05-lighthouse-resumen-eznutrifit-timespan-movil.md>)
  - [06 — Timespan escritorio](<informes lighthouse/06-lighthouse-resumen-eznutrifit-timespan-desktop.md>)
  - [Re-análisis navegación móvil v2](<informes lighthouse/lighthouse-resumen-eznutrifit-navegacion-movil-v2.md>)
- [Rendimiento navegación móvil](<rendimiento navegacion movil.txt>) — datos crudos de rendimiento; archivo untracked preexistente.

> Este `README.md` es el índice de `docs/`. No reemplaza el `README.md` de la raíz que exige el requisito DOC-02, que sigue ausente.

## Para una IA

Leer primero `AGENTS.md` de la raíz, luego `estado-actual.md` y `arquitectura.md`.
No editar archivos generados (`assets/css/styles.css`, bundles JS) a mano.
`config.php` es la fuente única de verdad; `docs/` no debe tratarse como código.
