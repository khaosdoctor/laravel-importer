<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ListTest extends DuskTestCase
{
    /**
     * Construtor do pai
     * @return void
    */
    public function setUp() 
    {
      parent::setUp();
    }

    /**
     * Testa a listagem de produtos
     *
     * - Verifica se não existe nenhum produto cadastrado
     * - Testa exibição em tela
     * - Assume que a base está limpa
     * - Checa colunas do banco de dados
     *
     * @return void
     */
    public function testProductListing()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('/')
                ->assertSee('Lista de produtos:')
                ->assertDontSee('Ops! Não existe nenhum produto aqui. Importe alguns aqui')
                ->assertVisible('table.table-striped')
                ->assertSee('Lm')
                ->assertSee('Preço')
                ->assertSee('Categoria')
                ->assertSee('Data de adição')
                ->assertSee('Frete Grátis')
                ->assertSee('Descrição')
                ->assertSee('Nome')
                ->assertVisible('.delete-btn');
      });
    }

    /**
     * Testa a paginação da lista de produtos
     * 
     * - Assume que existem produtos cadastrados na base
     *
     * @return void
    */
    public function testProductPagination()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('/')
                ->assertSee('Lista de produtos:')
                ->assertDontSee('Ops! Não existe nenhum produto aqui. Importe alguns aqui')
                ->assertVisible('table.table-striped')
                ->assertVisible('.pagination-links')
                ->assertDontSee('1010')
                ->clickLink('2')
                ->pause(1000)
                ->assertSee('1010');
      });
    }

    /**
     * Testa remoção de um produto pelo click no botão da listagem
     *
     * @return void
    **/
    public function testDeleteProduct() {
      $this->browse(function (Browser $browser) {
        $browser->visit('/')
                ->assertSee('Lista de produtos:')
                ->assertDontSee('Ops! Não existe nenhum produto aqui. Importe alguns aqui')
                ->assertVisible('table.table-striped')
                ->assertVisible('.delete-btn')
                ->assertSee('1001')
                ->assertSee('Furadeira ABC')
                ->press('.delete-btn[data-id="1001"]')
                ->pause(500)
                ->assertVisible('.alert')
                ->pause(2000)
                ->assertDontSee('1001')
                ->assertDontSee('Furadeira ABC');
      });
    }
}
