// Imports

const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const TerserPlugin = require('terser-webpack-plugin');

// Set variables by environment
let isProd = (process.env.NODE_ENV === 'production') ? true : false;

// Set plugins
let pluginsConfig = [];

if (isProd) {
  pluginsConfig = [
    new MiniCssExtractPlugin({ filename: 'css/styles.css' })
  ];
}
else {
  pluginsConfig = [
    new MiniCssExtractPlugin({ filename: 'css/styles.css' }),
    new webpack.SourceMapDevToolPlugin({})
  ]
}

// JS Optimization

if (isProd) {
  module.exports = {
    optimization: {
      minimize: true,
      minimizer: [new TerserPlugin()],
    },
  };
}

// Module configuration
module.exports = (env, argv) => {
  const isDevMode = argv.mode === "development";
  return {
    devtool: isDevMode ? "source-map" : false,
    mode: isDevMode ? "development" : "production",
    stats: 'minimal',
    watch: isDevMode ? true : false,
    entry: path.resolve(__dirname, './src/js/index.js'),
    module: {
      rules: [
        {
          test: /\.js$/,
          exclude: /(node_modules|bower_components)/,
          enforce: "pre",
          use: [
            'source-map-loader',
            {
              loader: 'babel-loader',
              options: {
                presets: ['@babel/preset-env']
              }
            }
          ]
        },
        {
          test: /\.css$/,
          use: [
            {
              loader: MiniCssExtractPlugin.loader,
            },
            {
              loader: 'css-loader',
              options: {
                sourceMap: true,
              }
            }
          ],
        },
        {
          test: /\.scss$/,
          use: [
            MiniCssExtractPlugin.loader,
            {
              loader: 'css-loader',
              options: {
                sourceMap: true,
              }
            },
            {
              loader: "sass-loader",
              options: {
                sourceMap: true,
                sassOptions: {
                }
              }
            },
            {
              loader: 'import-glob-loader'
            }
          ]
        },
        {
          test: /\.(png|jpg|jpeg|gif)$/,
          type: 'asset/resource',
          generator: {
            filename: 'img/[name][ext]'
          }
        },
        {
          test: /\.svg$/,
          type: 'asset/resource',
          generator: {
            filename: 'icons/[name][ext]',
          },
        },
      ],
    },
    plugins: pluginsConfig,
  }
}
