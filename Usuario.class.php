<?php
class Usuario{

private $id;
private $nome;
private $sobrenome;
private $nome_log;
private $status;
private $email;
private $telefone;
private $senha;

public function __construct(){
  $this->setId("");
  $this->setNome("");
  $this->setSobrenome("");
  $this->setNome_log("");
  $this->setStatus("");
  $this->setEmail("");
  $this->setTelefone("");
  $this->setSenha("");
  $this->setFuncao("");
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

public function getSobrenome(){
  return $this->sobrenome;
}
public function setSobrenome($sobrenome){
  $this->sobrenome=$sobrenome;
}

public function getNome_log(){
  return $this->nome_log;
}
public function setNome_log($nome_log){
  $this->nome_log=$nome_log;
}

public function getStatus(){
  return $this->status;
}
public function setStatus($status){
  $this->status=$status;
}

public function getSenha(){
  return $this->senha;
}
public function setSenha($senha){
  $this->senha=$senha;
}

public function getTelefone(){
  return $this->telefone;
}
public function setTelefone($telefone){
  $this->telefone=$telefone;
}

public function getEmail(){
  return $this->email;
}
public function setEmail($email){
  $this->email=$email;
}
public function getFuncao(){
  return $this->funcao;
}
public function setFuncao($funcao){
  $this->funcao=$funcao;
}

}
 ?>
