
<?php 
	
	session_start();

	// Variável de controle de verificação
	$is_user_auth = false;
	// Variável que armazenará o id na sessão
	$user_id = null;
	//Armazena o tipo de perfil = 0 para adm, 1 para user
	$profile_type = null;

	//Usuários do sistema
	$users = array(
		array('id' => 0, 'email'=> 'adm@email', 'password'=> '123', 'profile_type' => 0),
		array('id' => 1, 'email'=> 'teste1@email', 'password'=> '123', 'profile_type' => 1),
		array('id' => 2,'email'=> 'teste2@email', 'password'=> '123', 'profile_type' => 1),
		array('id' => 3,'email'=> 'teste3@email', 'password'=> '123', 'profile_type' => 1),
	);
	



	foreach ($users as $user) {

		if ($user['email'] == $_POST['email'] && $user['password'] == $_POST['password']) {
			$is_user_auth = true;
			$user_id = $user['id'];
			$profile_type = $user['profile_type'];
		}
	}

	// Testa se houve verificação
	
	if ($is_user_auth) {
		$_SESSION['authenticated'] = 'Y';
		$_SESSION['id'] = $user_id;
		$_SESSION['profile_type'] = $profile_type;
		header('Location: home.php');

	} else{
		$_SESSION['authenticated'] = 'N';

		header('Location: index.php?login=error');
	}
?>
