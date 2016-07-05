<?php
	require_once('../../../user/classes/class.evento.php');
	require_once('../../../user/classes/class.participante_frequencia.php');
	$evento = new Evento();
	$evento->find_evento_aberto();
	
	$frequencia = new ParticipanteFrequencia();
	$frequencia->find_by_codigo_pessoa($_GET["cp"], $evento->get_codigo_evento() );
	
	$frequencia->set_frequencia_palestras( floatval( $_GET['fp'] ) );
	$frequencia->set_frequencia_minicurso( floatval( $_GET['fm'] ) );
	
	
	if ( $frequencia->update() )
	{
		$_SESSION['msg'] = "Evento atualizado com sucesso!";
	}
	else
	{
		$_SESSION['msg'] = "Ocorreu um erro!";
	}
	
	echo "<script language=\"javascript\">location=(\"http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=showpessoa&cp=" . $_GET['cp'] . "\");</script>";		
	
?>
