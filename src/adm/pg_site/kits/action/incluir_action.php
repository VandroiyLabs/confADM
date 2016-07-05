<?php
$home = "/home/" . get_current_user() . "/";

include($home . 'public_html/sifsc/adm/error_handler.php');
require_once($home . 'public_html/sifsc/user/classes/class.inscricao.php');
require_once($home . 'public_html/sifsc/user/classes/class.administrador.php');
require_once($home . 'public_html/sifsc/user/classes/class.evento.php');
require_once($home . 'public_html/sifsc/user/classes/class.pessoa.php');
require_once($home . 'public_html/sifsc/user/classes/class.kits.php');

session_start();


/* Loading section variables */
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

if ( isset( $_POST['cp'] ) and $_POST['cp'] != "" )
{
	$pessoa->find_by_codigo($_POST['cp']);
	$kits->set_nome(addslashes($pessoa->get_nome()));
	$kits->set_camiseta( $_POST['camiseta'] );
	$kits->set_tipo_camiseta( $_POST['tipo_camiseta'] );
	$kits->set_codigo_pessoa( $_POST['cp'] );
	$kits->set_entrega(0);

}
else
{
	$kits->set_nome(addslashes($_POST['nome']));
	$kits->set_email($_POST['email']);
	$kits->set_camiseta( $_POST['camiseta'] );
	$kits->set_tipo_camiseta( $_POST['tipo_camiseta'] );
	$kits->set_codigo_pessoa(0);
	$kits->set_entrega(0);
	$pessoa->set_email( $_POST['email']);
	$pessoa->set_nome($_POST['nome']);
}

$kits->set_codigo_evento( $evento->get_codigo_evento() );

if ( $kits->insert() )
{

		$assunto    = $evento->get_tag_email() . " Compra de Kit";
		$nome = explode(" ", $pessoa->get_nome());
		$nome = $nome[0];
		$mensagem   = "Caro(a) " . $nome . ", \n\nregistramos a compra de seu Kit neste momento. Você pode conferir a numeração da camiseta pedida em sua conta no site, na área de status. Caso haja qualquer problema ou dúvidas, entre em contato imediatamente com a comissão! \n\n" . $evento->get_assinatura_email();

		$pessoa->manda_email($assunto, $mensagem);


	$_SESSION['msg'] = "Dados sobre venda de Kit adicionados com sucesso!";
	echo "<script language=\"JavaScript\">location=(\"../../home.php?p1=kits\");</script>";
}
else
{
	$_SESSION['msg'] = "Dados duplicados!";
	echo "<script language=\"JavaScript\">location=(\"../../home.php?p1=kits\");</script>";
}

?>
