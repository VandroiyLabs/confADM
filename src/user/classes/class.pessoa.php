<?php

require_once('class.conexao.php');
require_once("email_functions.php");

class Pessoa
{

	private $codigo_pessoa;
	private $nome;
	private $cpf;
	private $rg;
	private $rg_data;
	private $rg_expedidor;
	private $endereco;
	private $email;
	private $senha;
	private $estrangeiro;
	private $passaporte;
	private $passaporte_validade;
	private $passaporte_data;
	private $passaporte_expedidor;
	private $sexo;
	private $tipo;
	private $agencia_fomento;
	private $telefone;
	private $nusp;


	public function __construct(){

		$this->set_codigo_pessoa(NULL);
		$this->set_nome(NULL);
		$this->set_sexo(NULL);
		$this->set_tipo(NULL);
		$this->set_agencia_fomento(NULL);
		$this->set_cpf(NULL);
		$this->set_rg(NULL);
		$this->set_rg_data(NULL);
		$this->set_rg_expedidor(NULL);
		$this->set_endereco(NULL);
		$this->set_telefone(NULL);
		$this->set_email(NULL);
		$this->set_nusp(NULL);
		$this->set_senha(NULL);
		$this->set_estrangeiro(NULL);
		$this->set_passaporte(NULL);
		$this->set_passaporte_validade(NULL);
		$this->set_passaporte_data(NULL);
		$this->set_passaporte_expedidor(NULL);
	}


	/*  Encripts the password using
		similar method of SSHA1
	 */
	private function encrypt_senha($password)
	{
	  $salt = sha1(rand());
	  $salt = substr($salt, 0, 15);
	  $encrypted = base64_encode( sha1($password .  $salt , true) .  $salt ) . ":" . $salt;

	  return $encrypted;
	}

	/*
		Funcao que compara duas senhas
	*/
	public function compare_senhas($pass1, $pass_bd)
	{
		$salt = explode(":", $pass_bd);
		$salt = $salt[1];

		$encrypted_version = base64_encode( sha1($pass1 .  $salt , true) .  $salt ) . ":" . $salt;

		return strcmp($encrypted_version, $pass_bd);
	}


	//setters
	public function set_codigo_pessoa($codigo_pessoa){$this->codigo_pessoa = $codigo_pessoa;}
	public function set_nome($nome){$this->nome = $nome;}
	public function set_sexo($sexo){$this->sexo = $sexo;}
	public function set_tipo($tipo){$this->tipo = $tipo;}
	public function set_agencia_fomento($agencia_fomento){$this->agencia_fomento = $agencia_fomento;}
	public function set_cpf($cpf){$this->cpf = $cpf;}
	public function set_rg($rg){$this->rg = $rg;}
	public function set_rg_data($rg_data){$this->rg_data = $rg_data;}
	public function set_rg_expedidor($rg_expedidor){$this->rg_expedidor = $rg_expedidor;}
	public function set_endereco($endereco){$this->endereco = $endereco;}
	public function set_telefone($telefone){$this->telefone = $telefone;}
	public function set_email($email){$this->email = $email;}
	public function set_nusp($nusp){$this->nusp = $nusp;}
	public function set_senha($senha){$this->senha = $this->encrypt_senha($senha);}
	public function set_senha_db($senha){$this->senha = $senha;}
	public function set_estrangeiro($estrangeiro){$this->estrangeiro = $estrangeiro;}
	public function set_passaporte($passaporte){$this->passaporte = $passaporte;}
	public function set_passaporte_validade($passaporte_validade){$this->passaporte_validade = $passaporte_validade;}
	public function set_passaporte_data($passaporte_data){$this->passaporte_data = $passaporte_data;}
	public function set_passaporte_expedidor($passaporte_expedidor){$this->passaporte_expedidor = $passaporte_expedidor;}


