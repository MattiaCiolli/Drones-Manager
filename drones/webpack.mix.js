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

/*
mix.js('resources/assets/js/app.js','public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');
*/

mix.js(['node_modules/jquery/dist/jquery.min.js',
		'resources/assets/js/app.js',
		'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
		'node_modules/raphael/raphael.min.js',
		'node_modules/morris.js.so/morris.min.js',
		'resources/assets/js/insertProduct.js'],
    	'public/js/app.js');

mix.sass('node_modules/bootstrap-sass/assets/stylesheets/_bootstrap.scss', 'public/css/all')
	.styles([	'resources/assets/css/general.css',
				'resources/assets/css/sb-admin.css',
				'node_modules/morris.js.so/morris.css',
				'node_modules/font-awesome/css/font-awesome.min.css',
			],
        	'public/css/all.css');
