<?php

require_once('class.conexao.php');

class Avaliacao
{

	private $codigo_avaliador;
	private $codigo_evento;
	private $secao;
	
	public function __construct(){
		
		$this->set_codigo_avaliador(NULL);
		$this->set_codigo_evento(NULL);
		$this->set_secao(NULL);
	}

	//setters
	public function set_codigo_avaliador($codigo_avaliador){$this->codigo_avaliador = $codigo_avaliador;}
	public function set_codigo_evento($codigo_evento){$this->codigo_evento = $codigo_evento;}
	public function set_secao($secao){$this->secao = $secao;}

	//getters
	public function get_codigo_avaliador(){return $this->codigo_avaliador;}
	public function get_codigo_evento(){return $this->codigo_evento;}
	public function get_secao(){return $this->secao;}
	
	
	
	
	public static function find_by_avaliador_evento($codigo_avaliador, $codigo_evento)
	{
		$conexao = new Conexao();
		
		$consulta = $conexao->db_query("SELECT secao FROM Avaliacao WHERE codigo_avaliador = '" . $codigo_avaliador . "' AND codigo_evento = '" . $codigo_evento . "'");
		$conexao = null;
		
		return $consulta;
	}
	
	public static function find_poster_by_avaliador_evento($codigo_avaliador, $codigo_evento)
	{
		$conexao = new Conexao();
		
		$consulta = $conexao->db_query("SELECT secao FROM Avaliacao WHERE codigo_avaliador = '" . $codigo_avaliador . "' AND codigo_evento = '" . $codigo_evento . "' and secao > 0");
		$conexao = null;
		
		return $consulta;
	}

	public static function find_resumo_by_avaliador_evento($codigo_avaliador, $codigo_evento)
	{
		$conexao = new Conexao();
		$sql="SELECT secao FROM Avaliacao WHERE codigo_avaliador = '" . $codigo_avaliador . "' AND codigo_evento = '" . $codigo_evento . "' and secao = 0";
		//echo $sql;
		$consulta = $conexao->db_query($sql);
		$conexao = null;
		
		return $consulta;
	}

	public static function find_total_avaliacoes_by_avaliador_secao($codigo_evento)
	{
		$conexao = new Conexao();
		$sql="SELECT codigo_avaliador, count(secao) avaliacoes FROM Avaliacao WHERE codigo_evento = '" . $codigo_evento . "' group by codigo_avaliador";
		//echo $sql;
		$consulta = $conexao->db_query($sql);
		$conexao = null;
		
		return $consulta;
	}


