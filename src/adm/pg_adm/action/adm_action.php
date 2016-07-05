<?php
$home = "/home/" . get_current_user() . "/";
include($home . 'public_html/sifsc/adm/error_handler.php');
require_once($home . 'public_html/sifsc/user/classes/class.administrador.php');
require_once($home . 'public_html/sifsc/user/classes/class.log.php');
require_once($home . 'public_html/sifsc/user/classes/class.evento.php');
session_start();

$adm_novo = new Administrador();
$action = $_POST["action"];


/* Loading section variables */
require_once($home . 'public_html/sifsc/adm/secao.php');
include($home . "public_html/sifsc/adm/restricted.php");

$evento = new Evento();
$evento->find_evento_aberto();

if ( $action == 'insert' )
{
	$log = new Log();
	$log->set_adm_usuario( $adm->get_usuario() );
	$log->set_codigo_evento( $evento->get_codigo_evento() );
	$log->set_operacao( 'Incluir administrador' );
	$log->set_detalhes( 'Nome = ' . $_POST["usuario"] . ' :: tipo = ' . $_POST["tipo"] . '' );
	$log->insert();


	$adm_novo->set_usuario($_POST["usuario"]);
	$adm_novo->set_senha($_POST["senha"]);
	$adm_novo->set_nome($_POST["nome"]);
	$adm_novo->set_cpf('1');
	$adm_novo->set_rg('1');
	$adm_novo->set_email($_POST["email"]);
	$adm_novo->set_endereco('1');

	if ( isset( $_POST["tipo"] ) and $adm->get_tipo == 0 )
	{
		$adm_novo->set_tipo($_POST["tipo"]);
	}
	else
	{
		$adm_novo->set_tipo('1');
	}

	if ( $adm_novo->insert() )
	{
		echo "<script language=\"JavaScript\">alert(\"Administrador Inserido com Sucesso !\");location=(\"../home.php?p1=listar\");</script>";
	}
	else
	{
		echo "<script language=\"JavaScript\">window.alert(\"Usuário já Existente !\");history.back();</script>";
	}
}

if($action == 'update')
{
	$adm_novo->find_by_usuario($_POST["usuario"]);

	$log = new Log();
	$log->set_adm_usuario( $adm->get_usuario() );
	$log->set_codigo_evento( $evento->get_codigo_evento() );
	$log->set_operacao( 'Atualizar administrador' );
	$log->set_detalhes( 'Usuario = ' . $adm_novo->get_usuario() . ' :: Nome = ' . $_POST["nome"] . ' :: tipo = ' . $_POST["tipo"] . '' );
	$log->insert();

	if ( strcmp($_POST["senha"], "") != 0 and strcmp($_POST["senha"], " ") != 0 )
	{
		$adm_novo->set_senha($_POST["senha"]);
	}

	$adm_novo->set_nome($_POST["nome"]);
	$adm_novo->set_email($_POST["email"]);

	if ( strcmp($_POST["tipo"], "") != 0 and strcmp($_POST["post"], " ") != 0 and $adm->get_tipo() == 0 )
	{
		$adm_novo->set_tipo($_POST["tipo"]);
	}


	if ( $adm_novo->update() )
	{

		if ( strcmp( $_SESSION['adm']->get_usuario(), $adm_novo->get_usuario() ) == 0 )
		{
			$_SESSION['adm'] = $adm_novo;
		}

	    echo "<script language=\"JavaScript\">location=(\"../home.php?p1=listar\");</script>";
	}
	else
	{
		echo "<script language=\"JavaScript\">window.alert(\"Erro na atualização!\");history.back();)</script>";
	}
}

if( strcmp($_GET['p1'], 'setasuperadm') == 0 )
{
	$adm_novo = $_SESSION["adm_novo"];

	if ( $adm_novo->get_tipo() != -1)
	{
		$adm_novo->set_tipo(-2);
	}

	if ( $adm_novo->update() )
	{

		echo "<script language=\"JavaScript\">location=(\"../home.php?p1=listar\");</script>";
	}
	else
	{
		echo "<script language=\"JavaScript\">location=(\"../home.php?p1=listar\");</script>";
	}
}

if ( $action == 'remove' )
{
	$adm_novo = $_SESSION["adm_novo"];

	$log = new Log();
	$log->set_adm_usuario( $adm->get_usuario() );
	$log->set_codigo_evento( $evento->get_codigo_evento() );
	$log->set_operacao( 'Excluir administrador' );
	$log->set_detalhes( 'Nome = ' . $adm_novo->get_usuario() . ' :: tipo = ' . $adm_novo->get_tipo() . '' );
	$log->insert();

	if($adm_novo->remove()){
		echo "<script language=\"JavaScript\">alert(\"Administrador Removido com Sucesso !\");location=(\"../home.php?p1=listar\");</script>";
	}
	else{
		echo "<script language=\"JavaScript\">window.alert(\"Erro na remocao!\");history.back();)</script>";
	}

}

?>
