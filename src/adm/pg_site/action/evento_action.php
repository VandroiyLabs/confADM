<?php
$home = "/home/" . get_current_user() . "/";

include($home . 'public_html/sifsc/adm/error_handler.php');
require_once('./../../../user/classes/class.evento.php');
session_start();

/* Loading section variables */
require_once($home . 'public_html/sifsc/adm/secao.php');
include($home . "public_html/sifsc/adm/restricted.php");

$evento = new Evento();

$page = $_POST["page"];


if($page == 'insert'){

	$evento->set_nome($_POST["nome"]);
	$evento->set_data_inicio($_POST["data_inicio"]);
	$evento->set_data_fim($_POST["data_fim"]);
	$evento->set_descricao($_POST["descricao"]);
	$evento->set_aberto($_POST["aberto"]);
	$evento->set_website($_POST["website"]);

	if($evento->insert()){

		//$_SESSION["evento"] = $evento;
		echo "<script language=\"JavaScript\">alert(\"Evento Inserido com Sucesso !\");location=(\"../home.php?page=listar\")</script>";
	}
	else{
		echo "<script language=\"JavaScript\">window.alert(\"Erro ao Inserir o Evento !\");location=(\"../home.php?page=listar\")</script>";
	}
}

if($page == 'update'){


	$evento = $_SESSION["evento"];
	$evento->set_nome($_POST["nome"]);
	$evento->set_data_inicio($_POST["data_inicio"]);
	$evento->set_data_fim($_POST["data_fim"]);
	$evento->set_descricao($_POST["descricao"]);
	$evento->set_aberto($_POST["aberto"]);
	$evento->set_website($_POST["website"]);

	$codigo_evento = $evento->get_codigo_evento();

	if($evento->update()){
		echo "<script language=\"JavaScript\">alert(\"Evento Atualizado com Sucesso !\");location=(\"../home.php?p1=listar\")</script>";
	}
	else{
		echo "<script language=\"JavaScript\">window.alert(\"Erro ao Atualizar o Evento !\");location=(\"../home.php?page=listar\"))</script>";
	}
}

if($page == 'remove'){

	$evento = $_SESSION["evento"];

	if($evento->remove()){
		echo "<script language=\"JavaScript\">alert(\"Evento Removido com Sucesso !\");location=(\"../home.php?page=listar\")</script>";
	}
	else{
		echo "<script language=\"JavaScript\">window.alert(\"Erro ao Remover o Evento !!\");location=(\"../home.php?page=listar\"))</script>";
	}

}
