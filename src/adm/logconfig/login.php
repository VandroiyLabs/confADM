<?php

	session_start();
	session_destroy();
	
	require_once('./../../user/classes/class.administrador.php');
	require_once('./../../user/classes/class.evento.php');

	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	
	$adm = new Administrador();
	
	if( $adm->find_by_usuario_senha($usuario, $senha) )
	{
		
		session_start();
		$_SESSION["adm"] = $adm;
		$_SESSION["adm_usuario"] = $adm->get_usuario();

		$evento = new Evento();
		if($evento->find_evento_aberto())
		{
			$_SESSION["evento"] = $evento;			
			echo "<script language=\"JavaScript\">location=(\"../pg_evento/home.php?page=listar\")</script>";
		}
		else
			echo "<script language=\"JavaScript\">location=(\"../pg_evento/home.php?page=listar\")</script>";
	}
	else
	{
		echo "<script language=\"JavaScript\">window.alert(\"Usuario nao existente!\");location=(\"../index.php\")</script>";
	}

	

?>
