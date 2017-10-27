let mix = require('laravel-mix');

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

/*
mix.js('resources/assets/js/app.js','public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');
*/

mix.js(['resources/assets/js/app.js',
        'resources/assets/js/plugins/morris/morris.js',
    'resources/assets/js/plugins/morris/morris-data.js',
    'resources/assets/js/plugins/morris/raphael.min.js'],
    'public/js')
     .sass('resources/assets/sass/app.scss', 'public/css')
    .stylus(['resources/assets/css/sb-admin.css',
            'resources/assets/css/plugins/morris.css',
    'resources/assets/css/font-awesome/css/font-awesome.css'],
        'public/css');
