<?php

require_once('class.conexao.php');

class Autor{

	private $codigo_autor;
	private $codigo_resumo;
	private $nome;
	private $instituicao;
	private $ordem;
	
	public function __construct(){
		
		$this->set_codigo_autor(NULL);
		$this->set_codigo_resumo(NULL);
		$this->set_nome(NULL);
		$this->set_instituicao(NULL);
		$this->set_ordem(NULL);
	}

	//setters
	public function set_codigo_autor($codigo_autor){$this->codigo_autor = $codigo_autor;}
	public function set_codigo_resumo($codigo_resumo){$this->codigo_resumo = $codigo_resumo;}
	public function set_nome($nome){$this->nome = $nome;}
	public function set_instituicao($instituicao){$this->instituicao = $instituicao;}
	public function set_ordem($ordem){$this->ordem = $ordem;}

	//getters
	public function get_codigo_autor(){return $this->codigo_autor;}
	public function get_codigo_resumo(){return $this->codigo_resumo;}
	public function get_ordem(){return $this->ordem;}
	public function get_nome(){return $this->nome;}
	public function get_instituicao(){return $this->instituicao;}

	public function find_by_codigo($codigo_autor)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Autor WHERE codigo_autor='$codigo_autor'");
		$total = mysql_num_rows($consulta);

		if ($total==1){

			$this->set_codigo_autor(mysql_result($consulta,0,'codigo_autor'));
			$this->set_codigo_resumo(mysql_result($consulta,0,'codigo_resumo'));
			$this->set_ordem(mysql_result($consulta,0,'ordem'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_instituicao(mysql_result($consulta,0,'instituicao'));
			
			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		};
	}
	
	public function find_by_resumo_ordem($codigo_resumo, $ordem)
	{
		
		$conexao = new Conexao();
		
		$consulta = $conexao->db_query("SELECT * FROM Autor WHERE codigo_resumo='$codigo_resumo' and ordem='$ordem'");
		$total = mysql_num_rows($consulta);
		
		if ($total==1)
		{
			$this->set_codigo_autor(mysql_result($consulta,0,'codigo_autor'));
			$this->set_codigo_resumo(mysql_result($consulta,0,'codigo_resumo'));
			$this->set_ordem(mysql_result($consulta,0,'ordem'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_instituicao(mysql_result($consulta,0,'instituicao'));
			
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

	public static function numero_autores_by_resumo($codigo_resumo)
	{
		$conexao = new Conexao();
		$sql = "SELECT codigo_autor FROM Autor WHERE codigo_resumo='$codigo_resumo'";
		$consulta = $conexao->db_query($sql);
		$value = mysql_num_rows($consulta);
		$conexao = null;
		return $value;
	}
	
	public function find_by_nome($nome)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Autor WHERE nome='$nome'");
		$total = mysql_num_rows($consulta);

		if ($total==1){

			$this->set_codigo_autor(mysql_result($consulta,0,'codigo_autor'));
			$this->set_codigo_resumo(mysql_result($consulta,0,'codigo_resumo'));
			$this->set_ordem(mysql_result($consulta,0,'ordem'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_instituicao(mysql_result($consulta,0,'instituicao'));
			
			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		};
	}

	public static function find_all()
	{
		
		
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Autor ORDER BY ordem asc");
		$conexao = null;
		
		return $consulta;
	}
	
	public static function find_all_by_resumo($codigo_resumo)
	{
		
		
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Autor WHERE codigo_resumo ='$codigo_resumo'  ORDER BY ordem asc");
		$conexao = null;
		
		return $consulta;
	}

	
	public function insert()
	{
		$conexao = new Conexao();
	
		$sql = "INSERT INTO Autor (nome, instituicao, ordem, codigo_resumo) VALUES ('$this->nome', '$this->instituicao','$this->ordem','$this->codigo_resumo');";

		//echo $sql;
		
		if($conexao->db_update($sql)){
			//echo "Inserido<br>";

			$consulta = $conexao->db_query("SELECT MAX(codigo_autor) as ca FROM Autor WHERE codigo_resumo = $this->codigo_resumo and ordem = $this->ordem");
			$this->set_codigo_autor(mysql_result($consulta,0,'ca'));

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

		$sql = "UPDATE Autor SET nome = '$this->nome', instituicao = '$this->instituicao',ordem= '$this->ordem', codigo_resumo= '$this->codigo_resumo' WHERE codigo_autor = $this->codigo_autor";

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

	public function update_ordem_resumo()
	{
		$conexao = new Conexao();

		$sql = "UPDATE Autor SET nome = '$this->nome', instituicao = '$this->instituicao',ordem= '$this->ordem', codigo_resumo= '$this->codigo_resumo' WHERE codigo_resumo = $this->codigo_resumo and  ordem = $this->ordem";

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
	
	public function remove()
	{
		$conexao = new Conexao();

		$sql = "DELETE FROM Autor WHERE codigo_autor='$this->codigo_autor'";

		//echo $sql;
		
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
	public function remove_ordem_resumo()
	{
		$conexao = new Conexao();

		$sql = "DELETE FROM Autor WHERE codigo_resumo='$this->codigo_resumo' and ordem >= '$this->ordem'";

		//echo $sql;
		
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
}


?>
