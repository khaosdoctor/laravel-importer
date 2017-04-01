<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Artisan;
use App;


class FileUploadTest extends DuskTestCase
{

  use DatabaseTransactions, DatabaseMigrations;

  /**
   * Construtor da classe pai
   * @return void
  */
  public function setUp() 
  {
    parent::setUp();
  }
  
  /**
    * Testa a validação de arquivo para upload
    *
    * @return void
    */
  public function testUploadValidation()
  {
    $this->browse(function (Browser $browser) {
      $browser->visit('/')
              ->clickLink('Importar')
              ->assertPathIs('/Produtos/create')
              ->assertSee('Selecione um arquivo para importar:')
              ->assertDontSee('Enviar')
              ->assertMissing('.btn-form-file-submit')
              ->attach('.upload-button', storage_path().'/products.xlsx')
              ->assertVisible('.btn-form-file-submit');
    });
  }

  /**
  * Testa o upload do arquivo
  * - Envia o arquivo csv de teste localizado na pasta 'Storage'
  *
  * @return void
  */
  public function testUploadFile() 
  {
    $this->browse(function (Browser $browser) {
      $browser->visit('/')
              ->assertSee('Ops! Não existe nenhum produto aqui. Importe alguns aqui')
              ->clickLink('Importar')
              ->assertPathIs('/Produtos/create')
              ->assertSee('Selecione um arquivo para importar:')
              ->assertDontSee('Enviar')
              ->assertMissing('.btn-form-file-submit')
              ->attach('.upload-button', storage_path().'/products_teste_webdev_leroy.xlsx')
              ->pause(1000)
              ->assertVisible('.btn-form-file-submit')
              ->press('Enviar')
              ->pause(3000)
              ->assertPathIs('/Produtos')
              ->assertVisible('.alert-success')
              ->pause(2500)
              ->visit('/')
              ->assertDontSee('Ops! Não existe nenhum produto aqui. Importe alguns aqui');
    });
  }
}
