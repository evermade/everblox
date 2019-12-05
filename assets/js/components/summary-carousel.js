import Flickity from 'flickity';

function summaryCarousel() {
  const containerElements = document.querySelectorAll('.js-summary-carousel');

  const init = () => {
    Array.from(containerElements).forEach((containerEl) => {
      const itemsEl = containerEl.querySelector('.js-summary-carousel-items');

      if (itemsEl === null) return false;

      setupFlickity(containerEl, itemsEl, {
        contain: true,
        groupCells: true,
        prevNextButtons: true,
      });
    });
  };

  const setupFlickity = (containerEl, itemsEl, options) => {
    const flkty = new Flickity(itemsEl, options);

    flkty.containerEl = containerEl;

    flkty.on('dragStart', () => {
      hideHeader(flkty);
    });

    flkty.on('settle', () => {
      showHeader(flkty);
    });

    flkty.on('select', () => {
      toggleHeader(flkty);
    });

    showHeader(flkty);

    window.addEventListener('load', () => {
      flkty.resize();
    });
  };

  const showHeader = (flkty) => {
    if (flkty.selectedIndex < 1) {
      flkty.containerEl.classList.remove('hide-header');
    }
  };

  const hideHeader = (flkty) => {
    flkty.containerEl.classList.add('hide-header');
  };

  const toggleHeader = (flkty) => {
    if (flkty.selectedIndex < 1) {
      flkty.containerEl.classList.remove('hide-header');
    } else {
      flkty.containerEl.classList.add('hide-header');
    }
  };

  if (module.hot) {
    window.addEventListener('load', init, false);
  } else {
    init();
  }
}

export default summaryCarousel;
