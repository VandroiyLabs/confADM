<?php
require_once('../../classes/class.pessoa.php');
require_once('../../classes/class.evento.php');
require_once('../../classes/class.inscricao.php');
require_once('../../classes/class.resumo.php');
require_once('../../classes/class.conexao.php');
require_once('../../classes/class.autor.php');


session_start();
include("~/public_html/sifsc/user/error_handler.php");



include("~/public_html/sifsc/user/event/secao.php");

$page = $_POST["page"];

$resumo = new Resumo();
$resumo->find_by_codigo($inscricao->get_codigo_resumo());

$autor = new Autor();
$consulta_autores = $autor->find_all_by_resumo($inscricao->get_codigo_resumo());


if ( (($inscricao->get_situacao_resumo() == 1  and $evento->get_submissao_aberta()== 1) or ($inscricao->get_situacao_resumo() == 3 and $evento->get_resubmissao_aberta()== 1)) and isset($_SESSION['abstract_question']) and $_SESSION['abstract_question'] == 1 )
{
	unset($_SESSION['abstract_question']);

	/* Setando resumo como submetido! */
	$inscricao->set_situacao_resumo(2);

	/* Atualiza o resumo como submetido! */
	$inscricao->seta_modalidade(2, 1);

	if($inscricao->get_codigo_resumo_ingles() != 0)
	{
		/* Atualiza o resumo ingles como submetido! */
		$inscricao->seta_modalidade(2, 2);
	}

	$ok = $inscricao->update_no_form();

	//Backup do resumo
	$autores="";
	$separador="";
	while( $row = mysql_fetch_object($consulta_autores) )
	{
	      $autores.= $separador.$row->codigo_autor."::".$row->nome."::".$row->instituicao."::".$row->ordem;
	      $separador=";";
	}
	$resumo->insert_backup($autores);

	$_SESSION["inscricao"] = $inscricao;
	$_SESSION["msg"] = "Resumo foi submetido para avaliação.";
	echo "<script language=\"javascript\">location=(\"../abstract_home.php\");</script>";
}
else
{
	$_SESSION["problemas"] = "Você tentou acessar uma página fora do contexto.";
	echo "<script language=\"javascript\">location=(\"../abstract_home.php#submissaoresumo\");</script>";
}

?>
