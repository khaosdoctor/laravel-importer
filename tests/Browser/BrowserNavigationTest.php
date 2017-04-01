<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BrowserNavigationTest extends DuskTestCase
{
  /**
    * Testa a navegação básica da aplicação, passa por todos os links
    *
    * @return void
    */
  public function testBasicNavigation()
  {
      $this->browse(function (Browser $browser) {

          $browser->visit('/')
                  ->assertPathIs('/Produtos')
                  ->assertSee('Lista de produtos:')
                  ->assertTitle('Importer');

          $browser->visit('/Produtos')
                  ->assertSee('Lista de produtos')
                  ->assertTitle('Importer');

          $browser->visit('/Produtos/create')
                  ->assertSee('Selecione um arquivo para importar:');

          $browser->visit('/Produtos/create')
                  ->clickLink('Voltar para a lista')
                  ->assertSee('Lista de produtos')
                  ->assertTitle('Importer')
                  ->assertPathIs('/Produtos');
          
          $browser->visit('/')
                  ->clickLink('Importar')
                  ->assertSee('Selecione um arquivo para importar:')
                  ->assertPathIs('/Produtos/create')
                  ->clickLink('Produtos')
                  ->assertSee('Lista de produtos:')
                  ->assertPathIs('/Produtos');
      });
  }
}
