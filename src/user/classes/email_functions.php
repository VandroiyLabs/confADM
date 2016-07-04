<?php

$ownSMTPserver = "";   // SMTP of the server hosting the system
$ownSMTPpasswd = "";   // Password used during smtp auth

$gmailLOGIN  = "";     // login to the gmail option
$gmailPASSWD = "";     // password to the gmail option

// Define below the e-mail used to send error messages.
$adminEMAIL = "";

/*
Aqui temos diversas opcoes de envio de e-mail: usando o proprio servidor,
usando gmail, e casos mais especificos.
*/

function manda_email_admin($destino, $assunto, $mensagem)
{
	// Incluindo arquivo com a classe Mail
	require_once('Mail.php');

	$de         = "organizacao@sifsc.ifsc.usp.br";
	$servidor   = $ownSMTPserver;
	$login      = "organizacao@sifsc.ifsc.usp.br";
	$senha      = $ownSMTPpasswd;

	// Cabeçalho do email
	$headers = array (
		'From'     => "SIFSC <organizacao@sifsc.ifsc.usp.br>",
		'Reply-to' => "SIFSC <semanaifsc@gmail.com>",
		'To'       => $destino,
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
	$mail = $smtp->send($destino, $headers, $mensagem);

	// Verificando se houve erro
	if ( PEAR::isError($mail) )
	{
		return("Error:" . $mail->getMessage());
	}
	else
	{
		return(1);
	}
}

function manda_email_vandroiy($destino, $assunto, $mensagem)
{
	// Incluindo arquivo com a classe Mail
	require_once('Mail.php');

	$de         = "organizacao@sifsc.ifsc.usp.br";
	$servidor   = $ownSMTPserver;
	$login      = "organizacao@sifsc.ifsc.usp.br";
	$senha      = $ownSMTPpasswd;

	// Cabeçalho do email
	$headers = array (
		'From'     => "SIFSC <organizacao@sifsc.ifsc.usp.br>",
		'Reply-to' => "SIFSC <semanaifsc@gmail.com>",
		'To'       => $destino,
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
	$mail = $smtp->send($destino, $headers, $mensagem);

	// Verificando se houve erro
	if ( PEAR::isError($mail) )
	{
		manda_email_admin($adminEMAIL, "[SIFSC] Erro no envio de email", "Problema no envio de emails via vandroiy\n".$destino."\n".$assunto."\n".$mensagem."\nError:" . $mail->getMessage());
		return(0);
	}
	else
	{
		return(1);
	}
}


function manda_email_gmail($destino, $assunto, $mensagem)
{

	require_once('~/public_html/teste/PHPMailer/PHPMailerAutoload.php');
	$mail             = new PHPMailer();
	$mail->IsSMTP();  // telling the class to use SMTP
	$mail->SMTPDebug  = 0;
	$mail->SMTPAuth   = true;
	$mail->SMTPSecure = "tls";
	$mail->Host       = "smtp.gmail.com";
	$mail->Port       = 587;
	$mail->Username   = $gmailLOGIN;  // GMAIL username
	$mail->Password   = $gmailPASSWD;  // GMAIL password

	$mail->SetFrom("organizacaosifsc@gmail.com", 'SIFSC');
	$mail->ClearReplyTos();
	$mail->AddReplyTo("semanaifsc@gmail.com","SIFSC");

	$mail->Subject    = $assunto;
	$mail->Body       = $mensagem;

	$mail->AddAddress($destino);

	// This script check whether connection is being stablished.
	/*$checkconn = fsockopen('smtp.gmail.com', "465", $errno, $errstr, 5);
	if(!$checkconn)
	{
		echo "($errno) $errstr";
	}
	else
	{
		echo "Checkconn: ok<br />\n";
	}*/

	if(!$mail->Send())
	{
		manda_email_admin($adminEMAIL, "[SIFSC] Erro no envio de email", "Problema no envio de emails via gmail\n".$destino."\n".$assunto."\n".$mensagem."\nError:" . $mail->ErrorInfo);
		return(0);
	}
	else
	{
		return(1);
	}
  }


function manda_email_gmail_bcc($destino, $assunto, $mensagem)
{

	require_once('~/public_html/teste/PHPMailer/PHPMailerAutoload.php');
	$mail             = new PHPMailer();
	$mail->IsSMTP();  // telling the class to use SMTP
	$mail->SMTPDebug  = 0;
	$mail->SMTPAuth   = true;
	$mail->SMTPSecure = "tls";
	$mail->Host       = "smtp.gmail.com";
	$mail->Port       = 587;
	$mail->Username   = $gmailLOGIN;  // GMAIL username
	$mail->Password   = $gmailPASSWD;  // GMAIL password

	$mail->SetFrom("organizacaosifsc@gmail.com", 'SIFSC');
	$mail->ClearReplyTos();
	$mail->AddReplyTo("semanaifsc@gmail.com","SIFSC");

	$mail->Subject    = $assunto;
	$mail->Body       = $mensagem;

	//$mail->AddAddress("organizacaosifsc@gmail.com");
	$destspl = explode(",", $destino);
	foreach ($destspl as $destend)
	{
		$mail->AddBCC($destend);
	}
	//$mail->addCustomHeader("BCC: " . $destino);

	// This script check whether connection is being stablished.
	/*$checkconn = fsockopen('smtp.gmail.com', "465", $errno, $errstr, 5);
	if(!$checkconn)
	{
		echo "($errno) $errstr";
	}
	else
	{
		echo "Checkconn: ok<br />\n";
	}*/

	if(!$mail->Send())
	{
		manda_email_admin($adminEMAIL, "[SIFSC] Erro no envio de email", "Problema no envio de emails via gmail\n".$destino."\n".$assunto."\n".$mensagem."\nError:" . $mail->ErrorInfo);
		return(0);
	}
	else
	{
		return(1);
	}
}




function manda_email_organizacao_vandroiy($destino, $from, $assunto, $mensagem)
{
	// Incluindo arquivo com a classe Mail
	require_once('Mail.php');

	$de         = "organizacao@sifsc.ifsc.usp.br";
	$servidor   = $ownSMTPserver;
	$login      = "organizacao@sifsc.ifsc.usp.br";
	$senha      = $ownSMTPpasswd;

	// Cabeçalho do email
	$headers = array (
		'From'     => $from,
		'Reply-to' => $from,
		'To'       => $destino,
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
	$mail = $smtp->send($destino, $headers, $mensagem);

	// Verificando se houve erro
	if ( PEAR::isError($mail) )
	{
		manda_email_admin($adminEMAIL, "[SIFSC] Erro no envio de email", "Problema no envio de emails via vandroiy\n".$from."\n".$assunto."\n".$mensagem."\nError:" . $mail->getMessage());
		return(0);
	}
	else
	{
		return(1);
	}
}

?>
