<?php
	
	//inicia sessão
	session_start();
	//Atribuindo valores às variáveis
	$title = str_replace(';', ',', $_POST['title']);
	$category = str_replace(';', ',', $_POST['category']);
	$description = str_replace(';', ',', $_POST['description']);

	$text = $_SESSION['id'] . ';' . $title . ';' . $category . ';' . $description . PHP_EOL;




	//Abrindo arquivo
	$file = fopen('../db/data.hd', 'a');

	//Inserindo texto
	fwrite($file, $text);

	//Fechando o arquivo
	fclose($file);

	//Redireciona
	header('location: ../abrir_chamado.php')

?>