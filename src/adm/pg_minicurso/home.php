<?php
	require_once('./../../user/classes/class.administrador.php');
	require_once('./../../user/classes/class.evento.php');
	require_once('./../../user/classes/class.inscricao.php');
	require_once('./../../user/classes/class.pessoa.php');

	require_once('./../../user/classes/class.conexao.php');
	require_once('./../../user/classes/class.minicurso.php');
	require_once('./../../user/classes/class.participa_minicurso.php');
	session_start();

	/* Loading section variables */
	$home = "/home/" . get_current_user() . "/";
	require_once($home . 'public_html/sifsc/adm/secao.php');
	include("./../restricted.php");
	require_once('./../restricted_biblioteca.php');

	include("../header.php");
	$page = $_REQUEST["page"];

	$minicurso = new Minicurso();
	$evento = new Evento();
	$evento->find_evento_aberto();

	if(!isset($page)){
		$selected = 4.2;
		include("listar.php");
	}
	else if($page == "listar")
	{
		$selected = 4.2;
		include("listar.php");
	}
	else if($page == "listainscritos")
	{
		$selected = 4.2;
		include("listainscritos.php");
	}
	else if($page == "listainscritostxt")
	{
		$selected = 4.2;
		include("listainscritos_txt.php");
	}
	else if($page == "incluir")
	{
		$selected = 4.1;
		include("incluir.php");
	}
	else if($page == "alterar")
	{
		$selected = 4.3;
		include("alterar.php");
	}
	else if($page == "excluir")
	{
		$selected = 4.4;
		include("excluir.php");
	}
	else if($page == "excluir_inscricao")
	{
		$selected = 4.2;
		include("excluir_inscricao.php");
	}
	else if($page == "relatorio")
	{
		$selected = 4.5;
		include("relatorio.php");
	}

	include("../footer.php");
?>
