# docs/_archive — Archivo de documentos vencidos

Regla de ciclo de vida: los documentos **no se editan para "actualizarlos" ni se borran**.
Cuando sus tareas están resueltas, su utilidad fue suplantada por otro documento, o sus
mediciones quedaron viejas, se mueven acá con su nombre original y una cabecera de
archivado al inicio (fecha + motivo + link al documento que lo reemplaza).

- El documento de estado vigente de este proyecto es [`../estado-actual.md`](../estado-actual.md).
  Se actualiza *in-place*; solo se crea uno nuevo cuando hay una auditoría nueva (y el
  veredicto nuevo entra en `_audit/`).
- Excepción: artefactos crudos no-Markdown (ej. `.txt` de JSON de Lighthouse) no admiten
  cabecera sin romper su formato; su fecha y motivo se registran solo en este índice.

## Índice

| Fecha archivado | Archivo | Motivo |
|---|---|---|
| 2026-11-10 | `informe-cambios-seo.md` | Tareas resueltas; registro con valores desactualizados. Suplantado por `../estado-actual.md` + `docs/resumen-fixes-2026-11-10.md` del workspace. |
| 2026-11-10 | `plan-mejora-lighthouse-01.md` | Tareas resueltas (Static Maps aplicado); describe iframes ya no usados. Suplantado por `../estado-actual.md`. |
| 2026-11-10 | `rendimiento navegacion movil.txt` | JSON crudo de Lighthouse de sesión vieja (2026-08); mediciones formales en `docs/informes lighthouse/`. |
