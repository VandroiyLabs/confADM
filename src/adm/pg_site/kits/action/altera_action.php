<?php
$home = "/home/" . get_current_user() . "/";

include($home . 'public_html/sifsc/adm/error_handler.php');
require_once($home . 'public_html/sifsc/user/classes/class.inscricao.php');
require_once($home . 'public_html/sifsc/user/classes/class.administrador.php');
require_once($home . 'public_html/sifsc/user/classes/class.evento.php');
require_once($home . 'public_html/sifsc/user/classes/class.pessoa.php');
require_once($home . 'public_html/sifsc/user/classes/class.kits.php');

session_start();
require_once($home . 'public_html/sifsc/adm/secao.php');
include($home . "public_html/sifsc/adm/restricted.php");

$evento = new Evento();
$evento->find_evento_aberto();

if ( !isset($adm) )
{
	echo "<script language=\"javascript\">window.alert(\"This is a restricted p1.".'\r'."Please REGISTER!!!\");location=(\"../index.php\");</script>";
	exit;
}


if ( !isset( $_POST['cp'] ) and !isset( $_POST['em'] ) )
{
}
else
{

$kits = new Kits();
$pessoa = new Pessoa();

if ( isset( $_POST['cp'] ) )
{
	$kits->find_by_codigo_pessoa( $_POST['cp'], $evento->get_codigo_evento() );
	$pessoa->find_by_codigo($_POST['cp']);
}
elseif ( isset( $_POST['em'] ) )
{
	$kits->find_by_email( $_POST['em'], $evento->get_codigo_evento() );
	$pessoa->set_email( $kits->get_email());
	$pessoa->set_nome($kits->get_nome());
}

$kits->set_camiseta($_POST['camiseta']);
$kits->set_tipo_camiseta($_POST['tipo_camiseta']);

if ( $kits->update() )
{

		$assunto    = $evento->get_tag_email() . " Alteração do Kit";
		$nome = explode(" ", $pessoa->get_nome());
		$nome = $nome[0];
		$mensagem   = "Caro(a) " . $nome . ", \n\nregistramos que o seu Kit foi alterado pela comissão. Caso haja qualquer problema ou dúvidas, entre em contato! \n\n" . $evento->get_assinatura_email();

		$pessoa->manda_email($assunto, $mensagem);


	$_SESSION['msg'] = "Tamanho da camiseta foi atualizado.";
	echo "<script language=\"JavaScript\">location=(\"../../home.php?p1=kits\");</script>";
}
else
{
	$_SESSION['msg'] = "Problemas : ( ";
	echo "<script language=\"JavaScript\">location=(\"../../home.php?p1=kits\");</script>";
}
}
?>
