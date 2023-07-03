<?php

//Nome do arquivo na máquina do usuário
	$nome = $_FILES['itemImg']['name'];

	//Nome temporário do arquivo
	$nomeTemporario = $_FILES['itemImg']['tmp_name'];


	$destino = "./img/cardapios/";

print_r($_FILES);

	if(move_uploaded_file($nomeTemporario,$destino.$nome)){
		echo "entrou";
		//echo "<script type='javascript'>alert('Upload realizado com sucesso!')</script>";
		header("Location:listarItem.php");
	}else{
		echo "<script type='javascript'>alert('Upload não realizado com sucesso!')</script>";
	}


?>
