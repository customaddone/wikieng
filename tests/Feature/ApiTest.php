<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\User;
use App\Article;
use App\Http\Controllers\ArticlesController;
use Illuminate\Support\Facades\Auth;

class ApiTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testArticlesApi()
    {
        // ヘッダーでのwikipedia記事検索
        $this->get('api/searchArticle/123456789')
            ->assertStatus(200);
        // 日本語でも検索できる
        $this->get('api/searchArticle/%E3%83%86%E3%82%B9%E3%83%88')
            ->assertStatus(200);

        // なんらかの理由でエンコードできなかった場合はエラー
        $this->get('api/searchArticle/テスト')
            ->assertStatus(404);

        // ページ取得成功
        $this->get('api/searchArticleDetail/Vodka')
            ->assertJson([
                "parse" => [
                    "title" => "Vodka",
                ]
            ]);

        // ページ取得成功（エンコードしたもの）
        $this->get('api/searchArticleDetail/Sound%20of%20the%20Sky')
            ->assertJson([
                "parse" => [
                    "title" => "Sound of the Sky",
                ]
            ]);

        // ページ取得失敗
        $this->get('api/searchArticleDetail/VodkaVodka')
            ->assertJson([
                "error" => [
                     "code" => "missingtitle",
                ]
            ]);

        // SearchControllerのsearchMediaWiki関数にヘッダーをつけて、
        // 特殊文字が入った単語を閲覧できない（api/searchArticleDetailでアクセスできない）
        // 問題は解決
        $this->get('api/searchArticleDetail/Is_the_Order_a_Rabbit%3F')
            ->assertJson([
                "parse" => [
                    "title" => "Is the Order a Rabbit?",
                ]
            ]);

        $this->get('api/searchArticleSummary/Is_the_Order_a_Rabbit%3F')
            ->assertOK();

        $user = factory(User::class)->create();

        $this->be($user);

        // summaryはnullable,statusは初期値あり
        $response = $this->post('api/articles/import' , [
            'title' => 'article1',
            'article' => 'article_body',
        ]);

        $response->assertOK();
        $this->assertNotEmpty(Article::find(1));

        $response = $this->post('api/articles/import' , [
            'title' => 'article2',
            'summary' => 'article_summary',
            'status' => 'status'
        ]);
        $response->assertStatus(500);
        $this->assertEmpty(Article::find(2));

        // edit
        $response = $this->post('api/articles/edit' , [
            'id' => '1',
            'article' => 'article_summary_edit',
        ]);
        $response->assertStatus(200);
        // しっかりeditできている
        $this->assertEquals('article_summary_edit', Article::find(1)->article);

    }

    public function testWordsApi() {
        // article内での小さい枠の中での単語検索
        $response = $this->get('api/wordIdSearch/import')
            ->assertStatus(200);

        $response = $this->get('api/wordIdSearch/テスト')
            ->assertStatus(200);
    }
}
