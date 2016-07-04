<?php

require_once('class.conexao.php');

class Evento{

	private $codigo_evento;
	private $nome;
	private $data_inicio;
	private $data_fim;
	private $descricao;
	private $aberto;
	private $inscricao_aberta;
	private $minicurso_aberto;
	private $submissao_aberta;
	private $resubmissao_aberta;
	private $pesquisa_aberta;
	private $premio_aberto;
	private $avaliacao_aberta;
	private $website;
	private $tag_email;
	private $assinatura_email;
	private $certificados_disponiveis;
	private $threshold_participacao;
	private $threshold_minicurso;


	public function __construct(){

		$this->set_codigo_evento(NULL);
		$this->set_nome(NULL);
		$this->set_data_inicio(NULL);
		$this->set_data_fim(NULL);
		$this->set_descricao(NULL);
		$this->set_aberto(NULL);
		$this->set_website(NULL);
		$this->set_tag_email(NULL);
		$this->set_assinatura_email(NULL);
		$this->set_inscricao_aberta(NULL);
		$this->set_minicurso_aberto(NULL);
		$this->set_premio_aberto(NULL);
		$this->set_pesquisa_aberta(NULL);
		$this->set_submissao_aberta(NULL);
		$this->set_resubmissao_aberta(NULL);
		$this->set_avaliacao_aberta(NULL);
		$this->set_certificados_disponiveis(NULL);
		$this->set_threshold_participacao(NULL);
		$this->set_threshold_minicurso(NULL);

	}

	//setters
	public function set_codigo_evento($codigo_evento){$this->codigo_evento = $codigo_evento;}
	public function set_nome($nome){$this->nome = $nome;}
	public function set_data_inicio($data_inicio){$this->data_inicio = $data_inicio;}
	public function set_data_fim($data_fim){$this->data_fim = $data_fim;}
	public function set_descricao($descricao){$this->descricao = $descricao;}
	public function set_aberto($aberto){$this->aberto = $aberto;}
	public function set_website($website){$this->website = $website;}
	public function set_tag_email($tag_email){$this->tag_email = $tag_email;}
	public function set_assinatura_email($assinatura_email){$this->assinatura_email = $assinatura_email;}
	public function set_inscricao_aberta($inscricao_aberta){$this->inscricao_aberta = $inscricao_aberta;}
	public function set_minicurso_aberto($minicurso_aberto){$this->minicurso_aberto = $minicurso_aberto;}
	public function set_submissao_aberta($submissao_aberta){$this->submissao_aberta = $submissao_aberta;}
	public function set_premio_aberto($premio_aberto){$this->premio_aberto = $premio_aberto;}
	public function set_pesquisa_aberta($pesquisa_aberta){$this->pesquisa_aberta = $pesquisa_aberta;}
	public function set_resubmissao_aberta($resubmissao_aberta){$this->resubmissao_aberta = $resubmissao_aberta;}
	public function set_avaliacao_aberta($avaliacao_aberta){$this->avaliacao_aberta = $avaliacao_aberta;}
	public function set_certificados_disponiveis($certificados_disponiveis){$this->certificados_disponiveis = $certificados_disponiveis;}
	public function set_threshold_participacao($threshold_participacao){$this->threshold_participacao = $threshold_participacao;}
	public function set_threshold_minicurso($threshold_minicurso){$this->threshold_minicurso = $threshold_minicurso;}

	//getters
	public function get_codigo_evento(){return $this->codigo_evento;}
	public function get_nome(){return $this->nome;}
	public function get_data_inicio(){return $this->data_inicio;}
	public function get_data_fim(){return $this->data_fim;}
	public function get_descricao(){return $this->descricao;}
	public function get_aberto(){return $this->aberto;}
	public function get_website(){return $this->website;}
	public function get_tag_email(){return $this->tag_email;}
	public function get_assinatura_email(){return $this->assinatura_email;}
	public function get_inscricao_aberta(){return $this->inscricao_aberta;}
	public function get_minicurso_aberto(){return $this->minicurso_aberto;}
	public function get_submissao_aberta(){return $this->submissao_aberta;}
	public function get_premio_aberto(){return $this->premio_aberto;}
	public function get_pesquisa_aberta(){return $this->pesquisa_aberta;}
	public function get_resubmissao_aberta(){return $this->resubmissao_aberta;}
	public function get_avaliacao_aberta(){return $this->avaliacao_aberta;}
	public function get_certificados_disponiveis(){ return $this->certificados_disponiveis;}
	public function get_threshold_participacao(){return $this->threshold_participacao;}
	public function get_threshold_minicurso(){return $this->threshold_minicurso;}

