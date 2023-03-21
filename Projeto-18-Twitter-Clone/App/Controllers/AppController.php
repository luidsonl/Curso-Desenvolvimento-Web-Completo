<?php

namespace App\Controllers;

// Recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

// Models


class AppController extends Action {
	
	public function timeline(){

		session_start();

		if(!empty($_SESSION['id']) && !empty($_SESSION['username'])){
			$this->render('timeline');
		} else{
			header('Location: /?login=error');
		}
	}
}

?>