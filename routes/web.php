<?php

/**
* Rota base, mostra listagem de produtos
*/
Route::get('/', function () {
	return redirect('Produtos');
});

/**
* Cria recurso 'Produtos', ligado ao controller 'ProdutosController'
*/
Route::resource('Produtos', 'ProdutosController');
