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

class ArticlesTest extends TestCase
{
    use DatabaseMigrations;
    // use DatabaseTransactions;でテストの際データベースを初期化
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testArticleIndex()
    {
        $article = new ArticlesController;

        $this->assertNotEmpty($article->index());

    }

    public function testArticleShow()
    {
        $article = new ArticlesController;

        $request = new Request;
        $request->merge([
            'id' => 1,
        ]);

        $this->assertNotEmpty($article->show($request));
        $this->assertEmpty(Auth::id());
    }

    public function testArticleImport()
    {
        $article = new ArticlesController;

        // ログイン用ユーザー
        $user = factory(User::class)->create();
        // 作ったユーザーで認証します
        $this->be($user);
        // 認証されているユーザーがいればidがあるか調べます
        $this->assertNotEmpty(Auth::id());

        // requestの作成
        $request = new Request;
        $request->merge([
            'title' => 'article',
            'user_id' => Auth::id(),
            'article' => 'article_body',
            'summary' => 'article_summary',
            'status' => 'status'
        ]);

        // importには戻り値はないので、import($request)自体はnullになる
        $article->import($request);

        // ちゃんとarticleが生成されるか？
        $this->assertNotEmpty(Article::where('title', '=', 'article'));

        //  記事をdestroyする
        $article->destroy(1);
        $this->assertEmpty(Article::all());
    }
}
