<?php

require_once('class.conexao.php');

class ParticipaMinicurso
{
	private $codigo_minicurso;
	private $codigo_pessoa;
	private $codigo_evento;

	public function __construct()
	{
		$this->set_codigo_minicurso(NULL);
		$this->set_codigo_pessoa(NULL);
		$this->set_codigo_evento(NULL);
	}

	//setters
	public function set_codigo_minicurso($codigo_minicurso){$this->codigo_minicurso = $codigo_minicurso;}
	public function set_codigo_pessoa($codigo_pessoa){$this->codigo_pessoa = $codigo_pessoa;}
	public function set_codigo_evento($codigo_evento){$this->codigo_evento = $codigo_evento;}

	//getters
	public function get_codigo_minicurso(){return $this->codigo_minicurso;}
	public function get_codigo_pessoa(){return $this->codigo_pessoa;}
	public function get_codigo_evento(){return $this->codigo_evento;}

	public function find_by_codigo($codigo_pessoa, $codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM ParticipaMinicurso WHERE  codigo_pessoa='$codigo_pessoa' AND codigo_evento='$codigo_evento'");
		$total = mysql_num_rows($consulta);

		if ($total==1)
		{
			$this->set_codigo_minicurso(mysql_result($consulta,0,'codigo_minicurso'));
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));

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

	public function find_by_codigo_pessoa($codigo_pessoa)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM ParticipaMinicurso WHERE codigo_pessoa='$codigo_pessoa'");
		$total = mysql_num_rows($consulta);

		if ($total==1)
		{
			$this->set_codigo_minicurso(mysql_result($consulta,0,'codigo_minicurso'));
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));

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

	public static function find_by_minicurso_evento($codigo_minicurso, $codigo_evento)
	{


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT ParticipaMinicurso.codigo_pessoa AS codigo
										FROM ParticipaMinicurso, Pessoa
										WHERE
										ParticipaMinicurso.codigo_minicurso = '" . $codigo_minicurso . "'
										AND ParticipaMinicurso.codigo_evento = '" . $codigo_evento . "'
										AND Pessoa.codigo_pessoa = ParticipaMinicurso.codigo_pessoa
										ORDER BY Pessoa.nome");
		$conexao = null;

		return $consulta;
	}

	public static function find_by_minicurso_evento_limited($codigo_minicurso, $codigo_evento, $pagina_atual, $limite)
	{


		$conexao = new Conexao();

		if (!$pagina_atual)
		{
			$contador_pagina = "1";
		}
		else
		{
			$contador_pagina = $pagina_atual;
		}

		$sql = "SELECT codigo_pessoa AS codigo FROM ParticipaMinicurso WHERE codigo_minicurso = '" . $codigo_minicurso . "' AND codigo_evento = '" . $codigo_evento . "'";

		$registro_inicial = (($contador_pagina - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;

		return $intervalo;
	}

	public static function find_all()
	{


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM ParticipaMinicurso ORDER BY codigo_minicurso DESC");
		$conexao = null;

		return $consulta;
	}


	public static function find_all_by_evento($codigo_evento)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM ParticipaMinicurso WHERE codigo_evento = " . $codigo_evento . "ORDER BY codigo_minicurso DESC");
		$conexao = null;

		return $consulta;
	}


	public function insert()
	{
		$conexao = new Conexao();

		$sql = "INSERT INTO ParticipaMinicurso (codigo_minicurso, codigo_pessoa, codigo_evento) VALUES ('$this->codigo_minicurso', '$this->codigo_pessoa', '$this->codigo_evento');";

		if($conexao->db_update($sql))
		{
			$conexao = null;
			return True;
		}
		else
		{
			//echo "Erro na Insercao<br>";
			$conexao = null;
			return False;
		}
	}

	public function update($codigo_pessoa,$codigo_evento)
	{
		$conexao = new Conexao();

		$sql = "UPDATE ParticipaMinicurso SET codigo_pessoa = '$this->codigo_pessoa', codigo_evento = '$this->codigo_evento', codigo_minicurso = $this->codigo_minicurso
		WHERE  codigo_pessoa='$codigo_pessoa' AND codigo_evento='$codigo_evento'";

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

	public function remove($codigo_pessoa,$codigo_evento)
	{
		$conexao = new Conexao();

		$sql = "DELETE FROM ParticipaMinicurso WHERE codigo_minicurso = $this->codigo_minicurso AND codigo_pessoa='$codigo_pessoa' AND codigo_evento='$codigo_evento'";

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

	public function remove_by_evento($codigo_evento)
	{
		$conexao = new Conexao();

		$sql = "DELETE FROM ParticipaMinicurso WHERE codigo_minicurso = $this->codigo_minicurso AND codigo_pessoa='$this->codigo_pessoa' AND codigo_evento='$codigo_evento'";

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
