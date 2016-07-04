<?php


class Conexao
{

	private $conexao;
	private $db;
	public static $projeto = "SIFSC";
	public static $adm_email = "organizacao@sifsc.ifsc.usp.br";


	public function __construct($nome = NULL){
		$this->conexao=mysql_connect("localhost","DBUSER","PASSWORD") or die("Não foi possível a conexão com o Servidor!");
		$this->db=mysql_select_db("DBNAME",$this->conexao) or die("Não foi possível a seleção do Banco!");
	}

	public function __destruct(){
		if($conexao)mysql_close($conexao);
	}

	public function db_query($sql){
		$consulta = mysql_query($sql, $this->conexao) or die(mysql_error());
		return $consulta;
	}

	public function db_update($sql){
		$consulta = mysql_query($sql, $this->conexao) or False;
		return $consulta;
	}


?>
