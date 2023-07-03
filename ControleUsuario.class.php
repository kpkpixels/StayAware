<?php
include_once "Usuario.class.php";
include_once "./BD/MySQL.class.php";


class ControleUsuario{

	public function acaoUsuario($acao,$usuario){

		if($acao=="inserir"){
			$this->inserir($usuario);
		}else if($acao=="alterar"){
			$this->alterar($usuario);
		}else if($acao=="alterar_p"){
			$this->alterar_p($usuario);
		}else if($acao=="inativar"){
			$this->excluir($usuario);
		}
	}

	public function listarTodos(){
		$conexao = new MySQL();
		$sql = "select * from usuarios";
		$resultado = $conexao->consulta($sql);
		if($resultado){
			$usuarios = array();
			foreach($resultado as $usuario){
				$us = new usuario();
				$us->setId($usuario['id']);
				$us->setNome($usuario['nome']);
        $us->setSobrenome($usuario['sobrenome']);
				$us->setStatus($usuario['status']);
				$us->setLogin($usuario['login']);
				$us->setSenha($usuario['senha']);
				$us->setTelefone($usuario['telefone']);
				$us->setEmail($usuario['email']);
				$us->setFuncao($usuario['funcao']);
				$usuarios[] = $us;
			}
			return $usuarios;
		}else{
			return "vazio";
		}

	}

	public function listarUm($id){
		$conexao = new MySQL();
		$sql = "select * from usuario where ID=$id";
		$resultado = $conexao->consulta($sql);
		if($resultado){
			$us = new usuario();
			$us->setId($usuario['id']);
			$us->setNome($usuario['nome']);
			$us->setSobrenome($usuario['sobrenome']);
			$us->setStatus($usuario['status']);
			$us->setLogin($usuario['login']);
			$us->setSenha($usuario['senha']);
			$us->setTelefone($usuario['telefone']);
			$us->setEmail($usuario['email']);
			$us->setFuncao($usuario['funcao']);
			return $us;
		}else{
			return "vazio";
		}

	}


	public function inserir($usuario){
		$conexao = new MySQL();

		$consulta = mysqli_query("SELECT * FROM usuarios WHERE nome_log=".$usuario->getNome_log());
		$linha = mysqli_num_rows($consulta);

if($linha == 0){
	$sql = "INSERT INTO usuarios (nome, sobrenome, senha, telefone, email, status, nome_log, funcao) VALUES  ('".$usuario->getNome()."','".$usuario->getSobrenome()."','".$usuario->getSenha()."','".$usuario->getTelefone()."','".$usuario->getEmail()."@feliz.ifrs.edu.br','".$usuario->getStatus()."','".$usuario->getNome_log()."','".$usuario->getFuncao()."')";
	$resultado = $conexao->executa($sql);
	return $resultado;
}
else
{
die();
}


  }


	public function alterar($usuario){

		if(isset($_POST['reiniciar'])){
			$usuario->setSenha("0123");
		}

		$conexao = new MySQL();
		$sql = "update usuarios set nome = '".$usuario->getNome()."', sobrenome = '".$usuario->getSobrenome()."', senha = '".$usuario->getSenha()."', telefone = '".$usuario->getTelefone()."', nome_log = '".$usuario->getNome_log()."',email = '".$usuario->getEmail()."@feliz.ifrs.edu.br',funcao = '".$usuario->getFuncao()."',status='".$usuario->getStatus()."' where ID =  ".$usuario->getId();
		echo $sql;
		$resultado = $conexao->executa($sql);
		return $resultado;
	}

	public function alterar_p($usuario){
		$conexao = new MySQL();
		$sql = "update usuarios set nome = '".$usuario->getNome()."', sobrenome = '".$usuario->getSobrenome()."', senha = '".$usuario->getSenha()."', telefone = '".$usuario->getTelefone()."', nome_log = '".$usuario->getNome_log()."',email = '".$usuario->getEmail()."@feliz.ifrs.edu.br' where ID =  ".$usuario->getId();
		$resultado = $conexao->executa($sql);
		return $resultado;
	}

	public function inativar($usuario){
		$conexao = new MySQL();

		$sql = "select status from funcionarios where ID=".$usuario->getId();
		$valorStatus= $conexao->executa($sql);

		if ($valorStatus=="Ativo"){
				$usuario->setStatus("Inativo");
				$sql = "update usuarios set status='Inativo' WHERE ID=".$usuario->getId();

		}

		if ($valorStatus=="Inativo"){
				$usuario->setStatus("Ativo");
				$sql = "update usuarios set status='Ativo' WHERE ID=".$usuario->getId();

		}
		//talvez um select do status
		//
		///
		/*if ($usuario["status"]=="Ativo") {
			$sql = "update usuarios set status='Inativo' WHERE ID=".$usuario->getId();
		}
		if ($usuario["status"]=="Inativo") {
			$sql = "update usuarios set status='Ativo' WHERE ID=".$usuario->getId();
		}*/
		//echo $sql;
		$resultado = $conexao->executa($sql);
		return $resultado;
	}
	public function excluir($usuario){
		$conexao = new MySQL();
		$sql = "delete from usuarios where id = ".$usuario->getId();
		$resultado = $conexao->executa($sql);
		return $resultado;
	}

}

?>
