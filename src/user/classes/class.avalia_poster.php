<?php

require_once('class.conexao.php');

class AvaliaPoster{

	private $codigo_evento;
	private $codigo_avaliador1;
	private $codigo_avaliador2;
	private $codigo_pessoa;
	private $codigo_poster;
    	private $secao;


	public function __construct(){

		$this->set_codigo_evento(NULL);
		$this->set_codigo_avaliador1(NULL);
		$this->set_codigo_avaliador2(NULL);
		$this->set_codigo_pessoa(NULL);
		$this->set_codigo_poster(NULL);
		$this->set_secao(NULL);
	}

	//setters
	public function set_codigo_evento($codigo_evento){$this->codigo_evento = $codigo_evento;}
	public function set_codigo_avaliador1($codigo_avaliador1){$this->codigo_avaliador1 = $codigo_avaliador1;}
	public function set_codigo_avaliador2($codigo_avaliador2){$this->codigo_avaliador2 = $codigo_avaliador2;}
	public function set_codigo_pessoa($codigo_pessoa){$this->codigo_pessoa = $codigo_pessoa;}
	public function set_codigo_poster($codigo_poster){$this->codigo_poster = $codigo_poster;}
	public function set_secao($secao){$this->secao = $secao;}

	//getters
	public function get_codigo_evento(){return $this->codigo_evento;}
	public function get_codigo_avaliador1(){return $this->codigo_avaliador1;}
	public function get_codigo_avaliador2(){return $this->codigo_avaliador2;}
	public function get_codigo_pessoa(){return $this->codigo_pessoa;}
	public function get_codigo_poster(){return $this->codigo_poster;}
	public function get_secao(){return $this->secao;}



	public function find_avaliacoes_by_avaliador($codigo_evento,$codigo_avaliador)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Avalia_Poster WHERE codigo_evento='$codigo_evento' and (codigo_avaliador1 = $codigo_avaliador or codigo_avaliador2 = $codigo_avaliador)");

		$total = mysql_num_rows($consulta);
		$conexao = null;

