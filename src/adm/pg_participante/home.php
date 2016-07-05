<?php
	$p1 = $_REQUEST["p1"];
	if($p1 == "pesquisar")
	{
		// Prevents from asking to resubmit page
		header_remove("Expires");
		header_remove("Cache-Control");
		header_remove("Pragma");
		header_remove("Last-Modified");
	}

	require_once('./../../user/classes/class.administrador.php');
	require_once('./../../user/classes/class.inscricao.php');
	require_once('./../../user/classes/class.evento.php');
	require_once('./../../user/classes/class.pessoa.php');
	require_once('./../../user/classes/class.minicurso.php');
	require_once('./../../user/classes/class.participa_minicurso.php');
	require_once('./../../user/classes/class.participa_premiacao.php');
	require_once('./../../user/classes/class.arte.php');
	require_once('./../../user/classes/class.resumo.php');
	require_once('./../../user/classes/class.autor.php');
	require_once('./../../user/classes/class.kits.php');
	require_once('./../../user/classes/class.calendar.php');
	require_once('./../../user/classes/class.avaliador.php');
	require_once('./../../user/classes/class.avalia_poster.php');
	require_once('./../../user/classes/class.participante_frequencia.php');
	session_start();
	$home = "/home/" . get_current_user() . "/";
	require_once($home . 'public_html/sifsc/adm/secao.php');
	include($home . "public_html/sifsc/adm/restricted.php");

/*	unset($_SESSION["pessoa"]);
	unset($_SESSION["evento"]);
	unset($_SESSION["inscricao"]);
*/

	include("../header.php");


	$pessoa = new Pessoa();
	if(!isset($p1)){

		include("listar.php");
		$selected = 3.2;

	}
	else if($p1 == "incluir")
	{
		include("incluir.php");
		$selected = 3.1;
	}
	else if($p1 == "listar")
	{
		include("listar.php");
		$selected = 3.2;
	}
	else if($p1 == "pesquisar")
	{
		include("pesquisar.php");
		$selected = 3.3;
	}
	else if($p1 == "showpessoa")
	{
		include("show_pessoa.php");
		$selected = 3.2;
	}
	else if($p1 == "calculaerros")
	{
		include("calculaerros.php");
		$selected = 3.2;
	}

	else if($p1 == "relatorio")
	{
		include("relatorio.php");
		$selected = 3.4;
	}
	else if($p1 == "listanomes")
	{
		include("listas_por_nome.php");
		$selected = 3.4;
	}
        else if($p1 == "listanomes_e_emails")
	{
		include("listas_por_nome_email.php");
		$selected = 3.4;
	}
	else if($p1 == "crachas")
	{
		include("crachas.php");
		$selected = 3.5;
	}
	else if($p1 == "frequencia")
	{
		include("frequencia.php");
		$selected = 3.6;
	}
	else if($p1 == "correio")
	{
		include("correio.php");
		$selected = 3.6;
	}
	else if($p1 == "certificados")
	{
		include("certificados.php");
		$selected = 3.7;
	}
	else if($p1 == "livro")
	{
		include("livro.php");
		$selected = 3.8;
	}
	else if($p1 == "alterar")
	{
		include("alterar.php");
		$selected = 3.9;
	}
	else if($p1 == "detalhes")
	{
		include("detalhes.php");
		$selected = 3.10;
	}
	else if($p1 == "excluir_inscricao")
	{
		include("excluir_inscricao.php");
		$selected = 3.11;
	}
	else if($p1 == "excluir_participante")
	{
		include("excluir_participante.php");
		$selected = 3.12;
	}
	else if($p1 == "deferir")
	{
		include("deferir.php");
		$selected = 3.13;
	}

	include("../footer.php");
?>
