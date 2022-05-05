<?php

class Conexao {

    private $host = "localhost";
    private $dbname = "tb_tarefas";
    private $user = "root";
    private $senha = "";

    public function conectar(){
        try{

            //Conexção ao banco, host, usuario e senha
            $conexao = new PDO (
                "mysql:host=$this->host;dbname=$this->dbname", 
                "$this->user", 
                "$this->senha");

            //Necessario retornar a conexão cada vez que a pesqusa for realizada
            return $conexao;

        }catch(PDOExeption $erro){
            echo "<p>".$erro->getMessage()."</p>";
        }
    }
}

?>