const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .combine([
        'node_modules/jquery/dist/jquery.min.js',
    ], 'dist/js/vendor.js')

    .js('src/resources/js/fileman.js', 'dist/js')
    .sass('src/resources/scss/fileman.scss', 'dist/css');
