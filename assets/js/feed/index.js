import React from 'react';
import { render } from 'react-dom';
import App from './App';

function feed() {
  const el = document.getElementById('feed-app');

  if (el !== null) {
    const defaults = {
      perPage: 12,
    };

    const perPage = el.getAttribute('data-per-page');

    const settings = {
      perPage: perPage !== null ? parseFloat(perPage) : defaults.perPage,
    };

    render(<App {...settings} />, el);
  }
}

export default feed;
