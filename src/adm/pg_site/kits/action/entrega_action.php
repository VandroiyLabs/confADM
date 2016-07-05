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

$kits = new Kits();
$pessoa = new Pessoa();

if ( isset( $_GET['cp'] ) )
{
	$kits->find_by_codigo_pessoa( $_GET['cp'], $evento->get_codigo_evento() );
	$pessoa->find_by_codigo($_GET['cp']);
}
elseif ( isset( $_GET['em'] ) )
{
	$kits->find_by_email($_GET['em'], $evento->get_codigo_evento() );
	$pessoa->set_email( $kits->get_email());
	$pessoa->set_nome($kits->get_nome());
}


$kits->set_entrega(1);

if ( $kits->update() )
{

		$assunto = $evento->get_tag_email() . " Entrega do Kit";
		$nome = explode(" ", $pessoa->get_nome());
		$nome = $nome[0];
		$mensagem   = "Caro(a) " . $nome . ", \n\nregistramos que o seu kit já foi entregue pela comissão. Caso haja qualquer problema ou dúvidas, entre em contato imediatamente com a comissão! \n\n" . $evento->get_assinatura_email();

		$pessoa->manda_email($assunto, $mensagem); echo $pessoa->get_email();


	$_SESSION['msg'] = "Kit marcado como entregue!";
	echo "<script language=\"JavaScript\">location=(\"../../home.php?p1=kits\");</script>";
}
else
{
	$_SESSION['msg'] = "Problemas : ( ";
	echo "<script language=\"JavaScript\">location=(\"../../home.php?p1=kits\");</script>";
}

?>
