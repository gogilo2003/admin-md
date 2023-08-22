const mix = require('laravel-mix');
// require('mix-tailwindcss');
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
const { exec } = require('child_process');
mix.js('resources/assets/js/admin.js', 'public/js')
    .js('resources/assets/js/tags.js', 'public/js')
    .js('resources/assets/js/authors.js', 'public/js')
    .vue()
    .sass('resources/assets/scss/web.scss', 'public/css')
    .sass('resources/assets/scss/print.scss', 'public/css')
    .sass('resources/assets/scss/font-awesome.min.scss', 'public/css')
    .sass('resources/assets/scss/font-awesome-5-base64.scss', 'public/css')
    .sass('resources/assets/scss/font-awesome-4-base64.scss', 'public/css')
    .sass('resources/assets/scss/admin.scss', 'public/css')
    // .css('resources/assets/css/tailwind.css', 'public/css')
    // .tailwind('./tailwindcss-config.js')
    .postCss('resources/assets/css/tailwind.css', 'public/css', [
        require('tailwindcss')
    ])
    .after(() => {
        exec('php ../../../artisan vendor:publish --force --tag=admin-assets', (res, stdout, stderr) => { console.log(stdout); });
    })
