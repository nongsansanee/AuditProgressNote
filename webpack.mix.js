const mix = require('laravel-mix'); // original
 require('laravel-mix-tailwind');
 require('laravel-mix-purgecss');

 mix.js('resources/js/app.js','public/js')
    .postCss('resources/css/app.css','public/css')
    .tailwind('./tailwind.config.js');

if(mix.inProduction()){
        mix.version()
            .purgeCss()
}else{
        mix.sourceMaps()
}

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

// mix.js('resources/js/app.js', 'public/js')   original
//     .sass('resources/sass/app.scss', 'public/css');  original
