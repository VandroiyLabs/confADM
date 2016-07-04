<?php

require_once('class.conexao.php');

class Kits
{

	private $codigo_pessoa;
	private $nome;
	private $codigo_evento;
	private $email;
	private $camiseta;
	private $entrega;

	public function __construct()
	{

		$this->set_codigo_pessoa(NULL);
		$this->set_nome(NULL);
		$this->set_codigo_evento(NULL);
		$this->set_email(NULL);
		$this->set_camiseta(NULL);
		$this->set_tipo_camiseta(NULL);
		$this->set_entrega(NULL);
	}

	//setters
	public function set_codigo_pessoa($codigo_pessoa)	{$this->codigo_pessoa = $codigo_pessoa;}
	public function set_nome($nome)						{$this->nome = $nome;}
	public function set_codigo_evento($codigo_evento)	{$this->codigo_evento = $codigo_evento;}
	public function set_email($email)					{$this->email = $email;}
	public function set_camiseta($camiseta)				{$this->camiseta = $camiseta;}
	public function set_tipo_camiseta($tipo_camiseta)				{$this->tipo_camiseta = $tipo_camiseta;}
	public function set_entrega($entrega)				{$this->entrega = $entrega;}

	//getters
	public function get_codigo_pessoa()	{return $this->codigo_pessoa;}
	public function get_nome()			{return $this->nome;}
	public function get_codigo_evento()	{return $this->codigo_evento;}
	public function get_email()			{return $this->email;}
	public function get_camiseta()		{return $this->camiseta;}
	public function get_tipo_camiseta()		{return $this->tipo_camiseta;}
	public function get_entrega()		{return $this->entrega;}




	public static function find_by_evento($codigo_evento)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Kits WHERE codigo_evento = '" . $codigo_evento . "' order by nome");
		$conexao = null;

