<?php
	require_once('../../../user/classes/class.evento.php');
	$evento = new Evento();
	$evento->find_evento_aberto();
	
	$evento->set_certificados_disponiveis($_POST['certificados_disponiveis']);
	$evento->set_threshold_participacao($_POST['threshold_participacao']);
	$evento->set_threshold_minicurso($_POST['threshold_minicurso']);

	if($evento->update())
	{
		$_SESSION['msg'] = "Evento atualizado com sucesso!";
	}
	else
	{
		$_SESSION['msg'] = "Ocorreu um erro!";
	}
	
	echo "<script language=\"javascript\">location=(\"http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=certificados\");</script>";		
	
?>
