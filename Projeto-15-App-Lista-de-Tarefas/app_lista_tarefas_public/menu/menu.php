<style type="text/css">
	li a {
	color: #212529;
	text-decoration: none;
}
</style>
<div class="row">
	<div class="col-md-3 menu">
		<ul class="list-group">
		    <li class="list-group-item <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') { echo 'active'; } ?>">
		        <a href="index.php">Tarefas pendentes</a>
		    </li>
		    <li class="list-group-item <?php if(basename($_SERVER['PHP_SELF']) == 'nova_tarefa.php') { echo 'active'; } ?>">
		        <a href="nova_tarefa.php">Nova tarefa</a>
		    </li>
		    <li class="list-group-item <?php if(basename($_SERVER['PHP_SELF']) == 'todas_tarefas.php') { echo 'active'; } ?>">
		        <a href="todas_tarefas.php">Todas tarefas</a>
		    </li>
		</ul>
	 </div>