<?php

	require_once('./../../user/classes/class.administrador.php');
	session_start();

	$home = "/home/" . get_current_user() . "/";
	require_once($home . 'public_html/sifsc/adm/secao.php');
	include($home . "public_html/sifsc/adm/restricted.php");


	include("../header.php");
	$p1 = $_REQUEST["p1"];


	if(!isset($_REQUEST["p1"])){
		include("listar.php");
	}
	else if($p1 == "incluir"){
		include("incluir.php");
		$selected = 6.1;
	}
	else if($p1 == "listar"){
		include("listar.php");
		$selected = 6.2;
	}
	else if($p1 == "alterar")
	{
	    if ( strcmp($adm->get_usuario(), $_GET['usuario']) == 0 or $adm->get_tipo() == 0 )
	    {
		include("alterar.php");
		$selected = 6.3;
	    }
	    else
	    {
		echo "<script language=\"javascript\">" .
		  "location=(\"http://sifsc.ifsc.usp.br/adm/pg_adm/home.php?p1=listar\");" .
		  "</script>";
	    }
	}
	else if($p1 == "setasuperadm"){
		include("action/adm_action.php");
		$selected = 6.3;
	}
	else if($p1 == "excluir"){
		include("excluir.php");
		$selected = 6.4;
	}

	else if($p1 == "backup"){
		include("backup.php");
		$selected = 10.0;
	}

	include("../footer.php");
?>
