<?php
include "BancoDeDados.class.php";
include "Configuracao.inc.php";

class MySQL extends BancoDeDados{

	public function __construct(){
		//contrução da conexao
		$this->conexao = mysqli_connect('localhost','aluno','aluno', 'stayaware');
	}

	public function __destruct(){
		mysqli_close($this->conexao);
	}

	public function executa($sql){
		$retornoExecucao = mysqli_query($this->conexao,$sql);
		return $retornoExecucao;
	}

	public function consulta($select){
		$resultado_consulta = mysqli_query($this->conexao,$select);
		$resultados = mysqli_fetch_all($resultado_consulta, MYSQLI_ASSOC);
		/*$query = mysqli_query($this->conexao,$select);
		$retorno = array();
		$dados = array();
		while($retorno = mysqli_fetch_array($query)){
			$dados[] = $retorno;
		}*/
		return $resultados;
	}
}
?>
