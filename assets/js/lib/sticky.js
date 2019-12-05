/**
 * Example
 *  <div class="js-sticky" data-offset="80">Lorem ipsum</div>
 */

import stickybits from 'stickybits';

const sticky = () => {
  const els = document.querySelectorAll('.js-sticky');

  Array.from(els).forEach((el) => {
    const offset = parseInt(el.getAttribute('data-offset'));

    stickybits(el, {
      stickyBitStickyOffset: offset,
    });
  });
};

export default sticky;
