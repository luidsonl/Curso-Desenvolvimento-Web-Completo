<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	</head>

	<body>

		<?php
		// Inclui a barra de navegação
		require_once('menu/navbar.php') 
		?>

		<?php	if (isset($_GET['inclusao']) && $_GET['inclusao']==1 ){	?>

			<div class = "bg-success pt-2 text-white d-flex justify-content-center">
				<h5>Tarefa inserida com sucesso!</h5>
			</div>

		<?php }?>

		<div class="container app">

			<?php
			// Inclui o menu lateral
			require_once('menu/menu.php');
			?>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Nova tarefa</h4>
								<hr />

								<form method="post" action="tarefa_controller.php?acao=inserir">
									<div class="mb-3">
										<label>Descrição da tarefa:</label>
										<input type="text" name="tarefa" class="form-control" placeholder="Exemplo: Lavar o carro" autocomplete="off">
									</div>

									<button class="btn btn-success">Cadastrar</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
<script src="https://kit.fontawesome.com/81e9ff32d9.js" crossorigin="anonymous"></script>

</html>