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

mix.js(['resources/assets/js/app.js',
    'resources/assets/vendor/jquery/jquery.min.js',
    'resources/assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
    'resources/assets/vendor/jquery-easing/jquery.easing.min.js',
    'resources/assets/vendor/chart.js/Chart.min.js',
    //'resources/assets/vendor/datatables/jquery.dataTables.js',
    //'resources/assets/vendor/datatables/dataTables.bootstrap4.js',
    'resources/assets/js/sb-admin.min.js',
    'resources/assets/js/sb-admin-datatables.min.js',
    'resources/assets/js/sb-admin-charts.min.js',
],'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
    .styles([
    'resources/assets/css/sb-admin.css',
    'resources/assets/vendor/css/bootstrap.css',
        'resources/assets/vendor/font-awesome/css/font-awesome.css',
       // 'resources/assets/vendor/datatables/dataTables.bootstrap4.css'
], 'public/css/all.css');