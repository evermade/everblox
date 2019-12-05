const Copy = require('copy-webpack-plugin');
const Imagemin = require('imagemin-webpack-plugin').default;
const Manifest = require('webpack-manifest-plugin');
const MiniCSSExtract = require('mini-css-extract-plugin');

const paths = require('./paths');

const commonPlugins = (env) => ({
  plugins: [
    new Copy([
      {
        from: 'assets/img',
      }
    ]),
    new Imagemin({
      disable: true, // Image optimization has been disabled, as our BitBucket images don't currently support it.

      optipng: {
        optimizationLevel: 3
      },

      gifsicle: {
        optimizationLevel: 2,
      },

      jpegtran: {
        progressive: true,
        arithmetic: true,
      },

      svgo: {
        plugins: [
          { removeViewBox: false },
          { removeDimensions: true },
          { removeScriptElement: true },
        ],
      },
    })
  ]
});

const manifest = (env, options = {}) => ({
  plugins: [
    new Manifest({
      writeToFileEmit: 'true',
      fileName: 'asset-manifest.json',
      ...options
    })
  ]
});

const transpileJavaScript = (env) => ({
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            cacheDirectory: true,
            babelrc: true,
          }
        },
      },
    ],
  },
});

const extractCSS = (env) => ({
  module: {
    rules: [
      {
        test: /\.(scss|css)$/,
        use: [
          {
            loader: MiniCSSExtract.loader,
          },
          { loader: 'css-loader', options: { sourceMap: true } },
          { loader: 'postcss-loader', options: { sourceMap: true } },
          { loader: 'resolve-url-loader', options: { sourceMap: true } },
          { loader: 'sass-loader', options: { sourceMap: true } }
        ],
      },
    ],
  },

  plugins: [
    new MiniCSSExtract({
      filename: env === 'production' ? '[name].[hash].css' : '[name].css?v=[hash]',
    }),
  ],
});

const loadFonts = (env, options = {}) => ({
  module: {
    rules: [
      {
        test: /\.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/i,
        include: /node_modules/,
        use: {
          loader: 'file-loader',
          options: Object.assign({}, {
            name: env === 'production' ? '[name].[chunkhash].[ext]' : '[name].[ext]',
          }, options),
        },
      },
    ],
  },
});

const loadImages = (env) => ({
  module: {
    rules: [
      {
        test: /\.(jpe?g|png|gif|svg|ttf|otf|eot|woff(2)?)$/i,
        include: paths.source,
        use: [
          {
            loader: 'file-loader',
            options: {},
          },
        ],
      },
    ],
  },
});

const sourceMaps = (env) => ({
  devtool: env === 'production' ? false : 'cheap-module-source-map'
});

module.exports = {
  commonPlugins,
  manifest,
  transpileJavaScript,
  extractCSS,
  loadFonts,
  loadImages,
  sourceMaps
};
