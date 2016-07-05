<?php
$home = "/home/" . get_current_user() . "/";

require_once($home . 'public_html/sifsc/user/classes/class.administrador.php');
require_once($home . 'public_html/sifsc/user/classes/class.evento.php');
require_once($home . 'public_html/sifsc/user/classes/class.resumo.php');
require_once($home . 'public_html/sifsc/user/classes/class.pessoa.php');
session_start();

/* Loading section variables */
require_once($home . 'public_html/sifsc/adm/secao.php');
include($home . "public_html/sifsc/adm/restricted.php");

$evento = new Evento();
$evento->find_evento_aberto();

$resumo = new Resumo();
$lista_resumos = $resumo->checkBackups($evento->get_codigo_evento());

while ( $row = mysql_fetch_object($lista_resumos) )
{
	echo "<b>Codigo resumo:</b> " . $row->codigo_resumo . "<br />";
	echo "<b>Titulo atual:</b>&nbsp;&nbsp;  " . $row->titulo . "<br />";
	echo "<b>Titulo antigo:</b> " . $row->titulo_back . "<br />";

	echo "<b>Codigo pessoa:</b> " . $row->codigo_pessoa . "<br />";
	$pessoa = new Pessoa();
	$pessoa->find_by_codigo($row->codigo_pessoa);
	echo "<b>Nome:</b> " . $pessoa->get_nome() . "<br />";

	echo "<br />";
}

?>
