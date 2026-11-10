/**
 * Menú hamburguesa mobile.
 *
 * Abre/cierra el panel lateral del navbar, sincroniza aria-expanded/aria-label
 * y cierra al tocar un enlace o el overlay. El estado visual vive en la clase
 * .open, compartida con assets/css/navbar.css y assets/css/responsive.css.
 */
(function () {
  'use strict';
  var navbar = document.querySelector('.navbar');
  var toggle = document.querySelector('.navbar-toggle');
  var overlay = document.querySelector('.navbar-overlay');
  if (!toggle || !navbar) return;

  /**
   * Cierra el menú y restaura el estado accesible del botón.
   *
   * @returns {void}
   */
  function closeMenu() {
    navbar.classList.remove('open');
    toggle.setAttribute('aria-expanded', 'false');
    toggle.setAttribute('aria-label', 'Abrir menú');
  }

  // El botón es la única fuente de verdad del estado abierto/cerrado.
  toggle.addEventListener('click', function () {
    var open = navbar.classList.toggle('open');
    toggle.setAttribute('aria-expanded', open);
    toggle.setAttribute('aria-label', open ? 'Cerrar menú' : 'Abrir menú');
  });

  navbar.querySelectorAll('.navbar-menu a').forEach(function (link) {
    link.addEventListener('click', closeMenu);
  });

  if (overlay) {
    overlay.addEventListener('click', closeMenu);
  }
})();
