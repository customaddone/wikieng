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
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/main.scss', 'public/css')
   .sass('resources/sass/wikipediaArticle.scss', 'public/css/wikipediaArticle.css')
   .scripts('resources/js/header-toggle.js', 'public/js/header-toggle.js')
   .scripts('resources/js/showArticleDetail.js', 'public/js/showArticleDetail.js')
   .scripts('resources/js/footer-function.js', 'public/js/footer-function.js')
   .scripts('resources/js/footer-edit-function.js', 'public/js/footer-edit-function.js')
   .scripts('resources/js/dictionary.js', 'public/js/dictionary.js');
