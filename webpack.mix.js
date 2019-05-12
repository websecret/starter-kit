let mix = require('laravel-mix');
let webpack = require('webpack');

// require('laravel-mix-bundle-analyzer');
//
// if (mix.isWatching()) {
//     mix.bundleAnalyzer();
// }

mix.webpackConfig({
    plugins: [
        // Only russian and english locales for moment.js
        new webpack.ContextReplacementPlugin(/moment[\\/]locale$/, /^\.\/(ru)$/)
    ]
});


mix.options({
    processCssUrls: false,
});

// Font Awesome WebFonts
mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts/fa-solid-900.*', 'public/assets/admin/fonts/font-awesome');

// Custom fonts
mix.copy('resources/assets/admin/fonts', 'public/assets/admin/fonts');

mix.copy('node_modules/tabler-ui/src/assets/images', 'public/assets/admin/images');
mix.copy('resources/assets/admin/images', 'public/assets/admin/images');

mix.js('resources/assets/admin/js/app.js', 'public/assets/admin/js/app.js');

mix.sass('resources/assets/admin/sass/app.scss', 'public/assets/admin/css/app.css');

mix.version([
    'public/assets/admin/js/app.js',
    'public/assets/admin/css/app.css',
]);

