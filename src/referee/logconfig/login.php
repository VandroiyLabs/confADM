<?php
	session_start();
	session_destroy();
	
	require_once("./../../user/classes/class.avaliador.php");
	require_once("./../../user/classes/class.evento.php");

	

	$avaliador = new Avaliador();
	$evento = new Evento();
	$evento->find_evento_aberto();

	$email = $_POST['email'];
	$senha = $_POST['senha'];
	
	if( $avaliador->find_by_email_senha( $email, $senha, $evento->get_codigo_evento() ) )
	{
		
		session_start();
		$_SESSION["codigo_avaliador"] = $avaliador->get_codigo_avaliador();
		$_SESSION["avaliador"] = $avaliador;
		$avaliador->set_token('ativado');
		if($avaliador->update())
		{	
			header("location: http://sifsc.ifsc.usp.br/referee/event/status.php");
		}
				
	}
	else
	{
		echo "<script>location=(\"http://sifsc.ifsc.usp.br/referee/login.php?error=2\")</script>";
	}

?>