	//getters
	public function get_codigo_pessoa(){return $this->codigo_pessoa;}
	public function get_nome(){return $this->nome;}
	public function get_sexo(){return $this->sexo;}
	public function get_tipo(){return $this->tipo;}
	public function get_agencia_fomento(){return $this->agencia_fomento;}
	public function get_cpf(){return $this->cpf;}
	public function get_rg(){return $this->rg;}
	public function get_rg_data(){return $this->rg_data;}
	public function get_rg_expedidor(){return $this->rg_expedidor;}
	public function get_endereco(){return $this->endereco;}
	public function get_telefone(){return $this->telefone;}
	public function get_email(){return $this->email;}
	public function get_nusp(){return $this->nusp;}
	public function get_senha(){return $this->senha;}
	public function get_estrangeiro(){return $this->estrangeiro;}
	public function get_passaporte(){return $this->passaporte;}
	public function get_passaporte_validade(){return $this->passaporte_validade;}
	public function get_passaporte_data(){return $this->passaporte_data;}
	public function get_passaporte_expedidor(){return $this->passaporte_expedidor;}


	public function find_by_email_senha($email, $senha)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Pessoa WHERE email='$email' and email <> ''");
		$total = mysql_num_rows($consulta);

		if ( $total == 1 )
		{
			$senha_bd = mysql_result($consulta, 0, 'senha');
			$senha_strcmp = $this->compare_senhas($senha, $senha_bd);
		}

		if ( $total == 1 and $senha_strcmp == 0 )
		{
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_sexo(mysql_result($consulta,0,'sexo'));
			$this->set_tipo(mysql_result($consulta,0,'tipo'));
			$this->set_agencia_fomento(mysql_result($consulta,0,'agencia_fomento'));
			$this->set_cpf(mysql_result($consulta,0,'cpf'));
			$this->set_rg(mysql_result($consulta,0,'rg'));
			$this->set_rg_data(mysql_result($consulta,0,'rg_data'));
			$this->set_rg_expedidor(mysql_result($consulta,0,'rg_expedidor'));
			$this->set_endereco(mysql_result($consulta,0,'endereco'));
			$this->set_telefone(mysql_result($consulta,0,'telefone'));
			$this->set_email(mysql_result($consulta,0,'email'));
			$this->set_nusp(mysql_result($consulta,0,'nusp'));
			$this->set_senha_db(mysql_result($consulta,0,'senha'));
			$this->set_estrangeiro(mysql_result($consulta,0,'estrangeiro'));
			$this->set_passaporte(mysql_result($consulta,0,'passaporte'));
			$this->set_passaporte_validade(mysql_result($consulta,0,'passaporte_validade'));
			$this->set_passaporte_data(mysql_result($consulta,0,'passaporte_data'));
			$this->set_passaporte_expedidor(mysql_result($consulta,0,'passaporte_expedidor'));

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

	public function find_by_email($email)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Pessoa WHERE email='$email'  and email <> ''");

		$total = mysql_num_rows($consulta);

		if ($total==1)
		{

			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_sexo(mysql_result($consulta,0,'sexo'));
			$this->set_tipo(mysql_result($consulta,0,'tipo'));
			$this->set_agencia_fomento(mysql_result($consulta,0,'agencia_fomento'));
			$this->set_cpf(mysql_result($consulta,0,'cpf'));
			$this->set_rg(mysql_result($consulta,0,'rg'));
			$this->set_rg_data(mysql_result($consulta,0,'rg_data'));
			$this->set_rg_expedidor(mysql_result($consulta,0,'rg_expedidor'));
			$this->set_endereco(mysql_result($consulta,0,'endereco'));
			$this->set_telefone(mysql_result($consulta,0,'telefone'));
			$this->set_email(mysql_result($consulta,0,'email'));
			$this->set_nusp(mysql_result($consulta,0,'nusp'));
			$this->set_senha_db(mysql_result($consulta,0,'senha'));
			$this->set_estrangeiro(mysql_result($consulta,0,'estrangeiro'));
			$this->set_passaporte(mysql_result($consulta,0,'passaporte'));
			$this->set_passaporte_validade(mysql_result($consulta,0,'passaporte_validade'));
			$this->set_passaporte_data(mysql_result($consulta,0,'passaporte_data'));
			$this->set_passaporte_expedidor(mysql_result($consulta,0,'passaporte_expedidor'));

			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		};
	}

	public function find_by_nome($nome){//email UNIQUE

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Pessoa WHERE nome LIKE '%$nome%'");

		$conexao = null;

		return $consulta;
	}

