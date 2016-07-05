<?php
$home = "/home/" . get_current_user() . "/";

require_once($home . 'public_html/sifsc/user/classes/class.noticia.php');
require_once($home . 'public_html/sifsc/user/classes/class.evento.php');
session_start();
require_once($home . 'public_html/sifsc/adm/secao.php');
include($home . "public_html/sifsc/adm/restricted.php");

$noticia = new Noticia();

$page = $_POST["page"];
echo strcmp( $page, 'update');


if( strcmp( $page, 'insert' ) == 0 ){

	$noticia->set_codigo_evento($_POST["codigo_evento"]);
	$noticia->set_titulo($_POST["titulo"]);
	$noticia->set_conteudo($_POST["conteudo"]);
	$noticia->set_autor($_POST["autor"]);

	if($noticia->insert())
	{
		$_SESSION['msg'] = "Nova notícia inserida no site.";
		echo "<script language=\"JavaScript\">location=(\"../../home.php?p1=noticias\");</script>";
	}
	else{
		echo "<script language=\"JavaScript\">window.alert(\"Erro ao Inserir o noticia !\");location=(\"../../home.php?p1=noticias\");</script>";
	}
}

if( strcmp( $page, 'update') == 0 ){

	$noticia = new Noticia();
	$noticia->find_by_codigo($_POST["codigo_noticia"]);
	$noticia->set_codigo_evento($_POST["codigo_evento"]);
	$noticia->set_titulo($_POST["titulo"]);
	$noticia->set_conteudo($_POST["conteudo"]);
	$noticia->set_autor($_POST["autor"]);

	if($noticia->update())
	{
		$_SESSION['msg'] = "Notícia atualizada.";
		echo "<script language=\"JavaScript\">location=(\"../../home.php?p1=noticias\");</script>";
	}
	else{
		//echo "<script>alert(\"Erro ao Atualizar o noticia !\"); location=(\"../../home.php?p1=noticias\");</script>";
	}
}

if( strcmp( $page, 'remove' ) == 0 ){

	$noticia = $_SESSION["noticia"];

	if($noticia->remove())
	{
		$_SESSION['msg'] = "Notícia excluída do site.";
		echo "<script language=\"JavaScript\">location=(\"../../home.php?p1=noticias\");</script>";
	}
	else
	{
		echo "<script language=\"JavaScript\">window.alert(\"Erro ao Remover o noticia !!\");location=(\"../../home.php?p1=noticias\");</script>";
	}

}


?>
