let mix = require('laravel-mix');

// mix.js('src/app.js', 'dist').setPublicPath('dist');
// mix.css('resources/css/backend/css', 'public/backend/css/app.css');
// mix.copyDirectory('resources/views/backend/AdminLTE-3.2.0/dist', 'public/backend/dist');
// mix.copyDirectory('resources/views/backend/AdminLTE-3.2.0/plugins', 'public/backend/plugins');
mix.copy('vendor/proengsoft/laravel-jsvalidation/resources/views', 'resources/views/vendor/jsvalidation')
    .copy('vendor/proengsoft/laravel-jsvalidation/public', 'public/vendor/jsvalidation');
