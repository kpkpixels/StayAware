<?php
include_once "ControleUsuario.class.php";

if(isset($_POST['botao'])){

	$usuario = new Usuario();
	$usuario->setNome($_POST['nomeUsuario']);
  $usuario->setSobrenome($_POST['sobrenomeUsuario']);
  $usuario->setTelefone($_POST['telefoneUsuario']);
  $usuario->setEmail($_POST['emailUsuario']);
	$usuario->setNome_log($_POST['nome_logUsu']);
	$usuario->setSenha($_POST['senhaUsuario']);
	$usuario->setStatus($_POST['statusUsuario']);
	$usuario->setFuncao($_POST['funcaoUsuario']);


	$controleUser = new ControleUsuario();

	if($_POST['botao'] == "Inserir"){
		$controleUser->acaousuario("inserir",$usuario);
	}else if($_POST['botao'] == "Alterar"){
		$usuario->setId($_POST['id']);
		$controleUser->acaousuario("alterar",$usuario);
	}else if($_POST['botao'] == "Alterar perfil"){
			$usuario->setId($_POST['id']);
			$controleUser->acaousuario("alterar_p",$usuario);
	}else if($_POST['botao'] == "Inativar"){
		$usuario->setId($_POST['id']);
		$controleUser->acaousuario("inativar",$usuario);
	}else if($_POST['botao'] == "Excluir"){
		$usuario->setId($_POST['id']);
		$controleUser->acaousuario("excluir",$usuario);
	}else if($_POST['botao'] == "Recuperar senha"){
		$usuario->setEmail($_POST['emailUsuario']);
		$controleUser->recuperarSenha($usuario);
	}
}

header("Location:listarUser.php");

?>
