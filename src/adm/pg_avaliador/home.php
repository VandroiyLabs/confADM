<?php
	$page = $_REQUEST["page"];
 	if($page == "listar" or $page == "atribuicao_resumo" or $page == "atribuicao_poster")
	{
		// Prevents from asking to resubmit page
		header_remove("Expires");
	    	header_remove("Cache-Control");
	   	header_remove("Pragma");
	    	header_remove("Last-Modified");
	}
/*
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
*/
	require_once('./../../user/classes/class.administrador.php');
	require_once('./../../user/classes/class.avaliador.php');
	require_once('./../../user/classes/class.avaliacao.php');
	require_once('./../../user/classes/class.avalia_resumo.php');
	require_once('./../../user/classes/class.avalia_poster.php');
	require_once('./../../user/classes/class.nota_resumo.php');
	require_once('./../../user/classes/class.participa_premiacao.php');

	require_once('./../../user/classes/class.evento.php');

	session_start();

	/* Loading section variables */
	$home = "/home/" . get_current_user() . "/";
	require_once($home . 'public_html/sifsc/adm/secao.php');
	require_once($home . 'public_html/sifsc/adm/restricted.php');
	require_once($home . 'public_html/sifsc/adm/restricted_biblioteca.php');
	require_once($home . 'public_html/sifsc/adm/restricted_avaliacao.php');


	$evento = new Evento();
	$evento->find_evento_aberto();

	include("../header.php");



	$avaliador = new Avaliador();

	if($page == "incluir"){
		include("incluir.php");
		$selected = 5.1;
	}
	else if($page == "listar")
	{
		include("listar.php");
		$selected = 5.2;
	}
	else if($page == "listar_nomes")
	{
		include("listar_nomes.php");
		$selected = 5.2;
	}
	else if($page == "ranking")
	{
		include("ranking_resumos.php");
		$selected = 5.5;
	}
	else if($page == "alterar"){
		include("alterar.php");
		$selected = 5.3;
	}
	else if($page == "excluir"){
		include("excluir.php");
		$selected = 5.4;
	}
	else if($page == "atribuicao_resumo"){
		include("atribuicao_resumo.php");
		$selected = 5.5;
	}
	else if($page == "relatorio"){
		include("relatorio.php");
		$selected = 5.6;
	}
	else if($page == "email")
	{
		include("envia_email_avaliadores.php");
		$selected = 5.5;
	}
	else if($page == "premiacao"){
		include("premiacao.php");
		$selected = 5.7;
	}else if($page == "atribuicao_poster" ){
		include("atribuicao_poster.php");
		$selected = 5.8;
	}
	else if($page == "sorteio_poster" ){
		include("sorteio_poster.php");
		$selected = 5.8;
	}
	else if($page == "lista_ordenada_poster" ){
		include("OrdemPoster.php");
		$selected = 5.8;
	}
	else if($page == "listanomes" ){
		include("listas_por_nome.php");
		$selected = 5.8;
	}


	include("../footer.php");
?>
