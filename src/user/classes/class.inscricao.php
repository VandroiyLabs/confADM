<?php

require_once('class.conexao.php');



class Inscricao
{
	private $codigo_pessoa;
	private $codigo_evento;


	private $modalidade;
	private $situacao_deferimento;
	private $situacao_resumo;
  private $situacao_arte;
	private $dia_avaliacao;

	private $requer_auxilio;
	private $codigo_financiadora;


	private $codigo_resumo;
	private $codigo_resumo_ingles;
	private $codigo_arte;
	private $codigo_secao;
	private $premio;


	private $instituicao;
	private $nivel;
	private $curso;
 	private $grupo;
	private $subarea;
	private $orientador;

	private $token;
  private $codigo_barra;


	public function __construct()
	{
		$this->set_codigo_pessoa(NULL);
		$this->set_codigo_evento(NULL);
		$this->set_codigo_resumo(NULL);
		$this->set_codigo_resumo_ingles(NULL);
		$this->set_codigo_arte(NULL);
		$this->set_codigo_secao(NULL);
		$this->set_instituicao(NULL);
		$this->set_nivel(NULL);
		$this->set_curso(NULL);
		$this->set_grupo(NULL);
		$this->set_subarea(NULL);
		$this->set_orientador(NULL);
		$this->set_token(NULL);
		$this->set_codigo_barra(NULL);
		$this->set_situacao_arte(NULL);
		$this->set_modalidade(NULL);
		$this->set_situacao_deferimento(NULL);
		$this->set_situacao_resumo(NULL);
		$this->set_requer_auxilio(NULL);

		$this->set_dia_avaliacao(NULL);
		$this->set_premio(NULL);
		$this->set_codigo_financiadora(NULL);
	}



	//setters
	public function set_codigo_pessoa($codigo_pessoa){$this->codigo_pessoa = $codigo_pessoa;}
	public function set_codigo_evento($codigo_evento){$this->codigo_evento = $codigo_evento;}
	public function set_codigo_resumo($codigo_resumo){$this->codigo_resumo = $codigo_resumo;}
	public function set_codigo_resumo_ingles($codigo_resumo_ingles){$this->codigo_resumo_ingles = $codigo_resumo_ingles;}
	public function set_codigo_arte($codigo_arte){$this->codigo_arte = $codigo_arte;}
	public function set_codigo_secao($codigo_secao){$this->codigo_secao = $codigo_secao;}
	public function set_instituicao($instituicao){$this->instituicao = $instituicao;}
	public function set_nivel($nivel){$this->nivel = $nivel;}
	public function set_curso($curso){$this->curso = $curso;}
	public function set_grupo($grupo){$this->grupo = $grupo;}
	public function set_subarea($subarea){$this->subarea = $subarea;}
	public function set_orientador($orientador){$this->orientador =$orientador;}
	public function set_token($token){$this->token = $token;}
	public function set_codigo_barra($codigo_barra){$this->codigo_barra = $codigo_barra;}
	public function set_situacao_arte($situacao_arte){$this->situacao_arte = $situacao_arte;}
	public function set_modalidade($modalidade){$this->modalidade = $modalidade;}
	public function set_situacao_deferimento($situacao_deferimento){$this->situacao_deferimento = $situacao_deferimento;}
	public function set_situacao_resumo($situacao_resumo){$this->situacao_resumo = $situacao_resumo;}
	public function set_requer_auxilio($requer_auxilio){$this->requer_auxilio = $requer_auxilio;}

	public function set_dia_avaliacao($dia_avaliacao){$this->dia_avaliacao = $dia_avaliacao;}
	public function set_premio($premio){$this->premio = $premio;}
	public function set_codigo_financiadora($codigo_financiadora){$this->codigo_financiadora = $codigo_financiadora;}

	//getters
	public function get_codigo_pessoa(){return $this->codigo_pessoa;}
	public function get_codigo_evento(){return $this->codigo_evento;}
	public function get_codigo_resumo(){return $this->codigo_resumo;}
	public function get_codigo_resumo_ingles(){return $this->codigo_resumo_ingles;}
	public function get_codigo_arte(){return $this->codigo_arte;}
	public function get_codigo_secao(){return $this->codigo_secao;}
	public function get_instituicao(){return $this->instituicao;}
	public function get_nivel(){return $this->nivel;}
	public function get_curso(){return $this->curso;}
	public function get_grupo(){return $this->grupo;}
	public function get_subarea(){return $this->subarea;}
	public function get_orientador(){return $this->orientador;}
	public function get_token(){return $this->token;}
	public function get_codigo_barra(){return $this->codigo_barra;}
	public function get_situacao_arte(){return $this->situacao_arte;}
	public function get_modalidade(){return $this->modalidade;}
	public function get_situacao_deferimento(){return $this->situacao_deferimento;}
	public function get_situacao_resumo(){return $this->situacao_resumo;}
	public function get_requer_auxilio(){return $this->requer_auxilio;}

