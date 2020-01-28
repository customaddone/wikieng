<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            /* 検索フォームに'frankel'と打つとfrankelの記事が出るようにする */
            /* guzzle使うと処理が遅くなるのか */
            $browser->visit('/')
                    ->type('.input-form', 'fran')
                    ->pause(1000)
                    ->append('.input-form', 'kel')
                    ->pause(1000)
                    ->append('.input-form', ' ')
                    ->pause(1000)
                    ->assertSee('horse')
                    ->screenShot('test');
        });
    }
}
