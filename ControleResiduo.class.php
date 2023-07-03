
<?php
include_once "Residuo.class.php";
include_once "./BD/MySQL.class.php";


class ControleResiduo{

	public function acaoResiduo($acao,$residuo){

		if($acao=="inserir"){
			$this->inserir($residuo);
		}else if($acao=="alterar"){
			$this->alterar($residuo);
		}else if($acao=="inativar"){
			$this->excluir($residuo);
		}
		else if($acao=="excluir"){
			$this->excluir($residuo);
		}
	}


	public function inserir($residuo){
		$conexao = new MySQL();

		$destinoRe = "./img/cardapios/residuos/".date("h_i_s_d").$residuo->getImgResi()['name'];

		if(move_uploaded_file($residuo->getImgResi()["tmp_name"],$destinoRe)){
				$sql = "INSERT INTO residuos (nome, tipo, img, status) VALUES  ('".$residuo->getNome()."','".$residuo->getTipo()."','".$destinoRe."','".$residuo->getStatus()."')";
				$resultado = $conexao->executa($sql);
				return $resultado;
			}
	}


	public function alterar($residuo){

		$conexao = new MySQL();

		if ($residuo->getImgResi()['error']==4){
			$sql = "UPDATE residuos set nome = '".$residuo->getNome()."',tipo = '".$residuo->getTipo()."',status='".$residuo->getStatus()."' where id =  ".$residuo->getId();
		}else{
			$destinoRe = "./img/cardapios/residuos/".date("h_i_s_d").$residuo->getImgResi()['name'];

			if(move_uploaded_file($residuo->getImgResi()["tmp_name"],$destinoRe)){
					$sql = "UPDATE residuos set nome = '".$residuo->getNome()."',tipo = '".$residuo->getTipo()."',img = '".$destinoRe."',status='".$residuo->getStatus()."' where id =  ".$residuo->getId();
				}
		}
		$resultado = $conexao->executa($sql);
		return $resultado;
	}

}
?>