	public function get_dia_avaliacao(){return $this->dia_avaliacao;}
	public function get_premio(){return $this->premio;}
	public function get_codigo_financiadora(){return $this->codigo_financiadora;}

	/*
		Configura o $j-esimo elemento da modalidade como $value.
	*/
	public function seta_modalidade($value, $j)
	{
		$this->modalidade[$j] = $value;
	}

	public function find_by_pessoa_evento($codigo_pessoa, $codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Inscricao WHERE codigo_pessoa='$codigo_pessoa' and codigo_evento='$codigo_evento'");

		$total = mysql_num_rows($consulta);

		if ($total==1)
		{

			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_codigo_resumo(mysql_result($consulta,0,'codigo_resumo'));
			$this->set_codigo_resumo_ingles(mysql_result($consulta,0,'codigo_resumo_ingles'));
			$this->set_codigo_arte(mysql_result($consulta,0,'codigo_arte'));
			$this->set_codigo_secao(mysql_result($consulta,0,'codigo_secao'));
			$this->set_instituicao(mysql_result($consulta,0,'instituicao'));
			$this->set_nivel(mysql_result($consulta,0,'nivel'));
			$this->set_curso(mysql_result($consulta,0,'curso'));
			$this->set_grupo(mysql_result($consulta,0,'grupo'));
			$this->set_subarea(mysql_result($consulta,0,'subarea'));
			$this->set_orientador(mysql_result($consulta,0,'orientador'));
			$this->set_token(mysql_result($consulta,0,'token'));
			$this->set_codigo_barra(mysql_result($consulta,0,'codigo_barra'));
			$this->set_situacao_arte(mysql_result($consulta,0,'situacao_arte'));
			$this->set_modalidade(mysql_result($consulta,0,'modalidade'));
			$this->set_situacao_deferimento(mysql_result($consulta,0,'situacao_deferimento'));
			$this->set_situacao_resumo(mysql_result($consulta,0,'situacao_resumo'));
			$this->set_requer_auxilio(mysql_result($consulta,0,'requer_auxilio'));

			$this->set_dia_avaliacao(mysql_result($consulta,0,'dia_avaliacao'));
			$this->set_premio(mysql_result($consulta,0,'premio'));
			$this->set_codigo_financiadora(mysql_result($consulta,0,'codigo_financiadora'));

			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		};
	}


	public static function find_by_pessoa($codigo_pessoa)
	{
		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT Evento.nome nome_evento, Evento.codigo_evento ,Inscricao.situacao_deferimento, Inscricao.modalidade, Inscricao.codigo_financiadora, Inscricao.dia_avaliacao FROM Pessoa JOIN Inscricao ON Pessoa.codigo_pessoa = Inscricao.codigo_pessoa  JOIN Evento ON Inscricao.codigo_evento = Evento.codigo_evento WHERE Inscricao.codigo_pessoa = '$codigo_pessoa' ORDER BY Evento.codigo_evento DESC");
		$conexao = null;

		return $consulta;
	}
	public static function find_all_resumo_ifsc_pos($codigo_evento)
	{

		$conexao = new Conexao();
		$sql = "SELECT nome FROM Inscricao I, Pessoa P WHERE P.codigo_pessoa = I.codigo_pessoa AND situacao_resumo IN ( 5, 2 ) AND instituicao =  'IFSC-USP' AND nivel IN ( 'Mestrado',  'Doutorado' ) AND codigo_evento = '$codigo_evento' ORDER BY nome";
		$consulta = $conexao->db_query($sql);

		$conexao = null;

		return $consulta;
	}

	public static function find_by_evento($codigo_evento){//email UNIQUE


		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Inscricao WHERE Inscricao.codigo_evento = '$codigo_evento'");

		$conexao = null;

		return $consulta;
	}

	public static function find_by_evento_e_financiadora($codigo_evento, $codigo_financiadora)
	{
		$conexao = new Conexao();
		$consulta = $conexao->db_query("SELECT * FROM Inscricao WHERE Inscricao.codigo_evento = '$codigo_evento' AND Inscricao.codigo_financiadora = '$codigo_financiadora'");
		$conexao = null;
		return $consulta;
	}

