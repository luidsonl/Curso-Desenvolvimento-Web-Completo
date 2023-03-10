<?php

namespace App\Controllers;

use MF\Controller\Action;
use App\Connection;
use App\Models\Produto;

class IndexController extends Action {

	public function index(){

		//$this->view->dados = array('sofá','cadeira','cama');

		// Instanciando conexão
		$conn = Connection::getDb();

		//Instanciando modelo
		$produto = new Produto($conn);

		$produtos = $produto->getProdutos();

		$this->view->dados = $produtos;

		//Renderizando conteúdo

		$this->render('index','layout2');
	}

	public function sobreNos(){

		$this->view->dados = array('Notebook', 'Smartphone');
		$this->render('sobreNos', 'layout1');
	}	
}

?>