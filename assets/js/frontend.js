import '@babel/polyfill';

import featureDetection from './lib/feature-detection';
import cover from './lib/cover';
import sticky from './lib/sticky';
import truncate from './lib/truncate';

import accordion from './components/accordion';
import header from './components/header';
import imageCarousel from './components/image-carousel';
import modal from './components/modal';
import scrollAnimate from './components/scroll-animate';
import search from './components/search';
import summaryCarousel from './components/summary-carousel';
import youtubeBackground from './components/youtube-background';

import feed from './feed';

import '../scss/main.scss';

window.addEventListener('DOMContentLoaded', () => {
  featureDetection();
  feed();
  cover();
  accordion();
  header();
  imageCarousel();
  modal();
  scrollAnimate();
  search();
  summaryCarousel();
  sticky();
  truncate();
  youtubeBackground();
});
