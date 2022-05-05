<?php

//cria a classe tarefa com privada, sendo assim, um objeto
class Tarefa {
    private $id;
    private $id_status;
    private $tarefa;
    private $data_cadastradoo;

    //A função que retorna o atributo, get e set
    public function __get($atributo){
        return $this-> $atributo;
    }

    public function __set($atributo, $valor){
        return $this-> $atributo = $valor;
    }

    

}

?>