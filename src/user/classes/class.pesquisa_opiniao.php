<?php

require_once('class.conexao.php');

class PesquisaOpiniao
{

	private $codigo_opiniao;
	private $codigo_pessoa;
	private $codigo_avaliador;
	private $codigo_evento;
	private $notas;
	private $comments;
	private $codigo_minicurso;
	private $minicurso_nota;
	private $minicurso_comment;

	public function __construct()
	{
		$this->set_codigo_opiniao(NULL);
		$this->set_codigo_pessoa(NULL);
		$this->set_codigo_avaliador(NULL);
		$this->set_codigo_evento(NULL);
		$this->set_notas(NULL);
		$this->set_comments(NULL);
		$this->set_codigo_minicurso(NULL);
		$this->set_minicurso_nota(NULL);
		$this->set_minicurso_comment(NULL);
	}

	//setters
	public function set_codigo_opiniao($codigo_opiniao){$this->codigo_opiniao = $codigo_opiniao;}
	public function set_codigo_pessoa($codigo_pessoa){$this->codigo_pessoa = $codigo_pessoa;}
	public function set_codigo_avaliador($codigo_avaliador){$this->codigo_avaliador = $codigo_avaliador;}
	public function set_codigo_evento($codigo_evento){$this->codigo_evento = $codigo_evento;}
	public function set_notas($notas){$this->notas = $notas;}
	public function set_comments($comments){$this->comments = $comments;}
	public function set_codigo_minicurso($codigo_minicurso){$this->codigo_minicurso = $codigo_minicurso;}
	public function set_minicurso_nota($minicurso_nota){$this->minicurso_nota = $minicurso_nota;}
	public function set_minicurso_comment($minicurso_comment){$this->minicurso_comment = $minicurso_comment;}

	//getters
	public function get_codigo_opiniao(){return $this->codigo_opiniao;}
	public function get_codigo_pessoa(){return $this->codigo_pessoa;}
	public function get_codigo_avaliador(){return $this->codigo_avaliador;}
	public function get_codigo_evento(){return $this->codigo_evento;}
	public function get_codigo_notas(){return $this->codigo_notas;}
	public function get_codigo_comments(){return $this->codigo_comments;}
	public function get_codigo_minicurso(){return $this->codigo_minicurso;}
	public function get_minicurso_nota(){return $this->minicurso_nota;}
	public function get_minicurso_comment(){return $this->minicurso_comment;}


