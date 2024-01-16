mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/custom.js', 'public/js') // Add this line
    .sass('resources/sass/app.scss', 'public/css')
    .styles([
        'node_modules/slick-carousel/slick/slick.css',
        'node_modules/slick-carousel/slick/slick-theme.css',
    ], 'public/css/slick.css')
    .scripts([
        'node_modules/slick-carousel/slick/slick.min.js',
    ], 'public/js/slick.js');

