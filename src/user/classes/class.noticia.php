<?php

require_once('class.conexao.php');

class Noticia{

	private $codigo_noticia;
	private $titulo;
	private $conteudo;
	private $codigo_evento;
	private $data;
	private $autor;

	public function __construct()
	{
		$this->set_codigo_noticia(NULL);
		$this->set_titulo(NULL);
		$this->set_conteudo(NULL);
		$this->set_codigo_evento(NULL);
		$this->set_autor(NULL);
	}

	//setters
	public function set_codigo_noticia($codigo_noticia){$this->codigo_noticia = $codigo_noticia;}
	public function set_titulo($titulo){$this->titulo = $titulo;}
	public function set_conteudo($conteudo){$this->conteudo = $conteudo;}
	public function set_codigo_evento($codigo_evento){$this->codigo_evento = $codigo_evento;}
	public function set_autor($autor){$this->autor = $autor;}
	public function set_data($data){$this->data = $data;}

	//getters
	public function get_codigo_noticia(){return $this->codigo_noticia;}
	public function get_titulo(){return $this->titulo;}
	public function get_conteudo(){return $this->conteudo;}
	public function get_codigo_evento(){return $this->codigo_evento;}
	public function get_autor(){return $this->autor;}
	public function get_data(){return $this->data;}

	public function find_by_codigo($codigo_noticia)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Noticia WHERE codigo_noticia='$codigo_noticia'");
		$total = mysql_num_rows($consulta);

		if ($total==1)
		{

			$this->set_codigo_noticia(mysql_result($consulta,0,'codigo_noticia'));
			$this->set_titulo(mysql_result($consulta,0,'titulo'));
			$this->set_conteudo(mysql_result($consulta,0,'conteudo'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_autor(mysql_result($consulta,0,'autor'));
			$this->set_data(mysql_result($consulta,0,'data'));

			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		};
	}

	public static function find_by_evento($codigo_evento)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Noticia WHERE codigo_evento='$codigo_evento' ORDER BY codigo_noticia DESC");
		$conexao = null;

		return $consulta;

	}

	public function find_by_evento_ultima($codigo_evento)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Noticia WHERE codigo_evento='$codigo_evento' ORDER BY codigo_noticia DESC limit 1");
		$total = mysql_num_rows($consulta);

		if ( $total == 1 )
		{

			$this->set_codigo_noticia(mysql_result($consulta,0,'codigo_noticia'));
			$this->set_titulo(mysql_result($consulta,0,'titulo'));
			$this->set_conteudo(mysql_result($consulta,0,'conteudo'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_autor(mysql_result($consulta,0,'autor'));
			$this->set_data(mysql_result($consulta,0,'data'));

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

		$consulta = $conexao->db_query("SELECT * FROM Noticia ORDER BY codigo_noticia DESC");
		$conexao = null;

		return $consulta;
	}


	public function insert()
	{
		$conexao = new Conexao();

		$sql = "INSERT INTO Noticia (titulo, conteudo, codigo_evento, autor, data) " .
				"VALUES ('$this->titulo', '$this->conteudo', '$this->codigo_evento', '$this->autor', CURDATE());";

		if($conexao->db_update($sql))
		{
			$consulta = $conexao->db_query("SELECT MAX(codigo_noticia) codigo FROM Noticia");
			$this->set_codigo_noticia(mysql_result($consulta,0,'codigo'));

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

		$sql = "UPDATE Noticia SET titulo = '$this->titulo', conteudo = '$this->conteudo', codigo_evento = '$this->codigo_evento', autor = '$this->autor'
		WHERE codigo_noticia = $this->codigo_noticia";

		if($conexao->db_update($sql))
		{
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		}
	}

	public function remove()
	{
		$conexao = new Conexao();

		$sql = "DELETE FROM Noticia WHERE codigo_noticia='$this->codigo_noticia'";

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
