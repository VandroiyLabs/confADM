<?php
	$evento = new Evento();
	$avaliador = new Avaliador();
		
	// Setando o codigo pessoa em uma variavel de secao em vez do objeto pessoa
	if ( isset( $_SESSION['codigo_avaliador'] ) )
	{
		$codigo_avaliador = $_SESSION['codigo_avaliador'];
		$avaliador->find_by_codigo_avaliador( $codigo_avaliador );
		$_SESSION['avaliador'] = $avaliador;
		$_SESSION['codigo_avaliador'] = $codigo_avaliador;
	}
	else
	{
		$avaliador = $_SESSION['avaliador'];
		$codigo_avaliador = $avaliador->get_codigo_avaliador();
		$_SESSION['codigo_avaliador'] = $codigo_avaliador;
	}
	
	// Pegando o evento que estiver aberto
	$evento->find_evento_aberto();
?>
