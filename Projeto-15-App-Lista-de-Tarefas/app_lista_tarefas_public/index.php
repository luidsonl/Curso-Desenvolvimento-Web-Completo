<?php
	$acao = 'recuperarTarefasPendentes';
	require 'tarefa_controller.php';


?>
<script>
	pag = 'index';
</script>
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

		<div class="container app">

			<?php
			// Inclui o menu lateral
			require_once('menu/menu.php');
			?>


				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Tarefas pendentes</h4>
								<hr />

								<?php foreach($tarefas as $indice => $tarefa){ ?>

									<div class="row mb-3 d-flex align-items-center tarefa">
										<div class="col-sm-9" id = "tarefa_<?php echo $tarefa->id ?>">
											<?php echo "$tarefa->tarefa ($tarefa->status)"?> 
										</div>
										<div class="col-sm-3 mt-2 d-flex justify-content-between">
											<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?php echo $tarefa->id ?>)"></i>
											<i class="fas fa-edit fa-lg text-info" onclick = "editar(<?php echo $tarefa->id ?>, '<?php echo $tarefa->tarefa ?>')"></i>
											<i class="fas fa-check-square fa-lg text-success" onclick = "marcarRealizada(<?php echo $tarefa->id ?>)"></i>
										</div>
									</div>

								<?php } ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script src="js/script.js"></script>
		<script src="https://kit.fontawesome.com/81e9ff32d9.js" crossorigin="anonymous"></script>
	</body>

</html>