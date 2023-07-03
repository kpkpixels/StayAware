<?php
include_once "Cardapio.class.php";
include_once "./BD/MySQL.class.php";


class ControleCardapio{

  public function acaoCardapio($acao,$cardapio){

    if($acao=="inserir"){
      $this->inserir($cardapio);
    }else if($acao=="alterar"){
      $this->alterar($cardapio);
    }else if($acao=="inativar"){
      $this->excluir($cardapio);
    }else if($acao=="replicar"){
      $this->replicar($cardapio);
    }
    else if($acao=="excluir"){
      $this->excluir($cardapio);
    }
  }

  public function inserir($cardapio){
    $conexao = new MySQL();

    $turno = $cardapio->getTurno();
    $data = $cardapio->getDia();
    //Exploda a data para entrar no formato aceito pelo DB.
    $datap = implode('-', array_reverse(explode('/', $data)));


    $sql = "INSERT INTO cardapios (dia, turno, quant_item) VALUES ('".$datap."','".$cardapio->getTurno()."','".$cardapio->getQuantidade()."')";
    $resultado = $conexao->executa($sql);

    $cardapio->setId($resultado[0]['id']);

    $sql="select * from cardapios where dia='$datap' and turno='$turno'";
    $resultado = $conexao->consulta($sql);
    //echo $sql; die;
    if($resultado){
      //$proposta= new Proposta();
      $cardapio->setId($resultado[0]['id']);

      if($cardapio->getQuantidade()=="1"){
        $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio()."', '".$cardapio->getId()."')";
        $resultado = $conexao->executa($sql);
      }
      if($cardapio->getQuantidade()=="2"){
        $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio()."', '".$cardapio->getId()."')";
        $resultado = $conexao->executa($sql);
        $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio2()."', '".$cardapio->getId()."')";
        $resultado = $conexao->executa($sql);
      }
      if($cardapio->getQuantidade()=="3"){
        $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio()."', '".$cardapio->getId()."')";
        $resultado = $conexao->executa($sql);
        $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio2()."', '".$cardapio->getId()."')";
        $resultado = $conexao->executa($sql);
        $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio3()."', '".$cardapio->getId()."')";
        $resultado = $conexao->executa($sql);
      }

    }

    return $resultado;
  }

  public function alterar($cardapio){

    $conexao = new MySQL();

    $data = $cardapio->getDia();
    //Exploda a data para entrar no formato aceito pelo DB.
    $datap = implode('-', array_reverse(explode('/', $data)));

    $sql = "update cardapios set dia = '".$datap."', turno = '".$cardapio->getTurno()."', quant_item = '".$cardapio->getQuantidade()."' where id =  ".$cardapio->getId();


    $resultado = $conexao->executa($sql);

    if($cardapio->getQuantidade()=="1"){
      $sql = "DELETE FROM cardapio_item WHERE id_cardapio =".$cardapio->getId();
      $resultado = $conexao->executa($sql);
      $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio()."', '".$cardapio->getId()."')";
      $resultado = $conexao->executa($sql);
    }
    if($cardapio->getQuantidade()=="2"){
      $sql = "DELETE FROM cardapio_item WHERE id_cardapio =".$cardapio->getId();
      $resultado = $conexao->executa($sql);
      $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio()."', '".$cardapio->getId()."')";
      $resultado = $conexao->executa($sql);
      $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio2()."', '".$cardapio->getId()."')";
      $resultado = $conexao->executa($sql);
    }
    if($cardapio->getQuantidade()=="3"){
      $sql = "DELETE FROM cardapio_item WHERE id_cardapio =".$cardapio->getId();
      $resultado = $conexao->executa($sql);
      $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio()."', '".$cardapio->getId()."')";
      $resultado = $conexao->executa($sql);
      $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio2()."', '".$cardapio->getId()."')";
      $resultado = $conexao->executa($sql);
      $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio3()."', '".$cardapio->getId()."')";
      $resultado = $conexao->executa($sql);
    }
  }

  public function replicar($cardapio){
    $conexao = new MySQL();

    $turno = $cardapio->getTurno();
    $data = $cardapio->getDia();
    //Exploda a data para entrar no formato aceito pelo DB.
    $datap = implode('-', array_reverse(explode('/', $data)));


    $sql = "INSERT INTO cardapios (dia, turno, quant_item) VALUES ('".$datap."','".$cardapio->getTurno()."','".$cardapio->getQuantidade()."')";
    $resultado = $conexao->executa($sql);

    $cardapio->setId($resultado[0]['id']);

    $sql="select * from cardapios where dia='$datap' and turno='$turno'";
    $resultado = $conexao->consulta($sql);
    //echo $sql; die;
    if($resultado){
      //$proposta= new Proposta();
      $cardapio->setId($resultado[0]['id']);

      if($cardapio->getQuantidade()=="1"){
        $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio()."', '".$cardapio->getId()."')";
        $resultado = $conexao->executa($sql);
      }
      if($cardapio->getQuantidade()=="2"){
        $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio()."', '".$cardapio->getId()."')";
        $resultado = $conexao->executa($sql);
        $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio2()."', '".$cardapio->getId()."')";
        $resultado = $conexao->executa($sql);
      }
      if($cardapio->getQuantidade()=="3"){
        $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio()."', '".$cardapio->getId()."')";
        $resultado = $conexao->executa($sql);
        $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio2()."', '".$cardapio->getId()."')";
        $resultado = $conexao->executa($sql);
        $sql = "INSERT INTO cardapio_item (id_item, id_cardapio) VALUES  ('".$cardapio->getItemCardapio3()."', '".$cardapio->getId()."')";
        $resultado = $conexao->executa($sql);
      }

    }

    return $resultado;
  }

}


?>
