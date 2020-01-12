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
            /* 検索フォームに'frank'と打つとfrankelの記事が出るようにする */
            $browser->visit('/')
                    ->type('.input-form', 'frank')
                    ->screenshot('test')
                    ->assertSee('frankel');
        });
    }
}
