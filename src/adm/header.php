<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
$home = "/home/" . get_current_user() . "/";
include($home . 'public_html/sifsc/adm/error_handler.php');
?>

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="CACHE-CONTROL" content="NO-CACHE">
	<meta http-equiv="x-http-post-options" content="noresend" />
	<title>Adm-WEB v.4</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="http://sifsc.ifsc.usp.br/adm/style.css" rel="stylesheet" type="text/css" />
	<link href="../includes/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="http://sifsc.ifsc.usp.br/jsscripts/sifsc_warnings.js"></script>
	<script type="text/javascript" src="http://sifsc.ifsc.usp.br/adm/menuscript.js"></script>
	<script type="text/javascript" src="http://sifsc.ifsc.usp.br/adm/session_expiring.js"></script>

	<script type="text/javascript"
	   src="http://sifsc.ifsc.usp.br/mathjax/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
	</script>
</head>

<body onload = "menucookiesHandler(); startTimer(); startCount2ExpireSession()">

<script src="../includes/jquery.js"></script>
<script src="../includes/script.js"></script>


<div id="pre_header">

	<div id="header">
	</div>


	<div id="pre_header2">
		<div id="header2">
			<h3 align="right"><?=Conexao::$projeto?></h3>
		</div>
	</div>
</div>

<a name="topo"></a>
<div id="page">
