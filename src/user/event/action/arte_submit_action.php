<?php
require_once('~/public_html/sifsc/user/classes/class.pessoa.php');
require_once('~/public_html/sifsc/user/classes/class.inscricao.php');
require_once('~/public_html/sifsc/user/classes/class.evento.php');

session_start();
include("~/public_html/sifsc/user/error_handler.php");
include("~/public_html/sifsc/user/event/secao.php");

$page = $_POST["page"];


$inscricao = $_SESSION["inscricao"];
$evento = $_SESSION["evento"];


if($evento->get_inscricao_aberta() == '1')
{

	$inscricao->seta_modalidade(2,4);
	$inscricao->set_situacao_arte(2);

	if ( $inscricao->update_no_form())
	{
		$_SESSION["inscricao"] = $inscricao;
		$_SESSION['msg'] = 'Detalhes da sua obra de arte foram atualizados.';
		echo "<script language=\"javascript\">location=(\"../arte.php\");</script>";
	}

}
else
{
	$_SESSION['msg'] = 'Inscrições encerradas!';
	echo "<script language=\"JavaScript\">location=(\"../arte.php\");</script>";
}
?>
