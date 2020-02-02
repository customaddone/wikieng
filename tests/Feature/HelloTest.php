<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloTest extends TestCase
{
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
    
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
