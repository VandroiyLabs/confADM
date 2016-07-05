<?php
$home = "/home/" . get_current_user() . "/";

require_once('./../../user/classes/class.administrador.php');
require_once('./../../user/classes/class.evento.php');
require_once('./../../user/classes/class.inscricao.php');
require_once('./../../user/classes/class.pessoa.php');

require_once('./../../user/classes/class.conexao.php');
session_start();

/* Loading section variables */
require_once($home . 'public_html/sifsc/adm/secao.php');
include("./../restricted.php");
require_once('./../restricted_biblioteca.php');


include("../header.php");
$p1 = $_REQUEST["p1"];


if(!isset($p1)){
	include("listar.php");
	$selected = 2.1;
}
else if($p1 == "listar"){
	include("listar.php");
	$selected = 2.1;
}
else if($p1 == "incluir"){
	include("incluir.php");
	$selected = 2.2;
}
else if($p1 == "alterar"){
	include("alterar.php");
	$selected = 2.3;
}
else if($p1 == "excluir"){
	include("excluir.php");
	$selected = 2.3;
}
else if($p1 == "programacao"){
	include("calendar/home.php");
	$selected = 2.2;
}
else if($p1 == "noticias"){
	include("noticias/home.php");
	$selected = 2.1;
}
else if ( $p1 == "kits" )
{
	include("kits/home.php");
	$selected = 2.3;
}
else if ( $p1 == "opiniao" )
{
	include("opiniao/home.php");
	$selected = 2.5;
}

include("../footer.php");
?>
