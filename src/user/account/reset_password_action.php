<?php

include("~/public_html/sifsc/user/error_handler.php");
require_once("./../classes/class.pessoa.php");
require_once("./../classes/class.conexao.php");
require_once("./../classes/class.evento.php");

$evento = new Evento();
$pessoa = new Pessoa();



if ( $pessoa->find_by_email($_POST["email"]) && $evento->find_evento_aberto())
{

	// Gerando nova senha
	$salt = sha1(rand());
	$new_password = substr($salt, 0, 7);
	$pessoa->set_senha($new_password);

	// E-mail para enviar com a senha nova
	$assunto = $evento->get_tag_email() . " Senha perdida";
	$mensagem = "Caro(a) " . $pessoa->get_nome() . "\n\nAlguém entrou em nosso sistema e pediu para que sua senha fosse resetada. Caso não tenha sido você, entre em contato imediatamente com a organização do evento. \n\nAqui está sua nova senha:\n\n";
	$mensagem .= $new_password;

	$mensagem .= "\n\nVocê poderá alterar sua senha depois de se identificar em nosso sistema novamente, no endereço: http://sifsc.ifsc.usp.br/user/login.php \n\n" . $evento->get_assinatura_email();

	// Enviando e-mail
	$enviada = $pessoa->manda_email($assunto, $mensagem);

	// Verificando se o e-mail foi enviado e se a senha está atualizada
	if( $pessoa->update_senha() and $enviada == 1 )
	{
		echo "<script language=\"javascript\"> location=\"http://sifsc.ifsc.usp.br/user/login.php?out=1\"; </script>";
	}
	else
	{
		echo "<script language=\"javascript\"> location=\"http://sifsc.ifsc.usp.br/user/login.php?error=6&cp=".$enviada."\"; </script>";
	}

}
else
{
	echo"<script language=\"javascript\"> location=\"http://sifsc.ifsc.usp.br/user/login.php?error=7\"; </script>";
}


?>
