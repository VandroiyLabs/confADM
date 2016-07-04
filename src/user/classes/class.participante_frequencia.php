<?php

require_once('class.conexao.php');

class ParticipanteFrequencia
{

	private $codigo_pessoa;
	private $codigo_evento;
	private $frequencia_palestras;
	private $frequencia_minicurso;
	private $frequencia_arte;
	private $frequencia_workshop;
	private $frequencia_oral;

	public function __construct()
	{
		$this->set_codigo_pessoa(NULL);
		$this->set_codigo_evento(NULL);
		$this->set_frequencia_palestras(NULL);
		$this->set_frequencia_minicurso(NULL);
		$this->set_frequencia_arte(NULL);
		$this->set_frequencia_workshop(NULL);
		$this->set_frequencia_oral(NULL);
	}

	//setters
	public function set_codigo_pessoa($codigo_pessoa){$this->codigo_pessoa = $codigo_pessoa;}
	public function set_codigo_evento($codigo_evento){$this->codigo_evento = $codigo_evento;}
	public function set_frequencia_palestras($f){$this->frequencia_palestras = $f;}
	public function set_frequencia_minicurso($f){$this->frequencia_minicurso = $f;}
	public function set_frequencia_arte($f){$this->frequencia_arte = $f;}
	public function set_frequencia_workshop($f){$this->frequencia_workshop = $f;}
	public function set_frequencia_oral($f){$this->frequencia_oral = $f;}

	//getters
	public function get_codigo_pessoa(){return $this->codigo_pessoa;}
	public function get_codigo_evento(){return $this->codigo_evento;}
	public function get_frequencia_palestras(){return $this->frequencia_palestras;}
	public function get_frequencia_minicurso(){return $this->frequencia_minicurso;}
	public function get_frequencia_arte(){return $this->frequencia_arte;}
	public function get_frequencia_workshop(){return $this->frequencia_workshop;}
	public function get_frequencia_oral(){return $this->frequencia_oral;}


	//
	// Função específica para encontrar as frequencias por pessoa
	// e por evento
	//
	public function find_by_codigo_pessoa($codigo_pessoa, $codigo_evento)
	{

		$conexao = new Conexao();
		$sql = "SELECT * FROM ParticipanteFrequencia
										WHERE codigo_pessoa='$codigo_pessoa' AND codigo_evento='$codigo_evento'";

		$consulta = $conexao->db_query($sql);

		$total = mysql_num_rows($consulta);

		if ($total==1)
		{
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_frequencia_palestras(mysql_result($consulta,0,'frequencia_palestras'));
			$this->set_frequencia_minicurso(mysql_result($consulta,0,'frequencia_minicurso'));
			$this->set_frequencia_arte(mysql_result($consulta,0,'frequencia_arte'));
			$this->set_frequencia_workshop(mysql_result($consulta,0,'frequencia_workshop'));
			$this->set_frequencia_oral(mysql_result($consulta,0,'frequencia_oral'));

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

	public static function find_all_by_evento_by_filtro($codigo_evento, $filtro="")
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM ParticipanteFrequencia
										WHERE codigo_evento='$codigo_evento' ".$filtro);
		$conexao = null;

		return $consulta;
	}


	//
	// Inserindo nova entrada no banco
	//
	public function insert()
	{
		$conexao = new Conexao();

		$sql = "INSERT INTO ParticipanteFrequencia
				(codigo_pessoa,  codigo_evento, frequencia_palestras, frequencia_minicurso,frequencia_arte, frequencia_workshop, frequencia_oral)
				VALUES
				('$this->codigo_pessoa',  '$this->codigo_evento', '$this->frequencia_palestras', '$this->frequencia_minicurso', '$this->frequencia_arte', '$this->frequencia_workshop',, '$this->frequencia_oral');";

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

		$sql = "UPDATE ParticipanteFrequencia SET  frequencia_palestras = '$this->frequencia_palestras', frequencia_minicurso = '$this->frequencia_minicurso', frequencia_arte = '$this->frequencia_arte', frequencia_workshop = '$this->frequencia_workshop', frequencia_oral = '$this->frequencia_oral'
		WHERE codigo_pessoa = $this->codigo_pessoa and codigo_evento = $this->codigo_evento ";

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


	//
	// Começando do zero...
	//
	public function clear_all()
	{
		$conexao = new Conexao();

		$sql = "TRUNCATE TABLE ParticipanteFrequencia;";

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
}


?>
