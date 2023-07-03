<?php
include_once "ControleCardapio.class.php";
include_once "./BD/MySQL.class.php";

//os testes loucos começam aqui
if(isset($_POST['botaoCardapio'])){

	if($_POST['botaoCardapio']== "Replicar"){

		$conexao = new MySQL();
		$mysqli = mysqli_connect('localhost','aluno','aluno', 'stayaware');
		$resultado = mysqli_query($mysqli,"SELECT * FROM itens");
		$itens = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

		$copia=  explode("-", $_POST['cardapios']);
		$dataCopia=$copia[0];
		$turnoCopia=$copia[1];

		$datap = implode('-', array_reverse(explode('/', $dataCopia)));

		$sql = "SELECT id_item FROM cardapio_item WHERE id_cardapio IN (SELECT id FROM cardapios WHERE dia='".$datap."' AND turno='".$turnoCopia."')";
		$resultado = $conexao->consulta($sql);

		$sql2 = "SELECT quant_item FROM cardapios WHERE dia='".$datap."' AND turno='".$turnoCopia."'";
		$resultado2 = $conexao->consulta($sql2);

		$cardapio = new Cardapio();
		$cardapio->setDia($_POST['dataCardapio']);
		$cardapio->setTurno($_POST['turnoCardapio']);
		$cardapio->setQuantidade($resultado2[0]['quant_item']);
		$cardapio->setItemCardapio($resultado[0]['id_item']);
		$cardapio->setItemCardapio2($resultado[1]['id_item']);
		$cardapio->setItemCardapio3($resultado[2]['id_item']);
	}
	//terminam aqui
	else{
		$cardapio = new Cardapio();
		$cardapio->setDia($_POST['dataCardapio']);
		$cardapio->setTurno($_POST['turnoCardapio']);
		$cardapio->setQuantidade($_POST['quantItem']);
		$cardapio->setItemCardapio($_POST['itemCardapio']);
		$cardapio->setItemCardapio2($_POST['itemCardapio2']);
		$cardapio->setItemCardapio3($_POST['itemCardapio3']);
	}
	$controleCardapio = new ControleCardapio();

	if($_POST['botaoCardapio'] == "Inserir"){
		$controleCardapio->acaocardapio("inserir",$cardapio);
	}else if($_POST['botaoCardapio'] == "Alterar"){
		$cardapio->setId($_POST['id']);
		$controleCardapio->acaocardapio("alterar",$cardapio);
	}else if($_POST['botaoCardapio'] == "Inativar"){
		$cardapio->setId($_POST['id']);
		$controleCardapio->acaocardapio("inativar",$cardapio);
	}else if($_POST['botaoCardapio'] == "Replicar"){
		$controleCardapio->acaocardapio("replicar",$cardapio);
	}
}


header("Location:listarCardapio.php");

?>