	public function find_by_codigo($codigo_opiniao, $codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM PesquisaOpiniao
										WHERE  codigo_opiniao='$codigo_opiniao' AND codigo_evento='$codigo_evento'");

		$total = mysql_num_rows($consulta);

		if ($total==1)
		{
			$this->set_codigo_opiniao(mysql_result($consulta,0,'codigo_opiniao'));
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_codigo_avaliador(mysql_result($consulta,0,'codigo_avaliador'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_codigo_minicurso(mysql_result($consulta,0,'codigo_minicurso'));
			$this->set_minicurso_nota(mysql_result($consulta,0,'minicurso_nota'));
			$this->set_minicurso_comment(mysql_result($consulta,0,'minicurso_comment'));

			$notas = array(
				1 => mysql_result($consulta,0,'Q1_nota'),
				2 => mysql_result($consulta,0,'Q2_nota'),
				3 => mysql_result($consulta,0,'Q3_nota'),
				4 => mysql_result($consulta,0,'Q4_nota'),
				5 => mysql_result($consulta,0,'Q5_nota'),
				6 => mysql_result($consulta,0,'Q6_nota'),
				7 => mysql_result($consulta,0,'Q7_nota')
			);
			$this->set_notas($notas);

			$comments = array(
				1 => mysql_result($consulta,0,'Q1_comentario'),
				2 => mysql_result($consulta,0,'Q2_comentario'),
				3 => mysql_result($consulta,0,'Q3_comentario'),
				4 => mysql_result($consulta,0,'Q4_comentario'),
				5 => mysql_result($consulta,0,'Q5_comentario'),
				6 => mysql_result($consulta,0,'Q6_comentario'),
				7 => mysql_result($consulta,0,'Q7_comentario')
			);
			$this->set_comments($comments);

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


	public function find_by_pessoa_evento($codigo_pessoa, $codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM PesquisaOpiniao
										WHERE codigo_pessoa='$codigo_pessoa' AND codigo_evento='$codigo_evento'");

		$total = mysql_num_rows($consulta);

		if ($total==1)
		{
			$this->set_codigo_opiniao(mysql_result($consulta,0,'codigo_opiniao'));
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_codigo_avaliador(mysql_result($consulta,0,'codigo_avaliador'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_codigo_minicurso(mysql_result($consulta,0,'codigo_minicurso'));
			$this->set_minicurso_nota(mysql_result($consulta,0,'minicurso_nota'));
			$this->set_minicurso_comment(mysql_result($consulta,0,'minicurso_comment'));

			$notas = array(
				1 => mysql_result($consulta,0,'Q1_nota'),
				2 => mysql_result($consulta,0,'Q2_nota'),
				3 => mysql_result($consulta,0,'Q3_nota'),
				4 => mysql_result($consulta,0,'Q4_nota'),
				5 => mysql_result($consulta,0,'Q5_nota'),
				6 => mysql_result($consulta,0,'Q6_nota'),
				7 => mysql_result($consulta,0,'Q7_nota')
			);
			$this->set_notas($notas);

			$comments = array(
				1 => mysql_result($consulta,0,'Q1_comentario'),
				2 => mysql_result($consulta,0,'Q2_comentario'),
				3 => mysql_result($consulta,0,'Q3_comentario'),
				4 => mysql_result($consulta,0,'Q4_comentario'),
				5 => mysql_result($consulta,0,'Q5_comentario'),
				6 => mysql_result($consulta,0,'Q6_comentario'),
				7 => mysql_result($consulta,0,'Q7_comentario')
			);
			$this->set_comments($comments);

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


	public function find_by_avaliador_evento($codigo_avaliador, $codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM PesquisaOpiniao
										WHERE codigo_avaliador='$codigo_avaliador' AND codigo_evento='$codigo_evento'");

		$total = mysql_num_rows($consulta);

		if ($total==1)
		{
			$this->set_codigo_opiniao(mysql_result($consulta,0,'codigo_opiniao'));
			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_codigo_avaliador(mysql_result($consulta,0,'codigo_avaliador'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_codigo_minicurso(mysql_result($consulta,0,'codigo_minicurso'));
			$this->set_minicurso_nota(mysql_result($consulta,0,'minicurso_nota'));
			$this->set_minicurso_comment(mysql_result($consulta,0,'minicurso_comment'));

			$notas = array(
				1 => mysql_result($consulta,0,'Q1_nota'),
				2 => mysql_result($consulta,0,'Q2_nota'),
				3 => mysql_result($consulta,0,'Q3_nota'),
				4 => mysql_result($consulta,0,'Q4_nota'),
				5 => mysql_result($consulta,0,'Q5_nota'),
				6 => mysql_result($consulta,0,'Q6_nota'),
				7 => mysql_result($consulta,0,'Q7_nota')
			);
			$this->set_notas($notas);

			$comments = array(
				1 => mysql_result($consulta,0,'Q1_comentario'),
				2 => mysql_result($consulta,0,'Q2_comentario'),
				3 => mysql_result($consulta,0,'Q3_comentario'),
				4 => mysql_result($consulta,0,'Q4_comentario'),
				5 => mysql_result($consulta,0,'Q5_comentario'),
				6 => mysql_result($consulta,0,'Q6_comentario'),
				7 => mysql_result($consulta,0,'Q7_comentario')
			);
			$this->set_comments($comments);

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


	public static function media_minicurso($codigo_minicurso, $codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT AVG(minicurso_nota) as media FROM PesquisaOpiniao
										WHERE codigo_minicurso='$codigo_minicurso'
										AND minicurso_nota > 0
										AND codigo_evento='$codigo_evento'");
		$conexao = null;

		return $consulta;
	}

	public static function comentarios_minicurso($codigo_minicurso, $codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT minicurso_comment as comentario FROM PesquisaOpiniao
										WHERE codigo_minicurso='$codigo_minicurso'
										AND minicurso_nota > 0
										AND minicurso_comment != ''
										AND codigo_evento='$codigo_evento'");
		$conexao = null;

		return $consulta;
	}

	public static function find_comentarios_e_notas_by_minicurso($codigo_minicurso, $codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT minicurso_nota, minicurso_comment FROM PesquisaOpiniao
										WHERE codigo_minicurso='$codigo_minicurso'
										AND minicurso_nota > 0
										AND codigo_evento='$codigo_evento'");
		$conexao = null;

		return $consulta;
	}

	public static function media_minicursos($codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT AVG(minicurso_nota) as media FROM PesquisaOpiniao
										WHERE minicurso_nota > 0
										AND codigo_evento='$codigo_evento'");
		$conexao = null;

		return $consulta;
	}

	public static function media_quesito($j, $codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT AVG(Q" . $j . "_nota) as media FROM PesquisaOpiniao
										WHERE Q" . $j . "_nota > 0
										AND codigo_evento='$codigo_evento'");
		$conexao = null;

		return $consulta;
	}

	public static function quantidade_respostas($codigo_quesito, $resposta, $codigo_evento)
	{

		$conexao = new Conexao();

		$query = "SELECT COUNT(*) FROM PesquisaOpiniao
					WHERE Q" . $codigo_quesito . "_nota = '" . $resposta . "'
					AND codigo_evento = '$codigo_evento'";

		$consulta = $conexao->db_query( $query );
		$conexao = null;

		return $consulta;
	}

	public static function find_comentarios_notas_by_quesito($j, $codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT Q" . $j . "_nota, Q" . $j . "_comentario as media FROM PesquisaOpiniao
										WHERE Q" . $j . "_nota > 0
										AND codigo_evento='$codigo_evento'");
		$conexao = null;

		return $consulta;
	}

	public static function find_comentarios_by_quesito($j, $codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT Q" . $j . "_comentario, Q" . $j . "_nota FROM PesquisaOpiniao
										WHERE Q" . $j . "_nota > 0
										AND Q" . $j . "_comentario != \"\"
										AND codigo_evento='$codigo_evento'
										ORDER BY codigo_opiniao DESC");
		$conexao = null;

		return $consulta;
	}

	public static function find_comentarios_by_quesitogeral($codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT Q7_comentario, Q7_nota FROM PesquisaOpiniao
										WHERE Q7_comentario != \"\"
										AND codigo_evento='$codigo_evento'
										ORDER BY codigo_opiniao DESC");
		$conexao = null;

		return $consulta;
	}

	public static function find_all_participantes_by_evento($codigo_evento)
	{


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM PesquisaOpiniao
										WHERE codigo_evento='$codigo_evento'
										AND codigo_pessoa > 0");
		$conexao = null;

		return $consulta;
	}

	public static function find_all_avaliadores_by_evento($codigo_evento)
	{


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM PesquisaOpiniao
										WHERE codigo_evento='$codigo_evento'
										AND codigo_avaliador > 0");
		$conexao = null;

		return $consulta;
	}

	public static function find_all_by_evento($codigo_evento)
	{


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM PesquisaOpiniao
										WHERE codigo_evento='$codigo_evento'");
		$conexao = null;

		return $consulta;
	}


	public function insert()
	{
		$conexao = new Conexao();

		$sql = "INSERT INTO PesquisaOpiniao
				(codigo_pessoa, codigo_avaliador, codigo_evento, ";

		for ( $j=1; $j <= 8; $j++ )
		{
			$sql .= "Q" . $j . "_nota, Q" . $j . "_comentario, ";
		}

		$sql .=	"
				codigo_minicurso, minicurso_nota, minicurso_comment)
				VALUES
				('$this->codigo_pessoa', '$this->codigo_avaliador', '$this->codigo_evento', ";

		for ( $j=1; $j <= 8; $j++ )
		{
			$sql .= "'" . $this->notas[$j] . "', '" . $this->comments[$j] . "', ";
		}

		$sql .= "
				'$this->codigo_minicurso', '$this->minicurso_nota', '$this->minicurso_comment');";

		//echo $sql;

		if ( $conexao->db_update($sql) )
		{
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
}


?>
