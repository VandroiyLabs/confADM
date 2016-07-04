<?php
$home = "/home/" . get_current_user() . "/";

require_once($home . "public_html/sifsc/user/classes/class.pessoa.php");
require_once($home . "public_html/sifsc/user/classes/class.evento.php");
require_once($home . "public_html/sifsc/user/classes/class.inscricao.php");
require_once($home . "public_html/sifsc/user/classes/class.pesquisa_opiniao.php");
require_once($home . "public_html/sifsc/user/classes/class.minicurso.php");
require_once($home . "public_html/sifsc/user/classes/class.participa_minicurso.php");

session_start();

include($home . "public_html/sifsc/user/error_handler.php");
$page = $_POST["page"];



include($home . "public_html/sifsc/user/event/secao.php");

// Codigo pessoa
$codigo_pessoa = $pessoa->get_codigo_pessoa();

// Encontrando novamente o minicurso deste participante
$participacao = new ParticipaMinicurso();
$participacao->find_by_codigo( $pessoa->get_codigo_pessoa(), $evento->get_codigo_evento() );
$minicurso = new Minicurso();
$minicurso->find_by_codigo( $participacao->get_codigo_minicurso() );

$opiniao = new PesquisaOpiniao();

if ( $_POST['id'] == 1 )
{
	$opiniao->set_codigo_pessoa( $codigo_pessoa );
}
else
{
	$opiniao->set_codigo_pessoa( 0 );
}

$opiniao->set_codigo_evento( $evento->get_codigo_evento() );
$opiniao->set_codigo_minicurso( $minicurso->get_codigo_minicurso() );
$opiniao->set_minicurso_nota( $_POST['mi'] );
$opiniao->set_minicurso_comment( $_POST['mi_comment']);

$notas = array(
	1 => $_POST['pa'],
	2 => $_POST['ws'],
	3 => $_POST['st'],
	4 => $_POST['kit'],
	5 => $_POST['es'],
	6 => $_POST['em'],
	7 => 0,
	8 => $_POST['inne']
);
$opiniao->set_notas($notas);

$comments = array(
	1 => $_POST['pa_comment'],
	2 => $_POST['ws_comment'],
	3 => $_POST['st_comment'],
	4 => $_POST['kit_comment'],
	5 => $_POST['es_comment'],
	6 => $_POST['em_comment'],
	7 => $_POST['gr_comment'],
	8 => $_POST['inne_comment']
);
$opiniao->set_comments($comments);

$opiniao->insert();

echo "<script language=\"JavaScript\">location=(\"../status.php\");</script>";

?>
