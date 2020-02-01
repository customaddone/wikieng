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

// ホーム画面
Route::get('/', function () {
    return view('home.homeTop');
});



// 保存している記事一覧
Route::get('/myArticles', 'ArticlesController@index');
Route::get('/articles/{id}', 'ArticlesController@show');
Route::delete('/articles/{id}', 'ArticlesController@destroy');


// 検索した語のwiki記事を見る
Route::get('/searchArticleDetail/{word}', function () {
    return view('articles.showArticleDetail');
});


// 登録単語一覧
Route::get('/words/{articleId}', function () {
    return view('words.wordIndex');
});


// 認証用
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
