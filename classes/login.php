<?php

require_once 'conexao.php';


if(isset($_POST['usuario'])){

    $usuario = addslashes($_POST['usuario']);
    $senha   = addslashes($_POST['senha']);

    if(!empty($senha) && !empty($usuario)){
        
        $conex = new conexao();
        $conex->conecta();
        if($conex->cadastro($usuario,$senha)){
            echo "cadastrado com sucesso";
        }
    }else{
        echo "preencha todos os campos";
    }

}