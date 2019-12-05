/**
 * Example (truncate to two lines max.)
 *  <div class="js-truncate" style="max-height: 2em;">
 *    Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
 *    Sed posuere interdum sem. Quisque ligula eros ullamcorper quis,
 *    lacinia quis facilisis sed sapien. Mauris varius diam vitae arcu.
 *  </div>
 */

import shave from 'shave';
import { debounce } from './helpers';

const truncate = () => {
  const els = document.querySelectorAll('.js-truncate');

  const init = () => {
    setTruncate();
    setupEvents();
  };

  const setTruncate = () => {
    Array.from(els).forEach((el) => {
      const style = getComputedStyle(el);

      if (style.maxHeight === 'none') return false;

      const maxHeight = parseInt(style.maxHeight);

      shave(el, maxHeight);
    });
  };

  const setupEvents = () => {
    window.addEventListener(
      'resize',
      debounce(function() {
        setTruncate();
      }),
    );
  };

  init();
};

export default truncate;
