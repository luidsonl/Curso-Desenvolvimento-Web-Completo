<?php

namespace App\Controllers;

// Recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

// Models


class AppController extends Action {
	
	public function timeline(){


		if($this->usuarioLogado()){

			// Recuperar tweets
			$tweet = Container::getModel('Tweet');
			$tweet->__set('user_id', $_SESSION['id']);
			$tweets = $tweet->getAll();

			$this->view->tweets = $tweets;

			$this->render('timeline');	
		}
	}

	public function tweet(){

		if($this->usuarioLogado()){
			
			$tweet = Container::getModel('Tweet');
			$tweet->__set('tweet', $_POST['tweet']);
			$tweet->__set('user_id',$_SESSION['id']);
			$tweet->salvar();

			header('Location: /timeline');	
		}
	}

	public function usuarioLogado(){

		session_start();
		if(!empty($_SESSION['id']) && !empty($_SESSION['username'])){
			return true;
		} else{
			header('Location: /?login=error');
		}
	}
}

?>