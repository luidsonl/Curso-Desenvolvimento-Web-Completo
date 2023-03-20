<?php

namespace App\Controllers;

// Recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

// Models


class IndexController extends Action {

	public function index(){


		//Renderizando conteúdo
		$this->render('index');
	}
	public function inscreverse(){
		$this->render('inscreverse');
	}
}

?>