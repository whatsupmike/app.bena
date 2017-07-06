const { mix } = require('laravel-mix');

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
const WebpackShellPlugin = require('webpack-shell-plugin');

// Add shell command plugin configured to create JavaScript language file
mix.webpackConfig({
    plugins:
        [
            new WebpackShellPlugin({onBuildStart:['php artisan lang:js --quiet'], onBuildEnd:[]})
        ]
});

mix.js('resources/assets/js/app.js', 'public/js')

    .js('resources/assets/js/trips.js', 'public/js')
    .js('resources/assets/js/fuels.js', 'public/js')
    .js('resources/assets/js/libs/messages.js', 'public/js')
    .styles('resources/assets/css/app.scss', 'public/css')
    .version();

mix.copy('resources/assets/js/helpers.js', 'public/js/helpers.js');
mix.copy('resources/assets/js/libs/select2.full.min.js', 'public/js/select2.full.min.js');
mix.copy('resources/assets/css/libs/select2.min.css', 'public/css/select2.min.css');

