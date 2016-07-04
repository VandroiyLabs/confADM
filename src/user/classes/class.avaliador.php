<?php

require_once('class.conexao.php');
require_once("~/public_html/sifsc/user/classes/email_functions.php");

class Avaliador
{

	private $codigo_avaliador;
	private $nome;
	private $email;
	private $senha;
	private $cpf;
	private $token;
	private $lingua;
	private $nivel;
	private $grupo;
	private $area1;
	private $area2;
	private $subarea;



	public function __construct()
	{
		$this->set_codigo_avaliador(NULL);
		$this->set_nome(NULL);
		$this->set_email(NULL);
		$this->set_senha(NULL);
		$this->set_cpf(NULL);
		$this->set_token(NULL);
		$this->set_lingua(NULL);
		$this->set_nivel(NULL);
		$this->set_grupo(NULL);
		$this->set_area1(NULL);
		$this->set_area2(NULL);
		$this->set_subarea(NULL);
	}



	//setters
	public function set_codigo_avaliador($codigo_avaliador){$this->codigo_avaliador = $codigo_avaliador;}
	public function set_nome($nome){$this->nome = $nome;}
	public function set_email($email){$this->email = $email;}
	public function set_senha($senha){$this->senha = $senha;}
	public function set_cpf($cpf){$this->cpf = $cpf;}
	public function set_token($token){$this->token = $token;}
	public function set_lingua($lingua){$this->lingua = $lingua;}
	public function set_nivel($nivel){$this->nivel = $nivel;}
	public function set_grupo($grupo){$this->grupo = $grupo;}
	public function set_area1($area){$this->area1 = $area;}
	public function set_area2($area){$this->area2 = $area;}
	public function set_subarea($subarea){$this->subarea = $subarea;}


	//getters
	public function get_codigo_avaliador(){return $this->codigo_avaliador;}
	public function get_nome(){return $this->nome;}
	public function get_email(){return $this->email;}
	public function get_senha(){return $this->senha;}
	public function get_cpf(){return $this->cpf;}
	public function get_token(){return $this->token;}
	public function get_lingua(){return $this->lingua;}
	public function get_nivel(){return $this->nivel;}
	public function get_grupo(){return $this->grupo;}
	public function get_area1(){return $this->area1;}
	public function get_area2(){return $this->area2;}
	public function get_subarea(){return $this->subarea;}


