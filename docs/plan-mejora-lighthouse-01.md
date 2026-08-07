# Plan de mejora — Lighthouse móvil informe 01

**Sitio:** https://eznutrifit.milocalweb.com.ar/  
**Informe base:** `docs/informes lighthouse/01-lighthouse-resumen-eznutrifit-movil.md`  
**Fecha de implementación:** 07/08/2026  
**Puntajes antes de los cambios:** Performance 66 / Accessibility 91 / Best Practices 77 / SEO 100

---

## Resumen de cambios implementados

| Categoría | Problema | Solución | Archivos afectados |
|---|---|---|---|
| **Performance** | LCP 3.8 s — fondo del hero descubierto tarde | Preload de la imagen del hero con `fetchpriority="high"` | `includes/header.php`, `includes/sections/hero.php` |
| **Performance** | Google Fonts bloquea render (~1038 ms) | Fuentes descargadas y servidas localmente desde `assets/fonts/` | `assets/fonts/*`, `includes/header.php` |
| **Performance** | 8 archivos CSS render-blocking | Critical CSS inline (`assets/css/critical.css`) + bundle estático async generado en build time (`tools/build-css.php` → `assets/css/styles.css`); `fonts.css` también carga async | `assets/css/critical.css`, `assets/css/styles.css`, `tools/build-css.php`, `includes/header.php`, `index.php` |
| **Performance** | Trabajo de decodificación de imágenes en hilo principal | Atributo `decoding="async"` en imágenes no críticas; `decoding="auto"` en LCP | Varios `includes/sections/*.php`, `includes/header.php`, `includes/footer.php` |
| **Accessibility** | Contraste insuficiente en 6 elementos (incl. link "Pedí la tuya sin cargo") | Ajustes de opacidad y color; link del footer badge pasó a `#B3B3B3` | `assets/css/base.css`, `assets/css/aside.css`, `assets/css/footer.css`, `config.php` |
| **Performance** | Imágenes sin `width`/`height` → CLS | Atributos de dimensión agregados a todas las imágenes relevantes | Varios `includes/sections/*.php`, `includes/header.php`, `includes/footer.php` |
| **Performance** | JS propio contribuye al TBT | Scripts del footer cargan con `defer` | `includes/footer.php` |
| **Accessibility** | Contraste insuficiente en 6 elementos | Ajuste de opacidades y cambio de `--color-accent` a `#FF5555` | `assets/css/base.css`, `assets/css/aside.css`, `assets/css/footer.css`, `config.php` |
| **Accessibility** | 4 iframes de Google Maps sin `title` | Inyección automática de `title` descriptivo en `ubicacion.php` | `includes/sections/ubicacion.php` |
| **Accessibility** | Orden de headings roto en reels | `<h4>` cambiado a `<h3>`; selector CSS actualizado | `includes/sections/reels.php`, `assets/css/sections.css` |
| **Best Practices** | Issue reportado de CSP | Cabecera `Content-Security-Policy` agregada en `.htaccess`; caché para fuentes `.woff2` | `.htaccess` |
| **Documentación** | Manifiesto de estilos desactualizado | Ajustes de accesibilidad documentados en el informe de identidad visual | `docs/informe_estilo_eznutrifit.md` |

---

## 1. Performance

### 1.1 Preload del hero (LCP)

En `includes/header.php` se agregó:

```html
<link rel="preload" as="image" href="/assets/img/cliente/identidad/hero-fondo-gris-575x800.webp" type="image/webp" fetchpriority="high">
```

Además, en `hero.php` las etiquetas `<img>` del hero (layouts `stacked`, `img-right`, `img-left`) recibieron `fetchpriority="high"`.

### 1.2 Fuentes locales

Se descargaron los archivos `.woff2` de Bebas Neue y Montserrat (latin, latin-ext y subsets adicionales) desde Google Fonts y se guardaron en `assets/fonts/`. Se generó `assets/fonts/fonts.css` con referencias locales.

En `includes/header.php` se reemplazó:

```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@400;600;700;800;900&display=swap" rel="stylesheet">
```

por:

```html
<link rel="stylesheet" href="/assets/fonts/fonts.css?v={filemtime}">
```

### 1.3 Critical CSS inline + bundle asíncrono en build time

Se implementó el patrón que usan sitios con Performance 95+:

