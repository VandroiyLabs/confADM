<?php

	session_start();
	session_destroy();

	require_once("./../classes/class.pessoa.php");
	require_once("./../classes/class.inscricao.php");
	require_once("./../classes/class.evento.php");

	$email     = $_POST['email'];
	$senha     = $_POST['senha'];

	$pessoa    = new Pessoa();
	$inscricao = new Inscricao();
	$evento    = new Evento();

	if( $pessoa->find_by_email_senha($email,$senha) )
	{
		$evento->find_evento_aberto();

		// Setting the pessoa variable
		session_start();
		$_SESSION["codigopessoa"] = $pessoa->get_codigo_pessoa();
		$_SESSION["pessoa"] = $pessoa;
		$_SESSION["codigo_pessoa"] = $pessoa->get_codigo_pessoa();

		// Tenta encontrar a inscricao da pessoa
		if ( $inscricao->find_by_pessoa_evento($pessoa->get_codigo_pessoa(),$evento->get_codigo_evento()) )
		{

			// Encontrou a inscricao, mas precisa verificar
			// Se a pessoa jah ativou a conta dela.
			if ( strcmp($inscricao->get_token(), 'ativado') == 0 )
			{
				session_start();
				$_SESSION["inscricao"] = $inscricao;
				header("location: http://sifsc.ifsc.usp.br/user/event/status.php");
			}
			else
			{
				echo "<script>location=(\"http://sifsc.ifsc.usp.br/user/login.php?error=25\")</script>";
			}

		}
		else
		{
			// In this case the user will have access to the user space, but will not
			// be considered automatically for the new event.
			//header("location: http://sifsc.ifsc.usp.br/user/event/status.php");
			echo "<script>location=(\"http://sifsc.ifsc.usp.br/user/login.php?error=1\")</script>";
		}

	}
	else
	{
		echo "<script>location=(\"http://sifsc.ifsc.usp.br/user/login.php?error=2\")</script>";
	}

?>
