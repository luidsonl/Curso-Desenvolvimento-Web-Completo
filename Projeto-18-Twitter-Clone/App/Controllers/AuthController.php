<?php

namespace App\Controllers;

// Recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

// Models


class AuthController extends Action {
	
	public function autenticar(){
		$usuario = Container::getModel('Usuario');

		$usuario-> __set('email', $_POST['email']);
		$usuario-> __set('password', md5($_POST['password']));

		$usuario->autenticar();

		if(!empty($usuario->__get('id')) && !empty($usuario->__get('username'))){
			
			session_start();

			$_SESSION['id'] = $usuario->__get('id');
			$_SESSION['username'] = $usuario->__get('username');

			header('Location: /timeline');

		}else{
			header('Location: /?login=error');
		}
	}

	public function sair(){
		session_start();
		session_destroy();
		header('Location: /');
	}
}