let mix = require('laravel-mix');

mix.options({
    processCssUrls: false,
});

mix.copy('node_modules/tabler-ui/src/assets/fonts', 'public/assets/admin/fonts');
mix.copy('node_modules/tabler-ui/src/assets/images', 'public/assets/admin/images');
mix.copy('resources/assets/admin/images', 'public/assets/admin/images');

mix.js('resources/assets/admin/js/app.js', 'public/assets/admin/js/app.js');

mix.sass('resources/assets/admin/sass/app.scss', 'public/assets/admin/css/app.css');

mix.version([
    'public/assets/admin/js/app.js',
    'public/assets/admin/css/app.css',
]);

