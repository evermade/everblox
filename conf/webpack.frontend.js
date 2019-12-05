const OptimizeCSSAssets = require('optimize-css-assets-webpack-plugin');
const Terser = require('terser-webpack-plugin');
const path = require('path');
const merge = require('webpack-merge');
const paths = require('./paths');
const { commonPlugins, manifest, transpileJavaScript, extractCSS, loadFonts, loadImages, sourceMaps } = require('./modules');

const config = (env) => merge(
  {
    entry: {
      polyfill: ['@babel/polyfill'],
      frontend: [path.join(paths.source, 'js', 'frontend')],
    },
    output: {
      filename: env === 'production' ? '[name].[contenthash].js' : '[name].js?v=[contenthash]',
    },
    mode: env,
    target: 'web',
    node: {
      fs: 'empty',
    },
  },
  commonPlugins(env),
  transpileJavaScript(env),
  loadFonts(env),
  loadImages(env),
  sourceMaps(env),
  manifest(env, {
    fileName: 'frontend-manifest.json',
    publicPath: '',
  })
);
const developmentConfig = (env) => merge(
  extractCSS(env)
);
const productionConfig = (env) => merge(
  extractCSS(env),
  {
    optimization: {
      minimizer: [
        new Terser({
          parallel: true,
        }),
        new OptimizeCSSAssets({})
      ],
    },
  }
);

module.exports = ({ NODE_ENV: env }) => env === 'production' ? merge(config(env), productionConfig(env)) : merge(config(env), developmentConfig(env));
