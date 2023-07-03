<?php

include_once "./BD/MySQL.class.php";

$conexao = new MySQL();


if(isset($_POST['residuo'])){

  $residuo = $_POST['residuo'];

  $sql = "select * from residuos where nome = '$residuo'";

  $resultado = $conexao->consulta($sql);

  if($resultado){
    echo true;
  }else{
    echo false;
  }
}
?>