	public static function find_by_evento_e_modalidade($codigo_evento, $modalidade)
	{
		$conexao = new Conexao();
		$consulta = $conexao->db_query("SELECT * FROM Inscricao WHERE Inscricao.codigo_evento = '$codigo_evento' AND modalidade = '$modalidade'");
		$conexao = null;
		return $consulta;
	}

	public static function find_by_evento_e_deferimento($codigo_evento, $deferimento)
	{
		$conexao = new Conexao();
		$consulta = $conexao->db_query("SELECT * FROM Inscricao WHERE Inscricao.codigo_evento = '$codigo_evento' AND situacao_deferimento = '$deferimento'");
		$conexao = null;
		return $consulta;
	}

	public static function find_by_evento_e_situacao_resumo($codigo_evento, $situacao_resumo)
	{
		$conexao = new Conexao();
		$consulta = $conexao->db_query("SELECT * FROM Inscricao WHERE Inscricao.codigo_evento = '$codigo_evento' AND situacao_resumo = '$situacao_resumo'");
		$conexao = null;
		return $consulta;
	}


	/*
		Funcao que retorna apenas os nomes dos participantes com dada situacao_resumo
	*/
	public static function find_nomes_by_evento_e_modalidade($codigo_evento, $modalidade)
	{

		$conexao = new Conexao();
		$consulta = $conexao->db_query("SELECT nome
										FROM Pessoa AS P, Inscricao AS I
										WHERE I.codigo_pessoa = P.codigo_pessoa
										AND I.modalidade LIKE '" . $modalidade . "' and codigo_evento= '$codigo_evento'
										ORDER BY nome");
		$conexao = null;
		return $consulta;
	}

	public static function find_nomes_codigo_by_evento_e_modalidade($codigo_evento, $modalidade)
	{

		$conexao = new Conexao();
		$consulta = $conexao->db_query("SELECT P.nome, P.codigo_pessoa
										FROM Pessoa AS P, Inscricao AS I
										WHERE I.codigo_pessoa = P.codigo_pessoa
										AND I.modalidade LIKE '" . $modalidade . "' and codigo_evento= '$codigo_evento'
										ORDER BY nome");
		$conexao = null;
		return $consulta;
	}

/*
		Funcao que retorna apenas os nomes dos participantes com dada situacao_resumo
	*/
	public static function find_all_nomes_and_emails_by_evento($codigo_evento)
	{

		$conexao = new Conexao();
		$consulta = $conexao->db_query("SELECT nome, email
										FROM Pessoa AS P, Inscricao AS I
										WHERE I.codigo_pessoa = P.codigo_pessoa
										AND I.modalidade LIKE '1%' and codigo_evento= '$codigo_evento'
										ORDER BY nome");
		$conexao = null;
		return $consulta;
	}


	/*
		Funcao que retorna todas as inscricoes que estejam concorrendo ao premio
	*/
	public static function find_by_evento_situacao_resumo_premio($codigo_evento, $situacao_resumo)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Inscricao WHERE codigo_evento = '$codigo_evento' AND situacao_resumo = '$situacao_resumo' AND premio = 1");

		$conexao = null;

		return $consulta;
	}

	public static function find_by_evento_situacao_resumo($codigo_evento, $situacao_resumo,$ini,$limite)
	{

		$conexao = new Conexao();
		$sql="SELECT * FROM Inscricao WHERE codigo_evento = '$codigo_evento' AND situacao_resumo = '$situacao_resumo' order by codigo_pessoa limit $ini, $limite";
		//echo $sql;
		$consulta = $conexao->db_query($sql);

		$conexao = null;

		return $consulta;
	}



	public static function find_by_evento_situacao_resumo_by_grupo($codigo_evento, $situacao_resumo)
	{

		$conexao = new Conexao();
		$sql="SELECT * FROM Inscricao WHERE codigo_evento = '$codigo_evento' AND situacao_resumo = '$situacao_resumo' ORDER BY grupo, codigo_pessoa";
		//echo $sql;
		$consulta = $conexao->db_query($sql);

		$conexao = null;

		return $consulta;
	}



	public static function find_by_nivel_evento($nivel, $codigo_evento)
	{
		$conexao = new Conexao();
		$consulta = $conexao->db_query("SELECT * FROM Inscricao WHERE codigo_evento = '$codigo_evento' AND nivel = '$nivel'");

		$conexao = null;
		return $consulta;
	}


	public function find_by_token($token)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Inscricao WHERE token='$token'");

		$total = mysql_num_rows($consulta);

		if ($total==1)
		{

			$this->set_codigo_pessoa(mysql_result($consulta,0,'codigo_pessoa'));
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_codigo_resumo(mysql_result($consulta,0,'codigo_resumo'));
			$this->set_codigo_resumo_ingles(mysql_result($consulta,0,'codigo_resumo_ingles'));
			$this->set_codigo_arte(mysql_result($consulta,0,'codigo_arte'));
			$this->set_codigo_secao(mysql_result($consulta,0,'codigo_secao'));
			$this->set_instituicao(mysql_result($consulta,0,'instituicao'));
			$this->set_nivel(mysql_result($consulta,0,'nivel'));
			$this->set_curso(mysql_result($consulta,0,'curso'));
			$this->set_grupo(mysql_result($consulta,0,'grupo'));
			$this->set_subarea(mysql_result($consulta,0,'subarea'));
			$this->set_orientador(mysql_result($consulta,0,'orientador'));
			$this->set_token(mysql_result($consulta,0,'token'));
			$this->set_codigo_barra(mysql_result($consulta,0,'codigo_barra'));
			$this->set_situacao_arte(mysql_result($consulta,0,'situacao_arte'));
			$this->set_modalidade(mysql_result($consulta,0,'modalidade'));
			$this->set_situacao_deferimento(mysql_result($consulta,0,'situacao_deferimento'));
			$this->set_situacao_resumo(mysql_result($consulta,0,'situacao_resumo'));
			$this->set_requer_auxilio(mysql_result($consulta,0,'requer_auxilio'));

			$this->set_dia_avaliacao(mysql_result($consulta,0,'dia_avaliacao'));
			$this->set_premio(mysql_result($consulta,0,'premio'));
			$this->set_codigo_financiadora(mysql_result($consulta,0,'codigo_financiadora'));

			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		};
	}


	/*
	  Function that creates (and stores) a token
	*/
	public function generate_token($id)
	{
		$salt = sha1(rand());
		$salt = substr($salt, 0, 10);
		$token = $salt;

		$this->set_token($token);

		return $token;
	}

	public function insert()
	{
		$conexao = new Conexao();

		$sql = "INSERT INTO Inscricao (codigo_pessoa, codigo_evento, codigo_resumo, codigo_resumo_ingles, codigo_arte, codigo_secao, instituicao, nivel, curso, grupo, subarea, orientador, token, codigo_barra, situacao_arte, modalidade, situacao_deferimento, situacao_resumo, requer_auxilio, dia_avaliacao, premio, codigo_financiadora) VALUES ('$this->codigo_pessoa', '$this->codigo_evento', '$this->codigo_resumo', '$this->codigo_resumo_ingles', '$this->codigo_arte', '$this->codigo_secao', '$this->instituicao', '$this->nivel', '$this->curso', '$this->grupo', '$this->subarea', '$this->orientador', '$this->token', '$this->codigo_barra', '$this->situacao_arte', '$this->modalidade', '$this->situacao_deferimento', '$this->situacao_resumo', '$this->requer_auxilio', '$this->dia_avaliacao', '$this->premio', '$this->codigo_financiadora');";

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

	public function update(){
		$conexao = new Conexao();


		$sql = "UPDATE Inscricao SET codigo_resumo = '$this->codigo_resumo', codigo_resumo_ingles = '$this->codigo_resumo_ingles', codigo_arte = '$this->codigo_arte', codigo_secao = '$this->codigo_secao', instituicao = '$this->instituicao', nivel = '$this->nivel', curso = '$this->curso', grupo = '$this->grupo', subarea = '$this->subarea', orientador = '$this->orientador', token = '$this->token', codigo_barra ='$this->codigo_barra', situacao_arte ='$this->situacao_arte', modalidade ='$this->modalidade', situacao_deferimento = '$this->situacao_deferimento', situacao_resumo = '$this->situacao_resumo', requer_auxilio = '$this->requer_auxilio', dia_avaliacao = '$this->dia_avaliacao', premio = '$this->premio', codigo_financiadora = '$this->codigo_financiadora'
		WHERE codigo_pessoa = $this->codigo_pessoa AND codigo_evento = $this->codigo_evento";
		//if($inscricao->get_codigo_pessoa() == 132){ echo $inscricao->get_orientador(); exit();}

	//	if($this->codigo_pessoa == 132)
	//	echo $sql;


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

		$sql = "DELETE FROM Inscricao WHERE codigo_pessoa = $this->codigo_pessoa AND codigo_evento = $this->codigo_evento";

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

	public function remove_by_pessoa($codigo_pessoa){
		$conexao = new Conexao();

		$sql = "DELETE FROM Inscricao WHERE codigo_pessoa = $codigo_pessoa";


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

	public function find_by_nome_inscricao($codigo_evento,$nome,$filtro){//email UNIQUE

		$conexao = new Conexao();

		$nomeexp = explode(" ", $nome);
		$nome_like = "%";
		for ( $j = 0; $j < sizeof($nomeexp); $j++ )
		{
			$nome_like .= $nomeexp[$j] . "%";
		}
		$sql = "SELECT Pessoa.codigo_pessoa codigo_pessoa, Pessoa.nome nome, instituicao, Pessoa.email email FROM Pessoa JOIN Inscricao on Pessoa.codigo_pessoa = Inscricao.codigo_pessoa LEFT JOIN ParticipaMinicurso on Inscricao.codigo_pessoa = ParticipaMinicurso.codigo_pessoa and Inscricao.codigo_evento = ParticipaMinicurso.codigo_evento WHERE Inscricao.codigo_evento = '$codigo_evento' AND ( Pessoa.nome LIKE '$nome_like' OR Pessoa.email LIKE '$nome_like' ) ".$filtro;
		//echo $sql;
		$consulta = $conexao->db_query($sql);
		//echo $sql;
		$conexao = null;

		return $consulta;
	}


	public function find_by_nome_inscricao_limmited($codigo_evento,$nome,$filtro,$pagina_atual, $limite)
	{

		$conexao = new Conexao();

		$nomeexp = explode(" ", $nome);
		$nome_like = "%";
		for ( $j = 0; $j < sizeof($nomeexp); $j++ )
		{
			$nome_like .= $nomeexp[$j] . "%";
		}
		$sql = "SELECT Pessoa.codigo_pessoa codigo_pessoa, Pessoa.nome nome, instituicao, Pessoa.email email FROM Pessoa JOIN Inscricao on Pessoa.codigo_pessoa = Inscricao.codigo_pessoa LEFT JOIN ParticipaMinicurso on Inscricao.codigo_pessoa = ParticipaMinicurso.codigo_pessoa and Inscricao.codigo_evento = ParticipaMinicurso.codigo_evento WHERE Inscricao.codigo_evento = $codigo_evento AND ( Pessoa.nome LIKE '$nome_like' OR Pessoa.email LIKE '$nome_like' ) ".$filtro." ORDER BY Pessoa.nome, Pessoa.email ";

		if (!$pagina_atual)	$pagina_atual = "1";

		$registro_inicial = (($pagina_atual - 1) * $limite);
		$intervalo = $conexao->db_query("$sql LIMIT $registro_inicial,$limite");

		$conexao = null;

		return $intervalo;
	}

	public function update_no_form(){
		$conexao = new Conexao();


		$sql = "UPDATE Inscricao SET codigo_resumo = '$this->codigo_resumo', codigo_resumo_ingles = '$this->codigo_resumo_ingles', codigo_arte = '$this->codigo_arte', codigo_secao = '$this->codigo_secao',  token = '$this->token', codigo_barra ='$this->codigo_barra', situacao_arte ='$this->situacao_arte', modalidade ='$this->modalidade', situacao_deferimento = '$this->situacao_deferimento', situacao_resumo = '$this->situacao_resumo',  dia_avaliacao = '$this->dia_avaliacao', premio = '$this->premio', codigo_financiadora = '$this->codigo_financiadora'
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

	public function find_by_situacao_nivel($codigo_evento,$situacao,$nivel)
	{

		$conexao = new Conexao();
		if($nivel == 'ic') $filtro = " = 'Graduacao'";
		else if($nivel != 'ic') $filtro = " <> 'Graduacao'";

		$sql = "SELECT Inscricao.codigo_pessoa codigo_pessoa, Inscricao.codigo_evento codigo_evento FROM Inscricao, Resumo, Autor WHERE Inscricao.codigo_resumo = Resumo.codigo_resumo AND Resumo.autor_principal = Autor.codigo_autor AND Inscricao.codigo_evento = $codigo_evento AND situacao_resumo = '$situacao' and nivel $filtro order by Autor.nome";
		//echo $sql;
		$consulta = $conexao->db_query($sql);
		$conexao = null;

		return $consulta;
	}
}


?>
