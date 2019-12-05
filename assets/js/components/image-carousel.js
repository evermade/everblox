import Flickity from 'flickity';

function imageCarousel() {
  const containerElements = document.querySelectorAll('.js-image-carousel');

  const init = () => {
    Array.from(containerElements).forEach((el) => {
      setupFlickity(el, {
        wrapAround: true,
        cellAlign: 'left',
        prevNextButtons: false,
        pageDots: false,
        adaptiveHeight: true,
        accessibility: false,
      });
    });
  };

  const setupFlickity = (el, options) => {
    const itemsEl = el.querySelector('.js-image-carousel-items');
    const previousEl = el.querySelector('.js-image-carousel-previous');
    const nextEl = el.querySelector('.js-image-carousel-next');
    const captionEl = el.querySelector('.js-image-carousel-caption');

    if (itemsEl === null || itemsEl.childElementCount < 2) return false;

    const flkty = new Flickity(itemsEl, options);

    setupArrows(previousEl, nextEl, flkty);
    setupCaption(captionEl, flkty);

    window.addEventListener('load', () => {
      flkty.resize();
    });
  };

  const setupArrows = (previousEl, nextEl, flkty) => {
    if (typeof flkty === 'undefined') return false;

    if (previousEl !== null) {
      previousEl.addEventListener('click', (e) => {
        e.preventDefault();
        flkty.previous();
      });
    }

    if (nextEl !== null) {
      nextEl.addEventListener('click', (e) => {
        e.preventDefault();
        flkty.next();
      });
    }
  };

  const setupCaption = (captionEl, flkty) => {
    if (captionEl === null || typeof flkty === 'undefined') return false;

    flkty.on('cellSelect', () => {
      captionEl.innerHTML = flkty.selectedElement.getAttribute('data-caption');
    });
  };

  if (module.hot) {
    window.addEventListener('load', init, false);
  } else {
    init();
  }
}

export default imageCarousel;
