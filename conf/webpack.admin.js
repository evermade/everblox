const OptimizeCSSAssets = require('optimize-css-assets-webpack-plugin');
const Terser = require('terser-webpack-plugin');
const path = require('path');
const merge = require('webpack-merge');
const paths = require('./paths');
const { commonPlugins, manifest, transpileJavaScript, extractCSS, loadFonts, loadImages, sourceMaps } = require('./modules');

const config = (env) => merge(
  {
    entry: {
      editor: path.join(paths.source, 'js', 'editor'),
      admin: path.join(paths.source, 'js', 'admin'),
    },
    output: {
      filename: env === 'production' ? '[name].[contenthash].js' : '[name].js',
    },
    mode: env,
    target: 'web',
    node: {
      fs: 'empty',
    },
  },
  commonPlugins(env),
  transpileJavaScript(env),
  extractCSS(env),
  loadFonts(env),
  loadImages(env),
  sourceMaps(env),
  manifest(env, {
    fileName: 'admin-manifest.json',
    publicPath: '',
  })
);
const developmentConfig = (env) => merge({});
const productionConfig = (env) => merge(
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

module.exports = ({ NODE_ENV: env }) => env === 'production' ? merge(config(env), productionConfig(env)) : merge(config(env), developmentConfig(env))
