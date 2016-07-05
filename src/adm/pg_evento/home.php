<?php

	require_once('./../../user/classes/class.administrador.php');
	require_once('./../../user/classes/class.evento.php');
	require_once('./../../user/classes/class.inscricao.php');
	require_once('./../../user/classes/class.pessoa.php');


	require_once('./../../user/classes/class.conexao.php');
	session_start();

	$home = "/home/" . get_current_user() . "/";
	require_once($home . 'public_html/sifsc/adm/secao.php');
	include($home . "public_html/sifsc/adm/restricted.php");

	include("../header.php");
	$p1 = $_REQUEST["p1"];


	if(!isset($p1)){
		include("info.php");
		$selected = 1.1;
	}
	else if($p1 == "info"){
		include("info.php");
		$selected = 1.1;
	}
	else if($p1 == "incluir"){
		include("incluir.php");
		$selected = 1.2;
	}
	else if($p1 == "alterar"){
		include("alterar.php");
		$selected = 1.3;
	}
	else if($p1 == "excluir"){
		include("excluir.php");
		$selected = 1.3;
	}
	else if($p1 == "listar2")
	{
		include("info__.php");
		$selected = 1.3;
	}

	include("../footer.php");
?>
