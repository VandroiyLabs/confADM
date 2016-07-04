<?php
require_once('~/public_html/sifsc/user/classes/class.avaliador.php');
require_once('~/public_html/sifsc/user/classes/class.evento.php');
session_start();
include("~/public_html/sifsc/user/error_handler.php");




$avaliador = $_SESSION["avaliador"];
$evento = $_SESSION["evento"];

	if ( $avaliador->compare_senhas( $_POST["senha_antiga"], $avaliador->get_senha() ) == 0 )
	{
		$password = $avaliador->encrypt_senha($_POST["senha"]);
		$avaliador->set_senha($password);

		if ( $avaliador->update_senha() )
		{
			$_SESSION["avaliador"] = $avaliador;
			$_SESSION["msg"] = "Senha alterada com sucesso";
			echo "<script language=\"JavaScript\">location=(\"../senha.php\");</script>";
		}
	}
	else
	{
		$_SESSION["msg"] = "Senha antiga incorreta.";
		echo "<script language=\"JavaScript\">location=(\"../senha.php\");</script>";
	}
?>
