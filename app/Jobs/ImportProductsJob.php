<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Produtos;

class ImportProductsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file; //Arquivo que será enviado como array (name=>nome, path=>caminho)

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         Excel::selectSheets('Plan1')->load($this->file['path'], function($reader) {
          $reader->noHeading();
          $contents = array_filter($reader->toArray()); //Arquivo exemplo de retorno está em storage/excel.txt

          //Remove a categoria
          $category = array_shift($contents);
          $category = array_pop($category);
          //Remove as colunas
          $columns = array_shift($contents);

          foreach($contents as $key=>$product) {
            //Os produtos e as colunas tem os mesmos indices, então vamos colocar as chaves de cada coluna
            //sendo respectiva as chaves do array de colunas
            $produto = array_combine($columns, $product);
            $produto['category'] = $category; //Seta a categoria
            //Formatação de colunas
            $produto['lm'] = (int)$produto['lm'];
            $produto['free_shipping'] = (int)$produto['free_shipping'];
            $lm = array_shift($produto); //Extrai o Lm do array para bater as chaves
            $newPrd = Produtos::updateOrCreate(['lm' => $lm], $produto); //Insere ou atualiza
          }
        });
    }

    public function failed(Exception $e) {
      Log::error('Import Failed: '.$e->getMessage());
    }
}
