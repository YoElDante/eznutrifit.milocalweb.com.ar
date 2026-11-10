/**
 * Scroll suave para enlaces internos.
 *
 * Intercepta anchors #... y compensa la altura del header fijo para que el
 * título de la sección no quede tapado. El offset extra de 16 px es aire visual.
 * Depende de .site-header (includes/header.php) y de scroll-behavior en CSS.
 */
(function () {
  'use strict';
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
        var header = document.querySelector('.site-header');
        var offset = header ? header.offsetHeight : 0;
        // Header fixed: se resta su altura + 16 px de margen visual.
        var position = target.getBoundingClientRect().top + window.scrollY - offset - 16;
        window.scrollTo({ top: position, behavior: 'smooth' });
      }
    });
  });
})();
