<?php

include_once "./BD/MySQL.class.php";

$conexao = new MySQL();


if(isset($_POST['login'])){

  $login = $_POST['login'];

  $sql = "select * from usuarios where nome_log = '$login'";

  $resultado = $conexao->consulta($sql);

  if($resultado){
    echo true;
  }else{
    echo false;
  }
}

if(isset($_POST['email'])){

  $email = $_POST['email']."@feliz.ifrs.edu.br";

    $sql = "select * from usuarios where email = '$email'";

    $resultado = $conexao->consulta($sql);

    if($resultado){
      echo true;
    }else{
      echo false;
    }
  }
?>
