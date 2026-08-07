# AGENTS.md — MiLocalWeb Landing Page

> Instrucciones para asistentes de código. Leer esto ANTES de cualquier acción.
> Este archivo existe en cada proyecto cliente y es la guía canónica.
>
> **Skills disponibles**: `milocalweb-landing` — convenciones técnicas, assets, mapeo config.php, checklist.

---

## 1. Contexto del Negocio

MiLocalWeb (milocalweb.com.ar) es un servicio de marketing digital para negocios locales.
Una landing page optimizada para SEO es **uno de los productos del paquete**.

**Modelo de negocio:**
- Cada cliente recibe una landing page en un subdominio (`cliente.milocalweb.com.ar`)
- La landing funciona como hub central: indexa en Google, linkea redes sociales,
  Google Business Profile, y canaliza consultas a WhatsApp
- La página NO es e-commerce — es vitrina, captación de leads y presencia digital

**Monetización para MiLocalWeb:**
- La landing incluye elementos publicitarios propios (footer, aside) que promocionan
  el servicio de MiLocalWeb y generan tráfico hacia milocalweb.com.ar
- Se puede incluir una sección discreta de "Otros Clientes" como vidriera del portfolio

---

## 2. Arquitectura del Template

```
{cliente}.milocalweb.com.ar/
├── index.php                  ← Entry point. Arma la página completa.
├── config.php                 ← ÚNICA fuente de datos del sitio.
├── .htaccess                  ← Seguridad, caché, HTTPS forzado.
├── assets/
│   ├── css/                   ← Estilos divididos por componente.
│   ├── js/                    ← JS vanilla por funcionalidad.
│   ├── img/
│   │   ├── cliente/           ← Imágenes del negocio (logos, productos, fotos).
│   │   ├── milocalweb/        ← Assets de MiLocalWeb (logos, iconos).
│   │   └── terceros/          ← Logos de terceros (ej. Freebox, Origen).
│   └── vid/
│       └── reels/             ← Videos para la sección Reels (mp4 + posters webp).
├── includes/
│   ├── header.php             ← <head> completo + navbar + inicio del <main>.
│   ├── footer.php             ← Footer estándar MiLocalWeb + WhatsApp float.
│   └── sections/
│       ├── hero.php           ← Hero section (4 layouts configurables).
│       ├── productos.php      ← Hasta 3 productos destacados.
│       ├── estrella.php       ← Producto estrella showcase (hardcodeado, no en config).
│       ├── ubicacion.php      ← Mapa, dirección, horarios, estrellas.
│       ├── reels.php          ← Videos educativos (hardcodeado, no en config).
│       ├── nosotros.php       ← Quiénes somos, galería, redes, CTA final.
│       ├── aside.php          ← Aside publicitario MiLocalWeb.
│       └── clientes.php       ← Sección "Otros Clientes".
├── docs/
│   ├── guia-relevamiento.md   ← Template que completa la persona en campo.
│   ├── ficha-cliente.md       ← Documento canónico del negocio (generado por IA).
│   ├── {cliente}.cliente.md   ← Datos crudos del relevamiento (ARCHIVADO).
│   └── informe_estilo_{cliente}.md ← Identidad visual (colores, tipografías).
└── skills/
    └── milocalweb-landing/    ← Skill: convenciones, assets, mapeo, checklist.
```

**Principio fundamental:** `config.php` es la fuente única de verdad.
Toda la landing se genera a partir de ese array. Si algo no está en `config.php`,
no aparece en la página.

---

## 3. Flujo de Trabajo para un Nuevo Cliente

El proceso tiene 2 fases: **relevamiento** (humano) y **generación** (IA).

### Fase 1 — Relevamiento (persona en campo)

1. Copiar `docs/guia-relevamiento.md` al proyecto del cliente nuevo
2. Completar TODOS los campos con datos del cliente (visita, llamada, WhatsApp)
3. Si el cliente tiene redes sociales activas, generar `docs/informe_estilo_{cliente}.md`
   usando IA para analizar su identidad visual (colores, tipografías, estilo)
4. Recolectar y guardar las imágenes en `assets/img/cliente/`
5. Recolectar videos para Reels en `assets/vid/reels/` (si aplica)

### Fase 2 — Generación (IA)

> **Cargar skill `milocalweb-landing`** para el procedimiento detallado, mapeo de
> campos a config.php y checklist de implementación.

Resumen:
1. Leer `docs/guia-relevamiento.md` + `docs/informe_estilo_{cliente}.md`
2. Renombrar assets a la convención, eliminar .txt
3. Generar `docs/ficha-cliente.md`
4. Llenar `config.php` con el mapeo del skill
5. Editar `estrella.php` y/o `reels.php` si el cliente tiene esos contenidos
6. Marcar `{cliente}.cliente.md` como ARCHIVADO
7. Pasar la checklist del skill

