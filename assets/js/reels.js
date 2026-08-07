/**
 * Reel video playback — custom play button with show/hide on play/pause/ended
 */
(function () {
  'use strict';
  document.querySelectorAll('.reel-wrapper').forEach(function (wrapper) {
    var video = wrapper.querySelector('video');
    var btn   = wrapper.querySelector('.reel-play-btn');
    if (!video || !btn) return;

    function showBtn() { wrapper.classList.remove('playing'); }
    function hideBtn() { wrapper.classList.add('playing'); }

    btn.addEventListener('click', function (e) {
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
