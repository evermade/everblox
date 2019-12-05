const isInViewport = (
  el,
  offset = (window.innerHeight || document.documentElement.clientHeight) / 4,
) => {
  const bounding = el.getBoundingClientRect();

  return (
    (bounding.top >= 0 &&
      bounding.top <=
        (window.innerHeight || document.documentElement.clientHeight) -
          offset) ||
    (bounding.bottom >= 0 &&
      bounding.bottom <=
        (window.innerHeight || document.documentElement.clientHeight) -
          offset) ||
    (bounding.bottom >= 0 &&
      bounding.top <= 0 &&
      bounding.height >=
        (window.innerHeight || document.documentElement.clientHeight) - offset)
  );
};

const isFullyInViewport = (el) => {
  const bounding = el.getBoundingClientRect();

  return (
    bounding.top >= 0 &&
    bounding.left >= 0 &&
    bounding.bottom <=
      (window.innerHeight || document.documentElement.clientHeight) &&
    bounding.right <=
      (window.innerWidth || document.documentElement.clientWidth)
  );
};

const debounce = (func) => {
  let timer;

  return function(event) {
    if (timer) clearTimeout(timer);
    timer = setTimeout(func, 100, event);
  };
};

const hasMobileNavigation = () => {
  const width = window.innerWidth > 0 ? window.innerWidth : screen.width;

  return width < 900;
};

const isMobileMenuOpen = () => {
  return !!(
    hasMobileNavigation() &&
    document.body.classList.contains('open-mobile-menu')
  );
};

const parseFetchResponse = (response) => {
  return response.text().then((text) => {
    const data = text && JSON.parse(text);

    if (!response.ok) {
      const error = (data && data.message) || response.statusText;

      return Promise.reject(error);
    }

    return data;
  });
};

export {
  isInViewport,
  isFullyInViewport,
  debounce,
  hasMobileNavigation,
  isMobileMenuOpen,
  parseFetchResponse,
};