1. **`assets/css/critical.css`** contiene el CSS imprescindible para pintar el above-the-fold: variables, reset, navbar y hero (incluyendo sus breakpoints responsive).
2. **`tools/build-css.php`** combina los 8 archivos fuente en un único `assets/css/styles.css` con minificación conservadora.
3. En `includes/header.php`:
   - El `critical.css` se inyecta inline dentro de `<style>`.
   - El `styles.css` se carga de forma asíncrona con preload:
     ```html
     <link rel="preload" href="assets/css/styles.css?v=..." as="style" onload="this.onload=null;this.rel='stylesheet'">
     <noscript><link rel="stylesheet" href="assets/css/styles.css?v=..."></noscript>
     ```

En `index.php` se calcula `$stylesVersion` a partir del `filemtime` de `assets/css/styles.css`.

Los archivos individuales (`base.css`, `navbar.css`, etc.) se conservan como código fuente.

### 1.4 Dimensiones de imágenes

Se agregaron atributos `width` y `height` a:

- Logo del navbar (`300x300`)
- Logo del hero (`300x300`)
- Imagen del hero (`575x800`)
- Imagen del producto estrella (`600x600`)
- Imágenes secundarias del producto estrella (`600x600`)
- Imágenes de productos destacados (`600x600`)
- Logos de ubicaciones (dimensiones reales vía `getimagesize`)
- Logo del aside de MiLocalWeb (`691x300`)
- Logo del footer del cliente (`300x300`)
- Logo de MiLocalWeb en el footer (`691x300`)
- Imágenes de la galería "Nosotros" (`600x600`)

### 1.5 Scripts con `defer`

Los 4 scripts de `includes/footer.php` ahora cargan con `defer` para no bloquear el hilo principal durante el parseo inicial.

---

## 2. Accesibilidad

### 2.1 Contraste de color

| Elemento | Antes | Después |
|---|---|---|
| `.estrella-bajada` (`--color-accent`) | `#EB2D2D` | `#FF5555` |
| `.estrella-bajada` hover (`--color-accent-hover`) | `#FF5555` | `#FF7777` |
| `.aside-slogan` | opacidad `0.6` | opacidad `0.85` |
| `.footer-slogan` | opacidad `0.6` | opacidad `0.8` |
| Headings del footer (`SEGUINOS`, `CONTACTO`) | opacidad `0.5` | opacidad `0.65` |

Los cambios se aplicaron en los CSS y en `config.php` para que las variables inline inyectadas en el `<head>` sean consistentes.

### 2.2 Títulos de iframes

En `includes/sections/ubicacion.php` se inyecta automáticamente un atributo `title` en cada iframe de Google Maps, usando el nombre del punto de venta:

```html
<iframe title="Mapa de ubicación de FREE BOX Gimnasio" ...>
```

### 2.3 Jerarquía de headings

En `includes/sections/reels.php` el título de cada reel pasó de `<h4>` a `<h3>`. Se actualizó el selector correspondiente en `assets/css/sections.css`.

---

## 3. Best Practices

### 3.1 Content Security Policy (CSP)

Se agregó en `.htaccess`:

```apache
Header always set Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; font-src 'self'; img-src 'self' data:; frame-src https://www.google.com; connect-src 'self'; base-uri 'self'; form-action 'self';"
```

Esta política cubre:
- Fuentes locales (`font-src 'self'`)
- Scripts y estilos inline necesarios para JSON-LD y variables de color (`'unsafe-inline'`)
- Iframes de Google Maps (`frame-src https://www.google.com`)
- Imágenes locales y data URIs

### 3.2 Caché para fuentes

Se agregó en `.htaccess` caché inmutable de 1 año para archivos de fuentes:

```apache
<FilesMatch "\.(woff2|woff|ttf|otf|eot)$">
    Header set Cache-Control "public, max-age=31536000, immutable"
</FilesMatch>
```

---

## 4. Verificación realizada

- Validación de sintaxis PHP en todos los archivos modificados: **OK**
- Servidor local PHP: la página carga correctamente
- `bundle.php` entrega ~34 KB de CSS combinado
- `fonts.css` carga con referencias locales y los archivos `.woff2` responden correctamente
- Preload del hero, fuentes locales y títulos de iframes presentes en el HTML generado

---

## 5. Ajustes posteriores al re-análisis v2

