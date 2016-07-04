<?php

require_once('class.conexao.php');

class AvaliaResumo{

	private $codigo_evento;
	private $codigo_pessoa;
	private $codigo_avaliador1;
	private $codigo_avaliador2;	
	
	public function __construct(){
		
		$this->set_codigo_evento(NULL);
		$this->set_codigo_pessoa(NULL);
		$this->set_codigo_avaliador1(NULL);
		$this->set_codigo_avaliador2(NULL);
		
	}

	//setters
	public function set_codigo_evento($codigo_evento){$this->codigo_evento = $codigo_evento;}
	public function set_codigo_pessoa($codigo_pessoa){$this->codigo_pessoa = $codigo_pessoa;}
	public function set_codigo_avaliador1($codigo_avaliador1){$this->codigo_avaliador1 = $codigo_avaliador1;}	
	public function set_codigo_avaliador2($codigo_avaliador2){$this->codigo_avaliador2 = $codigo_avaliador2;}	

	//getters
	public function get_codigo_evento(){return $this->codigo_evento;}
	public function get_codigo_pessoa(){return $this->codigo_pessoa;}
	public function get_codigo_avaliador1(){return $this->codigo_avaliador1;}
	public function get_codigo_avaliador2(){return $this->codigo_avaliador2;}

	public function find_avaliacoes_by_avaliador($codigo_evento,$codigo_avaliador)
	{
		$conexao = new Conexao();
		
		$consulta = $conexao->db_query("SELECT * FROM Avalia_Resumo WHERE codigo_evento='$codigo_evento' and (codigo_avaliador1 = $codigo_avaliador or codigo_avaliador2 = $codigo_avaliador)");
		
		$total = mysql_num_rows($consulta);
		$conexao = null;

		return $total;
	}

	
	public function find_by_codigo($codigo_pessoa, $codigo_evento){

		$conexao = new Conexao();
		
		$consulta = $conexao->db_query("SELECT * FROM Avalia_Resumo WHERE codigo_pessoa ='$codigo_pessoa' AND codigo_evento='$codigo_evento'");
		
		$total = mysql_num_rows($consulta);

		if ($total==1){

			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_codigo_avaliador1(mysql_result($consulta,0,'codigo_avaliador1'));
			$this->set_codigo_avaliador2(mysql_result($consulta,0,'codigo_avaliador2'));
			
			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		};
	}
	
	public function find_by_avaliador_evento($codigo_avaliador, $codigo_evento)
	{

		$conexao = new Conexao();
		
		$consulta = $conexao->db_query("SELECT * FROM Avalia_Resumo WHERE ( codigo_avaliador1 ='$codigo_avaliador' OR codigo_avaliador2 ='$codigo_avaliador' ) AND codigo_evento='$codigo_evento'");
		
		$conexao = null;
		
		return $consulta;
	}
	
