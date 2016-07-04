<?php
$home = "/home/" . get_current_user() . "/";

include($home . "public_html/sifsc/user/error_handler.php");
require_once($home . 'public_html/sifsc/user/classes/class.avaliador.php');

session_start();

$avaliador = $_SESSION["avaliador"];


if ( isset($_POST["assunto"]) and isset($avaliador) )
{

	$subject = $_POST['assunto'];
	$conteudo = $_POST['mensagem'];
	$headlines = $_POST['natureza'];
	$organiza_email = 'avaliacaosifsc@gmail.com';

	$assunto = '[CONTATO AVALIADOR] <' . $headlines . '> - ' . $subject;


	$mensagem = "Avaliador: " . $avaliador->get_nome() . "\n" .
				"Email: " . $avaliador->get_email() . "\n";


				$mensagem .= "\n\n" .
				" -> Conteúdo da mensagem: \n---------------------------------------------------\n" . $conteudo . "\n---------------------------------------------------\n\n" .
				" ";

	if ( $avaliador->contata_organizacao($organiza_email, $assunto, $mensagem) )
	{
		$_SESSION["avaliador"] = $avaliador;
		$_SESSION["msg"] = "Mensagem enviada com sucesso";
		echo "<script language=\"JavaScript\"> location=(\"../faleconosco.php\"); </script>";
	}
}
?>
