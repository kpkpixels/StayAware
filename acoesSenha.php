<?php
include_once "ControleSenha.class.php";

if(isset($_POST['botao'])){

	$usuario = new Usuario();
  $usuario->setEmail($_POST['emailUsuario']);


	$controleSenha = new ControleSenha();

	if($_POST['botao'] == "Recuperar senha"){
		$usuario->setEmail($_POST['emailUsuario']);
		$controleSenha->recuperarSenha($usuario);
	}
}

//header("Location:formSenha.php");

?>
