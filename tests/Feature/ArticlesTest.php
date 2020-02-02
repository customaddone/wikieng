<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
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

    public function testArticle()
    {
        // ログイン用ユーザー
        $user = factory(User::class)->create();
        // 作ったユーザーで認証します
        $this->be($user);
        // 認証されているユーザーがいればidがあるか調べます
        $this->assertNotEmpty(Auth::id());

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
