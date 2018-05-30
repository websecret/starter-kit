let mix = require('laravel-mix');

mix.options({
    cleanCss: {
        level: {
            1: {
                specialComments: 'none'
            }
        }
    },
    purifyCss: true
});

mix.js('resources/assets/admin/js/app.js', 'public/assets/admin/js/app.js');

mix.sass('resources/assets/admin/sass/app.scss', 'public/assets/admin/css/app.css');

mix.version([
    'public/assets/admin/js/app.js',
    'public/assets/admin/css/app.css',
]);

