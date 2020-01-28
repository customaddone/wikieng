<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SearchController extends Controller
{
    // 同じ関数内で関数を呼び出したいときはstaticで
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
    private static function dictionarySearch($searchquery)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request(
            'GET',
            $url = "http://public.dejizo.jp/NetDicV09.asmx/GetDicItemLite",
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

    // 記事の見出しを検索
    public function wordIdSearch($pass)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request(
            'GET',
            $url = "http://public.dejizo.jp/NetDicV09.asmx/SearchDicItemLite",
            [ 'query' => [
                'Dic' => 'EJdict',
                'Word' => $pass,
                'Scope' => 'HEADWORD',
                'Match' => 'STARTWITH',
                'Merge' => 'AND',
                'Prof' => 'JSON',
                'PageSize' => 1,
                'PageIndex' => 0
            ]],
            // パラメーターがあれば設定
        );
        // レスポンスボディを取得
        $responseBody = $response->getBody()->getContents();
        return $responseBody;
    }

    //
    public function wordSearch($passId)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request(
            'GET',
            $url = "http://public.dejizo.jp/NetDicV09.asmx/GetDicItemLite",
            [ 'query' => [
                'Dic' => 'EJdict',
                'Item' => $passId,
                'Loc' => "",
                'Prof' => 'XHTML',
            ]],
            // パラメーターがあれば設定
        );
        // レスポンスボディを取得
        $responseBody = $response->getBody()->getContents();
        return $responseBody;
    }
}
