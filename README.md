# EZ Nutrifit — Landing INICIAL

Landing single-page de EZ Nutrifit (suplementos deportivos en Río Tercero, Córdoba). Es una implementación **INICIAL** de MiLocalWeb: vidriera y contacto por WhatsApp, sin catálogo ni carrito.

## Stack

- PHP plano, sin framework.
- CSS modular con build (`tools/build-css.php`).
- JS vanilla.
- `config.php` es la fuente única de datos.

## Estructura rápida

- `index.php` — orquesta las secciones.
- `config.php` — datos del negocio, productos, SEO y colores.
- `includes/header.php` — `<head>` SEO + JSON-LD + navbar.
- `includes/sections/` — hero, estrella, productos, aside, ubicación, reels, nosotros, clientes.
- `docs/` — estado, arquitectura, mapa del sitio y resumen.

## Comandos

```bash
php tools/build-css.php
php -S 127.0.0.1:8000 -t .
```

## Documentación

Empezá por [`docs/README.md`](docs/README.md) y [`docs/estado-actual.md`](docs/estado-actual.md).
