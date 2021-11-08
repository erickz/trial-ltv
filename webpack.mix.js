const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .copy('resources/js/bootstrap.js', 'public/assets/js/bootstrap.js')
    .copy('resources/js/handlesnsfw.js', 'public/assets/js/handlesnsfw.js')
    .copy('resources/css/bootstrap.css', 'public/assets/css/bootstrap.css')