		return $total;
	}
	public function find_avaliacoes_by_avaliador_secao($codigo_evento,$codigo_avaliador, $secao)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Avalia_Poster WHERE codigo_evento='$codigo_evento' and (codigo_avaliador1 = $codigo_avaliador or codigo_avaliador2 = $codigo_avaliador) and secao = $secao");

		$total = mysql_num_rows($consulta);
		$conexao = null;

		return $total;
	}
	public function find_all_by_secao($codigo_evento,$secao)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Avalia_Poster WHERE codigo_evento='$codigo_evento' and secao= $secao");


		$conexao = null;

		return $consulta;
	}

	public function find_all_resumo_by_secao($codigo_evento,$secao)
	{
		$conexao = new Conexao();
		$sql="SELECT nome, P.codigo_pessoa codigo_pessoa FROM Pessoa P, Avalia_Poster A WHERE P.codigo_pessoa =A.codigo_pessoa and  codigo_evento='$codigo_evento' and secao= $secao order by nome";
		$consulta = $conexao->db_query($sql);
		//echo $sql;

		$conexao = null;

		return $consulta;
	}

	public function find_all_avaliador_by_secao($codigo_evento,$secao)
	{
		$conexao = new Conexao();
		$sql="SELECT Av.nome nome, P.codigo_pessoa codigo_pessoa, I.nivel nivel FROM Pessoa P, Avalia_Poster A, Inscricao I, Avaliador Av WHERE (Av.codigo_avaliador = A.codigo_avaliador1 or Av.codigo_avaliador= A.codigo_avaliador2) and P.codigo_pessoa =I.codigo_pessoa and A.codigo_evento =I.codigo_evento and P.codigo_pessoa =A.codigo_pessoa and  A.codigo_evento='$codigo_evento' and secao= $secao order by Av.nome, codigo_pessoa";
		$consulta = $conexao->db_query($sql);
		//echo $sql;

		$conexao = null;

		return $consulta;
	}

	public function find_all_painel_by_secao($codigo_evento,$secao)
	{
		$conexao = new Conexao();
		$sql="SELECT nome, P.codigo_pessoa codigo_pessoa, nivel FROM Pessoa P, Avalia_Poster A, Inscricao I WHERE P.codigo_pessoa =I.codigo_pessoa and P.codigo_pessoa =A.codigo_pessoa and I.codigo_evento=A.codigo_evento and  A.codigo_evento='$codigo_evento' and secao= $secao order by nome";
		$consulta = $conexao->db_query($sql);
		//echo $sql;

		$conexao = null;

		return $consulta;
	}

	public function find_by_codigo($codigo_pessoa, $codigo_evento){//email UNIQUE

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Avalia_Poster WHERE codigo_pessoa='$codigo_pessoa' AND codigo_evento='$codigo_evento'");

		$total = mysql_num_rows($consulta);

		if ($total==1){

			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_codigo_avaliador1(mysql_result($consulta,0,'codigo_avaliador1'));
			$this->set_codigo_avaliador2(mysql_result($consulta,0,'codigo_avaliador2'));
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_codigo_poster(mysql_result($consulta,0,'codigo_poster'));
			$this->set_secao(mysql_result($consulta,0,'secao'));

			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		};
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
		$sql="SELECT Pessoa.codigo_pessoa codigo_pessoa, Inscricao.codigo_evento codigo_evento,
Resumo.titulo titulo, Inscricao.grupo grupo, Inscricao.curso curso, Inscricao.nivel nivel,Avalia_Poster.codigo_avaliador1 codigo_avaliador1,Avalia_Poster.codigo_avaliador2 codigo_avaliador2  FROM  Pessoa, Inscricao, Resumo,Avalia_Poster LEFT JOIN Avaliador A1 on A1.codigo_avaliador = Avalia_Poster.codigo_avaliador1 LEFT JOIN  Avaliador A2 on A2.codigo_avaliador = Avalia_Poster.codigo_avaliador2 LEFT JOIN Nota_Resumo N1 on Avalia_Poster.codigo_pessoa = N1.codigo_pessoa and Avalia_Poster.codigo_avaliador1 = N1.codigo_avaliador and N1.codigo_evento=Avalia_Poster.codigo_evento LEFT JOIN Nota_Resumo N2 on Avalia_Poster.codigo_pessoa = N2.codigo_pessoa and Avalia_Poster.codigo_avaliador2 = N2.codigo_avaliador and N2.codigo_evento=Avalia_Poster.codigo_evento WHERE Avalia_Poster.codigo_pessoa = Pessoa.codigo_pessoa AND Avalia_Poster.codigo_evento = Inscricao.codigo_evento AND Avalia_Poster.codigo_pessoa = Inscricao.codigo_pessoa AND Resumo.codigo_resumo = Inscricao.codigo_resumo AND Inscricao.codigo_evento='$codigo_evento' and (Pessoa.nome like '$nome_like' or Pessoa.email like '$nome_like' or A1.nome like '$nome_like' or A2.nome like '$nome_like')  $filtro order by Pessoa.nome";
		//echo $sql;

		$consulta = $conexao->db_query($sql);
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
		/*$sql="SELECT  Pessoa.codigo_pessoa codigo_pessoa, Pessoa.nome nome, Inscricao.codigo_evento codigo_evento,
Resumo.titulo titulo, Inscricao.grupo grupo, Inscricao.curso curso, Inscricao.nivel nivel,Avalia_Poster.codigo_avaliador1 codigo_avaliador1,Avalia_Poster.codigo_avaliador2 codigo_avaliador2, Avalia_Poster.secao secao FROM  Pessoa, Inscricao, Resumo,Avalia_Poster LEFT JOIN Avaliador A1 on A1.codigo_avaliador = Avalia_Poster.codigo_avaliador1 LEFT JOIN  Avaliador A2 on A2.codigo_avaliador = Avalia_Poster.codigo_avaliador2 LEFT JOIN Nota_Resumo N1 on Avalia_Poster.codigo_pessoa = N1.codigo_pessoa and Avalia_Poster.codigo_avaliador1 = N1.codigo_avaliador and N1.codigo_evento=Avalia_Poster.codigo_evento LEFT JOIN Nota_Resumo N2 on Avalia_Poster.codigo_pessoa = N2.codigo_pessoa and Avalia_Poster.codigo_avaliador2 = N2.codigo_avaliador and N2.codigo_evento=Avalia_Poster.codigo_evento WHERE Avalia_Poster.codigo_pessoa = Pessoa.codigo_pessoa AND Avalia_Poster.codigo_evento = Inscricao.codigo_evento AND Avalia_Poster.codigo_pessoa = Inscricao.codigo_pessoa AND Resumo.codigo_resumo = Inscricao.codigo_resumo AND Inscricao.codigo_evento='$codigo_evento' and (Pessoa.nome like '$nome_like' or Pessoa.email like '$nome_like' or A1.nome like '$nome_like' or A2.nome like '$nome_like')  $filtro order by Pessoa.nome";	*/
		$sql = "SELECT Pessoa.codigo_pessoa codigo_pessoa, Pessoa.nome nome, Inscricao.codigo_evento codigo_evento,
Resumo.titulo titulo, Inscricao.grupo grupo, Inscricao.curso curso, Inscricao.subarea subarea, Inscricao.nivel nivel,Avalia_Poster.codigo_avaliador1 codigo_avaliador1,Avalia_Poster.codigo_avaliador2 codigo_avaliador2, Avalia_Poster.secao secao  FROM Pessoa, Inscricao, Resumo,Avalia_Poster LEFT JOIN Avaliador A1 on A1.codigo_avaliador = Avalia_Poster.codigo_avaliador1 LEFT JOIN  Avaliador A2 on A2.codigo_avaliador = Avalia_Poster.codigo_avaliador2 WHERE Avalia_Poster.codigo_pessoa = Pessoa.codigo_pessoa AND Avalia_Poster.codigo_evento = Inscricao.codigo_evento AND Avalia_Poster.codigo_pessoa = Inscricao.codigo_pessoa AND Resumo.codigo_resumo = Inscricao.codigo_resumo AND Inscricao.codigo_evento='$codigo_evento' and (Pessoa.nome like '$nome_like' or Pessoa.email like '$nome_like' or A1.nome like '$nome_like' or A2.nome like '$nome_like')  $filtro order by Pessoa.nome";
		//echo $sql;

		if (!$pagina_atual)	$pagina_atual = "1";
		//echo "limite".$registro_inicial." - ".$limite;
		$registro_inicial = (($pagina_atual - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;

		return $intervalo;
	}
	public function find_by_inscricao($codigo_pessoa, $codigo_evento){//email UNIQUE

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Avalia_Poster WHERE codigo_pessoa='$codigo_pessoa' AND codigo_evento='$codigo_evento'");
		$conexao = null;

		return $consulta;
	}

	public function find_by_codigo_avaliador($codigo_avaliador, $codigo_pessoa, $codigo_evento){//email UNIQUE

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Avalia_Poster WHERE codigo_evento ='$codigo_evento' and codigo_pessoa ='$codigo_pessoa' and (codigo_avaliador1 ='$codigo_avaliador' or codigo_avaliador2 ='$codigo_avaliador') ");
		$conexao = null;

		return $consulta;
	}

	public function find_by_codigo_avaliador_evento_secao($codigo_avaliador,$codigo_evento, $secao){//email UNIQUE

		$conexao = new Conexao();
		$sql="SELECT titulo, nivel, Avalia_Poster.codigo_pessoa codigo_pessoa FROM Avalia_Poster, Resumo, Inscricao   WHERE Avalia_Poster.codigo_pessoa = Inscricao.codigo_pessoa and
Avalia_Poster.codigo_evento = Inscricao.codigo_evento and
Inscricao.codigo_resumo = Resumo.codigo_resumo and
(codigo_avaliador1='$codigo_avaliador' or codigo_avaliador2='$codigo_avaliador' ) and
Avalia_Poster.codigo_evento='$codigo_evento' and
secao ='$secao'";
		//echo $sql;
		$consulta = $conexao->db_query($sql);
		$conexao = null;

		return $consulta;
	}



	public static function find_all_avaliacoes(){//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Avalia_Poster, Inscricao, Pessoa WHERE Avalia_Poster.codigo_pessoa = Inscricao.codigo_pessoa and
Avalia_Poster.codigo_evento = Inscricao.codigo_evento and
Pessoa.codigo_pessoa = Inscricao.codigo_pessoa");
		$conexao = null;

		return $consulta;
	}


	public function insert(){
		$conexao = new Conexao();

		$sql = "INSERT INTO Avalia_Poster (codigo_avaliador1,codigo_avaliador2, codigo_evento, codigo_pessoa, codigo_poster, secao) VALUES ('$this->codigo_avaliador1','$this->codigo_avaliador2',  '$this->codigo_evento', '$this->codigo_pessoa', '$this->codigo_poster', '$this->secao');";

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

		$sql = "UPDATE Avalia_Poster SET codigo_avaliador1 = '$this->codigo_avaliador1',codigo_avaliador2 = '$this->codigo_avaliador2', codigo_evento = '$this->codigo_evento',  codigo_pessoa = '$this->codigo_pessoa', codigo_poster = '$this->codigo_poster', secao = '$this->secao'
		WHERE codigo_pessoa = $this->codigo_pessoa AND codigo_evento = $this->codigo_evento ";

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

		$sql = "DELETE FROM Avalia_Poster WHERE codigo_pessoa = $this->codigo_pessoa AND codigo_evento = $this->codigo_evento AND codigo_avaliador = '$this->codigo_avaliador'";

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
