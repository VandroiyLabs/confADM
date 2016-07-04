<?php
require_once("~/public_html/sifsc/user/classes/class.avaliador.php");
require_once("~/public_html/sifsc/user/classes/class.evento.php");
require_once("~/public_html/sifsc/user/classes/class.pesquisa_opiniao.php");

session_start();

include("~/public_html/sifsc/user/error_handler.php");
$page = $_POST["page"];



include("~/public_html/sifsc/referee/event/secao.php");

// Codigo pessoa
$codigo_avaliador = $avaliador->get_codigo_avaliador();	

$opiniao = new PesquisaOpiniao();

if ( $_POST['id'] == 1 )
{
	$opiniao->set_codigo_avaliador( $codigo_avaliador );
}
else
{
	$opiniao->set_codigo_avaliador( 0 );
}

$opiniao->set_codigo_evento( $evento->get_codigo_evento() );

$notas = array(
	1 => $_POST['pa'],
	2 => $_POST['ws'],
	3 => $_POST['st'],
	4 => $_POST['kit'],
	5 => $_POST['es'],
	6 => $_POST['em'],
	7 => 0
);
$opiniao->set_notas($notas);

$comments = array(
	1 => $_POST['pa_comment'],
	2 => $_POST['ws_comment'],
	3 => $_POST['st_comment'],
	4 => $_POST['kit_comment'],
	5 => $_POST['es_comment'],
	6 => $_POST['em_comment'],
	7 => $_POST['gr_comment']
);
$opiniao->set_comments($comments);

$opiniao->insert();

echo "<script language=\"JavaScript\">location=(\"../status.php\");</script>";

?>

