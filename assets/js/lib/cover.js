/**
 * Make any kind of image or embed -like element cover it's parent.
 */

import { debounce } from './helpers';

const cover = () => {
  const els = document.querySelectorAll('.js-cover');

  const init = () => {
    setSize();
    setupEvents();
  };

  const setSize = () => {
    Array.from(els).forEach((el) => {
      const containerWidth = el.parentNode.offsetWidth;
      const containerHeight = el.parentNode.offsetHeight;

      let elWidth;
      let elHeight;
      let aspectRatio = 16 / 9;

      if (containerWidth / containerHeight < aspectRatio) {
        elHeight = containerHeight;
        elWidth = containerHeight * aspectRatio;
      } else {
        elWidth = containerWidth;
        elHeight = containerWidth / aspectRatio;
      }

      el.style.width = `${elWidth}px`;
      el.style.height = `${elHeight}px`;
    });
  };

  const setupEvents = () => {
    window.addEventListener('load', setSize, false);
    window.addEventListener(
      'resize',
      debounce(function() {
        setSize();
      }),
    );
  };

  init();
};

export default cover;
