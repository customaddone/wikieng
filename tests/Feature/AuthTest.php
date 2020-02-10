<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginAuth()
    {
        $user = factory(User::class)->create();

        $this->be($user);

        // 認証されていることを確認
        $this->assertTrue(Auth::check());

        // ログアウトを実行
        $response = $this->post('logout');

        // 認証されていない
        $this->assertFalse(Auth::check());

        // ログイン
        $response = $this->post('login', [
            'email'    => $user->email,
            'password' => 'secret'
        ]);

        $this->assertTrue(Auth::check());
        $response = $this->post('logout');

        $response = $this->post('login', [
            'email'    => $user->email,
            'password' => 'Secret'
        ]);
        // 大文字はNG
        $this->assertFalse(Auth::check());
    }

    public function testRegisterAuth()
    {
        $user = factory(User::class)->create();

        $this->be($user);

        $response = $this->post('/register', [
            'name' => 'laravel',
            'email'    => 'laravel@gmail.com',
            'password' => 'topsecret',
            'password_confirmation' => 'topsecret'
        ]);

        // 認証されていることを確認
        $this->assertTrue(Auth::check());
        $response = $this->post('logout');

        $response = $this->post('/register', [
            'name' => 'Матрёшка',
            'email'    => 'laravel@gmail.com',
            'password' => 'Санкт-Петербург',
            'password_confirmation' => 'Санкт-Петербург'
        ]);

        // 名前とパスワードは何語でもいける
        $this->assertTrue(Auth::check());
        $response = $this->post('logout');

        $response = $this->post('/register', [
            'name' => 'laravel',
            'email'    => 'laravel@gmail.com',
            'password' => 'passwordsecret',
            'password_confirmation' => 'topsecret'
        ]);

        // パスワードと再入力パスワードは一致してないといけない
        $this->assertFalse(Auth::check());
    }
}
