<?php

namespace App\Http\Controllers;

use App\Jobs\ImportProductsJob;
use Illuminate\Http\Request;

class FileController extends Controller
{
    private $file = null;
    private $destinationPath = 'uploads';
    private $fullName;

    /**
     * Construtor do FileController.
     * @param $file Request Arquivo recebido pela request
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
        //Adiciona no arquivo a data de hoje para fins de evitar duplicação e conflitos
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . date('dmYHis');
        //Concatena com a extensão original
        $fileExtension = '.' . $file->getClientOriginalExtension();
        $this->fullName = $fileName . $fileExtension;
    }

    /**
     * Armazena o arquivo na pasta correta
     * @return void
     */
    public function store()
    {
        try {
            //Move o arquivo
            $this->file->move($this->destinationPath, $this->fullName);
        } catch (\Exception $e) {
            throw $e;
        }

    }

    /**
     * Retorna o nome completo do arquivo
     * @return string Nome completo do arquivo
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Inicia a job na fila
     * @return void
     */
    public function startJob()
    {
        try {
            //Inicia fila
            $this->dispatch
            (
                (new ImportProductsJob(
                    ['name' => $this->fullName, 'path' => 'public/' . $this->destinationPath . '/' . $this->fullName])
                )->onConnection('database')
            );
        } catch (\Exception $e) {
            throw $e;
        }

    }

}
