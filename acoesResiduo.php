<?php
include_once "ControleResiduo.class.php";


if(isset($_POST['botaoResiduo'])){

	$residuo = new Residuo();
	$residuo->setNome($_POST['nomeResi']);
  $residuo->setImgResi($_FILES['resiImg']);
  $residuo->setTipo($_POST['tipoResi']);
	$residuo->setStatus($_POST['statusResi']);

	$controleResiduo = new ControleResiduo();

	if($_POST['botaoResiduo'] == "Inserir"){
		$controleResiduo->acaoresiduo("inserir",$residuo);
	}else if($_POST['botaoResiduo'] == "Alterar"){
		$residuo->setId($_POST['id']);
		$controleResiduo->acaoresiduo("alterar",$residuo);
	}else if($_POST['botaoResiduo'] == "Inativar"){
		$residuo->setId($_POST['id']);
		$controleResiduo->acaoresiduo("inativar",$residuo);
	}else if($_POST['botao'] == "Excluir"){
		$residuo->setId($_POST['id']);
		$controleResiduo->acaoresiduo("excluir",$residuo);
	}

}

header("Location:listarResiduo.php");

?>
