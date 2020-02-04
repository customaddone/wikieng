<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testApi()
    {
        // ヘッダーでのwikipedia記事検索
        $this->get('api/searchArticle/123456789')
            ->assertStatus(200);
        // 日本語でも検索できる
        $this->get('api/searchArticle/%E3%83%86%E3%82%B9%E3%83%88')
            ->assertStatus(200);
        // 404エラー
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

        // "invalidreason": "The requested page title contains invalid characters: \"%3F\".",
        $this->get('api/searchArticleDetail/Is_the_Order_a_Rabbit?')
            ->assertJson([
                "error" => [
                    "code" => "missingtitle",
                ]
            ]);
    }
}
