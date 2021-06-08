const mix = require('laravel-mix');
require('vuetifyjs-mix-extension');
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
mix.setPublicPath('public_html/');
mix.js('resources/js/app.js', 'public_html/js').vuetify().vue()
    // .postCss('resources/css/app.css', 'public_html/css', [
    //     require('postcss-import'),
    //     require('tailwindcss'),
    // ]);

if (mix.inProduction()) {
    mix.version();
}
