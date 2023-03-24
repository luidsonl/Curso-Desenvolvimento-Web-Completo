<?php

namespace App\Controllers;

// Recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

// Models


class AppController extends Action {
	
	public function timeline(){

		$this->validaLogin();

		// Recuperar tweets
		$tweet = Container::getModel('Tweet');
		$tweet->__set('user_id', $_SESSION['id']);
		$tweets = $tweet->getAll();
		$this->view->tweets = $tweets;

		$this->render('timeline');	
	}

	public function tweet(){

		validaLogin();
		
		// publica tweet
		$tweet = Container::getModel('Tweet');
		$tweet->__set('tweet', $_POST['tweet']);
		$tweet->__set('user_id',$_SESSION['id']);
		$tweet->salvar();

		header('Location: /timeline');	
	}

	public function validaLogin(){

		session_start();
		if(empty($_SESSION['id']) && empty($_SESSION['username'])){
			header('Location: /?login=error');
		}
	}

	public function quemSeguir(){
		$this->validaLogin();
		$pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';

		$usuarios = array();

		if($pesquisarPor != ''){
			$usuario = Container::getModel('Usuario');
			$usuario-> __set('username', $pesquisarPor);
			$usuarios = $usuario->getAll();

		}

		$this->view->usuarios = $usuarios;
		$this->render('quemSeguir');
	}
}

//Projeto apenas para fins didáticos, não uso twitter

?>