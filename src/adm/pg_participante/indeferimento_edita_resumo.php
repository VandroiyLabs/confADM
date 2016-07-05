<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="CACHE-CONTROL" content="NO-CACHE">
	<title>Adm-WEB v.4</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="../style.css" rel="stylesheet" type="text/css" />
	<link href="../includes/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="http://sifsc.ifsc.usp.br/jsscripts/sifsc_warnings.js"></script>
	<script type="text/javascript" src="http://sifsc.ifsc.usp.br/adm/menuscript.js"></script>

	<script type="text/javascript"
	   src="http://sifsc.ifsc.usp.br/mathjax/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
	</script>
</head>

<body onload = "menucookiesHandler(); startTimer()">

<script src="../includes/jquery.js"></script>
<script src="../includes/script.js"></script>

<div id="page">



<?php

	require_once('./../../user/classes/class.administrador.php');
	require_once('./../../user/classes/class.inscricao.php');
	require_once('./../../user/classes/class.evento.php');
	require_once('./../../user/classes/class.pessoa.php');
	require_once('./../../user/classes/class.minicurso.php');
	require_once('./../../user/classes/class.participa_minicurso.php');
	require_once('./../../user/classes/class.arte.php');
	require_once('./../../user/classes/class.resumo.php');
	require_once('./../../user/classes/class.autor.php');

	session_start();
	$home = "/home/" . get_current_user() . "/";
	require_once($home . 'public_html/sifsc/adm/secao.php');
	include($home . "public_html/sifsc/adm/restricted.php");

	$p1 = $_REQUEST["p1"];

	include("incluir_vdef.php");
	$selected = 3.1;

?>
