/**
 * Reproducción de Reels.
 *
 * Controla el botón de play superpuesto y lo oculta/muestra según el estado
 * del <video>. El CSS usa .reel-wrapper.playing para ocultarlo
 * (assets/css/sections/03-reels.css).
 */
(function () {
  'use strict';
  document.querySelectorAll('.reel-wrapper').forEach(function (wrapper) {
    var video = wrapper.querySelector('video');
    var btn   = wrapper.querySelector('.reel-play-btn');
    if (!video || !btn) return;

    /**
     * Muestra el botón de play (video pausado o terminado).
     *
     * @returns {void}
     */
    function showBtn() { wrapper.classList.remove('playing'); }

    /**
     * Oculta el botón de play mientras el video corre.
     *
     * @returns {void}
     */
    function hideBtn() { wrapper.classList.add('playing'); }

    btn.addEventListener('click', function (e) {
      // Evita que el click burbujee al video y lo pause de inmediato.
      e.stopPropagation();
      if (video.paused) {
        video.play();
        hideBtn();
      }
    });

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
