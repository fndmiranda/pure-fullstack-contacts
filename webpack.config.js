var path = require('path');
var webpack = require('webpack');

module.exports = {
    entry: './resources/assets/app/app.js',
    output: {
        filename: 'build/js/bundle.js',
        path: path.resolve(__dirname, 'public')
    },
    devServer: {
        historyApiFallback: true
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules|bower_components)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['env']
                    }
                }
            }, {
                test: /\.html$/,
                use: [{
                    loader: 'html-loader',
                    options: {
                        minimize: true
                    }
                }],
            }, {
                test: /\.css$/,
                use: [ 'style-loader', 'css-loader' ]
            }, {
                test: /\.scss$/,
                use: [ 'style-loader', 'css-loader', 'sass-loader' ]
            }, {
                test: /\.(png|svg|jpg|gif|ico)$/,
                use: [
                    'file-loader'
                ]
            }
        ]
    },
    plugins: [
        new webpack.DefinePlugin({
            BASE_API: JSON.stringify('//pure-fullstack-contacts.localhost:81')
        })
    ]
};