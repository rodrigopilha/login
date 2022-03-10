<?php

class conexao{
    private $con;

    public function conecta(){
        //global $con;


        try {
            $this->con = new PDO('mysql:dbname=cad;host=localhost','root','');
            return $this->con;

        } catch (PDOException $erro) {
            echo  "erro ao conectar".$erro->getMessage();
        }

    }
    public function cadastro($usuario, $senha){
        //global $con;

        $sql = $this->con->prepare("SELECT id FROM user WHERE usuario = :usuario");
        $sql->bindValue(":usuario", $usuario);
        $sql->execute();
        if($sql->rowCount() > 0){
            return false;

        }else{
            
            $sql = $this->con->prepare("INSERT INTO user (usuario , senha) VALUES (:usuario , : senha)");
            $sql->bindValue(":usuario", $usuario);
            $sql->bindValue(":senha", $senha);
            $sql->execute();
            return true;
        }
    }

    public function logar($usuario, $senha){
       // global $con;

        $sql = $this->con->prepare("SELECT id FROM user WHERE usuario = :usuario AND senha = :senha" );
        $sql->bindValue(":usuario",$usuario);
        $sql->bindValue(":senha",$senha);
        $sql->execute();
        if($sql->rowCounnt() > 0){
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id'] = $dado['id'];
            return true;
        }else{
            return false;
        }



    }

}