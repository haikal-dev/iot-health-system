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

mix.js('resources/js/dashboard.js', 'public/js')
    .js('resources/js/login.js', 'public/js')
    .js('resources/js/patients.js', 'public/js')
    .js('resources/js/device.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

if(mix.inProduction()){
    mix.version();
}
