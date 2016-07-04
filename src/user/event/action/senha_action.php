<?php
require_once('~/public_html/sifsc/user/classes/class.pessoa.php');
require_once('~/public_html/sifsc/user/classes/class.evento.php');
require_once('~/public_html/sifsc/user/classes/class.inscricao.php');

session_start();
include("~/public_html/sifsc/user/error_handler.php");

include("~/public_html/sifsc/user/event/secao.php");

$pessoa = $_SESSION["pessoa"];
$evento = $_SESSION["evento"];

if($evento->get_aberto() == '1')
{
	if ( $pessoa->compare_senhas( $_POST["senha_antiga"], $pessoa->get_senha() ) == 0 )
	{

		$pessoa->set_senha($_POST["senha"]);

		if ( $pessoa->update_senha() )
		{
			$_SESSION["pessoa"] = $pessoa;
			$_SESSION["msg"] = "Senha alterada com sucesso";
			echo "<script language=\"JavaScript\">location=(\"../registration.php\");</script>";
		}
	}
}
else
{
	$_SESSION['msg'] = 'Período de inscrições encerrado!';
	echo "<script language=\"JavaScript\">location=(\"../registration.php\");</script>";
}
?>
