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
        $content->assertSee('Запомнить меня');
        $content->assertSee('Восстановить пароль');
        $content->assertSee('Войти');
        $content->assertSee('Email');
        $content->assertSee('Пароль');
    }
}
