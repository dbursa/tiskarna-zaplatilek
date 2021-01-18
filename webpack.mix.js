let mix = require('laravel-mix');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix
	.js('resources/js/app.js', 'assets/js')
	.sass('resources/sass/style.scss', 'assets/css')
	.postCss("resources/tailwind/tailwind.css", "assets/css", [
        require("tailwindcss"),
       ]);