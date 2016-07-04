<?php
$home = "/home/" . get_current_user() . "/";
include($home . "public_html/sifsc/user/error_handler.php");

require_once("../user/classes/class.avaliador.php");
require_once("../user/classes/class.conexao.php");
require_once("../user/classes/class.evento.php");

$evento = new Evento();
$avaliador = new Avaliador();

$evento->find_evento_aberto();

if ( $avaliador->find_by_email_evento($_POST["email"], $evento->get_codigo_evento() ) )
{

	// Gerando nova senha
	$salt = sha1(rand());
	$new_password = substr($salt, 0, 8);
	$password = $avaliador->encrypt_senha($new_password);

	$avaliador->set_senha($password);

	// E-mail para enviar com a senha nova
	$assunto = $evento->get_tag_email() . " Senha perdida";
	$mensagem = "Caro " . $avaliador->get_nome() . "\n\nAlguém entrou em nosso sistema de avaliação e pediu para que sua senha fosse resetada. Caso não tenha sido você, entre em contato imediatamente com a organização do evento. \n\nAqui está sua nova senha:\n\n";
	$mensagem .= $new_password;

	$mensagem .= "\n\nVocê poderá alterar sua senha depois de se identificar em nosso sistema novamente, no endereço: http://sifsc.ifsc.usp.br/referee \n\n" . $evento->get_assinatura_email();

	// Enviando e-mail
	$enviada = $avaliador->manda_email($assunto, $mensagem);

	// Verificando se o e-mail foi enviado e se a senha está atualizada
	if( $avaliador->update() and $enviada == 1 )
	{
		echo"<script language=\"javascript\"> location=\"login.php?out=1\"; </script>";
	}
	else
	{
		echo "<script language=\"javascript\"> location=\"login.php?error=6\"; </script>";
	}

}
else
{
	echo"<script language=\"javascript\"> location=\"login.php?error=7\"; </script>";
}


?>
