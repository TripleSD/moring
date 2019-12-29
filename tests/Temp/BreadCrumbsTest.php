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
        $a->assertSee('<li class="breadcrumb-item"><a href="http://moring.test">Главная</a></li>');
        $a->assertSee('<li class="breadcrumb-item active">Сводные данные</li>');
    }
}
