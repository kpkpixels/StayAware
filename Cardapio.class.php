<?php
class Cardapio{

  private $id;
  private $dia;
  private $turno;
  private $quantidade;
  private $itemCardapio;
  private $itemCardapio2;
  private $itemCardapio3;


  public function __construct(){
    $this->setId("");
    $this->setDia("");
    $this->setTurno("");
    $this->setQuantidade("");
    $this->setItemCardapio("");
    $this->setItemCardapio2("");
    $this->setItemCardapio3("");
  }

  public function getId(){
    return $this->id;
  }

  public function setId($id){
    $this->id = $id;
  }

  public function getDia(){
    return $this->dia;
  }

  public function setDia($dia){
    $this->dia = $dia;
  }

  public function getTurno(){
    return $this->turno;
  }

  public function setTurno($turno){
    $this->turno = $turno;
  }

  public function getQuantidade(){
    return $this->quantidade;
  }

  public function setQuantidade($quantidade){
    $this->quantidade = $quantidade;
  }

  public function getItemCardapio(){
    return $this->itemCardapio;
  }

  public function setItemCardapio($itemCardapio){
    $this->itemCardapio = $itemCardapio;
  }

  public function getItemCardapio2(){
    return $this->itemCardapio2;
  }

  public function setItemCardapio2($itemCardapio2){
    $this->itemCardapio2 = $itemCardapio2;
  }

  public function getItemCardapio3(){
    return $this->itemCardapio3;
  }

  public function setItemCardapio3($itemCardapio3){
    $this->itemCardapio3 = $itemCardapio3;
  }
}

?>
