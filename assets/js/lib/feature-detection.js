function isIE11() {
  return !!window.MSInputMethodContext && !!document.documentMode;
}

function detectHover(el) {
  if (
    isIE11() ||
    (window.matchMedia && window.matchMedia('(pointer:fine)').matches)
  ) {
    el.classList.add('has-hover');
  } else {
    el.classList.add('no-hover');
  }
}

function detectFirstTab(e) {
  if (e.keyCode === 9) {
    const htmlEl = document.querySelector('html');

    htmlEl.classList.add('user-is-tabbing');
    window.removeEventListener('keydown', detectFirstTab);
  }
}

const featureDetection = () => {
  const htmlEl = document.querySelector('html');

  detectHover(htmlEl);
  window.addEventListener('keydown', detectFirstTab);
};

export default featureDetection;
