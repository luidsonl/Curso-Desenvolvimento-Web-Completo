<?php

namespace App\Controllers;

// Recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

// Models


class IndexController extends Action {

	public function index(){
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';

		//Renderizando conteúdo
		$this->render('index');
	}

	public function inscreverse(){
		$this->view->erroCadastro = 0; // 0-sem erro, 1-texto curto, 2-usuario ja existe
		$this->view->user = [
			'username'=>'',
			'email'=>'',
			'password'=>''
		];
		
		$this->render('inscreverse');
	}

	public function registrar(){
		$this->view->erroCadastro = 0;
		$this->view->user = array();
		$this->view->user = array(
				'username'=>$_POST['username'],
				'email'=>$_POST['email'],
				'password'=>$_POST['password']
			);

		//Receber dados do formulário
		
		$usuario = Container::getModel('Usuario');

		$usuario->__set('username', $_POST['username']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('password', $_POST['password']);

		if ($usuario->validarCadastro()){

			if(count($usuario->getUsuarioPorEmail())==0){
				$usuario->salvar();
				$this->render('cadastro');
			}else{
				$this->view->erroCadastro = 2;
				$this->render('inscreverse');
			}
		}else{
			$this->view->erroCadastro = 1;
			$this->render('inscreverse');
		}
	}
}

?>