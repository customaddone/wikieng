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


    // ダミーのmy記事作成用
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

        // 「競技プログラミング」の記事をAPIで呼び出す
        $dummyArticle = searchMediaWiki(
            [
                'format' => 'json',
                'action' => 'parse',
                'page' =>  'Competitive_programming',
            ]
        );

        $dummyArticleTitle = json_decode($dummyArticle, true)["parse"]["title"];
        $dummyArticleText = json_decode($dummyArticle, true)["parse"]["text"]["*"];

        DB::table('articles')->insert([
           'user_id' => 1,
           'title' => $dummyArticleTitle,
           'article' => preg_replace('/<a[\s\S]*?>/', '', $dummyArticleText), // aリンクは消す
           'summary' => 'Competitive programming is a mind sport usually held over the Internet or a local network, involving participants trying to program according to provided specifications.'
        ]);
    }
}
