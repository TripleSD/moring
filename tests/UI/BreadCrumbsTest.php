<?php

namespace Tests\UI;

use Tests\TestCase;

class BreadCrumbsTest extends TestCase
{
    public function testExample()
    {
        //Main page
        $this->withoutMiddleware();
        $a = $this->call('GET', '/');
        $a->assertSee('Main');
    }
}
