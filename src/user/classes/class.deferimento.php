<?php

require_once('class.conexao.php');

class Deferimento
{

	private $codigo_evento;
	private $codigo_pessoa;
  private $codigo_resumo;
	private $codigo_arte;
	private $comentario;
	private $adm_usuario;
	private $adm_tipo;
	private $desconta_ponto;
	private $data;


	public function __construct()
	{
		$this->set_codigo_evento(NULL);
		$this->set_codigo_pessoa(NULL);
		$this->set_codigo_resumo(NULL);
		$this->set_codigo_arte(NULL);
		$this->set_comentario(NULL);
		$this->set_adm_usuario(NULL);
		$this->set_adm_tipo(NULL);
		$this->set_desconta_ponto(NULL);
		$this->set_data(NULL);
	}


	public function set_codigo_evento($codigo_evento){$this->codigo_evento = $codigo_evento;}
	public function set_codigo_pessoa($codigo_pessoa){$this->codigo_pessoa = $codigo_pessoa;}
 	public function set_codigo_resumo($codigo_resumo){$this->codigo_resumo = $codigo_resumo;}
	public function set_codigo_arte($codigo_arte){$this->codigo_arte = $codigo_arte;}
	public function set_comentario($comentario){$this->comentario = $comentario;}
	public function set_adm_usuario($adm_usuario){$this->adm_usuario = $adm_usuario;}
	public function set_adm_tipo($adm_tipo){$this->adm_tipo = $adm_tipo;}
	public function set_desconta_ponto($desconta_ponto){$this->desconta_ponto = $desconta_ponto;}
	public function set_data($data){$this->data = $data;}

	//getters

	public function get_codigo_evento(){return $this->codigo_evento;}
	public function get_codigo_pessoa(){return $this->codigo_pessoa;}
 	public function get_codigo_resumo(){return $this->codigo_resumo;}
	public function get_codigo_arte(){return $this->codigo_arte;}
	public function get_comentario(){return $this->comentario;}
	public function get_adm_usuario(){return $this->adm_usuario;}
	public function get_adm_tipo(){return $this->adm_tipo;}
	public function get_desconta_ponto(){return $this->desconta_ponto;}
	public function get_data(){return $this->data;}


	public function find_by_evento_pessoa_arte($codigo_evento,$codigo_pessoa,$codigo_arte)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Deferimento WHERE codigo_evento='$codigo_evento' and codigo_pessoa='$codigo_pessoa' and codigo_arte='$codigo_arte'");

		$total = mysql_num_rows($consulta);

		if ($total==1)
		{

			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_codigo_resumo(mysql_result($consulta,0,'codigo_resumo'));
			$this->set_codigo_arte(mysql_result($consulta,0,'codigo_arte'));
			$this->set_comentario(mysql_result($consulta,0,'comentario'));
			$this->set_adm_usuario(mysql_result($consulta,0,'adm_usuario'));
			$this->set_adm_tipo(mysql_result($consulta,0,'adm_tipo'));
			$this->set_desconta_ponto(mysql_result($consulta,0,'desconta_ponto'));
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

	public function find_by_evento_pessoa_resumo($codigo_evento,$codigo_pessoa,$codigo_resumo)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Deferimento WHERE codigo_evento='$codigo_evento' and codigo_pessoa='$codigo_pessoa' and codigo_resumo='$codigo_resumo' and data IN (SELECT max(data) FROM Deferimento WHERE codigo_evento='$codigo_evento' and codigo_pessoa='$codigo_pessoa' and codigo_resumo='$codigo_resumo')");

		$total = mysql_num_rows($consulta);

		if ($total==1)
		{

			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_codigo_resumo(mysql_result($consulta,0,'codigo_resumo'));
			$this->set_codigo_arte(mysql_result($consulta,0,'codigo_arte'));
			$this->set_comentario(mysql_result($consulta,0,'comentario'));
			$this->set_adm_usuario(mysql_result($consulta,0,'adm_usuario'));
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


	public function insert()
	{
		$conexao = new Conexao();

		$sql = "INSERT INTO Deferimento (codigo_evento, codigo_pessoa, codigo_resumo, codigo_arte, comentario, adm_usuario,adm_tipo, desconta_ponto, data) VALUES ('$this->codigo_evento', '$this->codigo_pessoa', '$this->codigo_resumo', '$this->codigo_arte', '$this->comentario', '$this->adm_usuario','$this->adm_tipo','$this->desconta_ponto', NOW() );";
		
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

	public function update()
	{
		$conexao = new Conexao();

		$sql = "UPDATE Deferimento SET codigo_evento = '$this->codigo_evento', codigo_pessoa = '$this->codigo_pessoa', codigo_resumo = '$this->codigo_resumo', codigo_arte = '$this->codigo_arte', comentario = '$this->comentario', adm_usuario = '$this->adm_usuario',data = '$this->data'
		WHERE codigo_evento = $this->codigo_evento and codigo_pessoa = $this->codigo_pessoa and codigo_resumo = $this->codigo_resumo and codigo_arte = $this->codigo_arte";

		if($conexao->db_update($sql)){
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

		$sql = "DELETE FROM Deferimento WHERE codigo_evento = $this->codigo_evento and codigo_pessoa = $this->codigo_pessoa and codigo_resumo = $this->codigo_resumo and codigo_arte = $this->codigo_arte";

		if($conexao->db_update($sql)){
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		}
	}



}


?>