	public function find_by_nome_inscricao($nome){//email UNIQUE

		$conexao = new Conexao();

		$nomeexp = explode(" ", $nome);
		$nome_like = "%";
		for ( $j = 0; $j < sizeof($nomeexp); $j++ )
		{
			$nome_like .= $nomeexp[$j] . "%";
		}

		$consulta = $conexao->db_query("SELECT * FROM Pessoa, Inscricao WHERE Pessoa.codigo_pessoa = Inscricao.codigo_pessoa and nome LIKE '$nome_like'");

		$conexao = null;

		return $consulta;
	}

	public function find_by_codigo($codigo_pessoa){//email UNIQUE

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Pessoa WHERE codigo_pessoa='$codigo_pessoa'");

		$total = mysql_num_rows($consulta);

		if ($total==1){

			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_sexo(mysql_result($consulta,0,'sexo'));
			$this->set_tipo(mysql_result($consulta,0,'tipo'));
			$this->set_agencia_fomento(mysql_result($consulta,0,'agencia_fomento'));
			$this->set_cpf(mysql_result($consulta,0,'cpf'));
			$this->set_rg(mysql_result($consulta,0,'rg'));
			$this->set_rg_data(mysql_result($consulta,0,'rg_data'));
			$this->set_rg_expedidor(mysql_result($consulta,0,'rg_expedidor'));
			$this->set_endereco(mysql_result($consulta,0,'endereco'));
			$this->set_telefone(mysql_result($consulta,0,'telefone'));
			$this->set_email(mysql_result($consulta,0,'email'));
			$this->set_nusp(mysql_result($consulta,0,'nusp'));
			$this->set_senha_db(mysql_result($consulta,0,'senha'));
			$this->set_estrangeiro(mysql_result($consulta,0,'estrangeiro'));
			$this->set_passaporte(mysql_result($consulta,0,'passaporte'));
			$this->set_passaporte_validade(mysql_result($consulta,0,'passaporte_validade'));
			$this->set_passaporte_data(mysql_result($consulta,0,'passaporte_data'));
			$this->set_passaporte_expedidor(mysql_result($consulta,0,'passaporte_expedidor'));

			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		};
	}



	public static function find_student_all()
	{//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Pessoa WHERE tipo < 5");
		$conexao = null;

		return $consulta;
	}


	public static function find_by_cpf($cpf)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Pessoa WHERE cpf = " . $cpf);
		$conexao = null;

