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

// 検索記事表示
Route::get("/searchArticleDetail/{word}", "SearchController@searchArticleDetail");

// 検索記事表示
Route::get("/searchArticleSummary/{word}", "SearchController@searchArticleSummary");

// 記事のインポート用
Route::post('/articles/import',  'ArticlesController@import');

// 辞書機能使用用
Route::get("/wordIdSearch/{pass}", "SearchController@wordIdSearch");
Route::get("/wordSearch/{passId}", "SearchController@wordSearch");
