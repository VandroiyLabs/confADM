<?php

require_once('class.conexao.php');

class Log
{

	// Identifica unicamente o log
	private $codigo_log;
	// Identifica o administrador
	private $adm_usuario;
	// Identifica o evento do registro
	private $codigo_evento;
	// Operacao realizada
	private $operacao;
	// Detalhes adicionais sobre a operacao
	private $detalhes;
	// Horario em que a operacao realizou
	private $horario;

	// Construtor da classe
	public function __construct()
	{
		$this->set_adm_usuario(NULL);
		$this->set_codigo_evento(NULL);
		$this->set_operacao(NULL);
		$this->set_detalhes(NULL);
		$this->set_horario(NULL);
	}

	//setters
	public function set_codigo_log($codigo_log) {$this->codigo_log = $codigo_log;}
	public function set_adm_usuario($adm_usuario) {$this->adm_usuario = $adm_usuario;}
	public function set_codigo_evento($codigo_evento) {$this->codigo_evento = $codigo_evento;}
	public function set_operacao($operacao) {$this->operacao = $operacao;}
	public function set_detalhes($detalhes) {$this->detalhes = $detalhes;}
	public function set_horario($horario) {$this->horario = $horario;}

	//getters
	public function get_codigo_log() {return $this->codigo_log;}
	public function get_adm_usuario() {return $this->adm_usuario;}
	public function get_codigo_evento() {return $this->codigo_evento;}
	public function get_operacao() {return $this->operacao;}
	public function get_detalhes() {return $this->detalhes;}
	public function get_horario() {return $this->horario;}


	/*
		Função para encontrar um único registro de um determinado administrador
		e para um dado evento.
	*/
	public function find_by_log($codigo_log)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Log WHERE codigo_log='$codigo_log'");
		$total = mysql_num_rows($consulta);

		if ($total==1)
		{

			$this->set_codigo_log(mysql_result($consulta,0,'codigo_log'));
			$this->set_adm_usuario(mysql_result($consulta,0,'adm_usuario'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_operacao(mysql_result($consulta,0,'operacao'));
			$this->set_detalhes(mysql_result($consulta,0,'detalhes'));
			$this->set_horario(mysql_result($consulta,0,'horario'));

			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		};
	}


	/*
		Função para encontrar todos os registros a um dado administrador
		e para um dado evento
	*/
	public function find_by_adm_evento($adm_usuario, $codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Log WHERE adm_usuario='$adm_usuario' AND codigo_evento='$codigo_evento'");
		$conexao = null;

		return $consulta;
	}


	/*
		Função para encontrar todos os registros relativos a uma dada operação
		e para um dado evento
	*/
	public function find_by_operacao_evento($operacao, $codigo_evento)
	{

		$conexao = new Conexao();
		$consulta = $conexao->db_query("SELECT * FROM Log WHERE operacao='$operacao' AND codigo_evento='$codigo_evento'");
		$conexao = null;
		return $consulta;
	}


	/*
		Função para encontrar todos os registros dentre todos os eventos
	*/
	public static function find_all()
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Log ORDER BY adm_usuario DESC");
		$conexao = null;

		return $consulta;
	}


	/*
		Insere novo registro ao banco
	*/
	public function insert()
	{
		$conexao = new Conexao();
		$sql = "INSERT INTO Log (adm_usuario, codigo_evento, operacao, detalhes, horario) VALUES ('$this->adm_usuario', '$this->codigo_evento', '$this->operacao', '$this->detalhes', NOW());";

		if($conexao->db_update($sql))
		{
			$conexao = null;

			return True;
		}
		else
		{
			$conexao = null;
			return False;
		}

	}

}


?>
