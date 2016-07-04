<?php

require_once('class.conexao.php');

class Calendar
{

	private $id;
	private $codigo_evento;
	private $aux;
	private $autor;
	private $instituicao;
   	private $chamada;
	private $titulo;
	private $resumo;
	private $start;
	private $end;
	private $color;
	private $local;


	public function __construct()
	{

		$this->set_id(NULL);
		$this->set_codigo_evento(NULL);
		$this->set_end(NULL);
		$this->set_color(NULL);
		$this->set_local(NULL);
		$this->set_chamada(NULL);
		$this->set_aux(NULL);
		$this->set_autor(NULL);
		$this->set_instituicao(NULL);
		$this->set_resumo(NULL);
		$this->set_titulo(NULL);
		$this->set_start(NULL);

	}



	//setters
	public function set_id($id){$this->id = $id;}
	public function set_codigo_evento($codigo_evento){$this->codigo_evento = $codigo_evento;}
	public function set_end($end){$this->end = $end;}
	public function set_color($color){$this->color = $color;}
	public function set_local($local){$this->local = $local;}
	public function set_chamada($chamada){$this->chamada = $chamada;}
	public function set_aux($aux){$this->aux = $aux;}
	public function set_autor($autor){$this->autor = $autor;}
	public function set_instituicao($instituicao){$this->instituicao = $instituicao;}
	public function set_resumo($resumo){$this->resumo = $resumo;}
	public function set_titulo($titulo){$this->titulo = $titulo;}
	public function set_start($start){$this->start = $start;}

	//getters
	public function get_id(){return $this->id;}
	public function get_codigo_evento(){return $this->codigo_evento;}
	public function get_end(){return $this->end;}
	public function get_color(){return $this->color;}
	public function get_local(){return $this->local;}
	public function get_chamada(){return $this->chamada;}
	public function get_aux(){return $this->aux;}
	public function get_autor(){return $this->autor;}
	public function get_instituicao(){return $this->instituicao;}
	public function get_resumo(){return $this->resumo;}
	public function get_titulo(){return $this->titulo;}
	public function get_start(){return $this->start;}


	public function find_by_pessoa_evento($id, $codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Calendar WHERE id='$id' and codigo_evento='$codigo_evento'");

		$total = mysql_num_rows($consulta);

		if ($total==1)
		{

			$this->set_id(mysql_result($consulta,0,'id'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_end(mysql_result($consulta,0,'end'));
			$this->set_color(mysql_result($consulta,0,'color'));
			$this->set_local(mysql_result($consulta,0,'local'));
			$this->set_chamada(mysql_result($consulta,0,'chamada'));
			$this->set_aux(mysql_result($consulta,0,'aux'));
			$this->set_autor(mysql_result($consulta,0,'autor'));
			$this->set_instituicao(mysql_result($consulta,0,'instituicao'));
			$this->set_resumo(mysql_result($consulta,0,'resumo'));
			$this->set_titulo(mysql_result($consulta,0,'titulo'));
			$this->set_start(mysql_result($consulta,0,'start'));

			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		};
	}

	public static function find_palestrante_by_evento($codigo_evento)
	{


		$conexao = new Conexao();
		$sql = "SELECT autor FROM Calendar WHERE codigo_evento = '$codigo_evento' AND autor <> ''  ORDER BY autor";
		$consulta = $conexao->db_query($sql);
		//echo $sql;
		$conexao = null;

		return $consulta;
	}

}


?>
