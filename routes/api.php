<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// wikipedia記事検索
Route::get("/searchArticle/{word}", "SearchController@searchArticle");

// 記事検索結果表示
Route::get("/searchArticleDetail/{word}", "SearchController@searchArticleDetail");
Route::get("/searchArticleSummary/{word}", "SearchController@searchArticleSummary");

// wiki記事編集用
Route::post('/articles/import',  'ArticlesController@import');
Route::post('/articles/edit',  'ArticlesController@edit');

// 辞書機能使用用
Route::get("/wordIdSearch/{pass}", "SearchController@wordIdSearch");
Route::get("/wordSearch/{passId}", "SearchController@wordSearch");

// 記事内の登録単語用
Route::get('/words/{articleId}', 'WordsController@show');
Route::post("/words/create", "WordsController@create");
Route::delete('/words/{id}', 'WordsController@destroy');
