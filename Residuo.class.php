<?php
/**
 *
 */
class Residuo{

  private $id;
  private $nome;
  private $imgResi;
  private $tipo;
  private $status;
  function __construct()
  {
    $this->setId("");
    $this->setNome("");
    $this->setImgResi("");
    $this->setTipo("");
    $this->setStatus("");
  }
  public function getId(){
  return $this->id;
}

public function setId($id){
  $this->id = $id;
}

public function getNome(){
  return $this->nome;
}

public function setNome($nome){
  $this->nome = $nome;
}

public function getImgResi(){
  return $this->imgResi;
}

public function setImgResi($imgResi){
  $this->imgResi = $imgResi;
}

public function getTipo(){
  return $this->tipo;
}

public function setTipo($tipo){
  $this->tipo = $tipo;
}

public function getStatus(){
  return $this->status;
}
public function setStatus($status){
  $this->status=$status;
}

}


 ?>
