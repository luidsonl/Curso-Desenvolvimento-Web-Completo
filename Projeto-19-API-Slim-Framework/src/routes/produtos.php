<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;

// Routes
// Lista produtos
$app->group('/api/v1', function(){
	$this->get('/produtos/lista', function($request, $response){
		$produtos = Produto::get();
		return $response->withJson($produtos);
	});
	//Adiciona produtos
	$this->post('/produtos/adiciona', function($request, $response){
		$dados = $request->getParsedBody();
		$produto = Produto::create($dados);
		return $response->withJson($produto);
	});
});