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
		

		// Variáveis de paginação
		$total_registros_pagina = 10;
		$deslocamento = 0;
		$pagina = 1;

		//$tweets = $tweet->getAll();
		echo "<br><br><br><br>Página atual: $pagina <br> Total de registros por página: $total_registros_pagina <br> deslocamento: $deslocamento";
		$tweets = $tweet->getPorPagina($total_registros_pagina, $deslocamento);
		$this->view->tweets = $tweets;

		$usuario = Container::getModel('Usuario');
		$usuario->__set('id', $_SESSION['id']);

		$this->view->info_usuario = $usuario->getInfoUsuario();
		$this->view->total_tweets = $usuario->getTotalTweets();
		$this->view->total_seguindo = $usuario->getTotalSeguindo();
		$this->view->total_seguidores = $usuario->getTotalSeguidores();

		$this->render('timeline');
	}

	public function tweet(){

		$this->validaLogin();
		
		// publica tweet
		$tweet = Container::getModel('Tweet');
		$tweet->__set('tweet', $_POST['tweet']);
		$tweet->__set('user_id',$_SESSION['id']);
		$tweet->salvar();

		header('Location: /timeline');	
	}
	public function deleteTweet(){

		$this->validaLogin();
		
		// deleta tweet
		$tweet = Container::getModel('Tweet');
		$tweet->__set('id', $_GET['tweet_id']);
		$tweet->deleteTweet();

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
			$busca = Container::getModel('Usuario');
			$busca-> __set('username', $pesquisarPor);
			$busca-> __set('id', $_SESSION['id']);
			$usuarios = $busca->getAll();	

		}

		$usuario = Container::getModel('Usuario');
		$usuario->__set('id', $_SESSION['id']);

		$this->view->info_usuario = $usuario->getInfoUsuario();
		$this->view->total_tweets = $usuario->getTotalTweets();
		$this->view->total_seguindo = $usuario->getTotalSeguindo();
		$this->view->total_seguidores = $usuario->getTotalSeguidores();

		$this->view->usuarios = $usuarios;
		$this->render('quemSeguir');
	}

	public function acao(){
		$this->validaLogin();


		$acao = isset($_GET['acao']) ? $_GET['acao'] : '';
		$followed_id = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';

		$usuario = Container::getModel('Usuario');
		$usuario->__set('id', $_SESSION['id']);

		if ($acao == 'seguir') {
			$usuario->seguirUsuario($followed_id);

		}else if ($acao == 'deixar_de_seguir') {
			$usuario->deixarSeguirUsuario($followed_id);
		}

		header('Location: /quem_seguir');


	}
}

//Projeto apenas para fins didáticos, não uso twitter

?>