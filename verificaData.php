<?php

include_once "./BD/MySQL.class.php";

$conexao = new MySQL();


if(isset($_POST['data'])){

  $data = $_POST['data'];
  $turno = $_POST['turno'];
  //Exploda a data para entrar no formato aceito pelo DB.
  $datap = implode('-', array_reverse(explode('/', $data)));

  $sql = "select * from cardapios where dia = '$datap' and (turno='$turno' or turno='Ambos')";

  if ($turno=="Ambos"){
    $sql2 = "select * from cardapios where dia = '$datap' and (turno='Manhã' or turno='Tarde')";
  }
  
  $resultado = $conexao->consulta($sql);
  $resultado2 = $conexao->consulta($sql2);

  if($resultado){
    echo true;
  }else{
    echo false;
  }

  if($resultado2){
    echo true;
  }else{
    echo false;
  }
}

?>
