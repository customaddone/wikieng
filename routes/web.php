<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home.homeTop');
});

// 保存している記事一覧
Route::get('/myArticles', 'ArticlesController@index');
// 詳細表示
Route::get('/articles/{id}', 'ArticlesController@show');

Route::get('/searchArticleDetail/{word}', function () {
    return view('articles.showArticleDetail');
});

// 認証用
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
