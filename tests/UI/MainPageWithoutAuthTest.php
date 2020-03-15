<?php

namespace Tests\UI;

use Tests\TestCase;

class MainPageWithoutAuthTest extends TestCase
{
    public function testExample()
    {
        // Main page without auth
        $content = $this->call('GET', '/login');
        $content->assertSee('MoRiNg');
    }
}
