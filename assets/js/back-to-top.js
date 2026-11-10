/**
 * Botón "Volver arriba".
 *
 * Muestra el botón (clase .visible) después de 600 px de scroll y vuelve
 * al inicio con desplazamiento suave. Depende del markup de includes/footer.php
 * y de los estilos de assets/css/footer.css.
 *
 * Orden de ejecución: se carga con defer al final del body (includes/footer.php).
 */
(function () {
  'use strict';
  var btn = document.querySelector('.back-to-top');
  if (!btn) return;

  // Umbral de aparición: evita tapar el hero en el primer viewport.
  window.addEventListener('scroll', function () {
    if (window.scrollY > 600) {
      btn.classList.add('visible');
    } else {
      btn.classList.remove('visible');
    }
  });

  btn.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
})();
