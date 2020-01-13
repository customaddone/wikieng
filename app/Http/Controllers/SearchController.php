<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SearchController extends Controller
{
    // composer require guzzlehttp/guzzleする
    public function searchArticle($word)
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request(
            'GET',
            $url = "https://en.wikipedia.org/w/api.php",
            [ 'query' => [
                'format' => 'json',
                'action' => 'query',
                'list' => "search",
                'srlimit' => 8,
                'srsearch' => $word,
            ]],
            // パラメーターがあれば設定
        );
        // レスポンスボディを取得
        $responseBody = $response->getBody()->getContents();
        return $responseBody;
    }
}
