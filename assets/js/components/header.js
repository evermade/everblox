import { isMobileMenuOpen } from '../lib/helpers.js';
import Headroom from 'headroom.js';

function header() {
  const el = document.querySelector('.js-header');
  const toggleEl = document.querySelector('.js-header-toggle');

  const init = () => {
    setupHeadroom();
    setupToggle();
  };

  const setupHeadroom = () => {
    if (el === null) return false;

    const headroom = new Headroom(el, {
      offset: 110,
      tolerance: 5,
      onUnpin: function() {
        if (isMobileMenuOpen()) {
          this.elem.classList.remove(this.classes.unpinned);
          this.elem.classList.add(this.classes.pinned);
        } else {
          this.elem.classList.add(this.classes.unpinned);
          this.elem.classList.remove(this.classes.pinned);
        }
      },
    });

    headroom.init();
  };

  const setupToggle = () => {
    if (el === null || toggleEl === null) return false;

    toggleEl.addEventListener('click', (e) => {
      e.preventDefault();

      const containerEl = document.body;

      if (containerEl.classList.contains('open-mobile-menu')) {
        containerEl.classList.remove('open-mobile-menu');
      } else {
        containerEl.classList.add('open-mobile-menu');
      }
    });
  };

  init();
}

export default header;
