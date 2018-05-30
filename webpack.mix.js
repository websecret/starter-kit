let mix = require('laravel-mix');

mix.js('resources/assets/admin/js/app.js', 'public/assets/admin/js/app.js');

mix.sass('resources/assets/admin/sass/app.scss', 'public/assets/admin/css/app.css');

mix.version([
    'public/assets/admin/js/app.js',
    'public/assets/admin/css/app.css',
]);

