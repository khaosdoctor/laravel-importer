<?php

namespace App\Http\Controllers;

use App\Produtos;
use DB;
use Illuminate\Http\Request;
use Response;

class ProdutosController extends Controller
{
    /**
     * Mostra a listagem de produtos paginado de 5 em 5 registros
     *
     * @return \Illuminate\Http\Response Objeto Response
     */
    public function index()
    {
        $lista = Produtos::paginate(5);
        return view('Produtos.list')->with('lista', $lista);
    }

    /**
     * Rota para a criação de um novo recurso, exibe o formulário de upload de arquivos
     *
     * @return \Illuminate\Http\Response Objeto response
     */
    public function create()
    {
        return view('Produtos.create');
    }

    /**
     * Rota para criação e importação de um novo produto
     *
     * @param  \Illuminate\Http\Request $request Requisição
     * @return \Illuminate\Http\Response Objeto response
     */
    public function store(Request $request)
    {
        //Inicializa o controller de arquivos e armazena o arquivo
        $fileHandler = new FileController($request->file('uploadProduct'));
        $fileHandler->store(); //Armazena o arquivo na pasta correta
        $fileHandler->startJob(); //Inicia o job da queue

        return redirect()->route('Produtos.index')->with('produto', $fileHandler->getFullName());
    }

    /**
     * Remove o produto de id igual a $id
     *
     * @param  int $id Id do produto
     * @return \Illuminate\Http\Response Objeto response
     */
    public function destroy($id)
    {
        if (Produtos::destroy($id)) {
            $message = Response::make(null, 200);
        } else {
            $message = Response::make(null, 500);
        }

        return $message;
    }
}
