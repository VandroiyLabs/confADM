<?php

require_once('class.conexao.php');

class Minicurso
{

	private $codigo_minicurso;
	private $codigo_evento;
	private $titulo;
	private $vagas;
	private $inscritos;
	private $descricao;
	private $tipo;
	private $responsavel;

	public function __construct()
	{
		$this->set_codigo_minicurso(NULL);
		$this->set_codigo_evento(NULL);
		$this->set_titulo(NULL);
		$this->set_vagas(NULL);
		$this->set_inscritos(NULL);
		$this->set_descricao(NULL);
		$this->set_tipo(NULL);
		$this->set_responsavel(NULL);
	}

	//setters
	public function set_codigo_minicurso($codigo_minicurso){$this->codigo_minicurso = $codigo_minicurso;}
	public function set_codigo_evento($codigo_evento){$this->codigo_evento = $codigo_evento;}
	public function set_titulo($titulo){$this->titulo = $titulo;}
	public function set_vagas($vagas){$this->vagas = $vagas;}
	public function set_inscritos($inscritos){$this->inscritos = $inscritos;}
	public function set_descricao($descricao){$this->descricao = $descricao;}
	public function set_tipo($tipo){$this->tipo = $tipo;}
	public function set_responsavel($responsavel){$this->responsavel = $responsavel;}

	//getters
	public function get_codigo_minicurso(){return $this->codigo_minicurso;}
	public function get_codigo_evento(){return $this->codigo_evento;}
	public function get_titulo(){return $this->titulo;}
	public function get_vagas(){return $this->vagas;}
	public function get_inscritos(){return $this->inscritos;}
	public function get_descricao(){return $this->descricao;}
	public function get_tipo(){return $this->tipo;}
	public function get_responsavel(){return $this->responsavel;}

	public function find_by_codigo($codigo_minicurso)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Minicurso WHERE codigo_minicurso='$codigo_minicurso'");
		$total = mysql_num_rows($consulta);

		if ($total==1)
		{

			$this->set_codigo_minicurso(mysql_result($consulta,0,'codigo_minicurso'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_titulo(mysql_result($consulta,0,'titulo'));
			$this->set_vagas(mysql_result($consulta,0,'vagas'));
			$this->set_inscritos(mysql_result($consulta,0,'inscritos'));
			$this->set_descricao(mysql_result($consulta,0,'descricao'));
			$this->set_tipo(mysql_result($consulta,0,'tipo'));
			$this->set_responsavel(mysql_result($consulta,0,'responsavel'));

			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		};
	}


	public function find_by_titulo($titulo)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Minicurso WHERE titulo='$titulo'");
		$total = mysql_num_rows($consulta);

		if ($total==1)
		{
			$this->set_codigo_minicurso(mysql_result($consulta,0,'codigo_minicurso'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_titulo(mysql_result($consulta,0,'titulo'));
			$this->set_vagas(mysql_result($consulta,0,'vagas'));
			$this->set_inscritos(mysql_result($consulta,0,'inscritos'));
			$this->set_descricao(mysql_result($consulta,0,'descricao'));
			$this->set_tipo(mysql_result($consulta,0,'tipo'));
			$this->set_responsavel(mysql_result($consulta,0,'responsavel'));

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

	public static function find_all()
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Minicurso ORDER BY codigo_minicurso DESC");
		$conexao = null;

		return $consulta;
	}

	public static function find_all_by_evento($codigo_evento)
	{
		$conexao = new Conexao($codigo_evento);

		$consulta = $conexao->db_query("SELECT * FROM Minicurso WHERE codigo_evento='$codigo_evento'ORDER BY codigo_minicurso DESC");
		$conexao = null;

		return $consulta;
	}

	public static function find_all_by_evento_alfabetico($codigo_evento)
	{

		$conexao = new Conexao($codigo_evento);

		$consulta = $conexao->db_query("SELECT * FROM Minicurso WHERE codigo_evento='$codigo_evento'ORDER BY titulo");
		$conexao = null;

		return $consulta;
	}

	public static function find_all_available_by_evento($codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Minicurso where codigo_evento='$codigo_evento' and inscritos < vagas ORDER BY titulo");
		$conexao = null;

		return $consulta;
	}

	public static function find_by_evento($codigo_evento)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Minicurso WHERE codigo_evento = $codigo_evento ORDER BY inscritos DESC");
		$conexao = null;

		return $consulta;
	}

	public static function find_by_evento_alfabetico($codigo_evento)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Minicurso WHERE codigo_evento = $codigo_evento ORDER BY titulo");
		$conexao = null;

		return $consulta;
	}

	public function insert()
	{
		$conexao = new Conexao();

		$sql = "INSERT INTO Minicurso (codigo_evento,titulo, vagas, inscritos, descricao, tipo, responsavel) VALUES ('$this->codigo_evento','$this->titulo', '$this->vagas', '$this->inscritos', '$this->descricao', '$this->tipo', '$this->responsavel');";

		if($conexao->db_update($sql))
		{
			$consulta = $conexao->db_query("SELECT MAX(codigo_minicurso) as codigo_minicurso FROM Minicurso");
			$this->set_codigo_minicurso(mysql_result($consulta,0,'codigo_minicurso'));

			$conexao = null;

			return True;
		}
		else
		{
			$conexao = null;
			return False;
		}

	}


	public function insert_inscritos()
	{
		$conexao = new Conexao();

		$sql = "UPDATE Minicurso SET inscritos = inscritos + 1 WHERE codigo_minicurso = $this->codigo_minicurso;";

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

	public function remove_inscritos()
	{
		$conexao = new Conexao();

		$sql = "UPDATE Minicurso SET inscritos = inscritos - 1 WHERE codigo_minicurso = $this->codigo_minicurso;";

		if ( $conexao->db_update($sql) )
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

	public function update()
	{
		$conexao = new Conexao();

		$sql = "UPDATE Minicurso SET codigo_evento = '$this->codigo_evento',titulo = '$this->titulo', vagas = '$this->vagas', inscritos = '$this->inscritos', descricao = '$this->descricao', tipo = '$this->tipo', responsavel = '$this->responsavel'
		WHERE codigo_minicurso = $this->codigo_minicurso";

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

	public function remove()
	{
		$conexao = new Conexao();

		$sql = "DELETE FROM Minicurso WHERE codigo_minicurso='$this->codigo_minicurso'";

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
