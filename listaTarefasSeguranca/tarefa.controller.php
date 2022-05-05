<?php

//Faz a requisição das outras paginas fora da pasta
require "../../listaTarefasSeguranca/tarefa.model.php";
require "../../listaTarefasSeguranca/tarefa.service.php";
require "../../listaTarefasSeguranca/conexao.php";

//se houver valor no get não é adicionado nada, se não houver valor no get, é adicionado acao

$acao = isset($_GET['acao']) ?  $_GET['acao'] :$acao;


//Recuperar o parametro passado por nova tarefa na url, pelo GET

    if($acao == 'inserir'){


        //cria uym novo objeto de tarefa, e adiciona a nova tarefa
        $tarefa = new Tarefa();
        $tarefa->__set('tarefa', $_POST['tarefa']);

        //instacia de conexão
        $conexao = new Conexao();

        //instacia de tarefa service para o crud
        $tarefaService = new TarefaService($conexao, $tarefa);

        //Acionamos o metodo inserir em tarefa.service.php
        $tarefaService->inserir();

        header('Location: nova_tarefa.php?inclusao=1');

    }else if($acao == 'recuperar'){
        
        $tarefa = new Tarefa();
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperar();
        
    
    }else if($acao == 'atualizar'){
        
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_POST['id']);
        $tarefa->__set('tarefa', $_POST['tarefa']);

        $conexao = new Conexao();
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->atualizar();

        if(isset($_GET['pag']) && $_GET['pag'] == index){

            header('location: index.php');
        }else{
            header('location: todas_tarefas.php');

        }
        

    }else if($acao == 'remover'){
        $tarefa = new Tarefa();

        //A variavel é recibida via GET, atraves de clicagem em excluir pelo javascript
        $tarefa->__set('id', $_GET['id']);
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);

        //Ativa a função remover() em tarefa.service.php   
        $tarefaService->remover();
        if(isset($_GET['pag']) && $_GET['pag'] == index){

            header('location: index.php');
        }else{
            header('location: todas_tarefas.php');

        }
    }else if($acao == 'realizada'){

        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);
        $tarefa->__set('id_status', 2);
        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);

        $tarefaService->marcarRealizada();

        if(isset($_GET['pag']) && $_GET['pag'] == index){

            header('location: index.php');
        }else{
            header('location: todas_tarefas.php');

        }

        
    }else if ($acao == 'recuperarTarefa'){

        //cria uym novo objeto de tarefa, e adiciona a nova tarefa
        $tarefa = new Tarefa();
        $tarefa->__set('id_status', 1);

        //instacia de conexão
        $conexao = new Conexao();

        //instacia de tarefa service para o crud
        $tarefaService = new TarefaService($conexao, $tarefa);

        //Acionamos o metodo inserir em tarefa.service.php
        $tarefas = $tarefaService->recuperarTarefa();
    }
?>