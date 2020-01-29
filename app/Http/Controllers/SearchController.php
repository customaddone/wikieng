<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SearchController extends Controller
{
    // 同じ関数内で関数を呼び出したいときはstaticで
    // wikipediaの記事を検索
    private static function searchMediaWiki($searchquery)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request(
            'GET',
            $url = "https://en.wikipedia.org/w/api.php",
            [ 'query' => $searchquery ],
            // パラメーターがあれば設定
        );
        // レスポンスボディを取得
        $responseBody = $response->getBody()->getContents();
        return $responseBody;
    }

    // 辞書APIを使用
    // Urlとクエリーが引数
    private static function dictionarySearch($searchUrl, $searchquery)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request(
            'GET',
            $url = $searchUrl,
            [ 'query' => $searchquery ],
            // パラメーターがあれば設定
        );
        // レスポンスボディを取得
        $responseBody = $response->getBody()->getContents();
        return $responseBody;
    }

    // composer require guzzlehttp/guzzleする
    // 記事の単語検索
    public function searchArticle($word)
    {
        return self::searchMediaWiki(
            [
                'format' => 'json',
                'action' => 'query',
                'list' => "search",
                'srlimit' => 8,
                'srsearch' => $word,
            ]
        );
    }

    // 記事検索->目的の記事に移動
    public function searchArticleDetail($word)
    {
        return self::searchMediaWiki(
            [
                'format' => 'json',
                'action' => 'parse',
                'page' =>  $word,
            ]
        );
    }

    public function searchArticleSummary($word)
    {
        return self::searchMediaWiki(
            [
                'format' => 'json',
                'action' => 'query',
                'prop' => 'extracts',
                'titles' =>  $word,
            ]
        );
    }

    // 調べたい単語のIDを検索（検索結果の上から１番目）
    public function wordIdSearch($pass)
    {
        return self::dictionarySearch(
            "http://public.dejizo.jp/NetDicV09.asmx/SearchDicItemLite",
            [
                'Dic' => 'EJdict',
                'Word' => $pass,
                'Scope' => 'HEADWORD',
                'Match' => 'STARTWITH',
                'Merge' => 'AND',
                'Prof' => 'JSON',
                'PageSize' => 1,
                'PageIndex' => 0
            ]
        );
    }

    // 調べたい単語の詳細について検索
    public function wordSearch($passId)
    {
        return self::dictionarySearch(
            "http://public.dejizo.jp/NetDicV09.asmx/GetDicItemLite",
            [
                'Dic' => 'EJdict',
                'Item' => $passId,
                'Loc' => "",
                'Prof' => 'XHTML',
            ]
        );
    }
}