	public function find_by_codigo($codigo_evento)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Evento WHERE codigo_evento='$codigo_evento'");
		$total = mysql_num_rows($consulta);

		if ($total==1)
		{

			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_data_inicio(mysql_result($consulta,0,'data_inicio'));
			$this->set_data_fim(mysql_result($consulta,0,'data_fim'));
			$this->set_descricao(mysql_result($consulta,0,'descricao'));
			$this->set_aberto(mysql_result($consulta,0,'aberto'));
			$this->set_inscricao_aberta(mysql_result($consulta,0,'inscricao_aberta'));
			$this->set_minicurso_aberto(mysql_result($consulta,0,'minicurso_aberto'));
			$this->set_submissao_aberta(mysql_result($consulta,0,'submissao_aberta'));
			$this->set_resubmissao_aberta(mysql_result($consulta,0,'resubmissao_aberta'));
			$this->set_pesquisa_aberta(mysql_result($consulta,0,'pesquisa_aberta'));
			$this->set_premio_aberto(mysql_result($consulta,0,'premio_aberto'));
			$this->set_avaliacao_aberta(mysql_result($consulta,0,'avaliacao_aberta'));
			$this->set_website(mysql_result($consulta,0,'website'));
			$this->set_tag_email(mysql_result($consulta,0,'tag_email'));
			$this->set_assinatura_email(mysql_result($consulta,0,'assinatura_email'));
			$this->set_certificados_disponiveis(mysql_result($consulta,0,'certificados_disponiveis'));
			$this->set_threshold_participacao(mysql_result($consulta,0,'threshold_participacao'));
			$this->set_threshold_minicurso(mysql_result($consulta,0,'threshold_minicurso'));

			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		};
	}

	public function find_last_evento( )
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Evento WHERE codigo_evento >= ALL (select codigo_evento from Evento)");
		$total = mysql_num_rows($consulta);

		if ($total==1)
		{

			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_data_inicio(mysql_result($consulta,0,'data_inicio'));
			$this->set_data_fim(mysql_result($consulta,0,'data_fim'));
			$this->set_descricao(mysql_result($consulta,0,'descricao'));
			$this->set_aberto(mysql_result($consulta,0,'aberto'));
			$this->set_inscricao_aberta(mysql_result($consulta,0,'inscricao_aberta'));
			$this->set_minicurso_aberto(mysql_result($consulta,0,'minicurso_aberto'));
			$this->set_submissao_aberta(mysql_result($consulta,0,'submissao_aberta'));
			$this->set_resubmissao_aberta(mysql_result($consulta,0,'resubmissao_aberta'));
			$this->set_pesquisa_aberta(mysql_result($consulta,0,'pesquisa_aberta'));
			$this->set_premio_aberto(mysql_result($consulta,0,'premio_aberto'));
			$this->set_avaliacao_aberta(mysql_result($consulta,0,'avaliacao_aberta'));
			$this->set_website(mysql_result($consulta,0,'website'));
			$this->set_tag_email(mysql_result($consulta,0,'tag_email'));
			$this->set_assinatura_email(mysql_result($consulta,0,'assinatura_email'));
			$this->set_certificados_disponiveis(mysql_result($consulta,0,'certificados_disponiveis'));
			$this->set_threshold_participacao(mysql_result($consulta,0,'threshold_participacao'));
			$this->set_threshold_minicurso(mysql_result($consulta,0,'threshold_minicurso'));

			mysql_free_result($consulta);
			$conexao = null;
			return True;
		}
		else{
			$conexao = null;
			return False;
		};
	}
	public function find_by_nome($nome)
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Evento WHERE nome='$nome'");
		$total = mysql_num_rows($consulta);

		if ($total==1)
		{

			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_data_inicio(mysql_result($consulta,0,'data_inicio'));
			$this->set_data_fim(mysql_result($consulta,0,'data_fim'));
			$this->set_descricao(mysql_result($consulta,0,'descricao'));
			$this->set_aberto(mysql_result($consulta,0,'aberto'));
			$this->set_inscricao_aberta(mysql_result($consulta,0,'inscricao_aberta'));
			$this->set_minicurso_aberto(mysql_result($consulta,0,'minicurso_aberto'));
			$this->set_submissao_aberta(mysql_result($consulta,0,'submissao_aberta'));
			$this->set_resubmissao_aberta(mysql_result($consulta,0,'resubmissao_aberta'));
			$this->set_pesquisa_aberta(mysql_result($consulta,0,'pesquisa_aberta'));
			$this->set_premio_aberto(mysql_result($consulta,0,'premio_aberto'));
			$this->set_avaliacao_aberta(mysql_result($consulta,0,'avaliacao_aberta'));
			$this->set_website(mysql_result($consulta,0,'website'));
			$this->set_tag_email(mysql_result($consulta,0,'tag_email'));
			$this->set_assinatura_email(mysql_result($consulta,0,'assinatura_email'));
			$this->set_certificados_disponiveis(mysql_result($consulta,0,'certificados_disponiveis'));
			$this->set_threshold_participacao(mysql_result($consulta,0,'threshold_participacao'));
			$this->set_threshold_minicurso(mysql_result($consulta,0,'threshold_minicurso'));

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

		$consulta = $conexao->db_query("SELECT * FROM Evento ORDER BY codigo_evento DESC");
		$conexao = null;

		return $consulta;
	}

	public static function find_all_aberto()
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Evento WHERE aberto='1' ORDER BY codigo_evento DESC");
		$conexao = null;

		return $consulta;
	}

	public function find_evento_aberto()
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Evento WHERE aberto='1'");
		$total = mysql_num_rows($consulta);

		if ($total==1)
		{

			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_data_inicio(mysql_result($consulta,0,'data_inicio'));
			$this->set_data_fim(mysql_result($consulta,0,'data_fim'));
			$this->set_descricao(mysql_result($consulta,0,'descricao'));
			$this->set_aberto(mysql_result($consulta,0,'aberto'));
			$this->set_inscricao_aberta(mysql_result($consulta,0,'inscricao_aberta'));
			$this->set_minicurso_aberto(mysql_result($consulta,0,'minicurso_aberto'));
			$this->set_submissao_aberta(mysql_result($consulta,0,'submissao_aberta'));
			$this->set_resubmissao_aberta(mysql_result($consulta,0,'resubmissao_aberta'));
			$this->set_pesquisa_aberta(mysql_result($consulta,0,'pesquisa_aberta'));
			$this->set_premio_aberto(mysql_result($consulta,0,'premio_aberto'));
			$this->set_avaliacao_aberta(mysql_result($consulta,0,'avaliacao_aberta'));
			$this->set_website(mysql_result($consulta,0,'website'));
			$this->set_tag_email(mysql_result($consulta,0,'tag_email'));
			$this->set_assinatura_email(mysql_result($consulta,0,'assinatura_email'));
			$this->set_certificados_disponiveis(mysql_result($consulta,0,'certificados_disponiveis'));
			$this->set_threshold_participacao(mysql_result($consulta,0,'threshold_participacao'));
			$this->set_threshold_minicurso(mysql_result($consulta,0,'threshold_minicurso'));

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

	public function find_evento_inscricao_aberta()
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Evento WHERE inscricao_aberta='1'");
		$total = mysql_num_rows($consulta);

		if ($total==1)
		{

			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));
			$this->set_nome(mysql_result($consulta,0,'nome'));
			$this->set_data_inicio(mysql_result($consulta,0,'data_inicio'));
			$this->set_data_fim(mysql_result($consulta,0,'data_fim'));
			$this->set_descricao(mysql_result($consulta,0,'descricao'));
			$this->set_aberto(mysql_result($consulta,0,'aberto'));
			$this->set_inscricao_aberta(mysql_result($consulta,0,'inscricao_aberta'));
			$this->set_minicurso_aberto(mysql_result($consulta,0,'minicurso_aberto'));
			$this->set_submissao_aberta(mysql_result($consulta,0,'submissao_aberta'));
			$this->set_resubmissao_aberta(mysql_result($consulta,0,'resubmissao_aberta'));
			$this->set_pesquisa_aberta(mysql_result($consulta,0,'pesquisa_aberta'));
			$this->set_premio_aberto(mysql_result($consulta,0,'premio_aberto'));
			$this->set_avaliacao_aberta(mysql_result($consulta,0,'avaliacao_aberta'));
			$this->set_website(mysql_result($consulta,0,'website'));
			$this->set_tag_email(mysql_result($consulta,0,'tag_email'));
			$this->set_assinatura_email(mysql_result($consulta,0,'assinatura_email'));
			$this->set_certificados_disponiveis(mysql_result($consulta,0,'certificados_disponiveis'));
			$this->set_threshold_participacao(mysql_result($consulta,0,'threshold_participacao'));
			$this->set_threshold_minicurso(mysql_result($consulta,0,'threshold_minicurso'));

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


	public function find_numero_de_eventos_abertos()
	{

		$conexao = new Conexao();

		$consulta = $conexao->db_query("SELECT * FROM Evento WHERE aberto='1'");
		$total = mysql_num_rows($consulta);

		$conexao = null;

		return $total;
	}

	public function insert()
	{
		$conexao = new Conexao();

		$sql = "INSERT INTO Evento (nome, data_inicio, data_fim, descricao, aberto, website, tag_email, assinatura_email, inscricao_aberta, minicurso_aberto, submissao_aberta,  resubmissao_aberta,pesquisa_aberta,premio_aberto,avaliacao_aberta,certificados_disponiveis,threshold_participacao,threshold_minicurso) VALUES ('$this->nome', '$this->data_inicio', '$this->data_fim', '$this->descricao', '$this->aberto', '$this->website', '$this->tag_email', '$this->assinatura_email','$this->inscricao_aberta','$this->minicurso_aberto','$this->submissao_aberta','$this->resubmissao_aberta','$this->pesquisa_aberta','$this->premio_aberto','$this->avaliacao_aberta','$this->certificados_disponiveis','$this->threshold_participacao','$this->threshold_minicurso');";

		if($conexao->db_update($sql))
		{
			$consulta = $conexao->db_query("SELECT codigo_evento FROM Evento WHERE nome='$this->nome'");
			$this->set_codigo_evento(mysql_result($consulta,0,'codigo_evento'));

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

		$sql = "UPDATE Evento SET nome = '$this->nome', data_inicio = '$this->data_inicio', data_fim = '$this->data_fim', descricao = '$this->descricao', aberto = '$this->aberto', website = '$this->website', tag_email = '$this->tag_email', assinatura_email = '$this->assinatura_email',inscricao_aberta='$this->inscricao_aberta',minicurso_aberto='$this->minicurso_aberto',submissao_aberta='$this->submissao_aberta', resubmissao_aberta='$this->resubmissao_aberta', pesquisa_aberta='$this->pesquisa_aberta', premio_aberto='$this->premio_aberto', avaliacao_aberta = '$this->avaliacao_aberta',certificados_disponiveis='$this->certificados_disponiveis',threshold_participacao='$this->threshold_participacao',threshold_minicurso='$this->threshold_minicurso'
		WHERE codigo_evento = $this->codigo_evento";

		//echo $sql;
		if($conexao->db_update($sql))
		{
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

		$sql = "DELETE FROM Evento WHERE codigo_evento='$this->codigo_evento'";


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
