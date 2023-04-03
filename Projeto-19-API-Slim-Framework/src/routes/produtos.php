<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;

// Routes
$app->group('/api/v1', function(){
	// Lista produtos
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
	//Recuperar produto para um determinado id
	$this->get('/produtos/lista/{id}', function($request, $response, $args){
		$produto = Produto::findOrFail($args['id']);
		return $response->withJson($produto);
		
	});
	//Atualiza produto para um determinado id
	$this->put('/produtos/atualiza/{id}', function($request, $response, $args){
		$dados = $request->getParsedBody();
		$produto = Produto::findOrFail($args['id']);
		$produto->update($dados);
		return $response->withJson($produto);
		
	});
	//Remove produto para um determinado id
	$this->get('/produtos/remove/{id}', function($request, $response, $args){
		$produto = Produto::findOrFail($args['id']);
		$produto->delete();
		return $response->withJson($produto);
		
	});
});