		return $consulta;
	}

	public static function find_all(){//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Pessoa");
		$conexao = null;

		return $consulta;
	}

	public static function find_limited_all($pagina_atual,$limite){//email UNIQUE

		$conexao = new Conexao();

		if (!$pagina_atual)	{ $contador_pagina = "1"; }
		else				{ $contador_pagina = $pagina_atual; };

		$sql = "SELECT * FROM Pessoa";

		$registro_inicial = (($contador_pagina - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;

		return $intervalo;
	}

	public static function find_student_limited_all($pagina_atual,$limite){//email UNIQUE

		$conexao = new Conexao();

		if (!$pagina_atual)	{ $contador_pagina = "1"; }
		else				{ $contador_pagina = $pagina_atual; };

		$sql = "SELECT * FROM Pessoa WHERE tipo < 5";

		$registro_inicial = (($contador_pagina - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;

		return $intervalo;
	}

	public static function find_all_by_evento($codigo_evento){//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT *, Pessoa.nome nome_pessoa FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento WHERE Evento.codigo_evento = '$codigo_evento'
		");
		$conexao = null;

		return $consulta;
	}

	public static function find_by_evento_alfabetico($codigo_evento, $filtro=""){//email UNIQUE


		$conexao = new Conexao();
			$sql="SELECT Pessoa.codigo_pessoa codigo_pessoa, Pessoa.email email, Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.situacao_resumo, Inscricao.instituicao instituicao,Inscricao.nivel nivel, Inscricao.codigo_arte codigo_arte,Inscricao.codigo_resumo codigo_resumo, Resumo.titulo titulo  FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento LEFT JOIN Resumo ON Inscricao.codigo_resumo = Resumo.codigo_resumo WHERE Evento.codigo_evento = '$codigo_evento' $filtro


		ORDER BY Pessoa.nome"; //echo $sql;
		$consulta = $conexao->db_query($sql);
		$conexao = null;

		return $consulta;
	}

public static function find_by_evento_alfabetico_crachas($codigo_evento, $filtro=""){//email UNIQUE


		$conexao = new Conexao();
			$sql="SELECT CB.id as id, Pessoa.codigo_pessoa codigo_pessoa, Pessoa.email email, Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.situacao_resumo, Inscricao.instituicao instituicao,Inscricao.nivel nivel, Inscricao.codigo_arte codigo_arte,Inscricao.codigo_resumo codigo_resumo, Resumo.titulo titulo  FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento LEFT JOIN Resumo ON Inscricao.codigo_resumo = Resumo.codigo_resumo  LEFT JOIN codigo_barra CB ON CB.codigo_pessoa = Inscricao.codigo_pessoa and CB.codigo_evento = Inscricao.codigo_evento WHERE Evento.codigo_evento = '$codigo_evento' $filtro


		ORDER BY CB.id"; //echo $sql;
		$consulta = $conexao->db_query($sql);
		$conexao = null;

		return $consulta;
	}




	public static function find_student_by_evento($codigo_evento){//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Resumo.titulo, Inscricao.situacao_resumo, Inscricao.qt_dias, Inscricao.qt_dias_pernoite, Inscricao.vl_diaria, Inscricao.vl_diaria_pernoite, Inscricao.codigo_financiadora FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento JOIN Resumo ON Inscricao.codigo_resumo = Resumo.codigo_resumo WHERE Evento.codigo_evento = '$codigo_evento' AND tipo < 5
		ORDER BY Pessoa.codigo_pessoa
		");
		$conexao = null;

		return $consulta;
	}

	public static function find_by_evento($codigo_evento){//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Inscricao.situacao_resumo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento WHERE Evento.codigo_evento = '$codigo_evento'
		ORDER BY Pessoa.codigo_pessoa
		");
		$conexao = null;

		return $consulta;
	}

	public static function find_by_evento_situacao($codigo_evento,$situacao){//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Inscricao.situacao_resumo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento WHERE Evento.codigo_evento = '$codigo_evento' and  Inscricao.situacao_resumo = '$situacao'
		ORDER BY Pessoa.codigo_pessoa
		");
		$conexao = null;

		return $consulta;
	}
	public static function find_by_evento_situacao_deferimento($codigo_evento,$situacao){//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Inscricao.situacao_resumo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento WHERE Evento.codigo_evento = '$codigo_evento' and  Inscricao.situacao_deferimento = '$situacao' and Inscricao.situacao_resumo = 2

		ORDER BY Pessoa.codigo_pessoa

		");
		$conexao = null;

		return $consulta;
	}


	public static function find_student_limited_evento($codigo_evento,$pagina_atual,$limite){//email UNIQUE

		$conexao = new Conexao();

		if (!$pagina_atual)	{ $contador_pagina = "1"; }
		else				{ $contador_pagina = $pagina_atual; };

		$sql = "SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Resumo.titulo, Inscricao.situacao_resumo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento JOIN Resumo ON Inscricao.codigo_resumo = Resumo.codigo_resumo WHERE Evento.codigo_evento = '$codigo_evento' AND tipo < 5
		ORDER BY Pessoa.codigo_pessoa";

		$registro_inicial = (($contador_pagina - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;

		return $intervalo;
	}

	public static function find_limited_evento($codigo_evento,$pagina_atual,$limite){//email UNIQUE

		$conexao = new Conexao();

		if (!$pagina_atual)	{ $contador_pagina = "1"; }
		else				{ $contador_pagina = $pagina_atual; };

		$sql = "SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Resumo.titulo, Inscricao.situacao_resumo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento JOIN Resumo ON Inscricao.codigo_resumo = Resumo.codigo_resumo WHERE Evento.codigo_evento = '$codigo_evento'
		ORDER BY Pessoa.codigo_pessoa";

		$registro_inicial = (($contador_pagina - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;

		return $intervalo;
	}

	public static function find_student_by_evento_participante($codigo_evento){//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Resumo.titulo, Inscricao.situacao_resumo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento JOIN Resumo ON Inscricao.codigo_resumo = Resumo.codigo_resumo WHERE Evento.codigo_evento = '$codigo_evento'
		AND Inscricao.modalidade = '1' AND tipo < 5
		ORDER BY Pessoa.codigo_pessoa
		");
		$conexao = null;

		return $consulta;
	}

	public static function find_by_evento_participante($codigo_evento){//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Resumo.titulo, Inscricao.situacao_resumo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento JOIN Resumo ON Inscricao.codigo_resumo = Resumo.codigo_resumo WHERE Evento.codigo_evento = '$codigo_evento'
		AND Inscricao.modalidade = '1'
		ORDER BY Pessoa.codigo_pessoa
		");
		$conexao = null;

		return $consulta;
	}

	public static function find_student_limited_evento_participante($codigo_evento,$pagina_atual,$limite){//email UNIQUE

		$conexao = new Conexao();

		if (!$pagina_atual)	{ $contador_pagina = "1"; }
		else				{ $contador_pagina = $pagina_atual; };

		$sql = "SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Resumo.titulo, Inscricao.situacao_resumo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento JOIN Resumo ON Inscricao.codigo_resumo = Resumo.codigo_resumo WHERE Evento.codigo_evento = '$codigo_evento'
		AND Inscricao.modalidade = '1' AND tipo < 5
		ORDER BY Pessoa.codigo_pessoa";

		$registro_inicial = (($contador_pagina - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;


		return $intervalo;
	}

	public static function find_limited_evento_participante($codigo_evento,$pagina_atual,$limite){//email UNIQUE

		$conexao = new Conexao();

		if (!$pagina_atual)	{ $contador_pagina = "1"; }
		else				{ $contador_pagina = $pagina_atual; };

		$sql = "SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Resumo.titulo, Inscricao.situacao_resumo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento JOIN Resumo ON Inscricao.codigo_resumo = Resumo.codigo_resumo WHERE Evento.codigo_evento = '$codigo_evento'
		AND Inscricao.modalidade = '1'
		ORDER BY Pessoa.codigo_pessoa";

		$registro_inicial = (($contador_pagina - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;

		return $intervalo;
	}


	public static function find_by_evento_conferencista_resumo($codigo_evento){//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Resumo.titulo,  Inscricao.situacao_resumo  FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento JOIN Resumo ON Inscricao.codigo_resumo = Resumo.codigo_resumo
		WHERE Evento.codigo_evento = '$codigo_evento'
		AND Inscricao.modalidade <> '1'
		AND Inscricao.situacao_deferimento = '2'
		ORDER BY nome
		");
		$conexao = null;

		return $consulta;
	}

	public static function find_by_evento_conferencista_alfabetico($codigo_evento){//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Resumo.titulo, Inscricao.situacao_resumo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento JOIN Resumo ON Inscricao.codigo_resumo = Resumo.codigo_resumo WHERE Evento.codigo_evento = '$codigo_evento'
		AND Inscricao.modalidade <> '1'
		ORDER BY Pessoa.nome
		");
		$conexao = null;

		return $consulta;
	}

	public static function find_by_evento_conferencista($codigo_evento){//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Resumo.titulo, Inscricao.situacao_resumo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento JOIN Resumo ON Inscricao.codigo_resumo = Resumo.codigo_resumo
WHERE Evento.codigo_evento = '$codigo_evento'
		AND Inscricao.modalidade <> '1'
		");
		$conexao = null;

		return $consulta;
	}

	public static function find_limited_evento_conferencista($codigo_evento,$pagina_atual,$limite){//email UNIQUE

		$conexao = new Conexao();

		if (!$pagina_atual)	{ $contador_pagina = "1"; }
		else				{ $contador_pagina = $pagina_atual; };

		$sql = "SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Resumo.titulo, Inscricao.situacao_resumo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento JOIN Resumo ON Inscricao.codigo_resumo = Resumo.codigo_resumo WHERE Evento.codigo_evento = '$codigo_evento'
		AND Inscricao.modalidade <> '1'
		";

		$registro_inicial = (($contador_pagina - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;

		return $intervalo;
	}


	public static function find_student_by_evento_conferencista_tipo($codigo_evento, $modalidade){//email UNIQUE

		$conferencista = "(Inscricao.modalidade = '$modalidade'";

		if($modalidade == 3)
			$conferencista .= " OR Inscricao.modalidade = '6' OR Inscricao.modalidade = '7')";

		else if($modalidade == 4)
			$conferencista += " OR Inscricao.modalidade = '6' OR Inscricao.modalidade = '8')";

		else if($modalidade == 5)
			$conferencista += " OR Inscricao.modalidade = '7' OR Inscricao.modalidade = '8')";

		else
			$conferencista .= ")";

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Resumo.titulo, Inscricao.situacao_resumo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento JOIN Resumo ON Inscricao.codigo_resumo = Resumo.codigo_resumo WHERE Evento.codigo_evento = '$codigo_evento'
		AND $conferencista AND tipo < 5
		");
		$conexao = null;

		return $consulta;
	}

	public static function find_by_evento_conferencista_tipo($codigo_evento, $modalidade){//email UNIQUE


		$conferencista = "(Inscricao.modalidade = '$modalidade'";

		if($modalidade == 3)
			$conferencista .= " OR Inscricao.modalidade = '6' OR Inscricao.modalidade = '7')";

		else if($modalidade == 4)
			$conferencista += " OR Inscricao.modalidade = '6' OR Inscricao.modalidade = '8')";

		else if($modalidade == 5)
			$conferencista += " OR Inscricao.modalidade = '7' OR Inscricao.modalidade = '8')";

		else
			$conferencista .= ")";


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Resumo.titulo, Inscricao.situacao_resumo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento JOIN Resumo ON Inscricao.codigo_resumo = Resumo.codigo_resumo WHERE Evento.codigo_evento = '$codigo_evento'
		AND $conferencista"

		);
		$conexao = null;

		return $consulta;
	}

	public static function find_student_limited_evento_conferencista_tipo($codigo_evento,$modalidade, $pagina_atual,$limite){//email UNIQUE

		$conferencista = "(Inscricao.modalidade = '$modalidade'";
		if($modalidade == 3)
			$conferencista .= " OR Inscricao.modalidade = '6' OR Inscricao.modalidade = '7')";

		else if($modalidade == 4)
			$conferencista .= " OR Inscricao.modalidade = '6' OR Inscricao.modalidade = '8')";

		else if($modalidade == 5)
			$conferencista .= " OR Inscricao.modalidade = '7' OR Inscricao.modalidade = '8')";

		else
			$conferencista .= ")";


		$conexao = new Conexao();

		if (!$pagina_atual)	{ $contador_pagina = "1"; }
		else				{ $contador_pagina = $pagina_atual; };

		$sql = "SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Resumo.titulo, Inscricao.situacao_resumo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento JOIN Resumo ON Inscricao.codigo_resumo = Resumo.codigo_resumo WHERE Evento.codigo_evento = '$codigo_evento'
		AND $conferencista AND tipo < 5
		";

		$registro_inicial = (($contador_pagina - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;

		return $intervalo;
	}

	public static function find_limited_evento_conferencista_tipo($codigo_evento,$modalidade, $pagina_atual,$limite)
	{

		$conferencista = "(Inscricao.modalidade = '$modalidade'";
		if($modalidade == 3)
			$conferencista .= " OR Inscricao.modalidade = '6' OR Inscricao.modalidade = '7')";

		else if($modalidade == 4)
			$conferencista .= " OR Inscricao.modalidade = '6' OR Inscricao.modalidade = '8')";

		else if($modalidade == 5)
			$conferencista .= " OR Inscricao.modalidade = '7' OR Inscricao.modalidade = '8')";

		else
			$conferencista .= ")";


		$conexao = new Conexao();

		if (!$pagina_atual)	{ $contador_pagina = "1"; }
		else				{ $contador_pagina = $pagina_atual; };

		$sql = "SELECT Pessoa.codigo_pessoa, Pessoa.email, Pessoa.endereco , Pessoa.nome nome, Pessoa.nusp, Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Resumo.titulo, Inscricao.situacao_resumo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento JOIN Resumo ON Inscricao.codigo_resumo = Resumo.codigo_resumo WHERE Evento.codigo_evento = '$codigo_evento'
		AND $conferencista
		";
		$registro_inicial = (($contador_pagina - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;

		return $intervalo;
	}


	public function manda_email($assunto, $mensagem)
	{
		$to = $this->get_email();
		$toexp = explode("@", $to);
		$servidor = $toexp[1];
		$serveritens = explode(".", $servidor);

		$key1 = array_search('usp', $serveritens);
		$key2 = array_search('br', $serveritens);

		if ( $key1 >= -1 and $key2 >= -1 )
		{
			return manda_email_gmail($to, $assunto, $mensagem);
		}
		else
		{
      return manda_email_vandroiy($to, $assunto, $mensagem);
		}
	}




	//
	// Funcao que manda email com autenticaco apropriada. Testada
	// Pra usar no acquahost.
	//
	public function contata_organizacao($organiza_email, $assunto, $mensagem)
	{

		return manda_email_vandroiy($organiza_email, $assunto, $mensagem);
	}

	public function insert()
	{
		$conexao = new Conexao();

		$sql = "INSERT INTO Pessoa (nome, sexo, tipo, agencia_fomento, cpf, rg, rg_data, rg_expedidor, endereco, telefone, email, nusp, senha, estrangeiro, passaporte, passaporte_validade, passaporte_data, passaporte_expedidor) VALUES ('$this->nome', '$this->sexo', '$this->tipo', '$this->agencia_fomento', '$this->cpf', '$this->rg', '$this->rg_data', '$this->rg_expedidor', '$this->endereco', '$this->telefone', '$this->email', '$this->nusp', '$this->senha', '$this->estrangeiro', '$this->passaporte', '$this->passaporte_validade', '$this->passaporte_data', '$this->passaporte_expedidor');";

		//echo $sql;

		if($conexao->db_update($sql)){
			//echo "Inserido<br>";

			$consulta = $conexao->db_query("SELECT codigo_pessoa FROM Pessoa WHERE email='$this->email'");
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));

			$conexao = null;

			return True;
		}
		else{
			//echo "Erro na Insercao<br>";
			$conexao = null;
			return False;
		}

	}

	public function update()
	{
		$conexao = new Conexao();

		$sql = "UPDATE Pessoa SET nome = '$this->nome', sexo = '$this->sexo', tipo = '$this->tipo', agencia_fomento = '$this->agencia_fomento', cpf = '$this->cpf', rg = '$this->rg', rg_data = '$this->rg_data', rg_expedidor = '$this->rg_expedidor', endereco = '$this->endereco', telefone = '$this->telefone', email = '$this->email', nusp = '$this->nusp', senha = '$this->senha', estrangeiro = '$this->estrangeiro', passaporte = '$this->passaporte', passaporte_validade ='$this->passaporte_validade', passaporte_data ='$this->passaporte_data', passaporte_expedidor ='$this->passaporte_expedidor'
		WHERE codigo_pessoa = $this->codigo_pessoa";

		//echo $sql;


		if($conexao->db_update($sql)){
			//echo "Atualizado<br>";
			$conexao = null;
			return True;
		}
		else{
			//echo "Erro na Atualizacao<br>";
			$conexao = null;
			return False;
		}
	}

	public function update_senha()
	{
		$conexao = new Conexao();

		$sql = "UPDATE Pessoa SET senha = '$this->senha'
		WHERE codigo_pessoa = $this->codigo_pessoa";

		//echo $sql;


		if($conexao->db_update($sql)){
			//echo "Atualizado<br>";
			$conexao = null;
			return True;
		}
		else{

			//echo "Erro na Atualizacao<br>";
			$conexao = null;
			return False;
		}
	}

	public function remove(){
		$conexao = new Conexao();

		$sql = "DELETE FROM Pessoa WHERE email='$this->email'";

		//echo $sql;

		if($conexao->db_update($sql)){
			//echo "Removidos<br>";
			$conexao = null;
			return True;
		}
		else{
			//echo "Erro na Remocao<br>";
			$conexao = null;
			return False;
		}
	}

	public static function find_by_evento_limmited($codigo_evento, $pagina_atual, $limite){//email UNIQUE

		$conexao = new Conexao();

		$sql = "SELECT *, Pessoa.nome nome_pessoa
						FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa
						JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento
						WHERE Evento.codigo_evento = '$codigo_evento'

		ORDER BY Pessoa.nome"; //echo $sql;

		if (!$pagina_atual)	$pagina_atual = "1";

		$registro_inicial = (($pagina_atual - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;

		return $intervalo;
	}
	public static function find_by_evento_limmited_situacao($codigo_evento, $pagina_atual, $limite,$situacao){//email UNIQUE

		$conexao = new Conexao();

		$sql = "SELECT *, Pessoa.nome nome_pessoa
						FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa
						JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento
						WHERE Evento.codigo_evento = '$codigo_evento' and Inscricao.situacao_resumo = '$situacao'

		ORDER BY Pessoa.nome"; //echo $sql;

		if (!$pagina_atual)	$pagina_atual = "1";

		$registro_inicial = (($pagina_atual - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;

		return $intervalo;
	}
	public static function find_by_evento_limmited_situacao_deferimento($codigo_evento, $pagina_atual, $limite,$situacao){//email UNIQUE

		$conexao = new Conexao();

		$sql = "SELECT *, Pessoa.nome nome_pessoa
						FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa
						JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento
						WHERE Evento.codigo_evento = '$codigo_evento' and Inscricao.situacao_deferimento = '$situacao' and Inscricao.situacao_resumo = 2

		ORDER BY Pessoa.nome"; //echo $sql;

		if (!$pagina_atual)	$pagina_atual = "1";

		$registro_inicial = (($pagina_atual - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;


		return $intervalo;
	}
	public static function find_all_limmited($pagina_atual, $limite){//email UNIQUE

		$conexao = new Conexao();

		$sql = "SELECT * FROM Pessoa";

		if (!$pagina_atual) $pagina_atual = "1";

		$registro_inicial = (($pagina_atual - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;

		return $intervalo;
	}

	public static function find_by_evento_minicurso($codigo_evento, $filtro = '')
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT nome, titulo FROM Pessoa JOIN Inscricao on Pessoa.codigo_pessoa = Inscricao.codigo_pessoa JOIN ParticipaMinicurso ON Pessoa.codigo_pessoa = ParticipaMinicurso.codigo_pessoa and  ParticipaMinicurso.codigo_evento = Inscricao.codigo_evento  JOIN Minicurso ON ParticipaMinicurso.codigo_minicurso = Minicurso.codigo_minicurso WHERE ParticipaMinicurso.codigo_evento = '$codigo_evento' " . $filtro . "
		ORDER BY nome");
		$conexao = null;

		return $consulta;
	}

	public static function find_by_evento_poster($codigo_evento){//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT nome, titulo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Resumo ON Resumo.codigo_resumo = Inscricao.codigo_resumo WHERE Inscricao.codigo_evento = '$codigo_evento' and situacao_resumo = 5
		ORDER BY nome");
		$conexao = null;

		return $consulta;
	}

	public static function find_by_evento_arte($codigo_evento){//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT nome, titulo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Arte ON Arte.codigo_arte = Inscricao.codigo_arte WHERE Inscricao.codigo_evento = '$codigo_evento' and situacao_arte = 4
		ORDER BY nome");
		$conexao = null;

		return $consulta;
	}
	public static function find_by_evento_poster_situacao($codigo_evento,$situacao_resumo, $situacao_deferimento){//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT nome, titulo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Resumo ON Resumo.codigo_resumo = Inscricao.codigo_resumo WHERE Inscricao.codigo_evento = '$codigo_evento' and situacao_resumo = '$situacao_resumo' and situacao_deferimento = '$situacao_deferimento'

		ORDER BY nome");
		$conexao = null;

		return $consulta;
	}

	public static function find_by_evento_arte_situacao($codigo_evento,$situacao){//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT nome, titulo FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Arte ON Arte.codigo_arte = Inscricao.codigo_arte WHERE Inscricao.codigo_evento = '$codigo_evento' and situacao_arte = '$situacao'

		ORDER BY nome");
		$conexao = null;

		return $consulta;
	}
}
