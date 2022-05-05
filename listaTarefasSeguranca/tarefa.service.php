<?php

class TarefaService{

    //variaveis que vai receber de tarefa.controller.php
    private $conexao;
    private $tarefa;

    //É possivel tipar da onde as variaveis estão vindo, no cado conexao e tarefa Objetos
    public function __construct(Conexao $conexao, Tarefa $tarefa){
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }

    //Funções para o crud, create, read, update, delete
    public function inserir(){
        $query = "insert into tb_tarefas (tarefa) values (:tarefa)";
        $stmt = $this->conexao->prepare($query);
        
        //O valor da tarefa foi criado e setado em tarefa.controller.php 
        $stmt ->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        //executa a query
        $stmt->execute();
    }

    public function recuperar(){
        //Faz a recuperação de id, do status e da tarefa 
        $query = '
        select 
            t.id, s.status, t.tarefa 
        from 
            tb_tarefas as t 
        left join tb_status as s on (t.id_status = s.id) ';
        //segurança para sql injection
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

 
    }

    public function atualizar(){

        echo 'aqui ta entrando';
        //faz a atualização por meio do $tarefa que recebu de tarefa controller atualizar
        $query = 'update tb_tarefas set tarefa = :tarefa where id = :id';
        //Pode ser feito desta maneira tambem
        //$query = 'update tb_tarefas set tarefa = ? where id = ?';

        $stmt = $this->conexao->prepare($query);

        //Caso tenha feito com '?'
        //$stmt->bindValue(1, $this->tarefa->__get('tarefa')); 1 por cauda do primeiro ponto de interrogação
        //$stmt->bindValue(2, $this->tarefa->__get('id')); 2 por causa do segundo ponto de interrogação

        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->bindValue(':id', $this->tarefa->__get('id'));
        return $stmt->execute();


    }

    public function remover(){
        $query = 'delete from tb_tarefas where id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $this->tarefa->__get('id'));
        $stmt->execute();
    }

    public function marcarRealizada(){
        //faz a atualização por meio do $tarefa que recebu de tarefa controller atualizar
        $query = 'update tb_tarefas set id_status = :id_status where id = :id';

        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
        $stmt->bindValue(':id', $this->tarefa->__get('id'));
        return $stmt->execute();
    }



    public function recuperarTarefa(){
        //Faz a recuperação de id, do status e da tarefa 
        $query = '
        select 
            t.id, s.status, t.tarefa 
        from 
            tb_tarefas as t 
        left join tb_status as s on (t.id_status = s.id) 
        where t.id_status = :id_status';

        //segurança para sql injection
        $stmt = $this->conexao->prepare($query);

        $stmt ->bindValue(':id_status', $this->tarefa->__get('id_status'));
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}

?>