<?php

require_once('class.conexao.php');

class NotaResumo
{

	private $codigo_evento;
	private $codigo_avaliador;
	private $codigo_pessoa;
	private $Q1;
	private $Q2;
	private $Q3;
	private $Q4;
	private $Q5;
	private $situacao;


	public function __construct()
	{
		$this->set_codigo_evento(NULL);
		$this->set_codigo_avaliador(NULL);
		$this->set_codigo_pessoa(NULL);
		$this->set_Q1(NULL);
		$this->set_Q2(NULL);
		$this->set_Q3(NULL);
		$this->set_Q4(NULL);
		$this->set_Q5(NULL);
		$this->set_situacao(NULL);
	}

	//setters
	public function set_codigo_evento($codigo_evento){$this->codigo_evento = $codigo_evento;}
	public function set_codigo_avaliador($codigo_avaliador){$this->codigo_avaliador = $codigo_avaliador;}
	public function set_codigo_pessoa($codigo_pessoa){$this->codigo_pessoa = $codigo_pessoa;}
	public function set_Q1($Q1){$this->Q1 = $Q1;}
	public function set_Q2($Q2){$this->Q2 = $Q2;}
	public function set_Q3($Q3){$this->Q3 = $Q3;}
	public function set_Q4($Q4){$this->Q4 = $Q4;}
	public function set_Q5($Q5){$this->Q5 = $Q5;}
	public function set_situacao($situacao){$this->situacao = $situacao;}

	//getters
	public function get_codigo_evento(){return $this->codigo_evento;}
	public function get_codigo_avaliador(){return $this->codigo_avaliador;}
	public function get_codigo_pessoa(){return $this->codigo_pessoa;}
	public function get_Q1(){return $this->Q1;}
	public function get_Q2(){return $this->Q2;}
	public function get_Q3(){return $this->Q3;}
	public function get_Q4(){return $this->Q4;}
	public function get_Q5(){return $this->Q5;}
	public function get_situacao(){return $this->situacao;}

	public function find_by_codigo($codigo_avaliador, $codigo_pessoa, $codigo_evento)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Nota_Resumo WHERE codigo_avaliador = '$codigo_avaliador' AND codigo_pessoa ='$codigo_pessoa' AND codigo_evento='$codigo_evento'");

		$total = mysql_num_rows($consulta);

		if ($total==1)
		{
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_codigo_avaliador(mysql_result($consulta,0,'codigo_avaliador'));
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_Q1(mysql_result($consulta,0,'Q1'));
			$this->set_Q2(mysql_result($consulta,0,'Q2'));
			$this->set_Q3(mysql_result($consulta,0,'Q3'));
			$this->set_Q4(mysql_result($consulta,0,'Q4'));
			$this->set_Q5(mysql_result($consulta,0,'Q5'));
			$this->set_situacao(mysql_result($consulta,0,'situacao'));

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

	public static function find_avaliacoes_by_avaliador($codigo_evento,$codigo_avaliador)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT *  FROM Nota_Resumo WHERE codigo_evento='$codigo_evento' and codigo_avaliador='$codigo_avaliador' ");

		$total = mysql_num_rows($consulta);
		$conexao = null;

		return $total;
	}



	public function	find_status($codigo_evento,$codigo_pessoa,$codigo_avaliador)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT situacao FROM Nota_Resumo WHERE codigo_avaliador = '$codigo_avaliador' AND codigo_pessoa ='$codigo_pessoa' AND codigo_evento='$codigo_evento'");

		$total = mysql_num_rows($consulta);

