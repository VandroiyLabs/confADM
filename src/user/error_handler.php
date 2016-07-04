<?php
require_once('~/public_html/sifsc/user/classes/email_functions.php');

try
{

// Trying to show something nicer than just an error page...
function fatalErrorHandler()
{
	// Getting last error
	$error = error_get_last();

	// Checking if last error is a fatal error
	if( ( $error['type'] === E_ERROR ) or ( $error['type'] === E_USER_ERROR ) )
	{

		$assunto = '[E_ERROR - IISIFSC] ' . $error['file'] . " -- " . date('l jS \of F Y h:i:s A');

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

		$mensagem .= " ------- \n Tipo da variável pessoa:\n";
		$mensagem .= is_object($_SESSION['pessoa']) . "\n\n";

		$mensagem .= " ------- \n Server info\n";
		$mensagem .= " - HTTP_USER_AGENT: " . $_SERVER['HTTP_USER_AGENT'] . "\n";
		$mensagem .= " - HTTP_REFERER: " . $_SERVER['HTTP_REFERER'] . "\n";
		$mensagem .= " - REMOTE_ADDR: " . $_SERVER['REMOTE_ADDR'] . "\n";
		$mensagem .= " - REMOTE_USER: " . $_SERVER['REMOTE_USER'] . "\n";

		$mensagem .= "\n\n--Fim";
		manda_email_vandroiy($adminEMAIL,$assunto, $mensagem);

		// Here we handle the error, displaying HTML, logging, ...
		echo "<script language=\"javascript\">location=(\"http://sifsc.ifsc.usp.br/user/fatalerrorpage.php\");</script>";
	}
}

}
catch (Exception $e)
{
	// Duas definições!
}

// Registering shutdown function
register_shutdown_function('fatalErrorHandler');

?>
