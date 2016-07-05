<?php
$home = "/home/" . get_current_user() . "/";
include($home . 'public_html/sifsc/adm/error_handler.php');
require_once('./../../../user/classes/class.minicurso.php');
require_once('./../../../user/classes/class.inscricao.php');
require_once('./../../../user/classes/class.participa_minicurso.php');
require_once('./../../../user/classes/class.evento.php');
session_start();


$page = $_POST["page"];

/* Loading section variables */
require_once($home . 'public_html/sifsc/adm/secao.php');
include($home . "public_html/sifsc/adm/restricted.php");

$minicurso = new Minicurso();

$evento = new Evento();
$evento->find_evento_aberto();

if($page == 'incluir')
{

	$minicurso->set_codigo_evento($evento->get_codigo_evento());
	$minicurso->set_titulo($_POST["titulo"]);
	$minicurso->set_vagas($_POST["vagas"]);
	$minicurso->set_descricao($_POST["descricao"]);
	$minicurso->set_tipo($_POST["tipo"]);
	$minicurso->set_responsavel($_POST["responsavel"]);

	if($minicurso->insert()){

		//$_SESSION["minicurso"] = $minicurso;
		echo "<script language=\"JavaScript\">alert(\"Minicurso Inserido com Sucesso !\");history.go(-2);</script>";
	}
	else{
		echo "<script language=\"JavaScript\">window.alert(\"Erro ao Inserir o minicurso !\");location=(\"../home.php?page=listar\")</script>";
	}
}

if($page == 'alterar')
{

	$minicurso->find_by_codigo($_POST['codigo']);

	$minicurso->set_titulo($_POST["titulo"]);
	$minicurso->set_vagas($_POST["vagas"]);
	$minicurso->set_descricao($_POST["descricao"]);
	$minicurso->set_tipo($_POST["tipo"]);
	$minicurso->set_responsavel($_POST["responsavel"]);

	if($minicurso->update()){
		echo "<script language=\"JavaScript\">alert(\"Minicurso Atualizado com Sucesso !\");history.go(-2);</script>";
	}
	else{
		echo "<script language=\"JavaScript\">window.alert(\"Erro ao Atualizar o minicurso !\");location=(\"../home.php?page=listar\"))</script>";
	}
}

if( $page == 'excluir' )
{

	$minicurso->find_by_codigo($_POST['codigo']);

	$PartMinic = new ParticipaMinicurso();
	$consulta = $PartMinic->find_by_minicurso_evento($minicurso->get_codigo_minicurso(), $_REQUEST["codigo_evento"]);

	$key = 1;

	while ( $row = mysql_fetch_object($consulta) )
	{
		$inscricao = new Inscricao();
		$inscricao->find_by_pessoa_evento($row->codigo, $_REQUEST["codigo_evento"]);
		$inscricao->seta_modalidade(0, 3);

		if ( !$inscricao->update_no_form() )
		{
			echo "<script language=\"JavaScript\">alert(\"Problema ao tentar desinscrever uma pessoa!!\");location=(\"http://sifsc.ifsc.usp.br/adm/pg_minicurso/home.php?page=listar\")</script>";
			$key = 0;
		}

		$PartMinic = new ParticipaMinicurso();
		$PartMinic->find_by_codigo($row->codigo, $evento->get_codigo_evento());
		if ( !$PartMinic->remove_by_evento($evento->get_codigo_evento()) )
		{
			echo "<script language=\"JavaScript\">alert(\"Problema ao tentar desinscrever uma pessoa!!\");location=(\"http://sifsc.ifsc.usp.br/adm/pg_minicurso/home.php?page=listar\")</script>";
			$key = 0;
		}
	}

	if ( $key == 1 )
	{
		if ( $minicurso->remove() )
		{
			echo "<script language=\"JavaScript\">location=(\"http://sifsc.ifsc.usp.br/adm/pg_minicurso/home.php?page=listar\")</script>";
		}
		else
		{
			echo "<script language=\"JavaScript\">window.alert(\"Erro ao Remover o minicurso !!\");location=(\"http://sifsc.ifsc.usp.br/adm/pg_minicurso/home.php?page=listar\"))</script>";
		}
	}
}

if ( strcmp( $page, 'excluir_inscricao' )  == 0 )
{
	$PartMinic = new ParticipaMinicurso();
	$PartMinic->find_by_codigo($_POST["codigo_pessoa"], $evento->get_codigo_evento());

	$inscricao = new Inscricao();
	$inscricao->find_by_pessoa_evento($_POST["codigo_pessoa"], $evento->get_codigo_evento());
	$inscricao->seta_modalidade(0, 3);

	$minicurso = new Minicurso();
	$minicurso->find_by_codigo($_POST["codigo_minicurso"]);
	$_SESSION["minicurso"] = $minicurso;


	if ( $PartMinic->remove_by_evento($evento->get_codigo_evento()) and $minicurso->remove_inscritos() and $inscricao->update_no_form() )
	{
		echo "<script language=\"JavaScript\">location=(\"../home.php?page=listainscritos\&codigo=" . $minicurso->get_codigo_minicurso() ."\");</script>";
	}
	else
	{
		echo "<script language=\"JavaScript\">window.alert(\"Erro ao Remover o minicurso !!\");location=(\"../home.php?page=listar\")</script>";
	}

}

?>
