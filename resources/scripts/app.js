import domReady from '@roots/sage/client/dom-ready';
import {tns} from 'tiny-slider/src/tiny-slider';

/**
 * Application entrypoint
 */
domReady(async () => {
  const slider = tns({
    container: '#carrusel',
    items: 1,
    slideBy: 'page',
    autoplay: true,
    controls: true,
    controlsText: ['◀', '▶'],
    nav: false,
    autoplayButtonOutput: false,
    mouseDrag: true,
    mode: 'gallery',
    speed: 1000,
    autoplayHoverPause: true,
  });
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
