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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.combine([
    'public/dist/js/bootstrap.min.js',
    'public/dist/js/sticky-sidebar.min.js',
    'public/dist/js/lightslider.min.js',
    'public/dist/js/owl.js',
    'public/dist/js/init.js',
], 'public/js/all.js');