const mix = require('laravel-mix');


mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/webCreate.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .vue('ExampleComponent.vue')
    .sourceMaps();