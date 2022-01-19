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
const { exec } = require('child_process');
mix.js('resources/assets/js/admin.js', 'public/js')
    .vue()
    .sass('resources/assets/scss/admin.scss', 'public/css')
    // .postCss('resources/assets/css/admin.css', 'public/css', [
    //     //
    // ])
    .after(() => {
        exec('php /home/ogilo/Desktop/Tests/laravel/artisan vendor:publish --force --tag=admin-assets', (res, stdout, stderr) => { console.log(stdout); });
    })
