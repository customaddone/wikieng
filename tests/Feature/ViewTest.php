<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Article;
use Illuminate\Support\Facades\Auth;

class ViewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testView()
    {
        // ホーム画面
        $response = $this->get('/');
        $response->assertSee('WikiEng');

        // 適当なパスだと404エラーが出る
        $response = $this->get('/geschwindigkeitsmesser');
        $response->assertStatus(404);

        // ログインしないとmy記事画面、記事詳細画面及び単語一覧画面には入れない（リダイレクトされる）
        $response = $this->get('/myArticles');
        $response->assertDontSee('記事一覧');

        $response = $this->get('/articles/1');
        $response->assertStatus(302);

        $response = $this->get('/words/1');
        $response->assertStatus(302);
    }

    public function testViewAuth()
    {
        // 認証ユーザと記事作成
        $user = factory(User::class)->create();
        $this->be($user);

        $article = factory(Article::class)->create();

        // ログインし、記事を作るとmy記事画面、記事詳細画面及び単語一覧画面には入れない
        $response = $this->get('/myArticles');
        $response->assertSee('記事一覧');

        $response = $this->get('/articles/1');
        $response->assertStatus(200);

        $response = $this->get('/words/1');
        $response->assertStatus(200);

        // idが作った記事の数より多いとサーバーエラー
        $response = $this->get('/articles/2');
        $response->assertStatus(500);
        // 200が返る?
        $response = $this->get('/words/2');
        $response->assertStatus(500);
    }
}