Tras el segundo informe (`lighthouse-resumen-eznutrifit-navegacion-movil-v2.md`),
que mostró **Performance 66 → 83** y **Accessibility 91 → 96**, se aplicaron
estos ajustes adicionales:

### 5.1 Contraste del link "Pedí la tuya sin cargo"

Último elemento de accesibilidad pendiente en v2. En `assets/css/footer.css` se
cambió `.footer-badge-cta a` a `color: #B3B3B3` para pasar el contraste WCAG AA.

### 5.2 `fonts.css` cargado de forma no bloqueante

En `includes/header.php` el link a `fonts.css` pasó del modo sincrónico al truco
async:

```html
<link rel="preload" href="assets/fonts/fonts.css?v=..." as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="assets/fonts/fonts.css?v=..."></noscript>
```

### 5.3 Descodificación de imágenes async

Se agregó `decoding="async"` a imágenes no críticas (logos, productos, galería,
aside, footer, ubicaciones) para reducir trabajo en el hilo principal. Las
imágenes LCP (hero) quedaron con `decoding="auto"`.

### 5.4 Optimización de imágenes pendiente de herramientas externas

El ahorro restante de ~81 KiB en 3 imágenes (`hero-split-bg`, `estrella-img`,
`secundaria-img`) requiere compresión/re-escalado con herramientas como `cwebp`,
Squoosh o TinyPNG, que no están disponibles en este entorno de trabajo.

---

## 6. Próximos pasos sugeridos

1. **Volver a correr Lighthouse** para medir el impacto de los últimos ajustes.
2. **Investigar el trabajo del hilo principal** con DevTools Performance
   (ver instrucciones en el skill o en la sección 7 de este documento).
3. **Optimizar las imágenes restantes** (~81 KiB) con una herramienta externa.
4. **Revisar el panel Issues de DevTools** para confirmar el detalle exacto del
   issue de CSP.
5. **Recuerdo para mantenimiento**: cada vez que se modifique un `.css`, correr
   `php tools/build-css.php` para regenerar `assets/css/styles.css`.

---

## 7. Guía para capturar traza de DevTools Performance

El principal freno restante del score de Performance es el trabajo en el hilo
principal (5.7 s reportados, TBT 430 ms). Nuestros scripts son pequeños y van
con `defer`, así que hace falta una traza real para ver qué está consumiendo
CPU.

### Pasos para capturar la traza

1. **Abrir Chrome en una ventana de incógnito** (Ctrl+Shift+N) para evitar
   extensiones.
2. **Abrir DevTools** con `F12` → pestaña **Performance**.
3. En la parte superior izquierda, hacer clic en el ícono de **recargar y
   capturar** (circular, justo al lado del botón de grabación gris).
4. Esperar a que termine la recarga y la traza se detenga sola.
5. **Guardar la traza** con el botón derecho → **Save profile...** (archivo `.json`).
6. Subir el archivo al chat o indicar lo siguiente:
   - ¿Qué tareas largas (>50 ms) aparecen en la sección **Main**?
   - ¿Hay bloques amarillos de **Parse HTML**, **Parse Stylesheet**, **Evaluate Script** o **Layout**?
   - ¿Cuánto tiempo ocupa cada uno de nuestros scripts (`back-to-top.js`,
     `navbar.js`, `smooth-scroll.js`, `reels.js`)?
   - ¿Aparece algún script que no reconozcas (por ejemplo, de extensiones)?

Con esa información podemos decidir si el problema está en nuestro código, en
el parseo del HTML/CSS, o en factores externos.

---

## Archivos modificados

- `.htaccess`
- `config.php`
- `index.php`
- `includes/header.php`
- `includes/footer.php`
- `includes/sections/hero.php`
- `includes/sections/estrella.php`
- `includes/sections/productos.php`
- `includes/sections/ubicacion.php`
- `includes/sections/reels.php`
- `includes/sections/aside.php`
- `includes/sections/nosotros.php`
- `assets/css/base.css`
- `assets/css/aside.css`
- `assets/css/footer.css`
- `assets/css/sections.css`
- `assets/css/critical.css` (nuevo)
- `assets/css/styles.css` (nuevo, generado por build)
- `assets/fonts/*` (nuevos)
- `tools/build-css.php` (nuevo)
- `docs/informe_estilo_eznutrifit.md`
- `docs/plan-mejora-lighthouse-01.md` (este documento)
