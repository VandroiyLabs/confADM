<?php

function contata_dev($assunto, $mensagem)
{

	// Incluindo arquivo com a classe Mail
	require_once('Mail.php');

	$dev_mail   = "";   // e-mail do desenvolvedor!
	$de         = "organizacao@sifsc.ifsc.usp.br";
	$servidor   = "";   // host
	$login      = "organizacao@sifsc.ifsc.usp.br";
	$senha      = "";   // password

	// Cabeçalho do email
	$headers = array (
		'From'     => $de,
		'Reply-to' => $de,
		'To'       => $dev_mail,
		'Subject'  => $assunto
		);

	// Conexão ao servidor
	$smtp = Mail::factory('smtp',
	    array (
	      'host'     => $servidor,
	      'port'     => 25,
	      'auth'     => true,
	      'username' => $login,
	      'password' => $senha
	    )
	);

	// Efetuando o envio autenticado
	$mail = $smtp->send($dev_mail, $headers, $mensagem);

	// Verificando se houve erro
	if (PEAR::isError($mail))
	{
		return("Error:" . $mail->getMessage());
	}
	else
	{
		return(1);
	}
}


// Trying to show something nicer than just an error page...
function fatalErrorHandler()
{
	// Getting last error
	$error = error_get_last();

	// Checking if last error is a fatal error
	if( ( $error['type'] === E_ERROR ) or ( $error['type'] === E_USER_ERROR ) )
	{

		$assunto = '[E_ERROR - ADMSIFSC] ' . $error['file'];

		$mensagem = "E-mail de erro!!\n\n";
		$mensagem .= "Mensagem: \n " . $error['message'] . "\n\n";
		$mensagem .= "Arquivo: \n " . $error['file'] . "\n\n";
		$mensagem .= "Linha: \n " . $error['line'] . "\n\n";

		$host = $_SERVER['HTTP_HOST'];
		$self = $_SERVER['PHP_SELF'];
		$query = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
		$url = !empty($query) ? "http://$host$self?$query" : "http://$host$self";

		$mensagem .= "URL: \n " . $url . "\n\n";
		$mensagem .= "Data servidor: \n " . date('l jS \of F Y h:i:s A') . "\n\n";

		$mensagem .= " ------- \n Informações do browser\n";
		$mensagem .= $_SERVER['HTTP_USER_AGENT'] . "\n\n";

		$mensagem .= " ------- \n Tipo da variável pessoa:\n";
		$mensagem .= is_object($_SESSION['pessoa']) . "\n\n";


		contata_dev($assunto, $mensagem);

		// Here we handle the error, displaying HTML, logging, ...
		echo "<script language=\"javascript\">location=(\"http://sifsc.ifsc.usp.br/adm/fatalerrorpage.php\");</script>";
	}
}

// Registering shutdown function
register_shutdown_function('fatalErrorHandler');

?>
