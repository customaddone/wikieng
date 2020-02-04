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

        // はてなマーク等がついた単語でapiを用いて検索するとステータス200が出る
        // しかしブラウザで実際に検索しても画面が出ない
        $this->get('api/searchArticle/Is_the_Order_a_Rabbit%3F')
            ->assertStatus(200);
    }
}
