<?php 

//Destrói a sessão e força um redirecionamento para index.php
	session_start();
	session_destroy();
	header('Location: ../index.php');

?>