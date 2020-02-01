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
// 保存した記事の詳細表示
Route::get('/articles/{id}', 'ArticlesController@show');
// 保存した記事の削除
Route::delete('/articles/{id}', 'ArticlesController@destroy');



Route::get('/searchArticleDetail/{word}', function () {
    return view('articles.showArticleDetail');
});



// 記事内の登録単語用
Route::get('/words/{articleId}', 'WordsController@show');
Route::delete('/words/{id}', 'WordsController@destroy');

// 認証用
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
