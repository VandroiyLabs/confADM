<?php

require_once('class.conexao.php');

class ParticipaPremiacao{

	private $codigo_evento;
	private $codigo_pessoa;
	private $dia;
	private $hora;

	public function __construct()
	{
		$this->set_codigo_evento(NULL);
		$this->set_codigo_pessoa(NULL);
		$this->set_dia(NULL);
		$this->set_hora(NULL);
	}

	//setters
	public function set_codigo_evento($codigo_evento){$this->codigo_evento = $codigo_evento;}
	public function set_codigo_pessoa($codigo_pessoa){$this->codigo_pessoa = $codigo_pessoa;}
	public function set_dia($dia){$this->dia = $dia;}
	public function set_hora($hora){$this->hora = $hora;}

	//getters
	public function get_codigo_evento(){return $this->codigo_evento;}
	public function get_codigo_pessoa(){return $this->codigo_pessoa;}
	public function get_dia(){return $this->dia;}
	public function get_hora(){return $this->hora;}


	public function find_by_codigo($codigo_pessoa, $codigo_evento){

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM ParticipaPremiacao WHERE codigo_pessoa ='$codigo_pessoa' AND codigo_evento='$codigo_evento'");

		$total = mysql_num_rows($consulta);

		if ($total==1)
		{
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_dia(mysql_result($consulta,0,'dia'));
			$this->set_hora(mysql_result($consulta,0,'hora'));

			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else
		{
			$conexao = null;
			return False;
		};
	}

	public function find_all_by_evento( $codigo_evento)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT Pessoa.codigo_pessoa codigo_pessoa, nivel, nome, curso, orientador, Resumo.tempo tempo FROM ParticipaPremiacao JOIN Pessoa on Pessoa.codigo_pessoa = ParticipaPremiacao.codigo_pessoa JOIN Inscricao ON ParticipaPremiacao.codigo_pessoa = Inscricao.codigo_pessoa and ParticipaPremiacao.codigo_evento = Inscricao.codigo_evento JOIN Resumo ON Resumo.codigo_resumo = Inscricao.codigo_resumo  WHERE  Inscricao.codigo_evento='$codigo_evento' order by nivel, nome");
		$conexao = null;
		return $consulta;

	}
}


?>