	public static function find_all($codigo_evento,$nome="", $filtro="")
	{

		
		$conexao = new Conexao();

		$nomeexp = explode(" ", $nome);
		$nome_like = "%";
		for ( $j = 0; $j < sizeof($nomeexp); $j++ )
		{
			$nome_like .= $nomeexp[$j] . "%";
		}

		$consulta = $conexao->db_query("SELECT Pessoa.codigo_pessoa codigo_pessoa, Pessoa.nome nome, Inscricao.codigo_evento codigo_evento,
Resumo.titulo titulo, Inscricao.grupo grupo, Inscricao.curso curso, Inscricao.nivel nivel,Avalia_Resumo.codigo_avaliador1 codigo_avaliador1,Avalia_Resumo.codigo_avaliador2 codigo_avaliador2  
FROM Pessoa 
JOIN Inscricao ON Inscricao.codigo_pessoa = Pessoa.codigo_pessoa
JOIN Resumo ON Resumo.codigo_resumo = Inscricao.codigo_resumo
JOIN Avalia_Resumo ON Avalia_Resumo.codigo_evento = Inscricao.codigo_evento AND Avalia_Resumo.codigo_pessoa = Inscricao.codigo_pessoa
LEFT JOIN Avaliador A1 on A1.codigo_avaliador = Avalia_Resumo.codigo_avaliador1 
LEFT JOIN Avaliador A2 on A2.codigo_avaliador = Avalia_Resumo.codigo_avaliador2 
LEFT JOIN Nota_Resumo N1 on Avalia_Resumo.codigo_pessoa = N1.codigo_pessoa and Avalia_Resumo.codigo_avaliador1 = N1.codigo_avaliador and Avalia_Resumo.codigo_evento = N1.codigo_evento
LEFT JOIN Nota_Resumo N2 on Avalia_Resumo.codigo_pessoa = N2.codigo_pessoa and Avalia_Resumo.codigo_avaliador2 = N2.codigo_avaliador and Avalia_Resumo.codigo_evento = N2.codigo_evento
WHERE Inscricao.codigo_evento='$codigo_evento' 
and (Pessoa.nome like '$nome_like' or Pessoa.email like '$nome_like' or A1.nome like '$nome_like' or A2.nome like '$nome_like')  $filtro 
order by Pessoa.nome");
		$conexao = null;
		
		return $consulta;
	}

	

	public static function find_limmited_all($codigo_evento,$pagina_atual, $limite,$nome, $filtro)
	{
	
		$conexao = new Conexao();

		$nomeexp = explode(" ", $nome);
		$nome_like = "%";
		for ( $j = 0; $j < sizeof($nomeexp); $j++ )
		{
			$nome_like .= $nomeexp[$j] . "%";
		}
			
		$sql = "SELECT Pessoa.codigo_pessoa codigo_pessoa, Pessoa.nome nome, Inscricao.codigo_evento codigo_evento,
Resumo.titulo titulo, Inscricao.grupo grupo, Inscricao.curso curso, Inscricao.subarea subarea, Inscricao.nivel nivel,Avalia_Resumo.codigo_avaliador1 codigo_avaliador1,Avalia_Resumo.codigo_avaliador2 codigo_avaliador2  
FROM Pessoa 
JOIN Inscricao ON Inscricao.codigo_pessoa = Pessoa.codigo_pessoa
JOIN Resumo ON Resumo.codigo_resumo = Inscricao.codigo_resumo
JOIN Avalia_Resumo ON Avalia_Resumo.codigo_evento = Inscricao.codigo_evento AND Avalia_Resumo.codigo_pessoa = Inscricao.codigo_pessoa
LEFT JOIN Avaliador A1 on A1.codigo_avaliador = Avalia_Resumo.codigo_avaliador1 
LEFT JOIN Avaliador A2 on A2.codigo_avaliador = Avalia_Resumo.codigo_avaliador2 
LEFT JOIN Nota_Resumo N1 on Avalia_Resumo.codigo_pessoa = N1.codigo_pessoa and Avalia_Resumo.codigo_avaliador1 = N1.codigo_avaliador and Avalia_Resumo.codigo_evento = N1.codigo_evento
LEFT JOIN Nota_Resumo N2 on Avalia_Resumo.codigo_pessoa = N2.codigo_pessoa and Avalia_Resumo.codigo_avaliador2 = N2.codigo_avaliador and Avalia_Resumo.codigo_evento = N2.codigo_evento
WHERE Inscricao.codigo_evento='$codigo_evento' 
and (Pessoa.nome like '$nome_like' or Pessoa.email like '$nome_like' or A1.nome like '$nome_like' or A2.nome like '$nome_like')  $filtro 
order by Pessoa.nome";
		//echo $sql;
				
		if (!$pagina_atual)	$pagina_atual = "1"; 
		//echo "pagina_atual".$pagina_atual;		
		$registro_inicial = (($pagina_atual - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;
		
		return $intervalo;
	}
	
	public function insert(){
		$conexao = new Conexao();
	
		$sql = "INSERT INTO Avalia_Resumo (codigo_evento, codigo_pessoa, codigo_avaliador1,codigo_avaliador2) VALUES ('$this->codigo_evento', '$this->codigo_pessoa','$this->codigo_avaliador1','$this->codigo_avaliador2' );";

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

		$sql = "UPDATE Avalia_Resumo SET codigo_evento = '$this->codigo_evento',  codigo_pessoa = '$this->codigo_pessoa' ,codigo_avaliador1 = '$this->codigo_avaliador1',codigo_avaliador2 = '$this->codigo_avaliador2'
		WHERE codigo_pessoa = $this->codigo_pessoa AND codigo_evento = $this->codigo_evento";

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

		$sql = "DELETE FROM Avalia_Resumo WHERE codigo_pessoa = $this->codigo_pessoa AND codigo_evento = $this->codigo_evento";

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

	public function remove_all(){
		$conexao = new Conexao();

		$sql = "DELETE FROM Avalia_Resumo";

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
