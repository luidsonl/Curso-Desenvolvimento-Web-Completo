<?php
	require_once"../vendor/autoload.php";

	$route = new \App\Route;
	echo "funcionou";
	echo "<hr>";
	print_r($route->getUrl());
?>