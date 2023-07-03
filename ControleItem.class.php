
<?php
include_once "Item.class.php";
include_once "./BD/MySQL.class.php";


class ControleItem{

	public function acaoItem($acao,$item){

		if($acao=="inserir"){
			$this->inserir($item);
		}else if($acao=="alterar"){
			$this->alterar($item);
		}else if($acao=="inativar"){
			$this->excluir($item);
		}
		else if($acao=="excluir"){
			$this->excluir($item);
		}
	}

	public function inserir($item){
		$conexao = new MySQL();

		$destino = "./img/cardapios/".date("h_i_s_d").$item->getImgItem()['name'];

		if(move_uploaded_file($item->getImgItem()["tmp_name"],$destino)){
				$sql = "INSERT INTO itens (nome, marca, quantidade, uni_med, desc_nutri, status, img, quant_resi, tipo) VALUES  ('".$item->getNome()."','".$item->getMarca()."','".$item->getQuantidade()."','".$item->getUnidadeMed()."','".$item->getDescNutri()."','".$item->getStatus()."','".$destino."','".$item->getQuantResi()."','".$item->getTipo()."')";
				$resultado = $conexao->executa($sql);

				$sql="select * from itens where img='$destino'";//imagem como o parâmetro que é unico
				    $resultado = $conexao->consulta($sql);
				    //echo $sql;
				    if($resultado){
				      //$proposta= new Proposta();
				      $item->setId($resultado[0]['id']);

							if($item->getQuantResi()=="1"){
								$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem()."', '".$item->getId()."')";
								$resultado = $conexao->executa($sql);
							}
							if($item->getQuantResi()=="2"){
								$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem()."', '".$item->getId()."')";
								$resultado = $conexao->executa($sql);
								$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem2()."', '".$item->getId()."')";
								$resultado = $conexao->executa($sql);
							}
							if($item->getQuantResi()=="3"){
								$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem()."', '".$item->getId()."')";
								$resultado = $conexao->executa($sql);
								$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem2()."', '".$item->getId()."')";
								$resultado = $conexao->executa($sql);
								$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem3()."', '".$item->getId()."')";
								$resultado = $conexao->executa($sql);
							}

			}

				return $resultado;
			}
  }


	public function alterar($item){

		$conexao = new MySQL();

		if ($item->getImgItem()['error']==4){
			$sql = "update itens set nome = '".$item->getNome()."', marca = '".$item->getMarca()."', quantidade = '".$item->getQuantidade()."', uni_med = '".$item->getUnidadeMed()."', desc_nutri = '".$item->getDescNutri()."',quant_resi = '".$item->getQuantResi()."',status='".$item->getStatus()."', tipo='".$item->getTipo()."' where id =  ".$item->getId();
			$resultado = $conexao->executa($sql);

			if($item->getQuantResi()=="1"){
				$sql = "DELETE FROM item_residuo WHERE id_item =".$item->getId();
				$resultado = $conexao->executa($sql);
				$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem()."', '".$item->getId()."')";
				$resultado = $conexao->executa($sql);
			}
			if($item->getQuantResi()=="2"){
				$sql = "DELETE FROM item_residuo WHERE id_item =".$item->getId();
				$resultado = $conexao->executa($sql);
				$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem()."', '".$item->getId()."')";
				$resultado = $conexao->executa($sql);
				$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem2()."', '".$item->getId()."')";
				$resultado = $conexao->executa($sql);
			}
			if($item->getQuantResi()=="3"){
				$sql = "DELETE FROM item_residuo WHERE id_item =".$item->getId();
				$resultado = $conexao->executa($sql);
				$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem()."', '".$item->getId()."')";
				$resultado = $conexao->executa($sql);
				$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem2()."', '".$item->getId()."')";
				$resultado = $conexao->executa($sql);
				$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem3()."', '".$item->getId()."')";
				$resultado = $conexao->executa($sql);
			}

		}else{
			$destino = "./img/cardapios/".date("h_i_s_d").$item->getImgItem()['name'];

			if(move_uploaded_file($item->getImgItem()["tmp_name"],$destino)){
				$sql = "update itens set nome = '".$item->getNome()."', marca = '".$item->getMarca()."', quantidade = '".$item->getQuantidade()."', uni_med = '".$item->getUnidadeMed()."', desc_nutri = '".$item->getDescNutri()."',quant_resi = '".$item->getQuantResi()."',img = '".$destino."',status='".$item->getStatus()."', tipo='".$item->getTipo()."' where id =  ".$item->getId();
				$resultado = $conexao->executa($sql);

				if($item->getQuantResi()=="1"){
					$sql = "DELETE FROM item_residuo WHERE id_item =".$item->getId();
					$resultado = $conexao->executa($sql);
					$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem()."', '".$item->getId()."')";
					$resultado = $conexao->executa($sql);
				}
				if($item->getQuantResi()=="2"){
					$sql = "DELETE FROM item_residuo WHERE id_item =".$item->getId();
					$resultado = $conexao->executa($sql);
					$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem()."', '".$item->getId()."')";
					$resultado = $conexao->executa($sql);
					$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem2()."', '".$item->getId()."')";
					$resultado = $conexao->executa($sql);
				}
				if($item->getQuantResi()=="3"){
					$sql = "DELETE FROM item_residuo WHERE id_item =".$item->getId();
					$resultado = $conexao->executa($sql);
					$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem()."', '".$item->getId()."')";
					$resultado = $conexao->executa($sql);
					$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem2()."', '".$item->getId()."')";
					$resultado = $conexao->executa($sql);
					$sql = "INSERT INTO item_residuo (id_residuo, id_item) VALUES  ('".$item->getNameresiItem3()."', '".$item->getId()."')";
					$resultado = $conexao->executa($sql);
				}

			}

		}

	}

}

?>
