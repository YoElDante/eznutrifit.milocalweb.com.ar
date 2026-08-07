# Guía de Relevamiento — Template para Recolectar Datos del Cliente

> **Uso**: Este documento lo completa la persona que releva al cliente (visita, llamada, WhatsApp).
> Es un formulario de campo. No requiere conocimientos técnicos.
>
> **Flujo de trabajo**:
> 1. Persona completa este archivo con los datos crudos del cliente
> 2. IA lee este archivo + `informe_estilo_{cliente}.md` (si existe)
> 3. IA genera `ficha-cliente.md` (documento canónico del negocio)
> 4. IA genera/actualiza `config.php` con los datos mapeados
>
> **IMPORTANTE**: No dejes campos vacíos. Si el dato no está disponible, escribí `PENDIENTE` o `NO APLICA`.
> La IA necesita saber explícitamente qué falta para no inventar datos.

---

## SECCIÓN 1 — Datos Básicos

| Campo | Valor | Instrucciones |
|-------|-------|---------------|
| Nombre del negocio | | Tal cual aparece en el logo / redes |
| Nombre y apellido del dueño | | Quién atiende el teléfono / WhatsApp |
| Slogan | | Una frase corta y potente (si no tiene, preguntarle qué lo define) |
| Rubro | | Ej: "Suplementos Dietarios — Nutrición — Indumentaria Deportiva" |
| WhatsApp | | Código país + número, sin + ni espacios. Ej: `5493571597376` |
| Email de contacto | | Si no usa email para clientes, escribir `NO APLICA` |
| Mensaje WhatsApp por defecto | | Lo que aparece pre-escrito cuando abren el chat desde la web. Ej: `Hola! Vi tu web y quisiera más info` |

---

## SECCIÓN 2 — Identidad Visual

> **Fuente principal**: `informe_estilo_{cliente}.md` generado por IA analizando sus redes.
> Si no hay informe de estilo, completar manualmente con lo que se observe.

| Campo | Valor | Instrucciones |
|-------|-------|---------------|
| Color primario (hex) | | El color dominante del logo / redes. Ej: `#8DC63F` |
| Color de acento (hex) | | Color secundario para destacados. Ej: `#EB2D2D` |
| Modo claro u oscuro | | `oscuro` o `claro` — ¿qué predomina en sus redes? |
| Tipografía sugerida | | Si tiene una fuente definida en su logo/redes. Si no, dejar vacío |
| Estilo visual | | `moderno` / `clásico` / `minimalista` / `vibrante` / `elegante` / `industrial` |
| Descripción de la vibra | | En palabras: ¿qué transmite su identidad visual? Ej: "neón sobre fondo negro, energía, calle" |
| Notas de diseño | | Cualquier restricción o pedido especial del cliente sobre colores, imágenes, etc. |

---

## SECCIÓN 3 — Hero Section

| Campo | Valor | Instrucciones |
|-------|-------|---------------|
| Layout del hero | | `img-right` / `img-left` / `split` / `stacked` (preguntar preferencia o decidir según la imagen disponible) |
| Foto para el hero | | Nombre del archivo. Ideal: foto del frente del negocio, producto estrella, o imagen de identidad de marca. Pedir al cliente su mejor foto. |
| Descripción breve (2-3 líneas) | | Texto que aparece debajo del slogan en el hero |
| Texto del botón principal | | Ej: `Escribinos por WhatsApp` / `Consultar precios` / `Pedir turno` |

---

## SECCIÓN 4 — Productos / Servicios Destacados

> Completar hasta 3 productos o servicios principales. Si tiene más, elegir los 3 más importantes.

### Producto 1
| Campo | Valor |
|-------|-------|
| Nombre | |
| Descripción (1-2 líneas) | |
| Foto (nombre del archivo) | |

### Producto 2
| Campo | Valor |
|-------|-------|
| Nombre | |
| Descripción (1-2 líneas) | |
| Foto (nombre del archivo) | |

### Producto 3
| Campo | Valor |
|-------|-------|
| Nombre | |
| Descripción (1-2 líneas) | |
| Foto (nombre del archivo) | |

### Producto Estrella (opcional — showcase principal)

> Si el cliente tiene UN producto/servicio que quiere destacar por encima de todo.

