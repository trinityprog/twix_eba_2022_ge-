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

mix.options({processCssUrls: false})
    .version()
    .browserSync('twix-eba-kz.test')
    .sass('resources/sass/style.scss', 'public/css')
    .js('resources/js/script.js', 'public/js');

mix.js('resources/admin/js/app.js', 'public/admin_assets/js')
    .postCss('resources/admin/css/app.css', 'public/admin_assets/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]);

mix.scripts([
    'resources/js/ml_twix/tf1.min.js',
    'resources/js/ml_twix/index.umd.js',
    'resources/js/ml_twix/scripts.js'
],  'public/js/ml_twix.js').version();
