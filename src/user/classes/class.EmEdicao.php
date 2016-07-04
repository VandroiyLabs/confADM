<?php

require_once('class.conexao.php');

class EmEdicao
{

	// Identifica o pessoa
	private $codigo_pessoa;
	// Identifica o administrador
	private $adm_usuario;
	// Horario em que a operacao realizou
	private $horario;
	
	// Construtor da classe
	public function __construct()
	{
		$this->set_adm_usuario(NULL);
		$this->set_codigo_pessoa(NULL);
		$this->set_horario(NULL);
	}

	//setters
	public function set_adm_usuario($adm_usuario) {$this->adm_usuario = $adm_usuario;}
	public function set_codigo_pessoa($codigo_pessoa) {$this->codigo_pessoa = $codigo_pessoa;}
	public function set_horario($horario) {$this->horario = $horario;}

	//getters
	public function get_adm_usuario() {return $this->adm_usuario;}
	public function get_codigo_pessoa() {return $this->codigo_pessoa;}
	public function get_horario() {return $this->horario;}
	
	
	/*
		Função para encontrar um único registro de um determinado administrador
		e para um dado evento.
	*/
	public function find_by_pessoa($codigo_pessoa)
	{
		
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM SendoModificado WHERE codigo_pessoa='$codigo_pessoa'");
		$total = mysql_num_rows($consulta);

		if ($total==1)
		{
			
			$this->set_adm_usuario(mysql_result($consulta,0,'adm_usuario'));
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
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
		Para manter tudo fazendo sentido, precisamos manter a consistência dos dados no banco.
		Para isso serve esta funcao.
	*/
	public function find_by_adm($adm_usuario)
	{
		
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM SendoModificado WHERE adm_usuario='$adm_usuario'");
		$total = mysql_num_rows($consulta);

		if ($total==1)
		{
			
			$this->set_adm_usuario(mysql_result($consulta,0,'adm_usuario'));
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_horario(mysql_result($consulta,0,'horario'));
			
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
	
	
	/*
		Insere novo registro ao banco
	*/
	public function insert()
	{
		$conexao = new Conexao();
	
		$sql = "INSERT INTO SendoModificado (codigo_pessoa, adm_usuario, horario) VALUES ('$this->codigo_pessoa', '$this->adm_usuario', NOW());";
		
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
	
	
	/*
		Insere novo registro ao banco
	*/
	public function remove()
	{
		$conexao = new Conexao();
	
		$sql = "DELETE FROM SendoModificado WHERE codigo_pessoa='$this->codigo_pessoa';";
		
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
