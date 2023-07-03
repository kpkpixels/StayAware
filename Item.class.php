<?php
class Item{

private $id;
private $nome;
private $marca;
private $quantidade;
private $status;
private $unidadeMed;
private $descNutri;
private $imgItem;
private $quantResi;
private $tipo;
private $nameresiItem;
private $nameresiItem2;
private $nameresiItem3;

public function __construct(){
  $this->setId("");
  $this->setNome("");
  $this->setMarca("");
  $this->setQuantidade("");
  $this->setStatus("");
  $this->setUnidadeMed("");
  $this->setDescNutri("");
  $this->setImgItem("");
  $this->setQuantResi("");
  $this->setNameresiItem("");
  $this->setNameresiItem2("");
  $this->setNameresiItem3("");
}


public function getId(){
  return $this->id;
}
public function setId($id){
  $this->id=$id;
}

public function getNome(){
  return $this->nome;
}
public function setNome($nome){
  $this->nome=$nome;
}

public function getMarca(){
  return $this->marca;
}
public function setMarca($marca){
  $this->marca=$marca;
}

public function getQuantidade(){
  return $this->quantidade;
}
public function setQuantidade($quantidade){
  $this->quantidade=$quantidade;
}

public function getStatus(){
  return $this->status;
}
public function setStatus($status){
  $this->status=$status;
}

public function getUnidadeMed(){
  return $this->unidadeMed;
}
public function setUnidadeMed($unidadeMed){
  $this->unidadeMed=$unidadeMed;
}

public function getDescNutri(){
  return $this->descNutri;
}
public function setDescNutri($descNutri){
  $this->descNutri=$descNutri;
}

public function getImgItem(){
  return $this->imgItem;
}
public function setImgItem($imgItem){
  $this->imgItem=$imgItem;
}
public function getQuantResi(){
  return $this->quantResi;
}
public function setQuantResi($quantResi){
  $this->quantResi=$quantResi;
}

public function getTipo(){
  return $this->tipo;
}
public function setTipo($tipo){
  $this->tipo = $tipo;
}
public function getNameresiItem(){
  return $this->nameresiItem;
}

public function setNameresiItem($nameresiItem){
  $this->nameresiItem = $nameresiItem;
}

public function getNameresiItem2(){
  return $this->nameresiItem2;
}

public function setNameresiItem2($nameresiItem2){
  $this->nameresiItem2 = $nameresiItem2;
}

public function getNameresiItem3(){
  return $this->nameresiItem3;
}

public function setNameresiItem3($nameresiItem3){
  $this->nameresiItem3 = $nameresiItem3;
}

}
 ?>
