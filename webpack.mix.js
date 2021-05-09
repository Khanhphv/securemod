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
    .sass('resources/sass/app.scss', 'public/css')
    .styles([
        '/public/vendors/iconfonts/mdi/font/css/materialdesignicons.min.css',
        '/public/vendors/css/vendor.bundle.base.css',
        '/vendors/css/vendor.bundle.addons.css',
        '/css/vertical-layout-light/style.css',
    ], 'public/css/all.css');
