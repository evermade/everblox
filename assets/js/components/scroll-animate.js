import { isInViewport, debounce } from '../lib/helpers';

function scrollAnimate() {
  const elements = document.querySelectorAll('[data-animate]');
  const enabledBreakpoint = 900;

  const init = () => {
    animate();
    setupEvents();
  };

  const animationsEnabled = () => {
    return window.innerWidth >= enabledBreakpoint;
  };

  const setupEvents = () => {
    window.addEventListener('scroll', animate, false);
    window.addEventListener('load', animate, false);

    window.addEventListener(
      'resize',
      debounce(() => {
        animate();
      }),
    );
  };

  const animate = () => {
    if (!elements.length || !animationsEnabled()) return false;

    Array.from(elements).forEach((el) => {
      if (el.classList.contains('animated')) return false;

      if (isInViewport(el)) {
        const classNames = el.getAttribute('data-animate').split(' ');

        classNames.forEach((className) => el.classList.add(className));
      }
    });
  };

  init();
}

export default scrollAnimate;