	public function find($codigo_avaliador, $secao, $codigo_evento)
	{

		$conexao = new Conexao();
		$sql="SELECT * FROM Avaliacao WHERE codigo_avaliador='$codigo_avaliador' AND codigo_evento='$codigo_evento' AND secao='$secao'";
		//echo $sql;
		$consulta = $conexao->db_query($sql);
		$total = mysql_num_rows($consulta);

		if ($total==1)
		{

			$this->set_codigo_avaliador(mysql_result($consulta,0,'codigo_avaliador'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_secao(mysql_result($consulta,0,'secao'));
			
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
	
	public static function find_all()
	{

		
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Avaliacao ORDER BY codigo_avaliador DESC");
		$conexao = null;
		
		return $consulta;
	}

	public static function find_all_secao($codigo_evento,$secao)
	{		
		$conexao = new Conexao();
		
		$consulta = $conexao->db_query("SELECT Avaliador.codigo_avaliador codigo_avaliador,Avaliador.email email, Avaliador.nome nome,Avaliador.area1 area1,Avaliador.area2 area2, Avaliador.subarea subarea,Avaliador.grupo grupo  FROM Avaliacao, Avaliador WHERE Avaliacao.codigo_avaliador = Avaliador.codigo_avaliador AND codigo_evento='$codigo_evento' AND secao='$secao' ORDER BY Avaliador.nome");
		$conexao = null;
		
		return $consulta;
	}

	public static function find_all_filtro($codigo_evento,$nome,$filtro)
	{		
		$conexao = new Conexao();

		$nomeexp = explode(" ", $nome);
		$nome_like = "%";
		for ( $j = 0; $j < sizeof($nomeexp); $j++ )
		{
			$nome_like .= $nomeexp[$j] . "%";
		}
		
		$sql = "SELECT Avaliador.codigo_avaliador codigo_avaliador, nome, email, area1, area2, subarea, grupo, nivel FROM Avaliador LEFT JOIN (SELECT * from Avaliacao  WHERE codigo_evento=$codigo_evento) Av on Avaliador.codigo_avaliador = Av.codigo_avaliador WHERE ( nome LIKE '$nome_like' OR email LIKE '$nome_like')  $filtro  
		GROUP BY Avaliador.codigo_avaliador, nome, email, area1, area2, subarea, grupo, nivel
		ORDER BY nome";


		//echo $sql;
		$consulta = $conexao->db_query($sql);
		$conexao = null;
		
		return $consulta;
	}

	public static function find_limmited_filtro($codigo_evento,$pagina_atual,$limite,$nome,$filtro)
	{		
		$conexao = new Conexao();

		$nomeexp = explode(" ", $nome);
		$nome_like = "%";
		for ( $j = 0; $j < sizeof($nomeexp); $j++ )
		{
			$nome_like .= $nomeexp[$j] . "%";
		}
		
		$sql = "SELECT Avaliador.codigo_avaliador codigo_avaliador, nome, email, area1, area2, subarea, grupo, nivel FROM Avaliador LEFT JOIN (SELECT * from Avaliacao  WHERE codigo_evento=$codigo_evento) Av on Avaliador.codigo_avaliador = Av.codigo_avaliador WHERE ( nome LIKE '$nome_like' OR email LIKE '$nome_like')  $filtro  
		GROUP BY Avaliador.codigo_avaliador, nome, email, area1, area2, subarea, grupo, nivel
		ORDER BY nome";

		//echo $sql;
		if (!$pagina_atual)	$pagina_atual = "1"; 
		
		$registro_inicial = (($pagina_atual - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;
		
		return $intervalo;		
	}
	
	public static function find_all_secao_area($codigo_evento, $area, $secao)
	{		
		$conexao = new Conexao();
		
		$consulta = $conexao->db_query("SELECT Avaliador.codigo_avaliador codigo_avaliador, Avaliador.nome nome,Avaliador.area1 area1,Avaliador.area2 area2,Avaliador.grupo grupo  FROM Avaliacao, Avaliador WHERE Avaliacao.codigo_avaliador = Avaliador.codigo_avaliador AND ( Avaliador.area1 = '$area' OR Avaliador.area2 = '$area' ) AND codigo_evento='$codigo_evento' AND secao='$secao' ORDER BY Avaliador.nome");
		$conexao = null;
		
		return $consulta;
	}

	
	public function insert()
	{
		$conexao = new Conexao();
	
		$sql = "INSERT INTO Avaliacao (codigo_avaliador, codigo_evento, secao) VALUES ('$this->codigo_avaliador', '$this->codigo_evento', '$this->secao');";

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
	
	public function remove($codigo_evento,$secao)
	{
		$conexao = new Conexao();

		$sql = "DELETE FROM Avaliacao WHERE codigo_avaliador = $this->codigo_avaliador AND codigo_evento='$codigo_evento' AND secao='$secao'";

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
	
	public function remove_by_avaliador($codigo_avaliador)
	{
		$conexao = new Conexao();

		$sql = "DELETE FROM Avaliacao WHERE codigo_avaliador = $codigo_avaliador";

		//echo $sql;
		
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

	public function remove_by_avaliador_and_evento($codigo_avaliador,$codigo_evento)
	{
		$conexao = new Conexao();

		$sql = "DELETE FROM Avaliacao WHERE codigo_avaliador = $codigo_avaliador and codigo_evento = $codigo_evento";

		//echo $sql;
		
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
