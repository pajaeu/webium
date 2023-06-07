const path = require('path');

module.exports = {
    entry: './assets/js/index.js',
    output: {
        path: __dirname + '/public/build',
        filename: 'bundle.js',
    },
};