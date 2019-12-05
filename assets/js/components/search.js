import 'whatwg-fetch';
import { parseFetchResponse } from '../lib/helpers';

function search() {
  const config = window.emSearchConfig;

  if (typeof config === 'undefined') {
    throw new Error('Could not find the search configuration data.');
  }

  const modalEl = document.querySelector('.js-search-modal');
  const inputEl = document.querySelector('.js-search-input');
  const resultsEl = document.querySelector('.js-search-results');
  const itemsEl = document.querySelector('.js-search-items');

  const init = () => {
    if (modalEl !== null) {
      setupModalOpenEvents();
      setupModalCloseEvents();
    }

    if (inputEl !== null) {
      setupInputEvent();
    }
  };

  const setupModalOpenEvents = () => {
    const els = document.querySelectorAll('.js-search-open');

    Array.from(els).forEach((el) => {
      el.addEventListener('click', (e) => {
        e.preventDefault();

        modalEl.classList.add('is-open');

        focusInput();
      });
    });
  };

  const setupModalCloseEvents = () => {
    const els = document.querySelectorAll('.js-search-close');

    Array.from(els).forEach((el) => {
      el.addEventListener('click', (e) => {
        e.preventDefault();

        modalEl.classList.remove('is-open');
      });
    });
  };

  const setupInputEvent = () => {
    inputEl.addEventListener('keyup', (e) => {
      e.preventDefault();

      debounceInput(makeSearch, inputEl.value);
    });
  };

  const makeSearch = (str) => {
    if (str.length < config.minLength || str === window.currentSearch) {
      return false;
    }

    if (resultsEl === null || itemsEl === null) {
      throw new Error('Could not find required search elements.');
    }

    resetResults();

    // Get search results from the WordPress REST API
    const url = `${config.apiUrl}?s=${str}&lang=${config.language}`;
    const requestOptions = {
      method: 'GET',
    };

    window
      .fetch(`${url}`, requestOptions)
      .then(parseFetchResponse)
      .then((data) => {
        window.currentSearch = str;
        populateResults(data);
      })
      .catch((error) => {
        throw new Error(error);
      });
  };

  const resetResults = () => {
    resultsEl.classList.add('is-loading');
    itemsEl.innerHTML = '';
  };

  const populateResults = (data) => {
    resultsEl.classList.remove('is-loading');

    if (!data.length) {
      itemsEl.innerHTML = `<h4 class="l-search-results__error">${
        config.text.noResults
      }</h4>`;

      return false;
    }

    const posts = data.map((post, index) => {
      return buildPost(post, index);
    });

    itemsEl.innerHTML = posts.join('');
  };

  const buildPost = (post, order) => {
    return `
      <div class="l-search-results__item animated fadeInUp delay--${order}">
        <div class="c-search-result c-search-result--${post.type}">
          <a href="${
  post.permalink
}" class="c-search-result__link wrapper-link">
            <div class="c-search-result__label">${post.typeLabel}</div>
            <h3 class="c-search-result__title">${post.title}</h3>
            <p class="c-search-result__excerpt">${post.excerpt}
              <span class="c-search-result__more">${config.text.readMore}</span>
            </p>
          </a>
        </div>
      </div>
    `;
  };

  const focusInput = () => {
    if (inputEl === null) {
      return false;
    }

    // Give CSS transition time to finish before setting focus
    setTimeout(function() {
      inputEl.focus();
    }, 1000);
  };

  const debounceInput = (callback, args) => {
    clearTimeout(window.emSearchInputTimeout);

    window.emSearchInputTimeout = setTimeout(() => {
      callback(args);
    }, 1000);
  };

  // Initialize component
  init();
}

export default search;