	//
	// Função que encontra o avaliador usando codigo avaliador
	//
	public function find_by_codigo_avaliador($codigo_avaliador)
	{
		$conexao = new Conexao();
		$sql="SELECT * FROM Avaliador WHERE codigo_avaliador='$codigo_avaliador'"; //echo $sql;
		$consulta = $conexao->db_query($sql);
		$total = mysql_num_rows($consulta);

		if ($total==1)
		{

			$this->set_codigo_avaliador(mysql_result($consulta,0,'codigo_avaliador'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_email(mysql_result($consulta,0,'email'));
			$this->set_senha(mysql_result($consulta,0,'senha'));
			$this->set_cpf(mysql_result($consulta,0,'cpf'));
			$this->set_token(mysql_result($consulta,0,'token'));
			$this->set_lingua(mysql_result($consulta,0,'lingua'));
			$this->set_nivel(mysql_result($consulta,0,'nivel'));
			$this->set_grupo(mysql_result($consulta,0,'grupo'));
			$this->set_area1(mysql_result($consulta,0,'area1'));
			$this->set_area2(mysql_result($consulta,0,'area2'));
			$this->set_subarea(mysql_result($consulta,0,'subarea'));

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
		Funcao que compara duas senhas
	*/
	public function compare_senhas($pass1, $pass_bd)
	{
		$salt = explode(":", $pass_bd);
		$salt = $salt[1];

		$encrypted_version = base64_encode( sha1($pass1 .  $salt , true) .  $salt ) . ":" . $salt;

		return strcmp($encrypted_version, $pass_bd);
	}

	//Criptografa senha
	public function encrypt_senha($password)
	{
	  $salt = sha1(rand());
	  $salt = substr($salt, 0, 15);
	  $encrypted = base64_encode( sha1($password .  $salt , true) .  $salt ) . ":" . $salt;

	  return $encrypted;
	}

	public function manda_email($assunto, $mensagem)
	{
		$to = $this->get_email();
		$toexp = explode("@", $to);
		$servidor = $toexp[1];
		$serveritens = explode(".", $servidor);

		$key1 = array_search('usp', $serveritens);
		$key2 = array_search('br', $serveritens);

		if ( $key1 > 0 and $key2 > 0 )
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
		return manda_email_gmail($organiza_email, $assunto, $mensagem);
	}



	public function find_by_email_senha($email, $senha)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Avaliador WHERE email='$email'");
		$total = mysql_num_rows($consulta);


		if ( $total == 1 )
		{
			$senha_bd = mysql_result($consulta, 0, 'senha');
			$senha_strcmp = $this->compare_senhas($senha, $senha_bd);
		}

		if ( $total == 1 and $senha_strcmp == 0 )
		{
			$this->set_codigo_avaliador(mysql_result($consulta,0,'codigo_avaliador'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_email(mysql_result($consulta,0,'email'));
			$this->set_senha(mysql_result($consulta,0,'senha'));
			$this->set_cpf(mysql_result($consulta,0,'cpf'));
			$this->set_token(mysql_result($consulta,0,'token'));
			$this->set_lingua(mysql_result($consulta,0,'lingua'));
			$this->set_nivel(mysql_result($consulta,0,'nivel'));
			$this->set_grupo(mysql_result($consulta,0,'grupo'));
			$this->set_area1(mysql_result($consulta,0,'area1'));
			$this->set_area2(mysql_result($consulta,0,'area2'));
			$this->set_subarea(mysql_result($consulta,0,'subarea'));

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


	public function find_by_email_evento($email, $evento)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Avaliador WHERE email='$email'");
		$total = mysql_num_rows($consulta);

		if ($total==1)
		{

			$this->set_codigo_avaliador(mysql_result($consulta,0,'codigo_avaliador'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_email(mysql_result($consulta,0,'email'));
			$this->set_senha(mysql_result($consulta,0,'senha'));
			$this->set_cpf(mysql_result($consulta,0,'cpf'));
			$this->set_token(mysql_result($consulta,0,'token'));
			$this->set_lingua(mysql_result($consulta,0,'lingua'));
			$this->set_nivel(mysql_result($consulta,0,'nivel'));
			$this->set_grupo(mysql_result($consulta,0,'grupo'));
			$this->set_area1(mysql_result($consulta,0,'area1'));
			$this->set_area2(mysql_result($consulta,0,'area2'));
			$this->set_subarea(mysql_result($consulta,0,'subarea'));

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
	//
	// Função que encontra todos os avaliadores com um nome dado
	//
	public function find_by_nome($nome)
	{

		$conexao = new Conexao();

		$nomeexp = explode(" ", $nome);
		$nome_like = "%";
		for ( $j = 0 ; $j < sizeof($nomeexp); $j++ )
		{
			$nome_like .= $nomeexp[$j] . "%";
		}

		$consulta = $conexao->db_query("SELECT * FROM Avaliador WHERE nome LIKE '$nome_like' ");

		$conexao = null;

		return $consulta;
	}

	public static function find_all_premio()
	{


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Avaliador");
		$conexao = null;

		return $consulta;
	}

	public static function find_all_poster()
	{


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Avaliador where codigo_avaliador IN (select  codigo_avaliador from Avaliacao where secao in (1,2,3,4,5)) order by nome");
		$conexao = null;

		return $consulta;
	}

	public static function find_all()
	{


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Avaliador order by nome");
		$conexao = null;

		return $consulta;
	}

	public static function find_all_by_evento($codigo_evento)
	{


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Avaliador where codigo_avaliador IN (select codigo_avaliador from Avaliacao where codigo_evento = '$codigo_evento' ) order by nome");
		$conexao = null;

		return $consulta;
	}

	public static function find_all_ab()
	{


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Avaliador ORDER BY nome");
		$conexao = null;

		return $consulta;
	}

	public function update_senha()
	{
		$conexao = new Conexao();

		$sql = "UPDATE Avaliador SET senha = '$this->senha'
		WHERE codigo_avaliador = $this->codigo_avaliador";

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

	public function insert(){
		$conexao = new Conexao();

		$sql = "INSERT INTO Avaliador (nome, email, senha, cpf, token, lingua, nivel, grupo, area1, area2, subarea) VALUES " .
				"('$this->nome', '$this->email', '$this->senha', '$this->cpf', '$this->token', '$this->lingua', '$this->nivel', '$this->grupo', '$this->area1', '$this->area2', '$this->subarea');";

		//echo $sql;

		if($conexao->db_update($sql)){
			//echo "Inserido<br>";

			$consulta = $conexao->db_query("SELECT MAX(codigo_avaliador) codigo FROM Avaliador WHERE nome='$this->nome' AND email='$this->email' ");
			$this->set_codigo_avaliador( mysql_result($consulta,0,'codigo') );

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

	public function generate_token($email)
	{
		$exploded1 = explode("@", $email);
		$login = substr($exploded1[0], 0, 15);
		$exploded2 = explode(".", $exploded1[1]);
		$server = $exploded2[0];

		$salt = sha1(rand());
		$salt = substr($salt, 0, 5);
		$token = base64_encode( sha1($login .  $salt . $server, true) .  $salt ) . ":" . $salt;

		$this->set_token($token);

		return $token;
	}

	public function update()
	{
		$conexao = new Conexao();

		$sql = "UPDATE Avaliador SET nome = '$this->nome', email = '$this->email', senha = '$this->senha', cpf = '$this->cpf', token = '$this->token', " .
		"lingua = '$this->lingua', nivel = '$this->nivel', grupo = '$this->grupo', area1 = '$this->area1', area2 = '$this->area2', subarea = '$this->subarea'
		WHERE codigo_avaliador = $this->codigo_avaliador";

		//echo $sql;

		if($conexao->db_update($sql))
		{
			//echo "Atualizado<br>";
			$conexao = null;
			return True;
		}
		else
		{
			//echo "Erro na Atualizacao<br>";
			$conexao = null;
			return False;
		}
	}

	public function remove()
	{
		$conexao = new Conexao();

		$sql = "DELETE FROM Avaliador WHERE codigo_avaliador='$this->codigo_avaliador'";

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
}


?>
