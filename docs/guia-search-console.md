# Guía: Subir sitemap a Google Search Console

> Para seguir cada vez que se crea una landing page nueva de MiLocalWeb.
> Tiempo estimado: 10 minutos. Solo se hace UNA vez por dominio.

---

## Requisito previo: verificar el dominio

Si el dominio YA está verificado en Search Console, saltar al paso 2.

### Paso 1 — Verificar propiedad del dominio

1. Ir a [Google Search Console](https://search.google.com/search-console)
2. Clic en **"Añadir propiedad"** (dropdown arriba a la izquierda)
3. Elegir **"Prefijo de URL"** (no "Dominio")
4. Ingresar: `https://eznutrifit.milocalweb.com.ar` (la URL exacta con https)
5. Elegir método de verificación: **"Etiqueta HTML"**
6. Copiar la meta tag que te da (algo como `<meta name="google-site-verification" content="xxxxx">`)
7. Pegarla en `includes/header.php` dentro del `<head>`
8. Volver a Search Console y hacer clic en **"Verificar"**

> Una vez verificado, el dominio queda para siempre. No hay que repetir este paso.

---

## Paso 2 — Subir el sitemap

1. En Search Console, seleccionar la propiedad (tu dominio)
2. En el menú izquierdo, ir a **"Sitemaps"** (está dentro de "Indexación")
3. En el campo "Añadir un nuevo sitemap", escribir: `sitemap.xml`
4. Clic en **"Enviar"**

Eso es todo. Google lo procesa en minutos u horas. El estado va a aparecer como "Correcto" cuando lo haya leído.

---

## Paso 3 — Solicitar indexación de la página principal

1. En el menú izquierdo, ir a **"Inspección de URLs"**
2. Escribir la URL completa: `https://eznutrifit.milocalweb.com.ar/`
3. Presionar Enter
4. Va a decir "La URL no está en Google" o "La URL está en Google"
5. Clic en **"Solicitar indexación"**

Esto acelera que Google visite la página. En 1-3 días debería aparecer en resultados.

---

## Paso 4 — Verificar el JSON-LD

1. Ir a [Rich Results Test](https://search.google.com/test/rich-results)
2. Pegar `https://eznutrifit.milocalweb.com.ar/`
3. Clic en **"Probar URL"**
4. Verificar que aparezcan resultados en verde:
   - "Elementos detectados: Store, Product, BreadcrumbList"

Si algo sale en rojo, revisar el JSON-LD en `includes/header.php`.

---

## Resumen rápido (para copiar y pegar en cada proyecto)

```
Para {NOMBRE_CLIENTE} ({DOMINIO}):

1. GSC → Añadir propiedad → {URL_COMPLETA}
2. Verificar con meta tag → pegar en header.php
3. GSC → Sitemaps → Añadir "sitemap.xml"
4. GSC → Inspección de URLs → Solicitar indexación
5. Rich Results Test → Validar JSON-LD
```

---

## Notas

- **Google tarda de 1 a 7 días** en indexar una página nueva. No desesperar.
- **El sitemap NO garantiza indexación**, solo acelera el descubrimiento.
- **No se necesita Google Analytics** para que esto funcione. Son cosas separadas.
- Si el cliente tiene **Google Business Profile**, asegurarse de que la URL de la web esté actualizada ahí también — es una señal fuerte de SEO local.
