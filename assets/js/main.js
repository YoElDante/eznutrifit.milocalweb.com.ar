/**
 * MiLocalWeb — Landing Page Template (Clientes)
 * Lógica de interacción del lado del cliente.
 *
 * Maneja:
 *   - Smooth scroll para links ancla
 *   - Botón "volver arriba" con show/hide al hacer scroll
 *   - WhatsApp float sin interferencias
 */
(function () {
  'use strict';

  // ── Back to top button ──────────────────────────────────────────
  var backToTop = document.querySelector('.back-to-top');
  if (backToTop) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 600) {
        backToTop.classList.add('visible');
      } else {
        backToTop.classList.remove('visible');
      }
    });

    backToTop.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // ── Mobile hamburger menu ───────────────────────────────────────
  var navbar = document.querySelector('.navbar');
  var toggle = document.querySelector('.navbar-toggle');
  var overlay = document.querySelector('.navbar-overlay');

  if (toggle && navbar) {
    toggle.addEventListener('click', function () {
      var open = navbar.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open);
      toggle.setAttribute('aria-label', open ? 'Cerrar menú' : 'Abrir menú');
    });

    // Cerrar al hacer click en un link
    navbar.querySelectorAll('.navbar-menu a').forEach(function (link) {
      link.addEventListener('click', function () {
        navbar.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-label', 'Abrir menú');
      });
    });

    // Cerrar al hacer click en el overlay
    if (overlay) {
      overlay.addEventListener('click', function () {
        navbar.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-label', 'Abrir menú');
      });
    }
  }
  document.querySelectorAll('a[href^="#"]').forEach(function (link) {
    link.addEventListener('click', function (e) {
      var targetId = this.getAttribute('href');
      if (targetId === '#') {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
        return;
      }
      var target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        var headerHeight = document.querySelector('.site-header')
          ? document.querySelector('.site-header').offsetHeight
          : 0;
        var position = target.getBoundingClientRect().top + window.scrollY - headerHeight - 16;
        window.scrollTo({ top: position, behavior: 'smooth' });
      }
    });
  });

  // ── Reel video play buttons ─────────────────────────────────────
  document.querySelectorAll('.reel-wrapper').forEach(function (wrapper) {
    var video = wrapper.querySelector('video');
    var btn   = wrapper.querySelector('.reel-play-btn');
    if (!video) return;

    function showBtn() { wrapper.classList.remove('playing'); }
    function hideBtn() { wrapper.classList.add('playing'); }

    // Click en el botón → play
    btn.addEventListener('click', function (e) {
      e.stopPropagation();
      if (video.paused) {
        video.play();
        hideBtn();
      }
    });

    // Click en el video (no en los controles nativos) → play
    video.addEventListener('click', function () {
      if (video.paused) {
        video.play();
        hideBtn();
      }
    });

    video.addEventListener('play', hideBtn);
    video.addEventListener('pause', showBtn);
    video.addEventListener('ended', showBtn);
  });

})();
