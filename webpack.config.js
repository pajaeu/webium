const path = require('path');

module.exports = {
    entry: {
        front: './assets/js/front.js',
        admin: './assets/js/admin.js'
    },
    output: {
        path: __dirname + '/public/dist',
        publicPath: '/dist/',
        filename: '[name].bundle.js',
    },
    module: {
        rules: [
            {
                test: /\.(scss)$/,
                use: [{
                    loader: 'style-loader', // inject CSS to page
                }, {
                    loader: 'css-loader', // translates CSS into CommonJS modules
                }, {
                    loader: 'sass-loader' // compiles Sass to CSS
                }]
            },
        ]
    }
};