| Campo | Valor |
|-------|-------|
| Nombre del producto estrella | |
| Bajada (subtítulo) | |
| Descripción extendida (3-5 líneas) | |
| Foto principal | |
| Mensaje WhatsApp específico | |
| Beneficio 1 | |
| Beneficio 2 | |
| Beneficio 3 | |
| Beneficio 4 | |
| Beneficio 5 | |
| Dato nutricional / técnico 1 | |
| Dato nutricional / técnico 2 | |
| Dato nutricional / técnico 3 | |

### Productos complementarios al estrella (opcional — hasta 3)

| # | Nombre | Descripción | Foto |
|---|--------|-------------|------|
| 1 | | | |
| 2 | | | |
| 3 | | | |

---

## SECCIÓN 5 — Ubicación

> IMPORTANTE: Si el negocio es 100% online / delivery sin punto físico, escribir `NO APLICA` y saltear esta sección.
> Si tiene múltiples sucursales o stands, completar un bloque por cada uno.

### ¿Cuántos puntos de venta / atención tiene?
**Cantidad**: ____

### Punto de venta 1
| Campo | Valor |
|-------|-------|
| Nombre del punto (ej: "FREE BOX Gimnasio", "Sucursal Centro") | |
| ¿Es local propio o dentro de otro negocio? | `propio` / `tercero` |
| Si es tercero: nombre y logo del negocio anfitrión | |
| Dirección completa | |
| Google Maps link | |
| Google Maps iframe embed | |
| Horario de atención | |
| Teléfono específico (si difiere del principal) | |

### Punto de venta 2
| Campo | Valor |
|-------|-------|
| Nombre del punto | |
| ¿Es local propio o dentro de otro negocio? | `propio` / `tercero` |
| Si es tercero: nombre y logo del negocio anfitrión | |
| Dirección completa | |
| Google Maps link | |
| Google Maps iframe embed | |
| Horario de atención | |
| Teléfono específico | |

### Punto de venta 3
| Campo | Valor |
|-------|-------|
| Nombre del punto | |
| ¿Es local propio o dentro de otro negocio? | `propio` / `tercero` |
| Si es tercero: nombre y logo del negocio anfitrión | |
| Dirección completa | |
| Google Maps link | |
| Google Maps iframe embed | |
| Horario de atención | |
| Teléfono específico | |

### Punto de venta 4
| Campo | Valor |
|-------|-------|
| Nombre del punto | |
| ¿Es local propio o dentro de otro negocio? | `propio` / `tercero` |
| Si es tercero: nombre y logo del negocio anfitrión | |
| Dirección completa | |
| Google Maps link | |
| Google Maps iframe embed | |
| Horario de atención | |
| Teléfono específico | |

### Reputación
| Campo | Valor | Instrucciones |
|-------|-------|---------------|
| ¿Tiene perfil de Google Business? | `SI` / `NO` | Buscar en Google Maps |
| Calificación (estrellas) | | Ej: `4.8` |
| Cantidad de reseñas | | Ej: `124` |
| ¿Mostrar estrellas en la web? | `SI` / `NO` | Si tiene pocas reseñas o mala calificación, mejor NO |

---

## SECCIÓN 6 — Redes Sociales

| Campo | Valor | Instrucciones |
|-------|-------|---------------|
| Instagram (URL completa) | | Dejar vacío si no tiene |
| Facebook (URL completa) | | Dejar vacío si no tiene |
| TikTok (URL completa) | | Dejar vacío si no tiene |
| Sitio web propio | | Si ya tiene dominio propio además de la landing de MiLocalWeb |
| Otra red (LinkedIn, YouTube, etc.) | | Especificar nombre y URL |

---

## SECCIÓN 7 — Quiénes Somos

| Campo | Valor |
|-------|-------|
| Texto "Quiénes somos" (3-5 líneas) | |
| Foto del local / interior 1 | |
| Foto del local / interior 2 | |
| Foto del equipo | |

---

## SECCIÓN 8 — Videos / Reels (opcional)

> Si el cliente tiene videos educativos, demostrativos o de producto que quiera mostrar.

