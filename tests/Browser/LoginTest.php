<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_login(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Não autenticado')
                ->clickLink('Entrar')
                ->waitFor('#loginUsuario', 20)
                ->type('#loginUsuario', '1111')
                ->press('Login')
                ->pause('3000')
                ->assertSee('Olá')
                ->click('.login_logout_link')
                ->assertSee('Não autenticado');
        });
    }
}
