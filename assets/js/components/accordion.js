function accordion() {
  const init = () => {
    setupEvents();
  };

  const setupEvents = () => {
    const els = document.querySelectorAll('.js-accordion-toggle');

    Array.from(els).forEach((el) => {
      el.addEventListener('click', (e) => {
        toggleItem(e.currentTarget);
      });

      el.addEventListener('keypress', (e) => {
        if (e.keyCode === 13) {
          toggleItem(e.currentTarget);
        }
      });
    });
  };

  const toggleItem = (el) => {
    const parent = el.parentNode;
    const content = parent.querySelector('.js-accordion-content');

    if (parent === null || content === null) return false;

    if (!parent.classList.contains('is-open')) {
      parent.classList.add('is-open');
      el.setAttribute('aria-expanded', 'true');
      content.setAttribute('aria-hidden', 'false');
    } else {
      parent.classList.remove('is-open');
      el.setAttribute('aria-expanded', 'false');
      content.setAttribute('aria-hidden', 'true');
    }
  };

  init();
}

export default accordion;