| # | Archivo de video | Título | Descripción |
|---|------------------|--------|-------------|
| 1 | | | |
| 2 | | | |
| 3 | | | |

---

## SECCIÓN 9 — Extras

| Campo | Valor | Instrucciones |
|-------|-------|---------------|
| ¿Mostrar otros clientes de MiLocalWeb? | `SI` / `NO` | Sección discreta con logos de otros negocios |
| ¿Mostrar aside publicitario? | `SI` / `NO` | Normalmente SI, es parte del modelo de negocio |
| Competencia / inspiración (links) | | Webs que al cliente le gustan como referencia |
| Pedidos especiales | | Cualquier cosa que el cliente haya pedido explícitamente |
| Restricciones | | Lo que NO quiere o NO se debe hacer |
| Fecha del relevamiento | | Día en que se recolectaron estos datos |

---

## SECCIÓN 10 — Checklist de Materiales Recibidos

> Tildar cuando el cliente entregó cada material.

| Material | Recibido | Archivos |
|----------|----------|----------|
| Logo (fondo transparente) | [ ] | |
| Logo (fondo de color) | [ ] | |
| Foto para Hero | [ ] | |
| Fotos de productos (mín. 1 c/u) | [ ] | |
| Fotos del local / interior | [ ] | |
| Fotos del equipo | [ ] | |
| Videos / Reels | [ ] | |
| Logo de negocios anfitriones (si aplica) | [ ] | |

> **IMPORTANTE: Cómo nombrar los archivos al guardarlos**
>
> Usar siempre este formato para que la IA los pueda procesar automáticamente:
> - Todo en **minúsculas**, separado por **guiones**, sin espacios ni símbolos
> - `logo-300x300-transp.webp`, `hero-fondo-gris-575x800.webp`, `prod-colageno.webp`
> - La convención completa está en `AGENTS.md` sección 7
> - **NUNCA dejar archivos .txt** en las carpetas de imágenes después de terminar

---

## ANEXO TÉCNICO — Mapeo de Campos a config.php

> **Este anexo es para la IA. La persona que releva NO necesita leer esto.**
>
> Cada campo de esta guía se mapea a una clave de `config.php` o a una sección PHP.
> La IA usa este mapeo para generar el archivo automáticamente una vez que
> la guía de relevamiento está completa.

### Datos Básicos → config.php

| Campo de la guía | Clave en config.php | Tipo |
|------------------|---------------------|------|
| Nombre del negocio | `nombre` | string |
| Slogan | `slogan` | string |
| Rubro | `rubro` | string |
| WhatsApp | `whatsapp` | string (solo dígitos) |
| Email de contacto | `email` | string (vacío si NO APLICA) |
| Mensaje WhatsApp | `whatsapp_mensaje` | string |

### Identidad Visual → config.php

| Campo de la guía | Clave en config.php | Nota |
|------------------|---------------------|------|
| Color primario | `colors['color-primary']` | |
| — | `colors['color-primary-hover']` | IA calcula: aclarar primario ~15% |
| Color de acento | `colors['color-accent']` | |
| — | `colors['color-accent-hover']` | IA calcula: aclarar acento ~15% |
| Modo claro/oscuro | `colors['color-bg']` | oscuro → `#0D0D0D`, claro → `#FFFFFF` |
| — | `colors['color-text']` | contraste automático según bg |
| — | `colors['color-muted']` | `#A0A0A0` / `#666666` según modo |
| — | `colors['color-bg-alt']` | `rgba(255,255,255,0.03)` / `rgba(0,0,0,0.03)` |
| — | `colors['color-card-bg']` | `#1A1A1A` / `#F5F5F5` según modo |
| — | `colors['color-hero-bg-start']` | gradiente hero, calculado |
| — | `colors['color-hero-bg-end']` | gradiente hero, calculado |
| Tipografía sugerida | `tipografia` | string CSS font-family |
| Estilo visual + Descripción vibra | Usado por IA para derivar `colors` | Si no hay informe de estilo |

### Hero Section → config.php

| Campo de la guía | Clave en config.php |
|------------------|---------------------|
| Layout del hero | `hero_layout` |
| Foto para el hero | `hero_img` |
| Descripción breve | `hero_descripcion` |
| Texto del botón | `hero_boton` |

### Productos → config.php

