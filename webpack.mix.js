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
    .js('resources/js/approval/purchase/create-purchase.js', 'public/js/approval/purchase')
    .js('resources/js/approval/purchase/update-purchase.js', 'public/js/approval/purchase')
   .sass('resources/sass/app.scss', 'public/css');
