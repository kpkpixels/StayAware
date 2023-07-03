<?php
include_once "ControleItem.class.php";



if(isset($_POST['botaoItem'])){


	$item = new Item();
	$item->setNome($_POST['nomeItem']);
  $item->setMarca($_POST['marcaItem']);
  $item->setQuantidade($_POST['quantItem']);
  $item->setUnidadeMed($_POST['unidadeItem']);
	$item->setDescNutri($_POST['descItem']);
  $item->setStatus($_POST['statusItem']);
	$item->setImgItem($_FILES['itemImg']);
	$item->setQuantResi($_POST['resiItem']);
	$item->setTipo($_POST['tipoItem']);
	$item->setNameresiItem($_POST['nameresiItem']);
	$item->setNameresiItem2($_POST['nameresiItem2']);
	$item->setNameresiItem3($_POST['nameresiItem3']);

	$controleItem = new ControleItem();

	if($_POST['botaoItem'] == "Inserir"){
		$controleItem->acaoitem("inserir",$item);
	}else if($_POST['botaoItem'] == "Alterar"){
		$item->setId($_POST['id']);
		$controleItem->acaoitem("alterar",$item);
	}else if($_POST['botaoItem'] == "Inativar"){
		$item->setId($_POST['id']);
		$controleItem->acaoitem("inativar",$item);
	}else if($_POST['botao'] == "Excluir"){
		$item->setId($_POST['id']);
		$controleItem->acaoitem("excluir",$item);
	}

}

header("Location:listarItem.php");

?>