| Campo de la guía | Clave en config.php |
|------------------|---------------------|
| Producto 1/2/3 (nombre, desc, foto) | `productos[]` array con keys `nombre`, `descripcion`, `imagen` |

### Producto Estrella → sección PHP (estrella.php)

> **IMPORTANTE**: El producto estrella NO se configura desde `config.php`.
> Actualmente está hardcodeado en `includes/sections/estrella.php`.
> Si el cliente cambia de producto estrella, hay que **editar el PHP directamente**
> o migrar estos datos a `config.php` como mejora futura.

### Ubicaciones → config.php

| Campo de la guía | Clave en config.php |
|------------------|---------------------|
| Cada punto de venta | `ubicaciones[]` array con keys `nombre`, `logo`, `direccion`, `gmaps_embed`, `gmaps_link` |
| Reputación (estrellas) | `mostrar_estrellas`, `estrellas`, `total_resenas` |
| Horario consolidado | `horario` |
| — | `direccion` (legacy, compatibilidad) |
| — | `gmaps_embed` (legacy, compatibilidad) |
| — | `gmaps_link` (legacy, compatibilidad) |

### Redes Sociales → config.php

| Campo de la guía | Clave en config.php |
|------------------|---------------------|
| Instagram | `redes['instagram']` |
| Facebook | `redes['facebook']` |
| TikTok | `redes['tiktok']` |
| Web propia | `redes['web']` |

### Quiénes Somos → config.php

| Campo de la guía | Clave en config.php |
|------------------|---------------------|
| Texto Quiénes somos | `nosotros_texto` |
| Fotos del local | `nosotros_galeria[]` array con keys `imagen`, `alt` |

### Videos / Reels → sección PHP (reels.php)

> **IMPORTANTE**: Los reels NO se configuran desde `config.php`.
> Actualmente están hardcodeados en `includes/sections/reels.php`.
> Si el cliente tiene videos, hay que editar el array `$reels` en ese archivo
> o migrar estos datos a `config.php` como mejora futura.

### Extras → config.php

| Campo de la guía | Clave en config.php |
|------------------|---------------------|
| ¿Mostrar otros clientes? | `mostrar_clientes` |
| Encabezado clientes | `clientes_encabezado` |
| Logos de otros clientes | `clientes[]` array con keys `nombre`, `logo`, `url`, `ancho`, `alto` |
| ¿Mostrar aside? | `aside_visible` |

### Logos e Íconos → config.php

| Recurso | Clave en config.php |
|---------|---------------------|
| Logo principal | `logo_img` |
| Favicon | `favicon` |

---

## NOTAS PARA LA IA

1. **Si no hay informe de estilo**: Derivar colores del logo con una herramienta de extracción de paleta. Si el logo no está disponible, usar paleta neutra (grises, system-ui). NUNCA inventar colores llamativos sin fuente.

2. **Si la guía tiene campos PENDIENTE**: No inventar. Usar `''` (string vacío) en config.php. La sección correspondiente se ocultará en la web.

3. **Si la guía tiene NO APLICA**: Dejar el campo vacío `''` en config.php.

4. **Google Maps iframe**: Siempre estandarizar el zoom a `!1d1500` en el embed. Revisar AGENTS.md sección 4 para el procedimiento.

5. **Google Maps link**: Preferir formato `https://www.google.com/maps?q=LAT,LNG` (más corto y confiable que los links acortados).

6. **Imágenes**: Verificar que los archivos referenciados existan en `assets/img/`. Si no existen, dejar el campo vacío y reportarlo. Si las imágenes tienen espacios o mayúsculas, **renombrarlas** siguiendo la convención de `AGENTS.md` sección 7 (`{categoria}-{descriptor}.webp`, todo minúsculas, guiones).

7. **Orden de procesamiento**:
   - Leer esta guía primero
   - Leer `informe_estilo_{cliente}.md` si existe
   - Cruzar datos: la guía tiene info de negocio, el informe tiene paleta/tipografía
   - Renombrar imágenes/videos a la convención de nombres
   - Eliminar cualquier `.txt` en carpetas de assets
   - Generar `ficha-cliente.md`
   - Generar `config.php`
   - Verificar imágenes referenciadas