### Datos que NO van en config.php (están hardcodeados en PHP)

- **Producto estrella** → `includes/sections/estrella.php`
- **Videos / Reels** → `includes/sections/reels.php`

---

## 4. Estrategia SEO

La landing está optimizada para búsquedas locales en Google. Elementos clave:

- **Title tag:** `{nombre} — {slogan}`
- **Meta description:** primeras 160 chars del hero_descripcion
- **Open Graph:** título, descripción, type=website, locale=es_AR
- **robots:** index, follow
- **Estructura semántica:** un `<h1>` por página (el slogan en el hero),
  `<h2>` para títulos de sección, `<h3>` para subtítulos
- **Alt text:** todas las imágenes tienen alt descriptivo
- **HTTPS forzado** vía .htaccess
- **Cache immutability** para CSS/JS (cache busting por filemtime)

**Google Business Profile:**
- La URL de la landing debe estar registrada en el perfil de Google Business del cliente
- La sección de Ubicación debe incluir el iframe embed de Google Maps
- Las estrellas y reseñas (si existen) deben mostrarse para reforzar prueba social
- **Zoom estandarizado de mapas:** Todos los iframes de Google Maps deben tener
  radio de zoom `!1d1500`. Si el embed viene con otro valor, reemplazar por `!1d1500`
  preservando los valores de `!2d` (longitud) y `!3d` (latitud).

---

## 5. Elementos Estándar (Obligatorios en Toda Landing)

### Footer MiLocalWeb
- Logo o nombre de MiLocalWeb con link a `https://milocalweb.com.ar#contacto`
- Badge: "Hecho con ❤️ por MiLocalWeb.com.ar"
- CTA: "¿Te gustó esta web? Pedí la tuya sin cargo" → WhatsApp de MiLocalWeb
- Copyright del cliente + botón "volver arriba"

### Aside Publicitario
- Espacio reservado para publicidad de terceros o autopromoción de MiLocalWeb
- Debe ser discreto, no invasivo. Desktop: sidebar lateral; mobile: banner horizontal.
- Contenido configurable vía `config.php`

### WhatsApp Float
- Botón flotante verde de WhatsApp siempre visible (abajo a la derecha)
- Link directo a wa.me/{numero}?text={mensaje}

### Sección "Nuestros Clientes"
- Muestra 3-4 logos de otros clientes de MiLocalWeb
- Super discreta: solo logos en escala de grises, sin textos llamativos
- Link a milocalweb.com.ar o a un portfolio

---

## 6. Reglas Estrictas

### Lo que NUNCA se debe hacer:
- ❌ Eliminar el footer estándar de MiLocalWeb
- ❌ Eliminar el aside publicitario
- ❌ Eliminar el WhatsApp float
- ❌ Cambiar la estructura de `config.php` (agregar claves sí, quitar las obligatorias no)
- ❌ Inventar un estilo visual sin basarse en el informe de identidad del cliente
- ❌ Usar lorem ipsum o placeholders — si no hay dato real, mostrar "próximamente"
- ❌ Hardcodear colores en los templates PHP (usar siempre variables CSS desde config.php)
- ❌ Agregar dependencias externas innecesarias (JS frameworks, icon fonts pesadas, trackers sin consentimiento)
- ❌ Usar espacios o mayúsculas en nombres de archivos de assets
- ❌ Dejar archivos .txt de trabajo en carpetas de imágenes o videos

### Lo que SIEMPRE se debe hacer:
- ✅ Mantener `config.php` como fuente única de verdad
- ✅ Usar variables CSS (`--color-*`) para todos los colores
- ✅ Respetar la estructura de secciones existente
- ✅ Documentar cualquier sección nueva en `docs/ficha-cliente.md`
- ✅ Usar `htmlspecialchars()` en todo output de datos del cliente
- ✅ Mantener compatibilidad mobile-first

---

## 7. Convenciones Técnicas

- **PHP:** Sin framework. PHP plano con includes. Compatible con PHP 7.4+.
- **CSS:** Variables CSS custom properties. Sin preprocesadores. Mobile-first.
- **JS:** Vanilla JS. Sin frameworks. Mínimo y solo para interacción esencial.
- **Imágenes:** Formato WebP prioritario. Lazy loading por defecto.
- **Tipografía:** `system-ui` como fallback. Google Fonts solo si el cliente tiene
  tipografía corporativa definida.
- **Íconos:** SVG inline (evitar icon fonts, evitan requests extra).
- **Rendimiento:** Sin jQuery, sin Bootstrap, sin Tailwind. CSS hecho a medida.

> **Convención de nombres de assets, mapeo config.php, y checklist**: ver skill `milocalweb-landing`.
