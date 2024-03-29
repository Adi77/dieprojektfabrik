// Achtung!! Funktioniert nur mit node version 14.21.3
const webpack = require('webpack');

module.exports = {
  output: {
    publicPath: 'http://dieprojektfabrik.ch.local:8080/',
  },
  module: {
    rules: [
      {
        test: /\.(c|sa|sc)ss$/,
        use: [
          {
            loader: 'style-loader',
            options: {
              sourceMap: true,
            },
          },
          {
            loader: 'css-loader',
            options: {
              sourceMap: true,
            },
          },
          {
            loader: 'postcss-loader',
            options: {
              sourceMap: true,
            },
          },
          {
            loader: 'sass-loader',
            options: {
              implementation: require('sass'),
              sourceMap: true,
              sassOptions: {
                outputStyle: 'expanded',
              },
            },
          },
        ],
      },
      {
        test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              outputPath: 'dist/',
            },
          },
        ],
      },
    ],
  },
  devServer: {
    port: 8080,
    host: '0.0.0.0', // this lets the server listen for requests from the lan network, not just localhost.
    headers: {
      'Access-Control-Allow-Origin': '*',
    },
    compress: true,
    hot: true,
    inline: true,
    stats: 'errors-only',
    overlay: true,
    disableHostCheck: true,
  },
  plugins: [
    new webpack.NamedModulesPlugin(),
    new webpack.HotModuleReplacementPlugin(),
  ],
};
