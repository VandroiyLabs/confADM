<?php
error_reporting(E_ERROR);
//error_reporting(E_ALL);

ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$home = "/home/" . get_current_user() . "/";
include($home . 'public_html/sifsc/adm/error_handler.php');
require_once('./../../../user/classes/class.evento.php');
require_once('./../../../user/classes/class.administrador.php');
require_once('./../../../user/classes/class.log.php');
session_start();

$evento = new Evento();

$page = $_POST["page"];

// Recovering session variables
require_once($home . 'public_html/sifsc/adm/secao.php');


if ( $page == 'insert' )
{
	$evento->set_nome($_POST["nome"]);
	$evento->set_data_inicio($_POST["data_inicio"]);
	$evento->set_data_fim($_POST["data_fim"]);
	$evento->set_descricao($_POST["descricao"]);
	$evento->set_aberto($_POST["aberto"]);
	$evento->set_inscricao_aberta($_POST["inscricao_aberta"]);
	$evento->set_submissao_aberta($_POST["submissao_aberta"]);
	$evento->set_resubmissao_aberta($_POST["resubmissao_aberta"]);
	$evento->set_avaliacao_aberta($_POST["avaliacao_aberta"]);
	$evento->set_pesquisa_aberta($_POST["pesquisa_aberta"]);
	$evento->set_premio_aberto($_POST["premio_aberto"]);
	$evento->set_website($_POST["website"]);
	$evento->set_tag_email($_POST["tag_email"]);
	$evento->set_assinatura_email($_POST["assinatura_email"]);

	if($evento->insert())
	{
		echo "<script language=\"JavaScript\">alert(\"Evento Inserido com Sucesso !\");location=(\"../home.php?p1=info\")</script>";
	}
	else{
		echo "<script language=\"JavaScript\">window.alert(\"Erro ao Inserir o Evento !\");location=(\"../home.php?p1=info\")</script>";
	}
}

if ( $page == 'update' )
{

	$evento->find_by_codigo($_POST["codigo_evento"]);
	$evento->set_nome($_POST["nome"]);
	$evento->set_data_inicio($_POST["data_inicio"]);
	$evento->set_data_fim($_POST["data_fim"]);
	$evento->set_descricao($_POST["descricao"]);
	$evento->set_aberto($_POST["aberto"]);
	$evento->set_inscricao_aberta($_POST["inscricao_aberta"]);
	$evento->set_minicurso_aberto($_POST["minicurso_aberto"]);
	$evento->set_submissao_aberta($_POST["submissao_aberta"]);
	$evento->set_resubmissao_aberta($_POST["resubmissao_aberta"]);
	$evento->set_avaliacao_aberta($_POST["avaliacao_aberta"]);
	$evento->set_pesquisa_aberta($_POST["pesquisa_aberta"]);
	$evento->set_premio_aberto($_POST["premio_aberto"]);
	$evento->set_website($_POST["website"]);
	$evento->set_tag_email($_POST["tag_email"]);
	$evento->set_assinatura_email($_POST["assinatura_email"]);
	$evento->set_assinatura_email($_POST["assinatura_email"]);

	$log = new Log();
	$log->set_adm_usuario( $adm->get_usuario() );
	$log->set_codigo_evento( $evento->get_codigo_evento() );
	$log->set_operacao( 'Atualiza evento' );
	$log->set_detalhes( 'inscricao_aberta = ' . $_POST["inscricao_aberta"] . ' :: subimissao_aberta = ' . $_POST["submissao_aberta"].' :: resubimissao_aberta = ' . $_POST["resubmissao_aberta"] . ' :: aberto = ' . $_POST["aberto"] . '' );
	$log->insert();

	if($evento->update()){
		echo "<script language=\"JavaScript\">alert(\"Evento Atualizado com Sucesso !\");location=(\"../home.php?p1=info\")</script>";
	}
	else{
		echo "<script language=\"JavaScript\">window.alert(\"Erro ao Atualizar o Evento !\");location=(\"../home.php?p1=info\")</script>";
	}
}

if ( $page == 'remove' )
{

	$evento->find_by_codigo($_POST["codigo_evento"]);

	if($evento->remove()){
		echo "<script language=\"JavaScript\">alert(\"Evento Removido com Sucesso !\");location=(\"../home.php?p1=info\")</script>";
	}
	else{
		echo "<script language=\"JavaScript\">window.alert(\"Erro ao Remover o Evento !!\");location=(\"../home.php?p1=info\")</script>";
	}

}