		return $consulta;
	}


	//
	// Retorna True se encontrar uma pessoa cadastrada no evento
	// e que comprou Kit. Seta o objeto com os detalhes em Kits.
	//
	public function find_by_codigo_pessoa($codigo_pessoa, $codigo_evento)
	{

		// Sempre que o Kit foi comprado para alguém que não se cadastrou no site
		// o codigo_pessoa será setado como 0, por isso não fará sentido esta consulta!
		// Neste caso, use a função find_by_nome()
		if ( $codigo_pessoa == 0 )
		{
			return False;
		}

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Kits WHERE codigo_pessoa='$codigo_pessoa' AND codigo_evento='$codigo_evento'");
		$total = mysql_num_rows($consulta);

		if ( $total == 1 )
		{

			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_email(mysql_result($consulta,0,'email'));
			$this->set_camiseta(mysql_result($consulta,0,'camiseta'));
			$this->set_tipo_camiseta(mysql_result($consulta,0,'tipo_camiseta'));
			$this->set_entrega(mysql_result($consulta,0,'entrega'));


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
	// Retorna True se encontrar uma pessoa NÃO cadastrada no evento
	// e que comprou Kit. Seta o objeto com os detalhes em Kits.
	//
	public function find_by_email($email, $codigo_evento)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Kits WHERE codigo_pessoa=0 AND email='$email' AND codigo_evento='$codigo_evento'");
		$total = mysql_num_rows($consulta);

		if ( $total == 1 )
		{

			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_email(mysql_result($consulta,0,'email'));
			$this->set_camiseta(mysql_result($consulta,0,'camiseta'));
			$this->set_tipo_camiseta(mysql_result($consulta,0,'tipo_camiseta'));
			$this->set_entrega(mysql_result($consulta,0,'entrega'));


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

	public static function find_by_camiseta($camiseta, $codigo_evento)
	{


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Kits WHERE camiseta='$camiseta' AND codigo_evento = '$codigo_evento'");
		$conexao = null;

		return $consulta;
	}

	public static function find_by_camiseta_e_tipo($camiseta, $tipo, $codigo_evento)
	{


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Kits WHERE camiseta='$camiseta' AND tipo_camiseta like '%$tipo%' AND codigo_evento = '$codigo_evento'");
		$conexao = null;

		return $consulta;
	}

	public static function find_by_camiseta_by_evento($camiseta, $codigo_evento)
	{


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Kits WHERE camiseta='$camiseta' and codigo_evento = '$codigo_evento'");
		$conexao = null;

		return $consulta;
	}


	//
	// Encontra todos os casos com nome parecido e COM E SEM inscrição no evento
	//
	public static function find_by_nome($nome)
	{

		$conexao = new Conexao();

		$nomeexp = explode(" ", $nome);
		$nome_like = "%";
		for ( $j = 0; $j < sizeof($nomeexp); $j++ )
		{
			$nome_like .= $nomeexp[$j] . "%";
		}

		$consulta = $conexao->db_query("SELECT * FROM Kits WHERE nome LIKE '$nome_like'");
		$conexao = null;

		return $consulta;
	}


	public static function find_by_nome_evento($nome, $codigo_evento)
	{

		$conexao = new Conexao();

		$nomeexp = explode(" ", $nome);
		$nome_like = "%";
		for ( $j = 0; $j < sizeof($nomeexp); $j++ )
		{
			$nome_like .= $nomeexp[$j] . "%";
		}

		$consulta = $conexao->db_query("SELECT * FROM Kits WHERE nome LIKE '$nome_like' AND codigo_evento = '$codigo_evento'");
		$conexao = null;

		return $consulta;
	}


	//
	// Encontra todos os casos com nome parecido e SEM inscrição no evento
	//
	public static function find_by_nome_wsubscription($nome, $codigo_evento)
	{

		$conexao = new Conexao();

		$nomeexp = explode(" ", $nome);
		$nome_like = "%";
		for ( $j = 0; $j < sizeof($nomeexp); $j++ )
		{
			$nome_like .= $nomeexp[$j] . "%";
		}

		$consulta = $conexao->db_query("SELECT * FROM Kits WHERE codigo_pessoa>0 AND nome LIKE '$nome_like' AND codigo_evento = '$codigo_evento'");
		$conexao = null;

		return $consulta;
	}

	//
	// Encontra todos os casos com nome parecido e SEM inscrição no evento
	//
	public static function find_by_nome_nosubscription($nome, $codigo_evento)
	{

		$conexao = new Conexao();

		$nomeexp = explode(" ", $nome);
		$nome_like = "%";
		for ( $j = 0; $j < sizeof($nomeexp); $j++ )
		{
			$nome_like .= $nomeexp[$j] . "%";
		}

		$consulta = $conexao->db_query("SELECT * FROM Kits WHERE codigo_pessoa=0 AND nome LIKE '$nome_like' AND codigo_evento = '$codigo_evento'");
		$conexao = null;

		return $consulta;
	}

	public static function find_all()
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT codigo_pessoa, nome, camiseta
FROM (
(

SELECT Kits.nome nome, camiseta, tipo_camiseta, codigo_pessoa
FROM Kits
WHERE codigo_pessoa =0
)
UNION (

SELECT P.nome nome, camiseta, tipo_camiseta, K.codigo_pessoa codigo_pessoa
FROM Kits K, Pessoa P
WHERE P.codigo_pessoa = K.codigo_pessoa
AND P.codigo_pessoa <>0
)
) AS t
ORDER BY nome");
		$conexao = null;

		return $consulta;
	}

	public static function find_all_by_evento($codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT codigo_pessoa, nome, camiseta,tipo_camiseta
FROM (
(

SELECT Kits.nome nome, camiseta, tipo_camiseta, codigo_pessoa
FROM Kits
WHERE codigo_pessoa =0 and codigo_evento = '$codigo_evento'
)
UNION (

SELECT P.nome nome, camiseta, tipo_camiseta, K.codigo_pessoa codigo_pessoa
FROM Kits K, Pessoa P
WHERE P.codigo_pessoa = K.codigo_pessoa and codigo_evento = '$codigo_evento'
AND P.codigo_pessoa <>0
)
) AS t
ORDER BY nome");
		$conexao = null;

		return $consulta;
	}

	public static function find_all_new()
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Kits ORDER BY nome");
		$conexao = null;

		return $consulta;
	}

	public function insert()
	{
		$conexao = new Conexao();

		$sql = "INSERT INTO Kits (codigo_pessoa, nome, codigo_evento, email, camiseta, tipo_camiseta, entrega) VALUES " .
				"('$this->codigo_pessoa', '$this->nome', '$this->codigo_evento', '$this->email', '$this->camiseta', '$this->tipo_camiseta', '$this->entrega');";

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

		$sql = "UPDATE Kits SET email = '$this->email', camiseta = '$this->camiseta',  tipo_camiseta = '$this->tipo_camiseta',  entrega = '$this->entrega' " .
				"WHERE  codigo_pessoa='$this->codigo_pessoa' AND nome='$this->nome' AND codigo_evento='$this->codigo_evento'";
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

	public function remove()
	{
		$conexao = new Conexao();

		$sql = "DELETE FROM Kits WHERE codigo_pessoa='$this->codigo_pessoa' AND codigo_evento='$this->codigo_evento' AND nome='$this->nome'";
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
