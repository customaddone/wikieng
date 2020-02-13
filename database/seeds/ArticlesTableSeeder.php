<?php

use Illuminate\Database\Seeder;
use GuzzleHttp\Client;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    // my記事作成用の
    public function run()
    {
        // privateなのでSSearchControllerのものは呼べない
        // のでsearchMediaWiki関数をそのまま写した
        function searchMediaWiki($searchquery)
        {
            $client = new \GuzzleHttp\Client();

            // ヘッダーに'Content-Type' => 'application/x-www-form-urlencoded'をつける
            // はてなマークがついてる単語の記事も見ることができる
            $headers = [ 'Content-Type' => 'application/x-www-form-urlencoded' ];

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

        $dummyArticle = searchMediaWiki(
            [
                'format' => 'json',
                'action' => 'parse',
                'page' =>  'laravel',
            ]
        );

        $dummyArticleTitle = json_decode($dummyArticle, true)["parse"]["title"];
        $dummyArticleText = json_decode($dummyArticle, true)["parse"]["text"]["*"];

        DB::table('articles')->insert([
           'user_id' => 1,
           'title' => $dummyArticleTitle,
           'article' => preg_replace('/<a[\s\S]*?>/', '', $dummyArticleText), // aリンクは消す
           'summary' => 'Laravel is a free, open-source[3] PHP web framework, created by Taylor Otwell and intended for the development of web applications.'
        ]);
    }
}
