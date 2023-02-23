<?php

    require '../app_lista_tarefas_private/tarefa.model.php';
    require '../app_lista_tarefas_private/tarefa.service.php';
    require '../app_lista_tarefas_private/conexao.php';

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if  ($acao == 'inserir'){
        
        $tarefa = new Tarefa();
        $tarefa-> __SET('tarefa', $_POST['tarefa']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->inserir();

        header('Location: nova_tarefa.php?inclusao=1');
    
    } else if ($acao == 'recuperar'){
        
        $tarefa = new Tarefa();
        $conexao = new Conexao();
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperar();
    
    } else if ($acao == 'atualizar'){
        
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_POST['id']);
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $conexao = new Conexao();
        
        $tarefaService = new TarefaService($conexao, $tarefa);
        if ($tarefaService->atualizar()){

            if(isset($_GET['pag']) && $_GET['pag']=='index'){
                header('location: index.php');

            } else if(isset($_GET['pag']) && $_GET['pag']=='todas_tarefas'){
                header('location: todas_tarefas.php');
            }

        }

    } else if($acao == 'remover'){
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);

        $conexao = new Conexao();
        
        $tarefaService = new TarefaService($conexao, $tarefa);
        if ($tarefaService->remover()){
            if(isset($_GET['pag']) && $_GET['pag']=='index'){
                header('location: index.php');

            } else if(isset($_GET['pag']) && $_GET['pag']=='todas_tarefas'){
                header('location: todas_tarefas.php');
            }
        }

    } else if($acao == 'marcarRealizada'){
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);
        $tarefa->__set('id_status', 2);

        $conexao = new Conexao();
        
        $tarefaService = new TarefaService($conexao, $tarefa);
       
        if ($tarefaService->marcarRealizada()){
            if(isset($_GET['pag']) && $_GET['pag']=='index'){
                header('location: index.php');

            } else if(isset($_GET['pag']) && $_GET['pag']=='todas_tarefas'){
                header('location: todas_tarefas.php');
            }
        }

    } else if($acao = 'recuperarTarefasPendentes'){
        $tarefa = new Tarefa();
        $tarefa-> __set('id_status',1);
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperarTarefasPendentes();

    }
    

?>