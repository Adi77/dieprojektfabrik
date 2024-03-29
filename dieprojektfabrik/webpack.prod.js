const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
  output: {
    publicPath: '/wp-content/themes/dieprojektfabrik/dist/',
  },
  module: {
    rules: [
      {
        test: /\.(c|sa|sc)ss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: '',
            },
          },
          'css-loader',
          'postcss-loader',
          'sass-loader',
        ],
      },
      {
        test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
            },
          },
        ],
      },
    ],
  },
  plugins: [new MiniCssExtractPlugin({ filename: '[name].css' })],
};
