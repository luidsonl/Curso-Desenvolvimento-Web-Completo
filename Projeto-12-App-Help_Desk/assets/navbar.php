<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Navbar</title>
</head>
<body>

	<nav class="navbar navbar-dark bg-dark navbar-expand-md">
      	<div class="container ms-5">
      		<a class="navbar-brand" href="index.php">
      			<img src="./img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        		App Help Desk
     		 </a>

     		<?php
     			//Irá verificar se a página atual é a de login e caso não seja, irá exibir o botão de logoff
     			if (!str_contains($_SERVER['REQUEST_URI'], 'index.php')) { ?>

     				<ul class="navbar-nav">
		     		 	<li class="nav-item">
		     		 		<a href="assets/logoff.php" class="nav-link">Sair</a>
		     		 	</li>
     		 		</ul>
     		<?php } ?>
     		 
     	</div>
    </nav>


</body>
</html>