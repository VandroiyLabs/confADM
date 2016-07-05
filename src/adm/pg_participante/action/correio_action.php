<?php
$home = "/home/" . get_current_user() . "/";

require_once('../../../user/classes/class.evento.php');
require_once('../../../user/classes/email_functions.php');
$evento = new Evento();
$evento->find_evento_aberto();
require_once('Mail.php');

require_once($home . 'public_html/sifsc/user/classes/class.administrador.php');
session_start();

/* Loading section variables */
require_once($home . 'public_html/sifsc/adm/secao.php');
include($home . "public_html/sifsc/adm/restricted.php");

echo "Enviando e-mail...";

if( manda_email_gmail_bcc($_POST["destino"], $evento->get_tag_email()." ".$_POST["assunto"], $_POST["mensagem"]."\n\n".$evento->get_assinatura_email() ) )
$_SESSION['msg'] = "Correio enviado com sucesso!";
else
$_SESSION['msg'] = "Ocorreu um erro!";

echo "<script language=\"javascript\">location=(\"http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=correio\");</script>";

?>
