<?php

require_once('class.conexao.php');

class Administrador
{

	private $usuario;
	private $nome;
	private $cpf;
	private $rg;
	private $endereco;
	private $email;
	private $senha;
    private $tipo;
    

	public function __construct()
	{
		
		$this->set_usuario(NULL);
		$this->set_nome(NULL);
		$this->set_cpf(NULL);
		$this->set_rg(NULL);
		$this->set_endereco(NULL);
		$this->set_email(NULL);
		$this->set_senha(NULL);
		$this->set_tipo(NULL);
	}
	


	//setters
	public function set_usuario($usuario){$this->usuario = $usuario;}
	public function set_nome($nome){$this->nome = $nome;}
	public function set_cpf($cpf){$this->cpf = $cpf;}
	public function set_rg($rg){$this->rg = $rg;}
	public function set_endereco($endereco){$this->endereco = $endereco;}
	public function set_email($email){$this->email = $email;}
//	public function set_senha($senha){$this->senha = $senha;}
	public function set_senha($senha){$this->senha = $this->encrypt_senha($senha);}
	public function set_senha_db($senha){$this->senha = $senha;}
	public function set_tipo($tipo){$this->tipo = $tipo;}


	//getters
	public function get_usuario(){return $this->usuario;}
	public function get_nome(){return $this->nome;}
	public function get_cpf(){return $this->cpf;}
	public function get_rg(){return $this->rg;}
	public function get_endereco(){return $this->endereco;}
	public function get_email(){return $this->email;}
	public function get_senha(){return $this->senha;}
    public function get_tipo(){return $this->tipo;}


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
	
	public function find_by_usuario_senha($usuario, $senha)
	{

		$conexao = new Conexao();
		$consulta = $conexao->db_query("SELECT * FROM Administrador WHERE usuario='$usuario'");
		$total = mysql_num_rows($consulta);
		
		if ( $total == 1 )
		{
			$senha_bd = mysql_result($consulta, 0, 'senha');
			$senha_strcmp = $this->compare_senhas($senha, $senha_bd);
		}
		
		
		if ( $total==1 and $senha_strcmp == 0 )
		{

			$this->set_usuario(mysql_result($consulta,0,'usuario'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_cpf(mysql_result($consulta,0,'cpf'));
			$this->set_rg(mysql_result($consulta,0,'rg'));
			$this->set_endereco(mysql_result($consulta,0,'endereco'));
			$this->set_email(mysql_result($consulta,0,'email'));
			$this->set_senha_db(mysql_result($consulta,0,'senha'));
			$this->set_tipo(mysql_result($consulta,0,'tipo'));
			
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
		if(get_magic_quotes_gpc())
		{
			$sql = "INSERT INTO Administrador (usuario, nome, cpf, rg, endereco, email, senha, tipo) VALUES ('$this->usuario', '$this->nome', '$this->cpf', '$this->rg', '$this->endereco', '$this->email', '$this->senha', '$this->tipo');";
		}
		else
		{
			$sql = "INSERT INTO Administrador (usuario, nome, cpf, rg, endereco, email, senha, tipo) VALUES ('".mysql_real_escape_string($this->usuario)."', '".mysql_real_escape_string($this->nome)."', '".mysql_real_escape_string($this->cpf)."', '".mysql_real_escape_string($this->rg)."', '".mysql_real_escape_string($this->endereco)."', '".mysql_real_escape_string($this->email)."', '".mysql_real_escape_string($this->senha)."', '$this->tipo');";
		}

		//echo $sql;
		
		if($conexao->db_update($sql)){
			//echo "Inserido<br>";
			$conexao = null;
			return True;
		}
		else{
			//echo "Erro na Insercao<br>";
			$conexao = null;
			return False;
		}
		
	}

	public function update(){
		$conexao = new Conexao();

		if(get_magic_quotes_gpc())
		{
			$sql = "UPDATE Administrador SET nome = '$this->nome', cpf = '$this->cpf', rg = '$this->rg', endereco = '$this->endereco',  email = '$this->email', senha = '$this->senha', tipo = '$this->tipo'
		WHERE usuario = '$this->usuario'";
		}
		else
		{
			$sql = "UPDATE Administrador SET nome = '".mysql_real_escape_string($this->nome)."', cpf = '".mysql_real_escape_string($this->cpf)."', rg = '".mysql_real_escape_string($this->rg)."', endereco = '".mysql_real_escape_string($this->endereco)."',  email = '".mysql_real_escape_string($this->email)."', senha = '".mysql_real_escape_string($this->senha)."', tipo = '$this->tipo' WHERE usuario = '".mysql_real_escape_string($this->usuario)."';";
		}

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

		$sql = "DELETE FROM Administrador WHERE usuario='$this->usuario'";
		
		if($conexao->db_update($sql)){
			//echo "Removido<br>";
			$conexao = null;
			return True;
		}
		else{
			//echo "Erro na Remocao<br>";
			$conexao = null;
			return False;
		}
	}

	public static function find_all(){//email UNIQUE

		
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Administrador");
		$conexao = null;
		
		return $consulta;
	}

	public function find_financiadora($agencia){//email UNIQUE

		
		$conexao = new Conexao();
		
		$consulta = $conexao->db_query("SELECT * FROM Financiadora WHERE codigo_financiadora = '$agencia' AND responsavel <> ''");
		$total = mysql_num_rows($consulta);
		
		$conexao = null;
		
		return $total;
	}
	
	public function find_by_financiadora($agencia){//email UNIQUE

		
		$conexao = new Conexao();
		
		$consulta = $conexao->db_query("SELECT * FROM Financiadora WHERE codigo_financiadora = '$agencia' AND responsavel = '$this->usuario' AND responsavel <> ''");
		$total = mysql_num_rows($consulta);
		
		$conexao = null;
		
		return $total;
	}
	
	public function find_responsavel_e_processo_financiadora($agencia, $codigo_evento){//email UNIQUE

		
		$conexao = new Conexao();
		
		//echo "SELECT * FROM Administrador WHERE $agencia = '1'";
		
		$consulta = $conexao->db_query("SELECT * FROM Financiadora JOIN Administrador ON responsavel = usuario JOIN Auxilio ON Auxilio.codigo_financiadora = Financiadora.codigo_financiadora WHERE Financiadora.codigo_financiadora = '$agencia' AND codigo_evento = '$codigo_evento'");
		
		$conexao = null;
		
		return $consulta;
	}


	public function find_by_usuario($usuario){//email UNIQUE

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Administrador WHERE usuario='$usuario'");
		$total = mysql_num_rows($consulta);

		if ($total==1){

			$this->set_usuario(mysql_result($consulta,0,'usuario'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_cpf(mysql_result($consulta,0,'cpf'));
			$this->set_rg(mysql_result($consulta,0,'rg'));
			$this->set_endereco(mysql_result($consulta,0,'endereco'));
			$this->set_email(mysql_result($consulta,0,'email'));
			$this->set_senha_db(mysql_result($consulta,0,'senha'));
			$this->set_tipo(mysql_result($consulta,0,'tipo'));
			
			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		};
	}

}


?>