		if ($total==1)
		{
			$status = mysql_result($consulta,0,'situacao');

			mysql_free_result($consulta);
			$conexao = null;
			return $status;
		}
		else
		{
			$conexao = null;
			return False;
		};


	}


	public function	ranking_by_nivel_evento($nivel, $codigo_evento, $limite)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT nome, P.codigo_pessoa as codigo_pessoa, avg(Q1*0.4 + Q2*0.3 + Q3*0.3)  AS nota, avg(Q1) AS Q1, avg(Q2) AS Q2, avg(Q3) AS Q3, avg(Q4) AS Q4, avg(Q5) AS Q5, count(*) as numero_avaliacoes
										FROM Nota_Resumo N, Inscricao I, Pessoa P
										WHERE N.codigo_pessoa = P.codigo_pessoa AND P.codigo_pessoa = I.codigo_pessoa AND I.codigo_evento = '$codigo_evento' AND N.codigo_evento = '$codigo_evento' AND N.situacao IN (2) and I.nivel = '$nivel'
										GROUP BY nome, P.codigo_pessoa
										ORDER BY numero_avaliacoes DESC, nota DESC, Q1 DESC, Q2 DESC, Q3 DESC, Q4 DESC, Q5 DESC
										LIMIT 0, $limite
										");

		$conexao = null;

		return $consulta;
	}

	public function	ranking_by_nivel_evento_antiga_5_quesitos($nivel, $codigo_evento, $limite)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT nome, P.codigo_pessoa as codigo_pessoa, avg( (Q1 + Q2 + Q3 + Q4 +Q5)/5 ) AS nota, avg(Q1) AS Q1, avg(Q2) AS Q2, avg(Q3) AS Q3, avg(Q4) AS Q4, avg(Q5) AS Q5, count(*) as numero_avaliacoes
										FROM Nota_Resumo N, Inscricao I, Pessoa P
										WHERE N.codigo_pessoa = P.codigo_pessoa AND P.codigo_pessoa = I.codigo_pessoa AND I.codigo_evento = '$codigo_evento' AND N.codigo_evento = '$codigo_evento' AND N.situacao IN (2) and I.nivel = '$nivel'
										GROUP BY nome, P.codigo_pessoa
										ORDER BY numero_avaliacoes DESC, nota DESC, Q1 DESC, Q2 DESC, Q3 DESC, Q4 DESC, Q5 DESC
										LIMIT 0, $limite
										");

		$conexao = null;

		return $consulta;
	}


	public function find_by_inscricao($codigo_pessoa, $codigo_evento)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Nota_Resumo WHERE codigo_pessoa='$codigo_pessoa' AND codigo_evento='$codigo_evento'");
		$conexao = null;

		return $consulta;
	}

	public function find_all_pendentes($codigo_evento)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Nota_Resumo WHERE codigo_evento='$codigo_evento' and situacao IN (0,1)");
		$conexao = null;

		return $consulta;
	}

	public function find_by_codigo_avaliador_evento($codigo_avaliador, $codigo_evento)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT titulo, Nota_Resumo.codigo_pessoa codigo_pessoa, Nota_Resumo.situacao situacao, Q1, Q2, Q3, Q4, Q5 FROM Nota_Resumo, Resumo WHERE Nota_Resumo.codigo_pessoa = Resumo.codigo_pessoa and Nota_Resumo.codigo_evento = Resumo.codigo_evento  and Resumo.ingles = 0 and codigo_avaliador='$codigo_avaliador' and Resumo.codigo_evento='$codigo_evento' order by situacao,titulo");
		$conexao = null;

		return $consulta;
	}

	public static function find_all()
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Nota_Resumo");
		$conexao = null;

		return $consulta;
	}



	public function insert()
	{
		$conexao = new Conexao();

		$sql = "INSERT INTO Nota_Resumo (codigo_avaliador, codigo_evento, codigo_pessoa, Q1, Q2, Q3, Q4, Q5, situacao) VALUES ('$this->codigo_avaliador', '$this->codigo_evento', '$this->codigo_pessoa', '$this->Q1','$this->Q2','$this->Q3', '$this->Q4','$this->Q5', '$this->situacao');";

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

	public function insert_backup()
	{
		$conexao = new Conexao();

		$sql = "INSERT INTO Nota_Resumo_Back (codigo_avaliador, codigo_evento, codigo_pessoa, Q1, Q2, Q3, Q4, Q5, situacao) VALUES ('$this->codigo_avaliador', '$this->codigo_evento', '$this->codigo_pessoa', '$this->Q1','$this->Q2','$this->Q3', '$this->Q4','$this->Q5', '$this->situacao');";

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

		$sql = "UPDATE Nota_Resumo SET codigo_avaliador = $this->codigo_avaliador, codigo_evento = $this->codigo_evento,  codigo_pessoa = $this->codigo_pessoa,  Q1 = $this->Q1, Q2 = $this->Q2, Q3 = $this->Q3, Q4 = $this->Q4, Q5 = $this->Q5, situacao = $this->situacao
		WHERE codigo_pessoa = $this->codigo_pessoa AND codigo_evento = $this->codigo_evento AND codigo_avaliador = $this->codigo_avaliador";

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

	public function remove()
	{
		$conexao = new Conexao();

		$sql = "DELETE FROM Nota_Resumo WHERE codigo_pessoa = $this->codigo_pessoa AND codigo_evento = $this->codigo_evento AND codigo_avaliador = '$this->codigo_avaliador'";

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

	public function remove_all()
	{
		$conexao = new Conexao();

		$sql = "DELETE FROM Nota_Resumo";

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
