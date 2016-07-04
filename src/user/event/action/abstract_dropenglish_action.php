<?php
$home = "/home/" . get_current_user() . "/";

require_once('../../classes/class.pessoa.php');
require_once('../../classes/class.evento.php');
require_once('../../classes/class.inscricao.php');
require_once('../../classes/class.resumo.php');
require_once('../../classes/class.conexao.php');
require_once('../../classes/class.autor.php');

session_start();
include($home . "public_html/sifsc/user/error_handler.php");
include($home . "public_html/sifsc/user/event/secao.php");

$page = $_POST["page"];

$inscricao = new Inscricao();
$inscricao->find_by_pessoa_evento( $pessoa->get_codigo_pessoa(), $evento->get_codigo_evento() );

if ( $inscricao->get_codigo_resumo_ingles() != 0 and (($inscricao->get_situacao_resumo() == 1  and $evento->get_inscricao_aberta()== 1 ) or ( $inscricao->get_situacao_resumo() == 3 and $evento->get_resubmissao_aberta()== 1 )) and isset($_SESSION['abstract_dropenglish_question']) and $_SESSION['abstract_dropenglish_question'] == 1 )
{
	unset($_SESSION['abstract_dropenglish_question']);

	/* Deletando o resumo em ingles  */
	$resumo = new Resumo();
	$resumo->find_by_codigo( $inscricao->get_codigo_resumo_ingles() );
	$ok_delete = $resumo->remove();

	/* Resetando tudo relacionado ao resumo em inglês */
	$inscricao->set_codigo_resumo_ingles(0);
	$inscricao->seta_modalidade(0, 2);

	$ok = $inscricao->update_no_form();

	$_SESSION["inscricao"] = $inscricao;
	$_SESSION["msg"] = "A versão em inglês de seu resumo foi descartado.";
	echo "<script language=\"javascript\">location=(\"../abstract_home.php\");</script>";
}
else
{
	$_SESSION["problemas"] = "Você tentou acessar uma página fora do contexto.";
	echo "<script language=\"javascript\">location=(\"../abstract_home.php#submissaoresumo\");</script>";
}

?>
