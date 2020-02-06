const mix = require('laravel-mix');

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


  // まとめろ
mix.sass('resources/sass/main.scss', 'public/css')
   .sass('resources/sass/wikipediaArticle.scss', 'public/css/wikipediaArticle.css')
   .js(
     [
       'resources/js/header-toggle.js',
       'resources/js/showArticleDetail.js',
       'resources/js/footer-function.js',
       'resources/js/footer-edit-function.js',
       'resources/js/dictionary.js',
       'resources/js/wordIndex.js'
     ],
     'public/js/app.js'
   );
